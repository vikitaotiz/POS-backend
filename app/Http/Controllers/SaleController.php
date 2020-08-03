<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Sale;
use App\Duplicatesale;
use App\Http\Resources\Sales\SaleResource;
use App\Http\Requests\Sales\CreateSale;
use App\Http\Requests\Sales\UpdateSale;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;

class SaleController extends Controller
{
    public function index()
    {
        $sales = Sale::latest()->get();

        return SaleResource::collection($sales);
    }

    public function duplicates()
    {
        $duplicates = Duplicatesale::latest()->get();

        return SaleResource::collection($duplicates);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    // public function store(CreateSale $request)
    public function store(CreateSale $request)
    {
        $duplicate_data = DB::table('sales')->where('amount', $request->amount)->get();

        if($duplicate_data->count() > 1){

            $sale = Duplicatesale::create([
                'user_order' => $request->user_order,
                'content' => $request->content,
                'payment_mode' => $request->payment_mode,
                'amount' => $request->amount,
                'amount_paid' => $request->amount_paid,
                'balance' => $request->balance,
                'sold' => $request->sold,
                'user_id' => auth()->user()->id
            ]);

        } else {

            $sale = Sale::create([
                'user_order' => $request->user_order,
                'content' => $request->content,
                'payment_mode' => $request->payment_mode,
                'amount' => $request->amount,
                'amount_paid' => $request->amount_paid,
                'balance' => $request->balance,
                'sold' => $request->sold,
                'user_id' => auth()->user()->id
            ]);

            return new SaleResource($sale);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $sale = Sale::findOrFail($id);

        return $sale;
    }


    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateSale $request, $id)
    {
        $sale = Sale::whereId($id)->update([
            'user_order' => $request->user_order,
            'content' => $request->content,
            'payment_mode' => $request->payment_mode,
            'amount' => $request->amount,
            'amount_paid' => $request->amount_paid,
            'balance' => $request->balance,
            'sold' => $request->sold,
            'user_id' => auth()->user()->id
        ]);

        return $sale;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $sale = Sale::findOrFail($id);

        $sale->delete();

        return response()->json(['message' => 'Sale deleted successfully!']);
    }

    public function cashSalesIn24hrs(){
        $from = Carbon::now()->startOfDay()->toDateTimeString();
        $to = Carbon::now()->endOfDay()->toDateTimeString();

        $sales = Sale::whereBetween('created_at', [$from, $to])
                    ->where('payment_mode', '=', 'cash')
                    ->get();

        return SaleResource::collection($sales);
    }

    public function mpesaSalesIn24hrs(){
        $from = Carbon::now()->startOfDay()->toDateTimeString();
        $to = Carbon::now()->endOfDay()->toDateTimeString();

        $sales = Sale::whereBetween('created_at', [$from, $to])
                    ->where('payment_mode', '=', 'mpesa')
                    ->get();

        return SaleResource::collection($sales);
    }

    public function cardSalesIn24hrs(){
        $from = Carbon::now()->startOfDay()->toDateTimeString();
        $to = Carbon::now()->endOfDay()->toDateTimeString();

        $sales = Sale::whereBetween('created_at', [$from, $to])
                    ->where('payment_mode', '=', 'card')
                    ->get();

        return SaleResource::collection($sales);
    }

    public function creditSalesIn24hrs(){
        $from = Carbon::now()->startOfDay()->toDateTimeString();
        $to = Carbon::now()->endOfDay()->toDateTimeString();

        $sales = Sale::whereBetween('created_at', [$from, $to])
                    ->where('payment_mode', '=', 'credit')
                    ->get();

        return SaleResource::collection($sales);
    }

    public function allSalesIn24hrs(){
        $from = Carbon::now()->startOfDay()->toDateTimeString();
        $to = Carbon::now()->endOfDay()->toDateTimeString();

        $sales = Sale::whereBetween('created_at', [$from, $to])->get();

        return SaleResource::collection($sales);
    }

    public function salesReport(Request $request){

        if($request->payment_mode){

            $sales = Sale::whereBetween(DB::raw('DATE(created_at)'),
                array($request->from, $request->to))
                ->where('payment_mode', $request->payment_mode)
                ->get();

        } elseif($request->user_id){

            $sales = Sale::whereBetween(DB::raw('DATE(created_at)'),
                array($request->from, $request->to))
                ->where('user_id', $request->user_id)
                ->get();

        } else {
            $sales = Sale::whereBetween(DB::raw('DATE(created_at)'),
                    array($request->from, $request->to))->get();
        }

        return SaleResource::collection($sales);
    }

    public function salesReportAll(Request $request){
        $sales = Sale::whereBetween(DB::raw('DATE(created_at)'),
            array($request->from, $request->to))
            ->where('payment_mode', $request->payment_mode)
            ->where('user_id', $request->user_id)
            ->get();

        return SaleResource::collection($sales);
    }

    public function salesLastSevenDays(){



        $today_sales = Sale::whereDate( 'created_at', Carbon::now()->toDateString())->get();

        $yesterday_sales = Sale::whereDate( 'created_at', Carbon::now()->subDays(1)->toDateString())
           ->get();

        $twoDaysAgo_sales = Sale::whereDate( 'created_at', Carbon::now()->subDays(2)->toDateString())
           ->get();

        $threeDaysAgo_sales = Sale::whereDate( 'created_at', Carbon::now()->subDays(3)->toDateString())
           ->get();

        $fourDaysAgo_sales = Sale::whereDate( 'created_at', Carbon::now()->subDays(4)->toDateString())
           ->get();

        $fiveDaysAgo_sales = Sale::whereDate( 'created_at', Carbon::now()->subDays(5)->toDateString())
           ->get();

        $sixDaysAgo_sales = Sale::whereDate( 'created_at', Carbon::now()->subDays(6)->toDateString())
           ->get();

        $sales = array(
            $today_sales->count(),
            $yesterday_sales->count(),
            $twoDaysAgo_sales->count(),
            $threeDaysAgo_sales->count(),
            $fourDaysAgo_sales->count(),
            $fiveDaysAgo_sales->count(),
            $sixDaysAgo_sales->count()
        );

        return $sales;
    }
}

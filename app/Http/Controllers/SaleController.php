<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
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
        $start = Carbon::now()->startOfMonth();
        $end = Carbon::now();

        $sales15 = Sale::whereBetween('created_at', [$start, $end])->orderBy('created_at', 'DESC')->get();
        $salez15 = Duplicatesale::whereBetween('created_at', [$start, $end])->orderBy('created_at', 'DESC')->get();

        $sales = $sales15->concat($salez15);

        return SaleResource::collection($sales);
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
        $duplicate_data = Sale::where('content', $request->content)
                ->where('payment_mode', $request->payment_mode)
                ->where('amount', $request->amount)
                ->where('user_id', auth()->user()->id)
                ->first();

        if($duplicate_data){

            $sale = Duplicatesale::create([
                'user_order' => $request->user_order,
                'content' => $request->content,
                'payment_mode' => $request->payment_mode,
                'amount' => $request->amount,
                'amount_paid' => $request->amount_paid,
                'balance' => $request->balance,
                'creditor_name' => $request->creditor_name,
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
                'creditor_name' => $request->creditor_name,
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

    public function clear_credit(Request $request){

        $user = User::where('name', $request->user)->first();

        $sales30 = Sale::where('content', $request->content)
                    ->where('payment_mode', 'credit')
                    ->where('amount', $request->amount)
                    ->where('user_id', $user->id)
                    ->first();

        $salez30 = Duplicatesale::where('content', $request->content)
                    ->where('payment_mode', 'credit')
                    ->where('amount', $request->amount)
                    ->where('user_id', $user->id)
                    ->first();

        if($sales30){

            $sale = Sale::whereId($sales30->id)->update([
                'user_order' => $request->user_order,
                'content' => $request->content,
                'payment_mode' => $request->payment_mode,
                'amount' => $request->amount,
                'sold' => 1,
                'user_id' => auth()->user()->id
            ]);

            return $sale;
        } else {

            $sale = Duplicatesale::whereId($salez30->id)->update([
                'user_order' => $request->user_order,
                'content' => $request->content,
                'payment_mode' => $request->payment_mode,
                'amount' => $request->amount,
                'sold' => 1,
                'user_id' => auth()->user()->id
            ]);

            return $sale;
        }

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

        $sales16 = Sale::whereBetween('created_at', [$from, $to])
                    ->where('payment_mode', '=', 'cash')
                    ->get();

        $salez16 = Duplicatesale::whereBetween('created_at', [$from, $to])
                    ->where('payment_mode', '=', 'cash')
                    ->get();

        $sales = $sales16->concat($salez16);

        return SaleResource::collection($sales);
    }

    public function mpesaSalesIn24hrs(){
        $from = Carbon::now()->startOfDay()->toDateTimeString();
        $to = Carbon::now()->endOfDay()->toDateTimeString();

        $sales17 = Sale::whereBetween('created_at', [$from, $to])
                    ->where('payment_mode', '=', 'mpesa')
                    ->get();
        $salez17 = Duplicatesale::whereBetween('created_at', [$from, $to])
                    ->where('payment_mode', '=', 'mpesa')
                    ->get();

        $sales = $sales17->concat($salez17);

        return SaleResource::collection($sales);
    }

    public function cardSalesIn24hrs(){
        $from = Carbon::now()->startOfDay()->toDateTimeString();
        $to = Carbon::now()->endOfDay()->toDateTimeString();

        $sales18 = Sale::whereBetween('created_at', [$from, $to])
                    ->where('payment_mode', '=', 'card')
                    ->get();

        $salez18 = Duplicatesale::whereBetween('created_at', [$from, $to])
                    ->where('payment_mode', '=', 'card')
                    ->get();

        $sales = $sales18->concat($salez18);

        return SaleResource::collection($sales);
    }

    public function creditSalesIn24hrs(){
        $from = Carbon::now()->startOfDay()->toDateTimeString();
        $to = Carbon::now()->endOfDay()->toDateTimeString();

        $sales19 = Sale::whereBetween('created_at', [$from, $to])
                    ->where('payment_mode', '=', 'credit')
                    ->get();

        $salez19 = Duplicatesale::whereBetween('created_at', [$from, $to])
                    ->where('payment_mode', '=', 'credit')
                    ->get();

        $sales = $sales19->concat($salez19);

        return SaleResource::collection($sales);
    }

    public function allSalesIn24hrs(){
        $from = Carbon::now()->startOfDay()->toDateTimeString();
        $to = Carbon::now()->endOfDay()->toDateTimeString();

        $sales20 = Sale::whereBetween('created_at', [$from, $to])->get();
        $salez20 = Duplicatesale::whereBetween('created_at', [$from, $to])->get();

        $sales = $sales20->concat($salez20);

        return SaleResource::collection($sales);
    }

    public function salesReport(Request $request){

        if($request->payment_mode){
            $sales11 = Sale::whereBetween(DB::raw('DATE(created_at)'),
                array($request->from, $request->to))
                ->where('payment_mode', $request->payment_mode)
                ->get();

            $salez11 = Duplicatesale::whereBetween(DB::raw('DATE(created_at)'),
                array($request->from, $request->to))
                ->where('payment_mode', $request->payment_mode)
                ->get();

            $sales = $sales11->concat($salez11);

        } elseif($request->user_order){

            $sales12 = Sale::whereBetween(DB::raw('DATE(created_at)'),
                array($request->from, $request->to))
                ->where('user_order', $request->user_order)
                ->get();

            $salez12 = Duplicatesale::whereBetween(DB::raw('DATE(created_at)'),
                array($request->from, $request->to))
                ->where('user_order', $request->user_order)
                ->get();

            $sales = $sales12->concat($salez12);

        } else {
            $sales13 = Sale::whereBetween(DB::raw('DATE(created_at)'),
                    array($request->from, $request->to))->get();
            $salez13 = Duplicatesale::whereBetween(DB::raw('DATE(created_at)'),
                    array($request->from, $request->to))->get();
            $sales = $sales13->concat($salez13);
        }

        return SaleResource::collection($sales);
    }

    public function salesReportAll(Request $request){
        $sales10 = Sale::whereBetween(DB::raw('DATE(created_at)'),
            array($request->from, $request->to))
            ->where('payment_mode', $request->payment_mode)
            ->where('user_id', $request->user_order)
            ->get();

        $salez10 = Duplicatesale::whereBetween(DB::raw('DATE(created_at)'),
            array($request->from, $request->to))
            ->where('payment_mode', $request->payment_mode)
            ->where('user_order', $request->user_order)
            ->get();

        $sales = $sales10->concat($salez10);

        return SaleResource::collection($sales);
    }

    public function salesLastSevenDays(){

        $sales1 = Sale::whereDate( 'created_at', Carbon::now()->toDateString())->get();
        $salez1 = Duplicatesale::whereDate( 'created_at', Carbon::now()->toDateString())->get();
        $today_sales = $sales1->concat($salez1);

        $sales2 = Sale::whereDate( 'created_at', Carbon::now()->subDays(1)->toDateString())->get();
        $salez2 = Duplicatesale::whereDate( 'created_at', Carbon::now()->subDays(1)->toDateString())->get();
        $yesterday_sales = $sales2->concat($salez2);

        $sales3 = Sale::whereDate( 'created_at', Carbon::now()->subDays(2)->toDateString())->get();
        $salez3 = Duplicatesale::whereDate( 'created_at', Carbon::now()->subDays(2)->toDateString())->get();
        $twoDaysAgo_sales = $sales3->concat($salez3);

        $sales4 = Sale::whereDate( 'created_at', Carbon::now()->subDays(3)->toDateString())->get();
        $salez4 = Duplicatesale::whereDate( 'created_at', Carbon::now()->subDays(3)->toDateString())->get();
        $threeDaysAgo_sales = $sales4->concat($salez4);

        $sales5 = Sale::whereDate( 'created_at', Carbon::now()->subDays(4)->toDateString())->get();
        $salez5 = Duplicatesale::whereDate( 'created_at', Carbon::now()->subDays(4)->toDateString())->get();
        $fourDaysAgo_sales = $sales5->concat($salez5);

        $sales6 = Sale::whereDate( 'created_at', Carbon::now()->subDays(5)->toDateString())->get();
        $salez6 = Duplicatesale::whereDate( 'created_at', Carbon::now()->subDays(5)->toDateString())->get();
        $fiveDaysAgo_sales = $sales6->concat($salez6);

        $sales7 = Sale::whereDate( 'created_at', Carbon::now()->subDays(6)->toDateString())->get();
        $salez7 = Duplicatesale::whereDate( 'created_at', Carbon::now()->subDays(6)->toDateString())->get();
        $sixDaysAgo_sales = $sales7->concat($salez7);

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

<?php

namespace App\Http\Controllers;

use App\Duplicatesale;
use Illuminate\Http\Request;
use App\User;
use App\Http\Resources\Users\UsersResource;
use App\Http\Resources\Users\UserResource;
use App\Http\Requests\RegisterRequest;
use Illuminate\Support\Facades\Redis;
use Carbon\Carbon;
use App\Sale;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function index()
    {
        // Redis::flushall();
        // if(Redis::exists('users')){
            // return json_decode(Redis::get('users'));
        // }
        // else {
            $users = User::latest()->get();
            // Redis::set('users', $users);
            // return $users;
            return UsersResource::collection($users);
        // }

    }

    public function user_sales(){
        $from = Carbon::now()->startOfDay()->toDateTimeString();
        $to = Carbon::now()->endOfDay()->toDateTimeString();

        $sale1_victor = Sale::whereBetween('created_at', [$from, $to])->where('user_order', 'Victor')->sum('amount');
        $sale2_victor = Duplicatesale::whereBetween('created_at', [$from, $to])->where('user_order', 'Victor')->sum('amount');
        $sale3_victor = Sale::whereBetween('created_at', [$from, $to])->where('user_order', 'Victor')->count();
        $sale4_victor = Duplicatesale::whereBetween('created_at', [$from, $to])->where('user_order', 'Victor')->count();

        $sale1_charles = Sale::whereBetween('created_at', [$from, $to])->where('user_order', 'Charles')->sum('amount');
        $sale2_charles = Duplicatesale::whereBetween('created_at', [$from, $to])->where('user_order', 'Charles')->sum('amount');
        $sale3_charles = Sale::whereBetween('created_at', [$from, $to])->where('user_order', 'Charles')->count();
        $sale4_charles = Duplicatesale::whereBetween('created_at', [$from, $to])->where('user_order', 'Charles')->count();

        $sale1_mario = Sale::whereBetween('created_at', [$from, $to])->where('user_order', 'Mario')->sum('amount');
        $sale2_mario = Duplicatesale::whereBetween('created_at', [$from, $to])->where('user_order', 'Mario')->sum('amount');
        $sale3_mario = Sale::whereBetween('created_at', [$from, $to])->where('user_order', 'Mario')->count();
        $sale4_mario = Duplicatesale::whereBetween('created_at', [$from, $to])->where('user_order', 'Mario')->count();

        $sale1_christine = Sale::whereBetween('created_at', [$from, $to])->where('user_order', 'Christine')->sum('amount');
        $sale2_christine = Duplicatesale::whereBetween('created_at', [$from, $to])->where('user_order', 'Christine')->sum('amount');
        $sale3_christine = Sale::whereBetween('created_at', [$from, $to])->where('user_order', 'Christine')->count();
        $sale4_christine = Duplicatesale::whereBetween('created_at', [$from, $to])->where('user_order', 'Christine')->count();

        $sales_victor = Array( 'name' => 'Victor',
                               'daily_sales' => $sale1_victor + $sale2_victor,
                               'sales_count' => $sale3_victor + $sale4_victor);
        $sales_charles = Array( 'name' => 'Charles',
                                'daily_sales' => $sale1_charles + $sale2_charles,
                                'sales_count' => $sale3_charles + $sale4_charles);
        $sales_mario = Array( 'name' => 'Mario',
                              'daily_sales' => $sale1_mario + $sale2_mario,
                              'sales_count' => $sale3_mario + $sale4_mario);
        $sales_christine = Array( 'name' => 'Christine',
                                  'daily_sales' => $sale1_christine + $sale2_christine,
                                  'sales_count' => $sale3_christine + $sale4_christine);

        $sales = Array($sales_victor, $sales_charles, $sales_mario, $sales_christine);

        return $sales;
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(RegisterRequest $request)
    {
        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'role_id' => $request->role_id,
            'department_id' => $request->department_id,
            'pin' => $request->pin,
            'password' => bcrypt($request->password),
            'pwd_clr' => $request->password
        ]);

        return new UsersResource($user);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $user = User::find($id);

        return new UserResource($user);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $user = User::find($id);

        $user->update([
            'name' => $request->name,
            'email' => $request->email,
            'role_id' => $request->role_id,
            'department_id' => $request->department_id,
            'pin' => $request->pin,
            'password' => bcrypt($request->password),
            'pwd_clr' => $request->password
        ]);

        return $user;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $user = User::find($id);

        $user->delete();

        return response()->json(['message' => 'User deleted successfully']);
    }
}

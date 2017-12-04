<?php

namespace App\Http\Controllers;

use App\Product;
use App\Production;
use App\Worker;
use Illuminate\Http\Request;

class ProductionController extends Controller
{
     /**
     * Display a listing of the production.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {



       
        if ($request->filter_worker_name) {
            $worker_name= $request->filter_worker_name;
            $productions=Production::with('worker','product')->where('worker_name',$worker_name)->orderBy('id','desc')->get();
        }elseif($request->start_date && $request->end_date){
            $start_date=$request->start_date;
            $end_date=$request->end_date;

        $start_date=date('Y-m-d',date(strtotime("-1 day", strtotime($start_date))));
        $end_date=date('Y-m-d',date(strtotime("+1 day", strtotime($end_date))));
      
          $productions = Production::orderBy('id','desc')->whereBetween('created_at', [$start_date,$end_date])->get();}
        else{
            $productions=Production::with('worker','product')->orderBy('id','desc')->get();
        }
        
        $workers=Worker::all();
        $products=Product::all();
        return view('admin.production.production_entry.productionList',compact(['productions','workers','products']));

    }



    /**
     * Store a newly created production in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // return $request->all();
        $this->validate($request,[
            'product_name'=>'required',
            'worker_name'=>'required',
            'rate'=>'required',
            'quantity'=>'required',
        ]);
        $input=$request->all();
        $product=Product::whereName($request->product_name)->firstOrFail();
        $worker=Worker::whereName($request->worker_name)->firstOrFail();
        $last_balance=$worker->productions()->orderBy('id','desc')->first();
        if ($last_balance) {
           $old_balance=$last_balance->balance;
        }else{
            $old_balance=0;
        }
        $total=$request->quantity*$request->rate;
        $balance=($total+$old_balance)-$request->paid;
        $input['total']=$total;
        $input['worker_id']=$worker->id;
        $input['product_id']=$product->id;
        $input['balance']=$balance;
        Production::create($input);
        return back()->with('status','Production entry created');


    }

    /**
     * Display the specified production.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }



    /**
     * Update the specified production in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
  
        $input=$request->all();
        $production=Production::findOrFail($id);
        $product=Product::whereName($request->product_name)->firstOrFail();
        $worker=Worker::whereName($request->worker_name)->firstOrFail();
        $last_balance=$worker->productions()->where('id','<>',$id)->orderBy('id','desc')->first();
        if ($last_balance) {
           $old_balance=$last_balance->balance;
        }else{
            $old_balance=0;
        }
        $total=$request->quantity*$request->rate;
        $balance=($total+$old_balance)-$request->paid;
        $input['total']=$total;
        $input['worker_id']=$worker->id;
        $input['product_id']=$product->id;
        $input['balance']=$balance;
        $production->update($input);
        return back()->with('status','Production entry Updated');
    }

    /**
     * Remove the specified production from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}

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



       // check if user search for a specific worker 
        if ($request->filter_worker_name) {
         // get the worker name
            $worker_name= $request->filter_worker_name;
          // get all the production sheet for this user
            $productions=Production::with('worker','product')->where('worker_name',$worker_name)->orderBy('id','desc')->get();

        }
        // check if the user search for production sheet for a date range
        elseif($request->start_date && $request->end_date){
            // grab the start date
            $start_date=$request->start_date;
            // grab the end date
            $end_date=$request->end_date;

       //  -1 day to start date as between helper extract first date
        $start_date=date('Y-m-d',date(strtotime("-1 day", strtotime($start_date))));
        // +1 day to start date as between helper extract first date
        $end_date=date('Y-m-d',date(strtotime("+1 day", strtotime($end_date))));

      // get all the productions of this date range
        $productions = Production::orderBy('id','desc')->whereBetween('created_at', [$start_date,$end_date])->get();}
        else{
            // if there is no search then get all the productions
            $productions=Production::with('worker','product')->orderBy('id','desc')->get();
        }
        
        // get all the workers for search filter and production entry dropdown
        $workers=Worker::all();
         // get all the Product for search filter and production entry dropdown
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

        // get all the request data and store in input variable
        $input=$request->all();
        // find the product using the selected product name
        $product=Product::whereName($request->product_name)->firstOrFail();
         // find the worker using the selected worker name
        $worker=Worker::whereName($request->worker_name)->firstOrFail();
        // get the last production entry  of the worker to find last balance
        $last_balance=$worker->productions()->orderBy('id','desc')->first();
        if ($last_balance) {
            // old balance from last production entry 
           $old_balance=$last_balance->balance;
        }else{
            $old_balance=0;
        }
 
    // if worker paid then store in $paid variable
      if ($request->paid) {
           $paid=$request->paid;
        }else{
            $paid=0;
        }
        // total amount to be paid 
        $total=$request->quantity*$request->rate;

        // calculate the balance 
        $balance=($total+$old_balance)-$paid;

        // add $total,$worker_id #product_id $balance in $input array
        $input['total']=$total;
        $input['worker_id']=$worker->id;
        $input['product_id']=$product->id;
        $input['balance']=$balance;

        // create the new production entry
        Production::create($input);
        return back()->with('status','Production entry created');


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
     // get all the request data and store in input variable


      


 
 

        $input=$request->all();
        // find the production to be update
        $production=Production::findOrFail($id);
        // find the product using the selected product name
        $product=Product::whereName($request->product_name)->firstOrFail();
         // find the worker using the selected worker name
        $worker=Worker::whereName($request->worker_name)->firstOrFail();
         // get the last production entry insted of current production  of the worker to find last balance
        $last_balance=$worker->productions()->where('id','<>',$id)->orderBy('id','desc')->first();

         // old balance from last production entry 
        if ($last_balance) {
           $old_balance=$last_balance->balance;
        }else{
            $old_balance=0;
        }

          // if worker paid then store in $paid variable
           if ($request->paid) {
           $paid=$request->paid;
        }else{
            $paid=0;
        }


       // total amount to be paid 
        $total=$request->quantity*$request->rate;

        // calculate the balance 
        $balance=($total+$old_balance)-$paid;

        // add $total,$worker_id #product_id $balance in $input array
        $input['total']=$total;
        $input['worker_id']=$worker->id;
        $input['product_id']=$product->id;
        $input['balance']=$balance;
  // Update production entry
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

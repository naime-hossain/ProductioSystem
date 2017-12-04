<?php

namespace App\Http\Controllers;

use App\Worker;
use Illuminate\Http\Request;

class WorkerController extends Controller
{
    /**
     * Display a listing of the worker.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $workers=Worker::all();
        return view('admin.production.worker.workerList',compact('workers'));
    }



    /**
     * Store a newly created worker in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
       $this->validate($request,[
         'name'=>'required',
       ]);
    $input=$request->all();
       Worker::create($input);
       return back()->with('status','Worker created succesfully');
   }  

  


    /**
     * Update the specified worker in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
       $worker=Worker::find($id);
       $input=$request->all();
       $worker->update($input);
       return back()->with(['status'=>'Worker Updated']);
    }

    /**
     * Remove the specified worker from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}

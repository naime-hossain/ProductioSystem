
@extends('admin.layouts.iframemaster')
{{-- @section('title')
Production list
@endsection --}}
@section('contents')
<link rel="stylesheet" href=" https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.7.1/css/bootstrap-datepicker.min.css">
<script
  src="https://code.jquery.com/jquery-3.2.1.min.js"
  integrity="sha256-hwg4gsxgFZhOsEEamdOYGBf13FyQuiTwlAQgxVSNgt4="
  crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.7.1/js/bootstrap-datepicker.min.js">
  
</script>

<div class="content-wrapper no-margin">
  <div class="row">
    <div class="col-sm-12">

@if(Session::has('status'))
      <div class="alert alert-success fade in">
        <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
        {{ Session::get('status') }}
      </div>

      @endif

      <div class="box box-widget" style="margin-bottom: 6px;">
        <div class="box-header with-border">
          <i class="fa fa-th"></i>
          <h3 class="box-title">Production List</h3><br>
          <div class="row"  style="overflow: hidden;margin-top: 20px">
             <div class="product_filter col-md-6">
                  <form class="" role="form" id="form" method="GET" action="{{route('production.index')}}">
                    {{ csrf_field() }}
                    <div class="col-md-6" style="padding: 0px">
                        <div class="form-group" id="worker_name_form_group">
                      {{-- <label for="lst_product_name">Product Name</label> --}}
                      <input type="text" class="form-control csearch" id="worker_name" placeholder="Search By  Worker" {{-- data-url="{{route('saleTempByName')}}" --}} name="filter_worker_name" list = "Wlist" aria-describedby="sizing-addon1" autocomplete = "off" required>
                      <datalist id = "Wlist" >
                        @foreach($workers as $Wlist)
                        <option data-value="{{$Wlist->name}}" value="{{$Wlist->name}}"></option>
                        @endforeach
                      </datalist>
                    </div>
                    </div>
                    <div class="col-md-2" style="padding: 0px">
                      <button type="submit" class="btn btn-primary">Search</button>
                    </div>
                  </form>
                </div> 
    <form action="{{route('production.index') }}" method="GET" role="form" style="z-index: 99;
    overflow: hidden;" class="col-md-6">
         
       {{ csrf_field() }}
         <div class="form-group col-md-5">
           
            <input  id='form_start_date' name='start_date' type="text"  placeholder="Start time: yy-mm-dd" class="form-control">
         </div>
         <div class="form-group col-md-5">
          
            <input  id='form_end_date' name='end_date' type="text" class="form-control" placeholder="End  time: yy-mm-dd" >
         </div>
       
         
         <div class="form-group col-md-1">
         <button type="submit" class="btn btn-primary">Search</button>
       </div>
       </form>
        <script>
     $('#form_start_date').datepicker({

    format: 'yyyy-mm-dd',
 });
     $('#form_end_date').datepicker({

    format: 'yyyy-mm-dd',
 });
    
   </script>
          </div>
         
 <div class="pull-right box-tools">
            
        <div class="box-tools">
          <div class="input-group input-group-sm" style="width: 250px;" >
          {{--   <input type="text" name="q" class="form-control input-xs pull-right customer-search" title="Search By Code, Name, Mobile, Email, Company" placeholder="Search By Code, Name, Mobile" data-url="{{route('customerSearchAjax')}}" autocomplete="off"> --}}
              
            <div class="input-group-btn">
              {{-- <button type="button" class="btn btn-warning"><i class="fa fa-search"></i></button> --}}
 
         
 
              <button type="button" class="btn btn-primary btn-xs" data-toggle="modal" data-target="#myModal"><span class="fa fa-plus-square"></span> Add  Production entry</button> 
            </div>
          </div>
        </div>
       
   

            <!-- Modal -->
            <div id="myModal" class="modal fade" role="dialog" data-backdrop="static" data-keyboard="false">
              <div class="modal-dialog">
                <!-- Modal content-->
                <div class="modal-content">
                  <div class="modal-header">
                    <button type="button" class="close" style="color:red" data-dismiss="modal">&times;</button>
                    <h4 class="modal-title"><span class="fa fa-plus"></span> New  Item</h4>
                  </div>
                  <form role="form" action="{{route('production.store')}}" method="POST">
                    <div class="modal-body">
                      {!! csrf_field() !!}
                      <div class = "row">
                        
                        <div class = "col-md-6">
                          <div class="form-group has-feedback{{ $errors->has('product_name') ? ' has-error' : '' }}">
                            <label for="text"> Product Name *</label>
                            <input type="text" class="form-control" value="{{ old('product_name') }}" id="product_name" name="product_name" list="plist" autocomplete="off" autofocus required >
                        <datalist id = "plist" >
                          @foreach($products as $plist)
                          <option data-value="{{$plist->name}}" value="{{$plist->name}}">
                           {{--  <input type="text" value="{{ $plist->id }}" hidden> --}}
                          </option>

                          @endforeach
                      </datalist>
                            @if( $errors->has('product_name') )
                            <span class="help-block">{{ $errors->first('product_name') }}</span>
                            @endif
                          </div>
                        </div>

                        <div class = "col-md-6">
                          <div class="form-group has-feedback{{ $errors->has('worker_name') ? ' has-error' : '' }}">
                            <label for="text">Worker Name</label>
                            <input type = "text" class="form-control" id="worker_name" list="wlist" name="worker_name"  autocomplete="off"  required>
                        <datalist id = "wlist" >
                          @foreach($workers as $wlist)
                          <option data-value="{{$wlist->name}}" value="{{$wlist->name}}">
                             {{-- <input type="text" value="{{ $wlist->id }}" hidden> --}}
                          </option>
                         
                          @endforeach
                      </datalist>
                            @if( $errors->has('worker_name') )
                            <span class="help-block">{{ $errors->first('worker_name') }}</span>
                            @endif
                          </div>
                        </div>

                          <div class = "col-md-6">
                          <div class="form-group has-feedback{{ $errors->has('quantity') ? ' has-error' : '' }}">
                            <label for="text">Quantity(piece/kg)</label>
                            <input type = "number" class="form-control"   id="quantity"  name="quantity"  autocomplete="off"  required>
                      
                            @if( $errors->has('quantity') )
                            <span class="help-block">{{ $errors->first('quantity') }}</span>
                            @endif
                          </div>
                        </div>

                        <div class = "col-md-6">
                          <div class="form-group has-feedback{{ $errors->has('rate') ? ' has-error' : '' }}">
                            <label for="text">Rate(tk)</label>
                            <input type = "number" class="form-control"   id="rate"  name="rate"  autocomplete="off"  required>
                      
                            @if( $errors->has('rate') )
                            <span class="help-block">{{ $errors->first('rate') }}</span>
                            @endif
                          </div>
                        </div>

                        <div class = "col-md-6">
                          <div class="form-group has-feedback{{ $errors->has('total') ? ' has-error' : '' }}">
                            <label for="text">Total(tk)</label>
                            <input type = "number" class="form-control"   id="total"  name="total"  autocomplete="off" disabled   required>
                      
                            @if( $errors->has('total') )
                            <span class="help-block">{{ $errors->first('total') }}</span>
                            @endif
                          </div>
                        </div>

                          <div class = "col-md-6">
                          <div class="form-group has-feedback{{ $errors->has('paid') ? ' has-error' : '' }}">
                            <label for="text">paid(tk)</label>
                            <input type = "number" class="form-control" id="paid"    name="paid"  autocomplete="off"  >
                      
                            @if( $errors->has('paid') )
                            <span class="help-block">{{ $errors->first('paid') }}</span>
                            @endif
                          </div>
                        </div>
                
                       
                      </div>

                  
                    <div class="modal-footer">
                     <button type="submit" name="btnSubmit" class="btn btn-success pull-right"><span class="fa fa-check"></span> Save</button> 
                   </div>

                 </form>
               </div>
             </div>
           </div>
         </div>
       </div>


         <div class="box-body" id="printArea">


          <table   class="table table-bordered text-center table-condensed">
            <thead>
              <tr>
                <th style = "min-width:50px;">Serial</th>
                <th style = "min-width:150px;">Date</th>
                
                <th style="min-width:100px;" align="left">Worker Name</th>
                <th style="min-width:100px;">Product Name</th>
                <th style="min-width:100px;">Quantity(kg)</th>
                <th style="min-width:100px;">Rate(tk)</th>
                <th style="min-width:100px;">Total(tk)</th>
                <th style="min-width:100px;">Paid(tk)</th>
                <th style="min-width:100px;">Balance(tk)</th>
              
                
                <th class="dontprint" style="min-width:100px">Action</th>
              </tr>
            </thead>
       




      <div class="customer-table-body">

      	 <div class="box-widget box no-padding" style="margin-bottom: 6px;">
        <div class="box-body ">
          <table class="table table-bordered table-condensed no-padding">
            <tbody>
            	@if ($productions->count()>0)
   
      @foreach($productions as $key=>$production)

      
              <tr>
         
            
                 <td style="min-width:50px;" align="center">{{$key+1}}</td>
                 <td style="min-width:150px;" align="center">{{$production->created_at->toFormattedDateString()}}</td>
            
             
                <td style="min-width: 100px;" align="left">
                  
                   {{$production->worker_name}} 
                </td>


                <td style="min-width: 100px;" align="center">
                  {{$production->product_name}}
                </td>


                <td style="min-width: 100px;text-align: right" align="left">
                  
                   {{$production->quantity}} 
                </td>

                <td style="min-width: 100px;text-align: right" align="left">
                  
                   {{$production->rate}} 
                </td>


                <td style="min-width: 100px;text-align: right" align="left">
                  
                   {{$production->total}} 
                </td>

                <td style="min-width: 100px;text-align: right" align="left">
                  
                   {{$production->paid}} 
                </td>

                <td style="min-width: 100px;text-align: right" align="left">
                  
                   {{$production->balance}} 
                </td>
               

 
            
                 
 
                <td class="dontprint" style="min-width: 100px;" align="center">
                      <div class="btn-group btn-group-xs">
                    
                    
                    <a href="#" data-toggle="modal" data-target="#myEditModal{{$production->id}}">
                          <span class="fa fa-edit"></span> Edit/Pay</a>
                    
                    </div>

                    </td>

                    
              </tr>


              <!--Edit Modal -->
                  <div id="myEditModal{{$production->id}}" class="modal fade" role="dialog" data-backdrop="static" data-keyboard="false">
                    <div class="modal-dialog">

                      <!-- Modal content-->
                      <div class="modal-content">
                        <div class="modal-header">
                          <button type="button" class="close" style="color:red" data-dismiss="modal">&times;</button>
                          <h4 class="modal-title"><span class="fa fa-plus"></span> Update production entry</h4>
                        </div>
                        <form role="form" action="{{route('production.update',$production->id)}}" method="POST">
                          <div class="modal-body">
                            {!! csrf_field() !!}
                           <div class = "row">
                        {{ method_field('put') }}
                   
                        
                        <div class = "col-md-6">
                          <div class="form-group has-feedback{{ $errors->has('product_name') ? ' has-error' : '' }}">
                            <label for="text">work item Name </label>
                            <input type="text" class="form-control"  id="update_product_name" name="product_name" list="plist" autocomplete="off" autofocus required 
                            value="{{$production->product_name}}">
                        <datalist id = "plist" >
                          @foreach($products as $plist)
                          <option data-value="{{$plist->name}}" value="{{$plist->name}}">
                           {{--  <input type="text" value="{{ $plist->id }}" hidden> --}}
                          </option>

                          @endforeach
                      </datalist>
                            @if( $errors->has('product_name') )
                            <span class="help-block">{{ $errors->first('product_name') }}</span>
                            @endif
                          </div>
                        </div>

                        <div class = "col-md-6">
                          <div class="form-group has-feedback{{ $errors->has('worker_name') ? ' has-error' : '' }}">
                            <label for="text">Worker Name</label>
                            <input type = "text" class="form-control" id="update_worker_name" list="wlist" name="worker_name"  autocomplete="off"  required value="{{ $production->worker_name }}">
                        <datalist id = "wlist"  >
                          @foreach($workers as $wlist)
                          <option data-value="{{$wlist->name}}" value="{{$wlist->name}}">
                             {{-- <input type="text" value="{{ $wlist->id }}" hidden> --}}
                          </option>
                         
                          @endforeach
                      </datalist>
                            @if( $errors->has('worker_name') )
                            <span class="help-block">{{ $errors->first('worker_name') }}</span>
                            @endif
                          </div>
                        </div>

                          <div class = "col-md-6">
                          <div class="form-group has-feedback{{ $errors->has('quantity') ? ' has-error' : '' }}">
                            <label for="text">Quantity(piece/kg)</label>
                            <input type = "number" class="form-control"   id="update_quantity"  name="quantity"  autocomplete="off"  required value="{{ $production->quantity }}">
                      
                            @if( $errors->has('quantity') )
                            <span class="help-block">{{ $errors->first('quantity') }}</span>
                            @endif
                          </div>
                        </div>

                        <div class = "col-md-6">
                          <div class="form-group has-feedback{{ $errors->has('rate') ? ' has-error' : '' }}">
                            <label for="text">Rate(tk)</label>
                            <input type = "number" class="form-control"   id="update_rate"  name="rate"  autocomplete="off"  required value="{{ $production->rate }}">
                      
                            @if( $errors->has('rate') )
                            <span class="help-block">{{ $errors->first('rate') }}</span>
                            @endif
                          </div>
                        </div>

                        <div class = "col-md-6">
                          <div class="form-group has-feedback{{ $errors->has('total') ? ' has-error' : '' }}">
                            <label for="text">Total(tk)</label>
                            <input type = "number" class="form-control"   id="update_total"  name="total" value="{{ $production->total }}"  autocomplete="off" disabled   required>
                      
                            @if( $errors->has('total') )
                            <span class="help-block">{{ $errors->first('total') }}</span>
                            @endif
                          </div>
                        </div>

                          <div class = "col-md-6">
                          <div class="form-group has-feedback{{ $errors->has('paid') ? ' has-error' : '' }}">
                            <label for="text">paid(tk)</label>
                            <input type = "number" class="form-control" id="paid"    name="paid"  autocomplete="off" value="{{ $production->paid }}" >
                      
                            @if( $errors->has('paid') )
                            <span class="help-block">{{ $errors->first('paid') }}</span>
                            @endif
                          </div>
                        </div>
                
                       
                     

                  
                       
                      </div>

                          </div>
                          <div class="modal-footer">
                           <button type="submit" name="btnSubmit" class="btn btn-success pull-right"><span class="fa fa-check"></span> Update  Production</button> 
                         </div>
                       </form>
                 </div> 
               </div>
             </div>

    
    
            
          
     
      @endforeach
        </tbody>
          </table>


        </div>
      </div>
        <a href="#" onclick="printDiv('printArea')" class="btn btn-md btn-primary">Print</a>
          
        

    @endif
       <script type="text/javascript">
             function printDiv(divName) {
     var printContents = document.getElementById(divName).innerHTML;
     var originalContents = document.body.innerHTML;

     document.body.innerHTML = printContents;

     window.print();

     document.body.innerHTML = originalContents;}

       $("#quantity").on('keyup', function(){
        $("#total").val(0);
    var quantity =  Number($(this).val());

       var rate = Number($('#rate').val());
       var total =  quantity*rate;
       
        // alert('ok');
    $("#total").val(total);
    
  });




    $("#rate").on('keyup', function(){
      $("#total").val(0);
   var rate =  Number($(this).val());

      var  quantity = Number($('#quantity').val());
       var total =  quantity*rate;
       
        // alert('ok');
    $("#total").val(total);
  }); 




    $("#update_quantity").on('keyup', function(){
        $("#update_total").val(0);
    var quantity =  Number($(this).val());

       var rate = Number($('#update_rate').val());
       var total =  quantity*rate;
       
        // alert('ok');
    $("#update_total").val(total);
    
  });

    $("#update_rate").on('keyup', function(){
      $("#update_total").val(0);
   var rate =  Number($(this).val());

      var  quantity = Number($('#update_quantity').val());
       var total =  quantity*rate;
       
        // alert('ok');
    $("#update_total").val(total);
  }); 


           </script>
      	 </div>
      	       </div>
       </div>

     </div>

@endsection
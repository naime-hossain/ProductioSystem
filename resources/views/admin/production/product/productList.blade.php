
@extends('admin.layouts.iframemaster')
{{-- @section('title')
Product list
@endsection --}}
@section('contents')

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
          <h3 class="box-title"> Product List</h3><br>
        <div class="pull-right box-tools">
            <form class="pull-right">
            <div class="box-tools">
            <div class="input-group input-group-sm" style="width: 250px;" >
            {{--   <input type="text" name="q" class="form-control input-xs pull-right customer-search" title="Search By Code, Name, Mobile, Email, Company" placeholder="Search By Code, Name, Mobile" data-url="{{route('customerSearchAjax')}}" autocomplete="off"> --}}
                
              <div class="input-group-btn">
                {{-- <button type="button" class="btn btn-warning"><i class="fa fa-search"></i></button> --}}
   
           
   
                <button type="button" class="btn btn-primary btn-xs" data-toggle="modal" data-target="#myModal"><span class="fa fa-plus-square"></span> Add new  Product</button> 
              </div>
            </div>
          </div>
          </form>
          {{-- end of form --}}
   

            <!-- Modal -->
            <div id="myModal" class="modal fade" role="dialog" data-backdrop="static" data-keyboard="false">
              <div class="modal-dialog">
                <!-- Modal content-->
                <div class="modal-content">
                  <div class="modal-header">
                    <button type="button" class="close" style="color:red" data-dismiss="modal">&times;</button>
                    <h4 class="modal-title"><span class="fa fa-plus"></span> New  Product</h4>
                  </div>
                  <form role="form" action="{{route('product.store')}}" method="POST">
                    <div class="modal-body">
                      {!! csrf_field() !!}
                      <div class = "row">
                        
                        <div class = "col-md-6">
                          <div class="form-group has-feedback{{ $errors->has('name') ? ' has-error' : '' }}">
                            <label for="text"> Product Name *</label>
                            <input type="text" class="form-control" value="{{ old('name') }}" id="name" name="name"  autocomplete="off" autofocus required >
                            @if( $errors->has('name') )
                            <span class="help-block">{{ $errors->first('name') }}</span>
                            @endif
                          </div>
                        </div>

                        <div class = "col-md-6">
                          <div class="form-group has-feedback{{ $errors->has('description') ? ' has-error' : '' }}">
                            <label for="text">Product description</label>
                            <input type = "text" class="form-control" id="description" name="description"  autocomplete="off"  >

                            @if( $errors->has('description') )
                            <span class="help-block">{{ $errors->first('description') }}</span>
                            @endif
                          </div>
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
           {{-- end of modal --}}
         </div>
       </div>

         <div class="box-body" id="printArea">


          <table   class="table table-bordered text-center table-condensed">
            <thead>
              <tr>
                <th style = "width:50px;">Serial</th>
                
                <th style="width:200px;" align="left">Product Name</th>
                <th style="width:200px;">Description</th>
              
                
                <th class="dontprint" style="width:150px">Action</th>
              </tr>
            </thead>
       




      <div class="customer-table-body">

      	 <div class="box-widget box no-padding" style="margin-bottom: 6px;">
        <div class="box-body ">
          <table class="table table-bordered table-condensed no-padding">
            <tbody>
            	@if ($products->count()>0)
   
      @foreach($products as $key=>$product)

      
              <tr>
         
            
                 <td style="width: 50px;" align="center">{{$key+1}}</td>
            
             
                <td style="width: 200px;" align="left">
                  
                   {{$product->name}} 
                </td>
                <td style="width: 200px;" align="center">
                  {{$product->description}}
                </td>
               

 
            
                 
 
                <td class="dontprint" style="width: 150px;" align="center">
                      <div class="btn-group btn-group-xs">
                    
                    
                    <a href="#" data-toggle="modal" data-target="#myEditModal{{$product->id}}">
                          <span class="fa fa-edit"></span> Edit</a>
                    
                    </div>

                    </td>

                    
              </tr>


              <!--Edit Modal -->
                  <div id="myEditModal{{$product->id}}" class="modal fade" role="dialog" data-backdrop="static" data-keyboard="false">
                    <div class="modal-dialog">

                      <!-- Modal content-->
                      <div class="modal-content">
                        <div class="modal-header">
                          <button type="button" class="close" style="color:red" data-dismiss="modal">&times;</button>
                          <h4 class="modal-title"><span class="fa fa-plus"></span> Update Product</h4>
                        </div>
                        <form role="form" action="{{route('product.update',$product->id)}}" method="POST">
                          <div class="modal-body">
                            {!! csrf_field() !!}
                           <div class = "row">
                        {{ method_field('put') }}
                        <div class = "col-md-6">
                          <div class="form-group has-feedback{{ $errors->has('name') ? ' has-error' : '' }}">
                            <label for="text">product Name *</label>
                            <input type="text" class="form-control" value="{{ $product->name }}" id="name" name="name"  autocomplete="off" autofocus >
                            @if( $errors->has('name') )
                            <span class="help-block">{{ $errors->first('name') }}</span>
                            @endif
                          </div>
                        </div>

                        <div class = "col-md-6">
                          <div class="form-group has-feedback{{ $errors->has('description') ? ' has-error' : '' }}">
                            <label for="text">product description</label>
                            <input type = "text" class="form-control" id="description" name="description"  autocomplete="off"  value="{{ $product->description }}">

                            @if( $errors->has('description') )
                            <span class="help-block">{{ $errors->first('description') }}</span>
                            @endif
                          </div>
                        </div>

                  
                       
                      </div>

                          </div>
                          <div class="modal-footer">
                           <button type="submit" name="btnSubmit" class="btn btn-success pull-right"><span class="fa fa-check"></span> Update Product</button> 
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
          
           <script type="text/javascript">
             function printDiv(divName) {
     var printContents = document.getElementById(divName).innerHTML;
     var originalContents = document.body.innerHTML;

     document.body.innerHTML = printContents;

     window.print();

     document.body.innerHTML = originalContents;
}
           </script>

    @endif
      	 </div>
      	       </div>
       </div>

     </div>
     {{-- end of col-12 --}}
   </div>
   {{-- end of row --}}
 </div>
 {{-- end of content_wraper --}}
@endsection
@extends('admin.layouts.master')

@section('contents')

  <section class="content" style="margin-top:-13px;">
  <div class="row hidden-sm hidden-xs">
    <div class="col col-md-12 col-lg-12">
      <!-- Application buttons -->
      <div class="box box-widget">
        <div class="box-body">
          <a href="" target="iBody" class="btn btn-app bg-blue quick-link" title="Retail Sale">
              <i class="fa fa-shopping-cart"></i> Retail Sales
            </a>
         
 
          <div class="pull-right">

            

            <a href="" class="btn btn-app bg-green">
               Today Sale <br><span style="font-size: 20px;">{{Auth::user()->name}}</span> TK
             </a>
          
          </div>          
        </div><!-- /.box-body -->
      </div><!-- /.box -->          
    </div>
  </div>
  <div class="row">
    <div class="col col-md-12">
      <iframe name="iBody" src="{{route('home')}}" frameborder=no width="100%" height="900px">
      </iframe>
    </div>
  </div>
</section><!-- /.content -->



@endsection()
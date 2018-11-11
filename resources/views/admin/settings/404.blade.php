@extends('layouts.admin1')

@section('header')
@endsection

@section('content')



    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
          
        </section>

        <!-- Main content -->
        <section class="content">
        <div class="error-page text-center">
    <h2 class="headline text-yellow">Oops!</h2>
    <div>
      <h3><i class="fa fa-warning text-yellow"></i> Something Went Wrong !</h3>
      <p> We could not find the page you were looking for.
        Meanwhile, you may <a href="{{URL::previous()}}" class="btn btn-lg btn-success m-t-3"><i class="fa fa-arrow-circle-left"></i> Click Here To Back</a> </p>
      
    </div>
    <!-- /.error-content --> 
  </div>
                <!-- /.error-content -->
            </div>
            <!-- /.error-page -->
        </section>
        <!-- /.content -->
    </div>
    <!-- /.content-wrapper -->

@endsection

@section('footer')


@endsection

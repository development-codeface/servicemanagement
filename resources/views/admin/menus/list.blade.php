@extends('layouts.admin')

@section('header')
@endsection

@section('content')



    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <h5>
                <ol class="breadcrumb">
                    <li><a href="{{ URL::route('Menus') }}"><i class="fa fa-dashboard"></i> Home</a></li>
                    <li class="active">Menus</li>
                </ol>
            </h5>

        </section>

        <!-- Main content -->
        <section class="content">
            <div class="row">
                <div class="col-xs-12">
                    <div class="box">
                        <!-- <div class="box-header">
                            <h3 class="box-title"><a href="{{ URL::route('NewMenu') }}"  class="btn btn-info">Create New </a></h3>
                        </div> -->
                        <!-- /.box-header -->
                        <div class="box-body">
                            <table id="sorting" class="table table-bordered table-hover">
                                <thead>
                                <th>Sl No</th>
                                <th>Menu</th>
                                <th>Action</th>
                                </tr>
                                </thead>
                                <tbody>
                                <?php $i =1 ?>
                                @foreach($menus as $menu)

                                    <tr id="tr_{{ $menu->menu_id }}">

                                        <td>{{ $i}}</td>
                                        <td>{{ $menu->menu_name }}</td>
                                        <td>
                                        <span class="tools">
                                            <a  class="btn btn-default btn-xs " href="{{ URL::route("NewMenu", $menu->menu_id ) }}"><i class="fa fa-pencil"></i></a>
                                        </span>
                                        </td>
                                    </tr>
                                    <?php $i ++; ?>
                                @endforeach
                                </tbody>
                                <tfoot>
                            </table>
                        </div>
                        <!-- /.box-body -->
                    </div>
                    <!-- /.box -->

                    <!-- /.box -->
                </div>
                <!-- /.col -->
            </div>
            <!-- /.row -->
        </section>
        <!-- /.content -->
    </div>
    <!-- /.content-wrapper -->


@endsection

@section('footer')
@endsection

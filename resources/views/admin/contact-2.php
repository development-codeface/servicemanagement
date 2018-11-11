<div class="content-wrapper">
        <section class="content-header">
            <h5>
                <ol class="breadcrumb">
                    <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
                    <li class="active"><a href="{{ URL::route('Uploads') }}">List</a></li>
                </ol>
            </h5>
        </section>
        <section class="content">
            <div class="row">
                <div class="col-md-12">
                    <div class="nav-tabs-custom">
                        <div class="tab-content">
                            <div class="tab-pane active" >
                                <div class="box-header with-border">
                                    <h3 class="box-title">Page</h3>
                                </div>
                                <form action="{{url('/post-csv')}}" method="post" id="ajaxForm" enctype="multipart/form-data">
                                    <div class="box-body">
                                        <div class="form-group Image">
                                            <label for="exampleInputFile">Image</label>

                                            <input type="file" name="upload-file" class="form-control">
                                        </div>

                                    </div>

                                    <div class="box-footer">
                                        <input type="hidden" name="page_token" value="{{ md5(uniqid(rand(), true)) }}">
                                        <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                        <button type="button" class="btn btn-default"><a href="{{ URL::route('Uploads') }}">Cancel</a></button>
                                        <button type="submit" class="btn btn-info pull-right">Submit</button>
                                    </div>

                                </form>
                            </div>
                        </div>
                    </div>
                </div>

        </section>
    </div>
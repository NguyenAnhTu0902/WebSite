@extends('layouts.adminLTE.layout.master')
@section('content')
    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <section class="content">
            <div class="row">
                <div class="col-lg-1">

                </div>
                <div class="col-lg-10">
                    <div class="card">
                        <div class="card-header">
                            <h5 class="card-title">Edit User</h5>
                        </div>

                        <div class="card-body">  <!-- Start Card body -->
                            <form role="form" action="" method="post">
                                @method('PATCH')
                                @csrf
                                <div class="position-relative row form-group">
                                    <label for="image"
                                           class="col-md-3 text-md-right col-form-label">Avatar</label>
                                    <div class="col-md-9 col-xl-8">
                                        <img style="height: 200px; cursor: pointer;"
                                             class="thumbnail rounded-circle" data-toggle="tooltip"
                                             title="Click to change the image" data-placement="bottom"
                                             src="front/img/user/{{$user->avatar ?? 'default-avatar.jpg'}}" alt="Avatar">
                                        <input name="image" type="file" onchange="changeImg(this)"
                                               class="image form-control-file" style="display: none;" value="">
                                        <input type="hidden" name="image_old" value="{{$user->avatar}}">
                                        <small class="form-text text-muted">
                                            Click on the image to change (required)
                                        </small>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="name" class="col-sm-2 col-form-label">
                                        User Name </label>
                                    <div class="col-sm-10">
                                        <input type="text" class="form-control" name="name" placeholder="Name" value="{{$user->name}}">
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="name" class="col-sm-2 col-form-label">Email </label>
                                    <div class="col-sm-10">
                                        <input type="text" class="form-control" name="email" placeholder="Email" value="{{$user->email}}">
                                    </div>
                                </div>

                                <div class="card-footer">
                                    <button type="submit" class="btn btn-success">Submit</button>
                                    <a href="{{URL::to ('/admin/users')}}" class="btn btn-info">Quay lại</a>
                                </div>

                            </form>
                        </div><!-- End Card body -->


                    </div>
                    <!-- Card-end -->

                </div>
                <div class="col-lg-1">

                </div>

            </div>

        </section>
        <!-- /.content -->
    </div>

    <!-- /.content-wrapper -->
@endsection

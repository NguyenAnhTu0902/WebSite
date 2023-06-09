@extends('layouts.adminLTE.layout.master')
@section('title','Create Users')
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
                            <h5 class="card-title">Create User</h5>
                        </div>

                        <div class="card-body">  <!-- Start Card body -->
                            <form role="form" action="admin/users" method="post" enctype="multipart/form-data">
                                @csrf
                                <div class="form-group row">
                                    <label for="name" class="col-sm-2 col-form-label">
                                        Avatar </label>

                                    <div class="col-sm-10">
                                        <img style="height: 200px; cursor: pointer;"
                                             class="thumbnail" data-toggle="tooltip"
                                             title="Click to change the image" data-placement="bottom"
                                             src="theme/dist/img/add-image-icon.jpg" alt="Avatar">
                                        <input name="image" type="file" onchange="changeImg(this)"
                                               class="image form-control-file" style="display: none;" value="">
                                        <input type="hidden" name="image_old" value="">
                                        <small class="form-text text-muted">
                                            Click on the image to change (required)
                                        </small>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="name" class="col-sm-2 col-form-label">
                                        User Name </label>
                                    <div class="col-sm-10">
                                        <input type="text" class="form-control" name="name" placeholder="Name" >
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="name" class="col-sm-2 col-form-label">Email </label>
                                    <div class="col-sm-10">
                                        <input type="text" class="form-control" name="email" placeholder="Email" >
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="name" class="col-sm-2 col-form-label">PassWord </label>
                                    <div class="col-sm-10">
                                        <input name="password" id="password" placeholder="Password" type="password"
                                               class="form-control" >
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="name" class="col-sm-2 col-form-label">Confirm Password </label>
                                    <div class="col-sm-10">
                                        <input name="password_confirmation" id="password_confirmation" placeholder="Confirm Password" type="password"
                                               class="form-control" >
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="name" class="col-sm-2 col-form-label">Address </label>
                                    <div class="col-sm-10">
                                        <input type="text" class="form-control" name="adress" placeholder="Address" >
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="name" class="col-sm-2 col-form-label">Phone </label>
                                    <div class="col-sm-10">
                                        <input type="text" class="form-control" name="phone" placeholder="Phone">
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="name" class="col-sm-2 col-form-label">Level </label>
                                    <div class="col-sm-10">
                                        <select required name="level" id="level" class="form-control">
                                            @foreach(\App\Utilities\Constant::$user_level as $key => $value)
                                                <option value={{$key}}>
                                                    {{$value}}
                                                </option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="name" class="col-sm-2 col-form-label">Description </label>
                                    <div class="col-sm-10">
                                        <textarea name="description" id="description" class="form-control"></textarea>
                                    </div>
                                </div>

                                <div class="card-footer">
                                    <button type="submit" class="btn btn-success">Submit</button>
                                    <a href="/admin/users" class="btn btn-info">Quay lại</a>
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

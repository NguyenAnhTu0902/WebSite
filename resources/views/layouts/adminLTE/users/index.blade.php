@extends('layouts.adminLTE.layout.master')
@section('content')
    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <section class="content">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-12">

                        <div class="card">
                            <div class="card-header">
                                <h3 class="card-title">All Users</h3>
                                <div class="card-tools">
                                    <form action="">
                                        <div class="input-group input-group-sm" style="width: 150px;">
                                            <input type="search" name="search" id="search" value="{{request('search')}}" class="form-control float-right" placeholder="Search">

                                            <div class="input-group-append">
                                                <button type="submit" class="btn btn-default">
                                                    <i class="fas fa-search"></i>
                                                </button>
                                            </div>
                                        </div>
                                    </form>

                                </div>
                            </div>
                            <br>
                            <div>
                                <a href="" class="btn btn-sm btn-success" style="width:10%; margin-left: 20px;">Create</a>
                            </div>
                            <!-- /.card-header -->
                            <div class="card-body">
                                <table id="example1" class="table table-bordered table-striped">
                                    <thead>
                                    <tr>
                                        <th>ID</th>
                                        <th>Avatar</th>
                                        <th>User</th>
                                        <th>Date</th>
                                        <th>Level</th>
                                        <th>Action</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @foreach($users as $user)
                                        <tr>
                                            <td>{{ $user->id }}</td>
                                            <td><img style="width: 60px; height: 60px;" src="front/img/user/{{$user->avatar ?? 'default-avatar.jpg'}}" alt="user-avatar" class="img-circle img-fluid"></td>
                                            <td>{{ $user->name }}</td>
                                            <td>{{ $user->created_at }}</td>
                                            <td>{{\App\Utilities\Constant::$user_level[$user->level]}}</td>
                                            <td>
                                                <a href="" class="btn btn-info">Edit</a>
                                                <a onclick="deleteData({{ $user->id }})" class="btn btn-danger">Delete</a>
                                            </td>
                                        </tr>
                                    @endforeach
                                    </tbody>
                                </table>
                            </div>
                            <!-- /.card-body -->
                            <div class="d-block card-footer">
                                {{$users->links()}}
                            </div>
                        </div>
                        <!-- /.card -->
                    </div>
                    <!-- /.col -->
                </div>
                <!-- /.row -->
            </div>
            <!-- /.container-fluid -->
        </section>
        <!-- /.content -->
    </div>

    <!-- /.content-wrapper -->
@endsection

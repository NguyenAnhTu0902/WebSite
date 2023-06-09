@extends('layouts.adminLTE.layout.master')
@section('title','Orders')
@section('content')
    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <section class="content">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-12">

                        <div class="card">
                            <div class="card-header">
                                <h3 class="card-title">All Orders</h3>
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
                            <!-- /.card-header -->
                            <div class="card-body">
                                <table id="example1" class="table table-bordered table-striped">
                                    <thead>
                                    <tr>
                                        <th>ID</th>
                                        <th>Customer / Products</th>
                                        <th>Address</th>
                                        <th>Amount</th>
                                        <th>Status</th>
                                        <th>Actions</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @foreach($orders as $order)
                                        <tr>
                                            <td class="text-center text-muted">#{{$order->id}}</td>
                                            <td><img style="width: 60px; height: 60px;" src="front/img/user/{{$user->avatar ?? 'default-avatar.jpg'}}" alt="user-avatar" class="img-circle img-fluid"></td>
                                            <td>{{ $user->name }}</td>
                                            <td>{{ $user->created_at }}</td>
                                            <td>{{\App\Utilities\Constant::$user_level[$user->level]}}</td>
                                            <td>
                                                <a href="./admin/users/{{$user->id}}" class="btn btn-info">
                                                    <span class="btn-icon-wrapper opacity-8">
                                                        <i class="fa fa-edit fa-w-20"></i>
                                                    </span>
                                                </a>
                                                <form class="d-inline" action="admin/users/{{$user->id}}" method="post">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button class="btn btn-danger"
                                                            type="submit" data-toggle="tooltip" title="Delete"
                                                            data-placement="bottom"
                                                            onclick="return confirm('Do you really want to delete this item?')">
                                                            <span class="btn-icon-wrapper opacity-8">
                                                                <i class="fa fa-trash fa-w-20"></i>
                                                            </span>
                                                    </button>
                                                </form>
                                            </td>
                                        </tr>
                                    @endforeach
                                    </tbody>
                                </table>
                            </div>
                            <!-- /.card-body -->
                            <div class="d-block card-footer">
                                {{orders->links()}}
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

@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">User Management</div>

                    <div class="card-body">
                        <table class="table table-striped">
                            <thead>
                            <th>Name</th>
                            <th>Email</th>
                            <th>Role</th>
                            <th class="text-center">Action</th>
                            </thead>
                            @foreach($users as $user)
                                <tbody>
                                <td>{{$user->name}}</td>
                                <td>{{$user->email}}</td>
                                <td>{{implode(', ',$user->roles->pluck('name')->toArray()) }}</td>
                                <td style="display: flex; justify-content: space-around;">

                                    <a href="{{route('admin.users.edit',$user)}}" class="btn btn-primary btn-sm">Edit</a>
                                    @can('delete-users')
                                    <form action="{{route('admin.users.destroy',$user)}}" method="POST">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-warning btn-sm">Delete</button>
                                    </form>
@endcan



                                </td>
                                </tbody>
                            @endforeach
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

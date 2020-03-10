@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">Edit {{$user->name}}</div>

                    <div class="card-body">
                        <form action="{{route('admin.users.update',$user)}}" method="post">


                            <div class="form-group row">
                                @csrf
                                @method('PUT')
                                <div class="col-form-label col-md-4  text-md-right">
                                    <label>Name</label>
                                </div>
                                <div class="col-md-6">
                                    <input class="form-control" type="text" value="{{$user->name}}" name="name"/>
                                </div>
                            </div>
                            <div class="form-group row">
                                <div class="col-form-label col-md-4 text-md-right">
                                    <label>Email</label>
                                </div>
                                <div class="col-md-6">
                                    <input class="form-control" type="email" value="{{$user->email}}" name="email"/>
                                </div>
                            </div>
                            <div class="form-group row">
                                <div class="col-form-label col-md-4 col-sm-2 text-md-right">
                                    <label>Role</label>
                                </div>
                                <div class="col-md-6 col-sm-4 ml-4 mt-1">
                                    @foreach(App\Role::all() as $role)
                                        <div class="d-block">
                                            <label>
                                                <input name="roles[]" type="checkbox" class="form-check-input"
                                                       value="{{$role->id}}"
                                                       @if($user->roles->pluck('id')->contains($role->id))
                                                       checked
                                                        @endif

                                                >
                                                {{$role->name}}
                                            </label>
                                        </div>
                                    @endforeach
                                </div>
                                <div class="text-center w-100">
                                    <button type="submit" class="btn btn-primary">
                                        Update
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    </div>
@endsection

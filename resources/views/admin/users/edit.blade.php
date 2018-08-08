@extends('layouts.app')

@section('title', '| Edit User')

@section('content')

<div class="container">
        <div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">修改用户</div>

                <div class="card-body">
                    <form class="form-horizontal" action="{{route('users.update', $user->id)}}" method="post">
                        @csrf
                        {{ method_field('PUT') }}
                        <div class="form-group row">
                            <label for="email" class="col-sm-4 col-form-label text-md-right">用户名:</label>

                            <div class="col-md-6">
                                <input id="name" type="text" class="form-control" name="name" value="{{ $user->name }}" required autofocus>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="email" class="col-sm-4 col-form-label text-md-right">邮箱:</label>

                            <div class="col-md-6">
                                <input id="email" type="email" class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}" name="email" value="{{ $user->email }}" required autofocus>

                                @if ($errors->has('email'))
                                    <span class="invalid-feedback">
                                        <strong>{{ $errors->first('email') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="password" class="col-md-4 col-form-label text-md-right">密码:</label>

                            <div class="col-md-6">
                                <input id="password" type="password" class="form-control" name="password" required>
                            </div>
                        </div>
                    <div class="form-group row">
                        <label class="col-md-4 col-form-label text-md-right">角色:</label>
                        <div class="col-md-3">
                            <select name="roles[]" class="form-control">
                          @foreach($roles as $role)
                            <option value="{{$role->name}}" @if($user->hasRole($role)) selected @endif >{{$role->name}}</option>
                          @endforeach
                            </select>
                        </div>
                    </div>
                        <div class="form-group row mb-0">
                            <div class="col-md-8 offset-md-4">
                                <button type="submit" class="btn btn-primary">
                                提交
                                </button>

                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>


@endsection
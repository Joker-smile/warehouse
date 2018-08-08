@extends('layouts.app')

@section('title', 'Edit User')

@section('content')

<div class="container col-8">
    <div class="card">
        <div class="card-header">修改用户</div>

        <div class="card-body">
            <form action="{{route('users.update', $user->id)}}" method="post">
                @csrf
                {{ method_field('PUT') }}
                <div class="form-group">
                    <label>用户名:</label>

                    <input id="name" type="text" class="form-control" name="name" value="{{ $user->name }}" disabled>
                </div>

                <div class="form-group">
                    <label>密码:</label>

                    <input id="password" type="password" class="form-control" name="password" required>
                </div>

                <button type="submit" class="btn btn-primary">提交</button>
            </form>
        </div>
    </div>
</div>


@endsection
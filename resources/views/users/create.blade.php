@extends('layouts.app')

@section('title', 'Add User')

@section('content')
<div class="container">
    <div class="card">
        <div class="card-header">添加用户</div>
        <div class="card-body">
            <form method="POST" action="{{ route('users.store') }}">
                @csrf
                <div class="form-group">
                    <label>用户名:</label>

                    <input id="name" type="text" class="form-control" name="name" value="{{ old('name') }}" required autofocus>
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
@extends('layouts.app')

@section('title', 'Add User')

@section('content')
<div class="container">
    <div class="card">
        <div class="card-header">添加类型</div>
        <div class="card-body">
            <form method="POST" action="{{ route('types.store') }}">
                @csrf
                <div class="form-group">
                    <label>类型名称:</label>

                    <input id="name" type="text" class="form-control" name="name" value="{{ old('name') }}" required autofocus>
                </div>
                <button type="submit" class="btn btn-primary">提交</button>
            </form>
        </div>
    </div>
</div>
@endsection
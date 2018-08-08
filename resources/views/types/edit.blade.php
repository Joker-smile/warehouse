@extends('layouts.app')

@section('title', 'Edit User')

@section('content')

<div class="container col-8">
    <div class="card">
        <div class="card-header">修改类型</div>

        <div class="card-body">
            <form action="{{route('types.update', $type->id)}}" method="post">
                @csrf
                {{ method_field('PUT') }}
                <div class="form-group">
                    <label>类型名称:</label>

                    <input id="name" type="text" class="form-control" name="name" value="{{ $type->name }}">
                </div>
                <button type="submit" class="btn btn-primary">提交</button>
            </form>
        </div>
    </div>
</div>


@endsection
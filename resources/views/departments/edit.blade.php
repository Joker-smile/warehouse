@extends('layouts.app')

@section('content')

<div class="container">
    <div class="card">
        <div class="card-header">修改车间</div>

        <div class="card-body">
            <form action="{{route('departments.update', $department->id)}}" method="post">
                @csrf
                {{ method_field('PUT') }}
                <div class="form-group">
                    <label >车间名:</label>
                    <input id="name" type="text" class="form-control" name="name" value="{{ $department->name }}" required autofocus>
                </div>
                <div class="form-group">
                    <label for="">管理员</label>
                    <select name="user_id" class="form-control">
                        @foreach ($operators as $operator)
                            <option value="{{ $operator->id }}">{{ $operator->name }}</option>
                        @endforeach
                    </select>
                </div>
                <button type="submit" class="btn btn-primary">提交</button>
            </form>
        </div>
    </div>
</div>


@endsection
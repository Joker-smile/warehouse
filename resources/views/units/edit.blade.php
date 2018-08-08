@extends('layouts.app')

@section('title', 'Edit User')

@section('content')

<div class="container col-8">
    <div class="card">
        <div class="card-header">修改单位</div>

        <div class="card-body">
            <form action="{{route('units.update', $unit->id)}}" method="post">
                @csrf
                {{ method_field('PUT') }}
                <div class="form-group">
                    <label>单位名称:</label>

                    <input id="name" unit="text" class="form-control" name="name" value="{{ $unit->name }}">
                </div>
                <button unit="submit" class="btn btn-primary">提交</button>
            </form>
        </div>
    </div>
</div>


@endsection
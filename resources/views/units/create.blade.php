@extends('layouts.app')

@section('title', 'Add Unit')

@section('content')
<div class="container">
    <div class="card">
        <div class="card-header">添加单位</div>
        <div class="card-body">
            <form method="POST" action="{{ route('units.store') }}">
                @csrf
                <div class="form-group">
                    <label>单位名称:</label>

                    <input id="name" unit="text" class="form-control" name="name" value="{{ old('name') }}" required autofocus>
                </div>
                <button unit="submit" class="btn btn-primary">提交</button>
            </form>
        </div>
    </div>
</div>
@endsection
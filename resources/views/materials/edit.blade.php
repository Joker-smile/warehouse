@extends('layouts.app')

@section('title', '修改物料')

@section('content')
<div class="container">
    <div class="card">
        <div class="card-header">
            修改物料
        </div>
        <div class="card-body">
            <form action="{{route('materials.update', $material->id)}}" method="POST">
                @csrf
                {{ method_field('PUT') }}
                <div class="form-group">
                    <label>物料名称:</label>
                    <input class="form-control" id="name" name="name" type="text" value="{{$material->name}}">
                    </input>
                </div>
                <div class="form-group">
                    <label>单位:</label>
                    <select name="unit" class="form-control">
                        @foreach ($units as $unit)
                            <option value="{{$unit->name}}" @if($unit->name == $material->unit) selected @endif>{{$unit->name}}</option>
                        @endforeach
                    </select>
                </div>
                <div class="form-group">
                    <label for="">单价</label>
                    <input type="number"  required="" name="price" value="{{$material->price}}" class="form-control">
                </div>
                <div class="form-group">
                    <label>类型:</label>
                    <select name="type" class="form-control">
                        @foreach ($types as $type)
                            <option value="{{$type->name}}" @if($type->name == $material->type) selected @endif>{{$type->name}}</option>
                        @endforeach
                    </select>
                </div>
                <div class="form-group">
                    <label for="">供应商</label>
                    <input type="text" name="supplier" value="{{ $material->supplier }}" class="form-control">
                </div>
                <div class="form-group">
                    <label for="">备注</label>
                    <input type="text" name="remark" value="{{ $material->remark }}" class="form-control">
                </div>
                <button class="btn btn-primary" type="submit">提交</button>

            </form>
        </div>
    </div>
</div>
@endsection


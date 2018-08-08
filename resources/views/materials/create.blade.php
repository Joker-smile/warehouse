@extends('layouts.app')

@section('title', '添加物料')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-14">
                <div class="card">
                    <div class="card-header">
                        添加物料
                    </div>
                    <div class="card-body">
                        <form action="{{ route('materials.store') }}" method="POST">
                            @csrf
                            @for ($i = 1; $i<=8; $i++)
                                <div class="form-group row">
                                    <label class="col-form-label ml-1 text-right" ><span class="text-primary">{{ $i }}</span>, </label>
                                    <label class="col-form-label ml-1 text-right" for="specifications">
                                        物料名称:
                                    </label>
                                    <div class="col-2">
                                        <input class="form-control" name="data[{{$i}}][name]" type="text">
                                        </input>
                                    </div>
                                    <label class="col-form-label ml-1 text-right" for="unit">
                                        单位:
                                    </label>
                                    <div class="col-1">
                                    <select name="data[{{$i}}][unit]" class="form-control">
                                        @foreach ($units as $unit)
                                            <option value="{{$unit->name}}">{{$unit->name}}</option>
                                        @endforeach
                                    </select>
                                    </div>
                                    <label class="col-form-label ml-1 text-right" for="type">
                                        类型:
                                    </label>
                                    <div class="col-1">
                                    <select name="data[{{$i}}][type]" class="form-control">
                                        @foreach ($types as $type)
                                            <option value="{{$type->name}}">{{$type->name}}</option>
                                        @endforeach
                                    </select>
                                    </div>
                                    <label class="col-form-label ml-1 text-right" for="price">
                                        单价:
                                    </label>
                                    <div class="col-1">
                                        <input class="form-control" name="data[{{$i}}][price]" type="text" value="">
                                        </input>
                                    </div>
                                    <label class="col-form-label ml-1 text-right" for="supplier">
                                        供货商:
                                    </label>
                                    <div class="col-1">
                                        <input class="form-control" name="data[{{$i}}][supplier]" type="text" value="">
                                        </input>
                                    </div>
                                    <label class="col-form-label ml-1 text-right" for="remark">
                                        备注:
                                    </label>
                                    <div class="col-2">
                                        <input class="form-control" name="data[{{$i}}][remark]" type="text" value="">
                                        </input>
                                    </div>
                                </div>
                            @endfor
                            <div class="form-group row">
                                <div class="col-8 offset-5">
                                    <button class="btn btn-primary " type="submit">
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

@section("footer")
@endsection


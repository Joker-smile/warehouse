@extends('layouts.app')

@section('title', '物料')

@section('content')
<div class="container">
    <div class="card">
        <div class="card-header">
            物料
        </div>
        <div class="card-body container-fluid ">
            <div class="row">
                <div class="col-md-2 col-xs-12">
                    <div class="form-group">
                        <a href="{{route('materials.create')}}">
                            <button class="btn btn-default">
                                添加物料
                            </button>
                        </a>
                    </div>
                </div>
            </div>
            <form action="" method="get">
                <div class="row">
                    <div class="col-md-2 col-xs-12">
                        <div class="form-group">
                            <input class="form-control" type="text" name="material_name" id="material_name"  placeholder="物料名称" value="{{request('material_name')}}" >
                        </div>
                    </div>

                    <div class="col-md-2 col-xs-12">
                        <div class="form-group">
                            <input class="form-control" type="text" name="type" id="type"  placeholder="物料类型" value="{{request('type')}}">
                        </div>
                    </div>

                    <div class="col-md-2 col-xs-12">
                        <div class="form-group">
                            <input class="form-control" type="text" name="supplier" id="supplier"  placeholder="供货商" value="{{request('supplier')}}">
                        </div>
                    </div>

                    <div class="col-md-2 col-xs-12">
                        <div class="form-group">
                            <button class="btn btn-primary">
                                搜索
                            </button>
                        </div>
                    </div>
                </div>
            </form>
            <div class="row">
                <div class="col-md-12">
                    <div class="table-responsive">
                        <table class="table table-striped">
                            <thead class="bg-grey">
                                <tr>
                                    <th>类型</th>
                                    <th>物料名称</th>
                                    <th>单位</th>
                                    <th>单价</th>
                                    <th>供货商</th>
                                    <th>备注</th>
                                    <th>总价</th>
                                    <th>总库存</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($materials as $material)
                                <tr>
                                    <td>
                                        {{ $material->type }}
                                    </td>
                                    <td>
                                        <a href="{{route('materials.edit', ['id' => $material->id])}}">{{$material['name']}}</a>
                                    </td>
                                    <td>
                                        {{ $material->unit }}
                                    </td>
                                    <td>
                                        {{ $material->price }}
                                    </td>
                                    <td>
                                        {{ $material->supplier }}
                                    </td>
                                    <td>
                                        {{ $material->remark }}
                                    </td>
                                    <td>
                                        {{ $material->price * $material->total_quantity }}
                                    </td>
                                    <td>
                                        {{ $material->total_quantity }}
                                    </td>

                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                    {{$materials->links()}}
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

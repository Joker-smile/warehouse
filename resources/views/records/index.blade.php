@extends('layouts.app')

@section('title', '操作记录')

@section('content')
<div class="container">
    <div class="card">
        <div class="card-header">
            操作记录
        </div>
        <div class="card-body container-fluid ">
            @include('layouts.search')
            @include('layouts.excel')
            <div class="row">
                <div class="col-md-12">
                    <div class="table-responsive">
                        <table class="table table-striped">
                            <thead class="bg-grey">
                                <tr>
                                    <th>操作者</th>
                                    <th>车间</th>
                                    <th>类型</th>
                                    <th>物料</th>
                                    <th>单位</th>
                                    <th>类型</th>
                                    <th>库存前</th>
                                    <th>库存后</th>
                                    <th>变化数量</th>
                                    <th>调整原因</th>
                                    <th>记录时间</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($records as $record)
                                <tr>
                                    <td>{{ $record->user->name }}</td>
                                    <td>{{ $record->department->name }}</td>
                                    <td>{{ $record->material->type }}</td>
                                    <td>{{ $record->material->name }}</td>
                                    <td>{{ $record->material->unit }}</td>
                                    <td>{{ $record->type_name }}</td>
                                    <td>{{ $record->before }}</td>
                                    <td>{{ $record->after }}</td>
                                    <td>{{ $record->after - $record->before }}</td>
                                    <td>{{ $record->adjust_reason }}</td>
                                    <td>{{ $record->created_at }}</td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                    {{$records->links()}}
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

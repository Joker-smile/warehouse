@extends('layouts.app')

@section('title', '车间')

@section('content')
<div class="container">
    <div class="card">
        <div class="card-header">
            车间
        </div>
        <div class="card-body container-fluid ">
            <div class="row">
                <div class="col-md-2 col-xs-12">
                    <div class="form-group">
                        <a href="{{route('departments.create')}}">
                            <button class="btn btn-default">
                                添加车间
                            </button>
                        </a>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12">
                    <div class="table-responsive">
                        <table class="table table-striped">
                            <thead class="bg-grey">
                                <tr>
                                    <th>车间名称</th>
                                    <th>管理员</th>
                                    <th>物料</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($departments as $department)
                                <tr>
                                    <td>
                                        <a href="{{route('departments.edit', ['id' => $department->id])}}">
                                                {{$department['name']}}
                                        </a>
                                    </td>
                                    <td>
                                        {{ $department->user->name }}
                                    </td>
                                    <td>
                                        <a href="{{route('departments.show', ['id' => $department->id])}}">
                                                {{ $department->materials_count }}
                                        </a>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                    {{$departments->links()}}
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

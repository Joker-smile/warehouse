@extends('layouts.app')

@section('title', '我的车间')

@section('content')
<div class="container">
    <div class="card">
        <div class="card-header">
            我的车间
        </div>
        <div class="card-body container-fluid ">
            <div class="row">
                <div class="col-md-12">
                    <div class="table-responsive">
                        <table class="table table-striped">
                            <thead class="bg-grey">
                                <tr>
                                    <th>车间名称</th>
                                    <th>物料</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($departments as $department)
                                <tr>
                                    <td>
                                        {{$department['name']}}
                                    </td>
                                    <td>
                                        <a href="{{route('department.materials', ['id' => $department->id])}}">
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

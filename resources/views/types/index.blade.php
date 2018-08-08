@extends('layouts.app')

@section('title', '类型')

@section('content')
<div class="container">
        <div class="card">
            <div class="card-header">
                类型
            </div>
            <div class="card-body">
                <div class="row">
                      <div class="col-2">
                          <div class="form-group">
                          <a href="{{route('types.create')}}">
                              <button class="btn btn-default">添加</button>
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
                                  <th>ID</th>
                                  <th>类型名称</th>
                                  <th>时间</th>
                              </tr>
                              </thead>
                              <tbody>
                              @foreach($types as $type)
                              <tr>
                                  <td>{{$type->id}}</td>
                                  <td>
                                    <a href="{{route('types.edit', ['id' => $type->id])}}">
                                      {{$type->name}}
                                    </a>
                                  </td>
                                  <td>{{ $type->created_at }}</td>
                              </tr>
                              @endforeach
                              </tbody>
                          </table>
                        </div>
                      </div>
                  </div>
            </div>
        </div>
    </div>
@endsection

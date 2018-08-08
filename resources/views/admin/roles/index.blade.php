@extends('layouts.app')

@section('title', '| Users')

@section('content')
<div class="container">
        <div class="panel">
            <div class="panel-body container-fluid ">
                <div class="row">
                      <div class="col-md-2 col-xs-12">
                          <div class="form-group">
                          <a href="{{route('roles.create')}}">
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
                                  <th class="text-center">ID</th>
                                  <th class="text-center">角色名</th>
                                  <th class="text-nowrap text-center">操作</th>
                              </tr>
                              </thead>
                              <tbody>
                              @foreach($roles as $role)
                              <tr>
                                  <td class="text-center">{{$role->id}}</td>
                                  <td class="text-center">{{$role->name}}</td>
                                  <td class="text-nowrap text-center">
                                  <a href="{{route('roles.edit', ['id' => $role->id])}}">
                                      <button class="btn btn-sm btn-default" data-original-title="Edit" data-toggle="tooltip" type="button">
                                          编辑
                                      </button>
                                  </a>
                                  <form method="POST" onsubmit="return confirm(function(event){
                                          event.target.submit();
                                      }, event)"  action="{{ route('roles.destroy', $role->id) }}" style="margin:0px;display:inline;">
                                    {{ csrf_field() }}
                                    {{ method_field("DELETE") }}
                                    <button type="submit" class="btn btn-sm btn-danger" data-toggle="tooltip" data-original-title="Delete">
                                      删除
                                    </button>
                                    </form>
                              </td>
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

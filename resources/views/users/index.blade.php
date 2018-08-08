@extends('layouts.app')

@section('title', '用户')

@section('content')
<div class="container">
        <div class="card">
            <div class="card-header">
                用户
            </div>
            <div class="card-body">
                <div class="row">
                      <div class="col-2">
                          <div class="form-group">
                          <a href="{{route('users.create')}}">
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
                                  <th>用户名</th>
                                  <th>创建时间</th>

                              </tr>
                              </thead>
                              <tbody>
                              @foreach($users as $user)
                              <tr>
                                  <td>
                                    <a href="{{route('users.edit', ['id' => $user->id])}}">
                                      {{$user->name}}
                                    </a>
                                  </td>
                                  <td>{{ $user->created_at }}</td>
                              </tr>
                              @endforeach
                              </tbody>
                          </table>
                        </div>
                          {{$users->links()}}
                      </div>
                  </div>
            </div>
        </div>
    </div>
@endsection

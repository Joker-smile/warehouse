@extends('layouts.app')

@section('title', '单位')

@section('content')
<div class="container">
        <div class="card">
            <div class="card-header">
                单位
            </div>
            <div class="card-body">
                <div class="row">
                      <div class="col-2">
                          <div class="form-group">
                          <a href="{{route('units.create')}}">
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
                                  <th>单位名称</th>
                                  <th>时间</th>
                              </tr>
                              </thead>
                              <tbody>
                              @foreach($units as $unit)
                              <tr>
                                  <td>{{$unit->id}}</td>
                                  <td>
                                    <a href="{{route('units.edit', ['id' => $unit->id])}}">
                                      {{$unit->name}}
                                    </a>
                                  </td>
                                  <td>{{ $unit->created_at }}</td>
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

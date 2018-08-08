@extends('layouts.app')

@section('title', "{$department->name} - 物料")

@push('js')
<link href="https://cdn.bootcss.com/toastr.js/2.1.4/toastr.min.css" rel="stylesheet">
@endpush

@section('content')
<div class="container">
    <div class="card">
        <div class="card-header">
            物料
        </div>
        <div class="card-body container-fluid ">
            @include("partials.warning")
            <div class="row">
                <div class="col-md-12">
                    <table class="table table-striped">
                        <thead class="bg-grey">
                            <tr>
                                <th class="text-center">
                                    ID
                                </th>
                                <th class="text-center">
                                    类型
                                </th>
                                <th class="text-center">
                                    物料
                                </th>
                                <th class="text-center">
                                    单位
                                </th>
                                <th class="text-center">
                                    库存数量
                                </th>
                                <th class="text-center">
                                    时间
                                </th>
                                <th class="text-center">
                                    操作
                                </th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($department->materials as $material)
                            <tr>
                                <td class="text-center">
                                    {{$material->id}}
                                </td>
                                <td class="text-center">
                                    {{$material->type}}
                                </td>
                                <td class="text-center">
                                    {{$material->name}}
                                </td>
                                <td class="text-center">
                                    {{$material->unit}}
                                </td>
                                <td class="text-center">
                                    {{$material->pivot->quantity}}
                                </td>
                                <td class="text-center">
                                    {{$material->pivot->updated_at}}
                                </td>
                                <td class="text-center">
                                    @if ($department->user_id == auth()->user()->id)
                                    <form action="{{route('department.reduce', ['id' => $material->id])}}" class="form-inline" method="post">
                                        @csrf
                                        <input class="form-control" id="department_id" name="department_id" type="hidden" value="{{request('id')}}"/>
                                        <div class="form-group offset-4">
                                            @role("operator")
                                            <label class="col-form-label ml-1 text-right" for="">
                                                消耗:
                                            </label>
                                            <input class=" form-control col-md-3" id="used" name="used" type="number" value="0">
                                            </input>
                                            @endrole
                                            <label class="col-form-label ml-1 text-right" for="">
                                                损耗:
                                            </label>
                                            <input class="form-control col-md-3" id="loss" name="loss" style="margin-left: 5px;" type="number" value="0">
                                            </input>
                                            <button class="btn btn-sm btn-primary" style="margin-left: 5px;" type="submit">
                                                提交
                                            </button>
                                            @role("keeper")
                                            <button class="btn btn-sm btn-danger" style="margin-left: 5px;" data-target="#update_modal" data-toggle="modal" href="javascript:void(0)" onclick="update(this);" type="button">
                                                调整
                                            </button>
                                    @endrole
                                        </div>
                                    </form>
                                    @endif
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
<div class="example example-buttons">
          <!-- Modal -->
          <div class="modal fade modal-fade-in-scale-up" id="update_modal" aria-labelledby="exampleModalTitle" role="dialog" tabindex="-1" style="display: none;" aria-hidden="true">
              <div class="modal-dialog modal-simple">
                  <div class="modal-content">
                      <div class="modal-header">
                      <h4 class="modal-title">物料库存调整</h4>
                          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                              <span aria-hidden="true">×</span>
                          </button>
                      </div>
                      <div class="modal-body">
                          <form action="" method="post" id="forms">
                              <div class="form-group row">
                                  <label class="col-md-2 offset-1 col-form-label text-right">当前数量: </label>
                                  <div class="col-md-8">
                                    <input type="text" name="quantity" id="quantity" class="form-control" value="" disabled="">
                                    <input type="text" name="department_id" id="department_id" class="form-control" value="{{request('id')}}" hidden="">
                                    <input type="text" name="material_id" id="material_id" class="form-control" value="" hidden="">
                                  </div>
                              </div>
                              <div class="form-group row">
                                  <label class="col-md-2 offset-1 col-form-label text-right">调整数量: </label>
                                  <div class="col-md-8">
                                    <input type="number" name="adjust_number" class="form-control">
                                  </div>
                              </div>
                              <div class="form-group row">
                                  <label class="col-md-2 offset-1 col-form-label text-right">调整原因: </label>
                                  <div class="col-md-8">
                                      <input type="text" name="adjust_reason" class="form-control">
                                  </div>
                              </div>
                          </form>
                      </div>
                      <div class="modal-footer">
                          <button type="button" class="btn btn-default" data-dismiss="modal">关闭</button>
                          <button type="button" class="btn btn-primary" id="save">保存</button>
                      </div>
                  </div>
              </div>
          </div>
          <!-- End Modal -->
      </div>
@endsection

@push('js')
<script src="https://cdn.bootcss.com/limonte-sweetalert2/7.21.1/sweetalert2.all.min.js"></script>
<script src="https://cdn.bootcss.com/toastr.js/2.1.4/toastr.min.js"></script>
<script src="{{asset('js/admin.js')}}"></script>
<script>
function update(obj){
    var tds=$(obj).parent().parent().parent().parent().find('td');
        $('#material_id').val(tds.eq(0).text().trim());
        $('#quantity').val(tds.eq(4).text().trim());
        $('#update_modal').modal('show');
    };

$(document).ready(function() {
      $('#save').on('click', function () {
                $.ajax({
                    type : 'post',
                    url :   '{{route('department.adjustment')}}',
                    data    :   $('#forms').serialize(),

                    success : function (ret) {
                        console.log(ret);
                        u.toastr.success('操作成功!');
                        u.reload(1500);
                    },
                    error : function (ret) {
                        u.toastr.error('操作失败!');
                        u.reload(1500);
                    }
                });
            });
    });
</script>
@endpush

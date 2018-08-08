@extends('layouts.app')

@section("title")
入库
@endsection
@push('css')
   <link rel="stylesheet" href="{{asset('css/combo.select.css')}}">
@endpush

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    入库
                </div>
                <div class="card-body">
                    @include("partials.warning")
                    <form action="{{ route('in.store') }}" method="post">
                        @csrf
                        @for ($i = 1; $i<=5; $i++)
                             <div class="row">
                                  <div class="form-group col">
                                      <label class="col-form-label" for="email">
                                              {{ $i }}, 物料名称:
                                      </label>
                                      <select class="form-control materials" name="data[{{$i}}][material_id]" placeholder="选择物料">
                                              <option value="">
                                                  选择物料
                                              </option>
                                              @foreach($materials as $material)
                                                  <option value="{{$material['id']}}">
                                                      {{$material['name']}}
                                                  </option>
                                              @endforeach
                                      </select>
                                  </div>

                                   <div class="form-group col">
                                       <label class="col-form-label" for="email">
                                           入库数量:
                                       </label>
                                       <input class="form-control quantity" name="data[{{$i}}][quantity]" type="number" min="1" />
                                   </div>
                             </div>
                        @endfor
                        <div class="form-group row">
                            <div class="col-8 offset-6">
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
@push('js')
<script src="{{asset('js/jquery.combo.select.js')}}"></script>
<script>

$(function() {
    $('.materials').comboSelect();
});

</script>
@endpush
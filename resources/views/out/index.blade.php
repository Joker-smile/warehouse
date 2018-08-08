@extends('layouts.app')

@section("title")
出库
@endsection
@push('css')
  {{--css写在这里--}}
   <link rel="stylesheet" href="{{asset('css/combo.select.css')}}">
@endpush

@section('content')
<div class="container">
    <div class="card">
        <div class="card-header">
            出库
        </div>
        <div class="card-body">
            @include("partials.warning")
            <form action="{{ route('out.store') }}" method="post">
                @csrf
                <div class="form-group">
                    <label>
                        物料:
                    </label>
                    <select class="form-control materials" name="material_id" placeholder="选择物料" required="required">
                        @foreach ($materials as $material)
                            <option value="{{ $material->id }}">{{ $material->name }} - 库存{{ $material->pivot->quantity }}</option>
                        @endforeach
                    </select>
                </div>

                <div class="form-group ">
                    <label>
                         入库车间:
                    </label>
                    <select class="form-control" id="departments" name="department_id">
                        @foreach($workshops as $workshop)
                            <option value="{{$workshop->id}}">
                                {{$workshop->name}}
                            </option>
                        @endforeach
                    </select>
                </div>

                <div class="form-group">
                    <label>
                        出库数量:
                    </label>
                    <input class="form-control" name="number" id="number" required="required" type="number"></input>
                </div>
                <button class="btn btn-primary " type="submit">提交</button>
            </form>
        </div>
    </div>
</div>
@endsection

@push('js')
  {{--js写在这里--}}
<script src="{{asset('js/jquery.combo.select.js')}}"></script>
<script>
$(function() {
    $('.materials').comboSelect();
});
</script>
@endpush

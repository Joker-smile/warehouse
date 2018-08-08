<form action="" method="get">
    <div class="row">
        <div class="col-md-2 col-xs-12">
            <div class="form-group">
                <select name="department_id" class="form-control">
                    @foreach($departments as $department)
                    <option value="{{$department->id}}" @if($department->id == request('department_id')) selected @endif>{{$department->name}}</option>
                    @endforeach
                </select>
            </div>
        </div>
        <div class="col-md-2 col-xs-12">
            <div class="form-group">
                <select name="type" class="form-control">
                    <option value="in"@if (request('type')=='in') selected @endif>入库</option>
                    <option value="out"@if (request('type')=='out') selected @endif>出库</option>
                    <option value="used"@if (request('type')=='used') selected @endif>消耗</option>
                    <option value="loss"@if (request('type')=='loss') selected @endif>损耗</option>
                    <option value="adjust"@if (request('type')=='adjust') selected @endif>调整</option>
                </select>
            </div>
        </div>
        <div class="col-md-3 col-xs-12">
            <div class="form-group">
                <input class="form-control" type="date" name="start_time" id="start_time"  placeholder="日期范围" value="{{request('start_time')}}" >
            </div>
        </div>

        <div class="col-md-3 col-xs-12">
            <div class="form-group">
                <input class="form-control" type="date" name="end_time" id="end_time"  placeholder="日期范围" value="{{request('end_time')}}">
            </div>
        </div>

        <div class="col-md-2 col-xs-12">
            <div class="form-group">
                <button class="btn btn-primary">
                    搜索
                </button>
            </div>
        </div>
    </div>
</form>
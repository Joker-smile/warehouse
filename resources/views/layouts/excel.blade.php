<form action="{{route('records.excel')}}" method="get">
    <div class="row">
        <div class="col-md-3 col-xs-12">
            <div class="form-group">
                <input class="form-control" id="start_time" name="start_time" placeholder="日期范围" type="hidden" value="{{request('start_time')}}">
                </input>
            </div>
        </div>
        <div class="col-md-3 col-xs-12">
            <div class="form-group">
                <input class="form-control" id="end_time" name="end_time" placeholder="日期范围" type="hidden" value="{{request('end_time')}}">
                </input>
            </div>
        </div>
        <div class="col-md-3 col-xs-12">
            <div class="form-group">
                <input class="form-control" id="type" name="type" type="hidden" value="{{request('type')}}">
                </input>
            </div>
        </div>
        <div class="col-md-3 col-xs-12">
            <div class="form-group">
                <input class="form-control" id="department_id" name="department_id" type="hidden" value="{{request('department_id')}}">
                </input>
            </div>
        </div>
        <div class="col-md-2 col-xs-12">
            <div class="form-group">
                <button class="btn btn-primary">
                    导出
                </button>
            </div>
        </div>
    </div>
</form>
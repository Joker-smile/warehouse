<?php

namespace App\Http\Controllers;

use App\FastExcel\HandlerExcelTrait;
use App\Services\DepartmentService;
use App\Services\RecordService;
use Illuminate\Http\Request;

class RecordsController extends Controller
{
    use HandlerExcelTrait;

    protected $record;
    protected $department;

    public function __construct(RecordService $record,
        DepartmentService $department) {

        $this->record     = $record;
        $this->department = $department;
    }

    public function index(Request $request)
    {
        $args        = $request->all();
        $records     = $this->record->get($args);
        $departments = $this->department->get();

        return view("records.index", compact("records", "departments"));
    }

    public function exportExcel(Request $request)
    {
        $args       = $request->all();
        $cellData   = $this->record->excelData($args);
        $cellLetter = ['id', '操作者', '车间', '物料', '类型', '库存前', '库存后', '记录时间', '调整原因', '单位', '变化数量'];

        $this->exportToExcel('操作记录', $cellLetter, $cellData);
    }

}

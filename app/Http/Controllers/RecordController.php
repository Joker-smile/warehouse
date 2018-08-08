<?php

namespace App\Http\Controllers;

use App\Services\DepartmentService;
use App\Services\RecordService;
use Illuminate\Http\Request;

class RecordController extends Controller
{
    protected $record;
    protected $department;

    public function __construct(RecordService $record, DepartmentService $department)
    {
        $this->record     = $record;
        $this->department = $department;
    }

    public function index(Request $request)
    {
        $args            = $request->all();
        $args['user_id'] = auth()->user()->id;
        $records         = $this->record->get($args);
        $departments     = $this->department->get();

        return view("record.index", compact("records", "departments"));
    }
}

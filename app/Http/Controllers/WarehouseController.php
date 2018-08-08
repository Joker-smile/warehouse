<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\WarehouseService;

class WarehouseController extends Controller
{
    protected $warehouse;

    public function __construct(WarehouseService $warehouse)
    {
        $this->warehouse = $warehouse;
    }

    public function index()
    {

    }

    public function in()
    {

    }

    public function out()
    {

    }
}


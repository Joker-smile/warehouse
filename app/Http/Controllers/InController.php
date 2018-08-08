<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\MaterialService;
use App\Services\WarehouseService;

class InController extends Controller
{
    protected $material;

    protected $warehouse;

    public function __construct(MaterialService $material, WarehouseService $warehouse)
    {
        $this->material = $material;

        $this->warehouse = $warehouse;
    }

    public function index()
    {
        $materials = $this->material->inAll();

        return view("in.index", compact("materials"));
    }

    public function store(Request $request)
    {
        $this->warehouse->in($request->get('data', []));

        return back()->withSuccess("Done!");
    }
}

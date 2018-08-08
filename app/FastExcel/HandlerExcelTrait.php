<?php
namespace App\FastExcel;

use Maatwebsite\Excel\Exceptions\LaravelExcelException;
use Maatwebsite\Excel\Facades\Excel;
use PHPExcel_Exception;

trait HandlerExcelTrait
{

    /**
     * @param string $fileName
     * @param array $title
     * @param array $data
     * @return mixed
     * @throws LaravelExcelException
     */
    public function exportToExcel(string $fileName, array $title, array $data)
    {
        try {
            return Excel::create($fileName, function ($excel) use ($data, $title) {
                $excel->sheet('sheet', function ($sheet) use ($data, $title) {
                    try {
                        $sheet->fromArray($data, null, 'A1', true, false);
                    } catch (PHPExcel_Exception $e) {
                        throw new LaravelExcelException($e->getMessage());
                    }

                    $sheet->prependRow($title);
                });

            })->export('xlsx');
        } catch (LaravelExcelException $e) {
            throw new LaravelExcelException($e->getMessage());
        }
    }
}

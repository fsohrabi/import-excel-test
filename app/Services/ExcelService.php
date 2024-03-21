<?php

namespace App\Services;

use App\Jobs\EmployeesImportJob;

class ExcelService
{
    public function import($file)
    {
        $filePath = $this->uploadFile($file);
        return EmployeesImportJob::dispatch($filePath);
    }

    public function uploadFile($file)
    {
        $fileName = time() . '.' . $file->extension();
        $file->move(public_path('uploads'), $fileName);
        return public_path('uploads') . '/' . $fileName;
    }
}

<?php

namespace App\Services;

use App\Repositories\Interfaces\EmployeeInterface;

class EmployeeService
{
    public function __construct(protected EmployeeInterface $employeeRepository, private ExcelService $excelService)
    {
    }

    public function importEmployees($file)
    {
        return $this->excelService->import($file);
    }


    public function getEmployees($request)
    {
        $employees = $this->employeeRepository->findAll($request);
        return $employees;
    }

    public function getEmployeeById($id)
    {
        $employee = $this->employeeRepository->findById($id);
        return $employee;
    }

    public function deleteEmployee($id)
    {
        return $this->employeeRepository->delete($id);
    }
}

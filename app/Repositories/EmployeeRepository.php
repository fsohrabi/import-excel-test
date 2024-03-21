<?php

namespace App\Repositories;

use App\Models\Employee;
use App\Repositories\Interfaces\EmployeeInterface;

class EmployeeRepository implements EmployeeInterface
{
    public function findAll($request)
    {
        return Employee::paginate($request->limit ?: 25)
            ->appends(request()->all());
    }

    public function findByID($id): Employee
    {
        return Employee::findOrFail($id);;
    }

    public function delete($id)
    {
        $employee = Employee::findOrFail($id);
        return $employee->delete();
    }
}

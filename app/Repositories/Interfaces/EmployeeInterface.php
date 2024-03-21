<?php

namespace App\Repositories\Interfaces;

use App\Models\Employee;

interface EmployeeInterface
{
    public function findById($id): Employee;

    public function findAll($request);

    public function delete($employee);
}

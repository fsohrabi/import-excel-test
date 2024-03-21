<?php

namespace App\Http\Controllers\Employee;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreEmployeeRequest;
use App\Http\Resources\EmployeeCollection;
use App\Http\Resources\EmployeeResource;
use App\Services\EmployeeService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class EmployeeController extends Controller
{
    public function __construct(public EmployeeService $employeeService)
    {
    }

    public function store(StoreEmployeeRequest $request): JsonResponse
    {
        $this->employeeService->importEmployees($request->file('file'));
        return response()->json(['message' => 'CSV import process has been started']);
    }

    public function index(Request $request): EmployeeCollection
    {
        $employees = $this->employeeService->getEmployees($request);
        return new EmployeeCollection($employees);
    }

    public function show(int $id): EmployeeResource
    {
        $employee = $this->employeeService->getEmployeeById($id);
        return new EmployeeResource($employee);
    }

    public function destroy(int $id): JsonResponse
    {
        $this->employeeService->deleteEmployee($id);
        return response()->json(['message' => 'Employee deleted successfully'], 200);
    }
}

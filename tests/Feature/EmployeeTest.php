<?php

namespace Tests\Feature;

use App\Models\Employee;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class EmployeeTest extends TestCase
{
    use RefreshDatabase;

    /**
     * Test GET request to retrieve all employees.
     *
     * @return void
     */
    public function testGetAllEmployees()
    {

        $response = $this->get('/api/employee');
        $response->assertStatus(200);
        $response->assertJson([
            'data' => []
        ]);
    }

    /**
     * Test GET request to retrieve a specific employee by ID.
     *
     * @return void
     */
    public function testGetEmployeeById()
    {
        $employee = Employee::factory()->create();
        $response = $this->get('/api/employee/' . $employee->id);
        $response->assertStatus(200);
        $response->assertJson([
            'data' => [
                'id' => $employee->id,
                'employee_id' => $employee->employee_id,
                'user_name' =>  $employee->user_name,
            ]
        ]);
    }

    /**
     * Test delete employee functionality.
     *
     * @return void
     */

    public function testDeleteEmployee()
    {
        $employee = Employee::factory()->create();
        $response = $this->delete('/api/employee/' . $employee->id);
        $response->assertStatus(200);
        $retrievedEmployee = Employee::find($employee->id);
        $this->assertNull($retrievedEmployee);
    }
}

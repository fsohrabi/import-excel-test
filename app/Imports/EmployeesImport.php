<?php

namespace App\Imports;

use App\Models\Employee;
use Carbon\Carbon;

use Maatwebsite\Excel\Concerns\Importable;
use Maatwebsite\Excel\Concerns\SkipsErrors;
use Maatwebsite\Excel\Concerns\SkipsFailures;
use Maatwebsite\Excel\Concerns\SkipsOnError;
use Maatwebsite\Excel\Concerns\SkipsOnFailure;
use Illuminate\Support\Facades\Log;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithBatchInserts;
use Maatwebsite\Excel\Concerns\WithChunkReading;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Concerns\WithValidation;

class EmployeesImport implements ToModel, SkipsOnFailure, WithChunkReading, WithBatchInserts, WithHeadingRow, SkipsOnError, WithValidation
{
    use Importable;
    use SkipsFailures;
    use SkipsErrors;
  


    /**
     * @param array $row
     *
     * @return \Illuminate\Database\Eloquent\Model|null
     */
    public function model(array $row)
    {
        try {
            return new Employee([
                'employee_id' => $row['emp_id'],
                'user_name' => $row['user_name'],
                'name_prefix' => $row['name_prefix'],
                'first_name' => $row['first_name'],
                'middle_initial' => $row['middle_initial'],
                'last_name' => $row['last_name'],
                'gender' => $row['gender'],
                'email' => $row['e_mail'],
                'date_of_birth' => Carbon::createFromFormat('m/d/Y', $row['date_of_birth'])->format('Y-m-d'),
                'time_of_birth' =>  Carbon::createFromFormat('h:i:s A', $row['time_of_birth'])->format('H:i:s'),
                'age_in_years' => $row['age_in_yrs'],
                'date_of_joining' => Carbon::createFromFormat('m/d/Y', $row['date_of_joining'])->format('Y-m-d'),
                'age_in_company' => $row['age_in_company_years'],
                'phone_number' => $row['phone_no'],
                'place_name' => $row['place_name'],
                'country' => $row['county'],
                'city' => $row['city'],
                'zip' => $row['zip'],
                'region' => $row['region'],
            ]);
        } catch (\Exception $exception) {
            Log::error('Error importing row: ' . json_encode($row) . '. Exception: ' . $exception->getMessage());
            return null; 
        }
    }

    public function rules(): array
    {
        return [
            'emp_id' => ['required', 'numeric', 'unique:employees,employee_id'],
            'user_name' => ['required', 'string', 'min:5', 'max:50', 'unique:employees,user_name'],
            'name_prefix' => ['required', 'string'],
            'first_name' => ['required', 'string'],
            'middle_initial' => ['required', 'string'],
            'last_name' => ['required', 'string'],
            'gender' => ['required', 'string'],
            'e_mail' => ['required', 'email'],
            'date_of_birth' => ['required', 'string'],
            'time_of_birth' => ['required', 'string'],
            'age_in_yrs' => ['required', 'numeric'],
            'date_of_joining' => ['required', 'string'],
            'age_in_company_years' => ['required', 'numeric'],
            'phone_no' => ['required', 'string'],
            'place_name' => ['required', 'string'],
            'county' => ['required', 'string'],
            'city' => ['required', 'string'],
            'zip' => ['required'],
            'region' => ['required', 'string'],
        ];
    }

    public function chunkSize(): int
    {
        return 500;
    }

    public function batchSize(): int
    {
        return 500;
    }
}

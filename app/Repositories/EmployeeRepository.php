<?php

namespace App\Repositories;

use App\Models\Employee;
use Illuminate\Database\Eloquent\Collection;

class EmployeeRepository
{

    /**
     * @return Collection
     */
    public function getList():Collection
    {
        return Employee::all();
    }

    /**
     * @param array $data
     * @return Employee
     */
    public function store(array $data):Employee
    {
        return Employee::create($data);
    }

    /**
     * @param array $data
     * @param Employee $employee
     * @return Employee
     */
    public function update(array $data, Employee $employee):Employee
    {
        $employee->update($data);
        return $employee;
    }

}

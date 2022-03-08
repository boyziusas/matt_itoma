<?php

namespace App\Services;

use App\Models\Employee;
use App\Repositories\EmployeeRepository;
class EmployeeService{

    /**
     * @var EmployeeRepository
     */
    protected $employeeRepository;

    Const SUCCESS = 'success';
    CONST SUCCESS_MESSAGE = 'Employee deleted successfully';

    /**
     * @param EmployeeRepository $employeeRepository
     */
    public function __construct(EmployeeRepository $employeeRepository){
        $this->employeeRepository = $employeeRepository;
    }

    /**
     * @param array $data
     * @return Employee
     */
    public function saveEmployeeData(array $data):Employee
    {
        return $this->employeeRepository->store($data);
    }

    /**
     * @param array $data
     * @param Employee $employee
     * @return Employee
     */
    public function updateEmployeeData(array $data, Employee $employee):Employee
    {
        return $this->employeeRepository->update($data, $employee);
    }

    /**
     * @param Employee $employee
     * @return array
     */
    public function deleteEmployee(Employee $employee): array
    {
        $returnStrings = [
            'type' => EmployeeService::SUCCESS,
            'message' => __(EmployeeService::SUCCESS_MESSAGE)
        ];
        $employee->delete();
        return $returnStrings;
    }
}

<?php

namespace App\Http\Controllers;

use App\Helpers\Helper;
use App\Http\Requests\StoreEmployeeRequest;
use App\Http\Requests\UpdateEmployeeRequest;
use App\Models\Company;
use App\Models\Employee;
use App\Repositories\EmployeeRepository;
use App\Services\EmployeeService;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Redirect;

class EmployeeController extends Controller
{
    /**
     * @var EmployeeRepository
     */
    public $employeeRepository;

    /**
     * @var EmployeeService
     */
    public $employeeService;

    const FAIL = 'fail';
    const SUCCESS = 'success';
    const SUCCESS_MESSAGE = 'Company created successfully';
    const FAIL_MESSAGE = 'Unable to create employee';
    const FAIL_UPDATE_MESSAGE = 'Unable to update employee';
    const SUCCESS_UPDATE_MESSAGE = 'Employee edited successfully';
    const FAIL_DELETE_MESSAGE = 'Unable to delete Employee';

    /**
     * @param EmployeeRepository $employeeRepository
     * @param EmployeeService $employeeService
     */
    public function __construct(EmployeeRepository $employeeRepository, EmployeeService $employeeService)
    {
        $this->employeeService = $employeeService;
        $this->employeeRepository = $employeeRepository;
        $this->middleware('auth');
    }

    /**
     * Display a listing of the resource.
     * @return Application|Factory|View
     */
    public function index()
    {
        return view('employees.index',['employees' => $this->employeeRepository->getList(),'rank'=> Helper::getRank()]);
    }

    /**
     * Show the form for creating a new resource.
     * @return Application|Factory|View
     */
    public function create()
    {
        return view('employees.create',['companies'=> Company::all()]);
    }

    /**
     * Store a newly created resource in storage.
     * @param StoreEmployeeRequest $request
     * @return RedirectResponse
     */
    public function store(StoreEmployeeRequest $request): RedirectResponse
    {
        try{
            $employee = $this->employeeService->saveEmployeeData($request->getData());
        }catch(\Exception $e){
            return Redirect::back()->withErrors(__(EmployeeController::FAIL_MESSAGE));
        }
        return redirect()->route('employees.show', compact('employee'))->with(EmployeeController::SUCCESS, __(EmployeeController::SUCCESS_MESSAGE));
    }

    /**
     * Display the specified resource.
     * @param Employee $employee
     * @return Application|Factory|View
     */
    public function show(Employee $employee)
    {
        return view('employees.show',compact('employee'));
    }

    /**
     * Show the form for editing the specified resource.
     * @param Employee $employee
     * @return Application|Factory|View
     */
    public function edit(Employee $employee)
    {
        return view('employees.edit', ['employee'=> $employee, 'companies'=> Company::all()]);
    }

    /**
     * Update the specified resource in storage.
     * @param UpdateEmployeeRequest $request
     * @param Employee $employee
     * @return RedirectResponse
     */
    public function update(UpdateEmployeeRequest $request, Employee $employee):RedirectResponse
    {
        try{
            $employee = $this->employeeService->updateEmployeeData($request->getData(), $employee);
        }catch(\Exception $e){
            return Redirect::back()->withErrors(__(EmployeeController::FAIL_UPDATE_MESSAGE));
        }
        return redirect()->route('employees.show', $employee)->with(EmployeeController::SUCCESS, __(EmployeeController::SUCCESS_UPDATE_MESSAGE));
    }

    /**
     * Remove the specified resource from storage.
     * @param Employee $employee
     * @return RedirectResponse
     */
    public function destroy(Employee $employee): RedirectResponse
    {
        try{
            $return = $this->employeeService->deleteEmployee($employee);
        }catch(\Exception $e){
            $return['type'] = EmployeeController::FAIL;
            $return['message'] = __(EmployeeController::FAIL_DELETE_MESSAGE);
        }
         return Redirect::back()->with($return['type'], $return['message']);
    }
}

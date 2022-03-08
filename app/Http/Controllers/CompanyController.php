<?php

namespace App\Http\Controllers;

use App\Helpers\Helper;
use App\Http\Requests\StoreCompanyRequest;
use App\Http\Requests\UpdateCompanyRequest;
use App\Models\Company;
use App\Repositories\CompanyRepository;
use App\Services\CompanyService;
use App\Services\ImageService;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Redirect;

class CompanyController extends Controller
{
    /**
     * @var CompanyService
     */
    public $companyService;

    /**
     * @var CompanyRepository
     */
    public $companyRepository;

    /**
     * @var ImageService
     */
    public $imageService;

    const FAIL = 'fail';
    const SUCCESS = 'success';
    const SUCCESS_MESSAGE = 'Company created successfully';
    const SUCCESS_EDIT_MESSAGE = 'Company edited successfully';
    const FAIL_UPDATE_MESSAGE = 'Unable to update company';
    const FAIL_DELETE_MESSAGE = 'Unable to delete Company';


    /**
     * @param CompanyService $service
     * @param CompanyRepository $companyRepository
     * @param ImageService $imageService
     */
    public function __construct(CompanyService $service, CompanyRepository $companyRepository, ImageService $imageService)
    {
        $this->companyService = $service;
        $this->companyRepository = $companyRepository;
        $this->imageService = $imageService;
        $this->middleware('auth');
    }

    /**
     * Display a listing of the resource.
     * @return Application|Factory|View
     */
    public function index()
    {
        return view('companies.index', ['companies'=> $this->companyRepository->getList(), 'rank'=> Helper::getRank()]);
    }

    /**
     * Displays a listing of the paginated resources
     * @return Application|Factory|View
     */
    public function indexPaginated()
    {
        return view('companies.index-paginated',['companies'=> $this->companyRepository->getPaginatedList()]);
    }

    /**
     * Show the form for creating a new resource.
     * @return Application|Factory|View
     */
    public function create()
    {
        return view('companies.create');
    }

    /**
     * Store a newly created resource in storage.
     * @param StoreCompanyRequest $request
     * @return RedirectResponse
     */
    public function store(StoreCompanyRequest $request): RedirectResponse
    {
        try{
            $data = $request->getData();
            $this->companyService->saveCompanyData($data);
            $this->imageService->saveToStorage($data['image']);
        }catch(\Exception $e){
            return Redirect::back()->withErrors(__('Unable to create company'));
        }
        #TODO:: make mail service
        #\Mail::to($company->email)->send(new \App\Mail\CompanyCreatedMail($company));
        return redirect()->route('companies')->with(CompanyController::SUCCESS, __(CompanyController::SUCCESS_MESSAGE));
    }

    /**
     * Display the specified resource
     * @param Company $company
     * @return Application|Factory|View
     */
    public function show(Company $company)
    {
        return view('companies.show',compact('company'));
    }

    /**
     * Show the form for editing the specified resource.
     * @param Company $company
     * @return Application|Factory|View
     */
    public function edit(Company $company)
    {
        return view('companies.edit',compact('company'));
    }

    /**
     * Update the specified resource in storage.
     * @param UpdateCompanyRequest $request
     * @param Company $company
     * @return RedirectResponse
     */
    public function update(UpdateCompanyRequest $request, Company $company): RedirectResponse
    {
        try{
            $data = $request->getData();
            $this->companyService->updateCompanyData($data, $company);
            $this->imageService->saveToStorage($data['image']);
        }catch(\Exception $e){
            return Redirect::back()->withErrors(__(CompanyController::FAIL_UPDATE_MESSAGE));
        }
        return redirect()->route('companies.show', $company)->with(CompanyController::SUCCESS, __(CompanyController::SUCCESS_EDIT_MESSAGE));
    }

    /**
     * Remove the specified resource from storage.
     * @param Company $company
     * @return RedirectResponse
     */
    public function destroy(Company $company): RedirectResponse
    {
        try{
            $return = $this->companyService->deleteCompany($company);
        } catch(\Exception $e){
            $return['type'] = CompanyController::FAIL;
            $return['message'] = __(CompanyController::FAIL_DELETE_MESSAGE);
        }
        return Redirect::back()->with($return['type'], $return['message']);
    }
}

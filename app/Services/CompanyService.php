<?php

namespace App\Services;

use App\Models\Company;
use App\Repositories\CompanyRepository;

class CompanyService{

    Const FAIL = 'fail';
    Const SUCCESS = 'success';
    Const FAIL_MESSAGE = 'Unable to delete company due to it having employees';
    Const SUCCESS_MESSAGE = 'Company deleted successfully';

    /**
     * @var CompanyRepository
     */
    protected $companyRepository;

    /**
     * CompanyService constructor
     * @param CompanyRepository $companyRepository
     */
    public function __construct(companyRepository $companyRepository)
    {
        $this->companyRepository = $companyRepository;
    }

    /**
     * @param array $data
     * @return Company
     */
    public function saveCompanyData(array $data):Company
    {
        return $this->companyRepository->store($data);
    }

    /**
     * @param array $data
     * @param Company $company
     * @return Company
     */
    public function updateCompanyData(array $data, Company $company):Company
    {
        return $this->companyRepository->update($data, $company);
    }

    /**
     * @param Company $company
     * @return array
     */
    public function deleteCompany(Company $company):array
    {
        $failMessage = __(CompanyService::FAIL_MESSAGE);
        $returnStrings = [
            'type' => CompanyService::SUCCESS,
            'message' => __(CompanyService::SUCCESS_MESSAGE)
        ];
        if($company->getEmployeeCount() != 0){
            $returnStrings['type'] = CompanyService::FAIL;
            $returnStrings['message'] = $failMessage;
            return $returnStrings;
        }
        $company->delete();
        return $returnStrings;
    }

}

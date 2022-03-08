<?php

namespace App\Repositories;

use App\Models\Company;

use http\Exception\InvalidArgumentException;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Pagination\LengthAwarePaginator;

class CompanyRepository{

    /**
     * @return LengthAwarePaginator
     */
    public function getPaginatedList():LengthAwarePaginator
    {
        return Company::paginate(10);
    }

    /**
     * @return Collection
     */
    public function getList():Collection
    {
        return Company::all();
    }

    /**
     * @param array $data
     * @return Company|null
     */
    public function store(array $data): ?Company
    {
        //throw new \InvalidArgumentException('test');
        return Company::create($data);
    }

    /**
     * @param array $data
     * @param $company
     * @return Company|null
     */
    public function update(array $data, $company): ?Company
    {
        $company->update($data);
        return $company;
    }

}

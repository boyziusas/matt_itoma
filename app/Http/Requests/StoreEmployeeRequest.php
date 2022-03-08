<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreEmployeeRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * @return array
     */
    public function getData(): array
    {
        $data = $this->request->all();
        return $this->setCompanyId($data);
    }

    /**
     * @param $data
     * @return mixed
     */
    public function setCompanyId($data)
    {
        $data['company_id'] = $data['company'];
        return $data;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules(): array
    {
        return [
            'name' => 'required|string|max:255:min:2',
            'company' => 'required|integer|exists:companies,id|max:100000',
            'telephone' => 'required|numeric|starts_with:370|digits:11',
            'email' => 'required|email|max:255|min:5'
        ];
    }
}

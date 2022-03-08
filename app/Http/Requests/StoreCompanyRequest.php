<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\UploadedFile;

class StoreCompanyRequest extends FormRequest
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
        return $this->addImageToData($data);
    }

    /**
     * @param $data
     * @return mixed
     */
    public function addImageToData($data)
    {
        $data['logo'] = $this->getImage()->hashName();
        $data['image'] = $this->getImage();
        return $data;
    }

    /**
     * @return array|UploadedFile|UploadedFile[]|null
     */
    public function getImage(){
        return $this->file('logo');
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules(): array
    {
        return [
            'name' => 'required|string|max:255',
            'logo' => 'required|image|mimes:jpg,png,jpeg|max:2048',
            'website' => 'required|url|max:255',
            'email' => 'required|email|max:255'
        ];
    }
}

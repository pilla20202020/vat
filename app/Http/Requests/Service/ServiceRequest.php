<?php

namespace App\Http\Requests\Service;

use Illuminate\Foundation\Http\FormRequest;

class ServiceRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'name' => 'required',
            'servicecategory_id' => 'required'
        ];
    }

    public function data()
    {
        $data = [
            'name' => $this->get('name'),
            'servicecategory_id' => $this->get('servicecategory_id'),
        ];

        return $data;

    }
}

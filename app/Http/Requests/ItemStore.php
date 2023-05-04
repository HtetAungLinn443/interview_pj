<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ItemStore extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'name' => 'required',
            'category' => 'required',
            'price' => 'required',
            'description' => 'required',
            'condition' => 'required',
            'type' => 'required',
            'ownerName' => 'required',
            'contactNumber' => 'required',
            'address' => 'required',
        ];
    }

}
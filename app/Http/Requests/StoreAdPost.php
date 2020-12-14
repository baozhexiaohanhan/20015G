<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class StoreAdPost extends FormRequest
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
        // dd(request()->all());
        return [
             'ad_name' =>[
                'required',
                Rule::unique('ad')->ignore(request()->ad_id,'ad_id'),
             ],
             'ad_link' => 'required',
        ];
    }
    public function messages(){
       return [
            'ad_name.required'=>'广告名称不能为空',
            'ad_name.unique'=>'广告名称已存在',
            'ad_link.required'=>'广告网址不能为空',
        ];
    }
}

<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class StorePositionPost extends FormRequest
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
             'position_name' =>[
                'required',
                Rule::unique('ad_position')->ignore(request()->position_id,'position_id'),
             ],
             'ad_width' => 'required',
             'ad_height' => 'required',
        ];
    }
    public function messages(){
       return [
            'position_name.required'=>'广告位名称不能为空',
            'position_name.unique'=>'广告位名称已存在',
            'ad_width.required'=>'广告位宽度不能为空',
            'ad_height.required'=>'广告位高度不能为空',
        ];
    }
}

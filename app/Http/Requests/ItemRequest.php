<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ItemRequest extends FormRequest
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
            'name' => 'required|max:255',
            'price' => 'required|numeric',
            'condition_id' => 'required',
        ];
    }

    public function messages()
    {
        return [
            'name.required' => '商品名を入力してください',
            'name.max' => '商品名は255文字以内で入力してください',
            'price.required' => '金額を入力してください',
            'price.numeric' => '金額は整数で入力してください',
            'condition_id.required' => '状態を選択してください',
        ];
    }
}

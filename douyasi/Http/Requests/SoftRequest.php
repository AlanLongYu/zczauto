<?php

namespace Douyasi\Http\Requests;

use App\Http\Requests\Request;

class SoftRequest extends Request
{

    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        //return false;
        return true;
    }

    /**
     * 自定义验证规则rules
     *
     * @return array
     */
    public function rules()
    {
        $id = $this->segment(3) ? ','.$this->segment(3).',id' : '';
        $rules = [
            //'name' => 'required|alpha',
            'slug' => 'required|alpha|unique:soft_categories,slug'.$id,
            'sort' => 'required|numeric',
        ];
        return $rules;
    }

    /**
     * 自定义验证信息
     *
     * @return array
     */
    public function messages()
    {
        return [
            //'name.required' => '分类名称不能为空',
            //'name.alpha'    => '分类名称必须为常规字符',
            'slug.required' => '软件分类名称不能为空',
            'slug.alpha'    => '软件分类名称不符合规则',
            'slug.unique'   => '分类名称已存在',
            'sort.required' => '分类排序不能为空',
            'sort.numeric'  => '分类排序必须为数字',
        ];
    }
}

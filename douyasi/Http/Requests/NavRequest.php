<?php

namespace Douyasi\Http\Requests;

use App\Http\Requests\Request;

class NavRequest extends Request
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
        //$id = $this->segment(3) ? ','.$this->segment(3).',id' : '';
        $rules = [
            'name' => 'required|alpha',
            //'slug' => 'required|regex:/^[a-z0-9\-_]{3,20}$/|unique:categories,slug'.$id,
            'p_id' => 'required|numeric',
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
            'name.required' => '导航名称不能为空',
            'p_id.required' => '父级导航不能为空',
            'name.alpha'    => '导航名称必须为常规字符',
            //'slug.required' => '导航别名不能为空',
            //'slug.regex'    => '导航别名不符合组合规则([a-z0-9\-_]{3,20})',
            //'slug.unique'   => '导航别名已存在',
            'sort.required' => '导航排序不能为空',
            'sort.numeric'  => '导航排序必须为数字',
        ];
    }
}

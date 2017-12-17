<?php

namespace Douyasi\Http\Requests;

use App\Http\Requests\Request;

class CarRequest extends Request
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
        ];
    }
}

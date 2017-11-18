<?php

namespace Douyasi\Http\Requests;

use App\Http\Requests\Request;

class SoftArticleRequest extends Request
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
            'title'       => 'required|min:3|max:80|unique:soft_articles,title'.$id,
            'cid'         => 'required|exists:soft_categories,id',
            'description' => 'required|min:10',
            'content'     => 'required|min:20',
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
            'title.required'       => '软件标题不能为空',
            'title.min'            => '软件标题长度不能少于3',
            'title.max'            => '软件标题长度不能多于80',
            'cid.required'         => '分类不能为空',
            'cid.exists'           => '不存在此分类ID',
            'description.required' => '软件摘要不能为空',
            'description.min'      => '软件摘要长度不能少于10',
            'content.required'     => '正文不能为空',
            'content.min'          => '正文长度不能少于20',
        ];
    }
}

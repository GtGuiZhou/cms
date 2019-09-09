<?php


namespace app\common\validate;


use think\Request;
use think\Validate;

class BaseValidate extends Validate
{

    /**
     * 执行验证操作
     * @return bool 验证失败抛出异常,否则返回true
     * @throws ParameterException
     */
    public function goCheck()
    {
        $request = Request::instance();
        $params = $request->param();
        $result = $this->check($params);
        if (!$result){
            $error = $this->getError();
            throw new ParameterException($error);
        } else {
            return true;
        }
    }

    /**
     * 必须为正整数
     * @param mixed $value 验证数据
     * @param string $rule 验证规则
     * @param string $data 全部数据（数组）
     * @param string $field 字段名
     * @param string $desc 字段描述
     * @return bool|string
     */
    protected function positiveInteger($value,$rule='',$data='',$field='',$desc=''){
        $desc = $desc?$desc:$field;
        if (is_numeric($value) && is_int($value + 0) && ($value + 0) > 0){
            return true;
        } else {
            return $desc.'必须为正整数';
        }
    }
}
<?php


namespace app\common\validate;


class IdMustBePostiveInt extends BaseValidate
{
    protected $rule = [
        'id' => 'require|positiveInteger'
    ];

    public function setIdKeyName($keyName)
    {
        $this->rule[$keyName] = $this->rule['id'];
        unset($this->rule['id']);
    }





}
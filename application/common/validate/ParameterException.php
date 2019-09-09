<?php


namespace app\common\validate;


use app\common\exception\BaseException;

class ParameterException extends BaseException
{
    protected $message  = '参数错误';
    protected $errCode = 10000;
}
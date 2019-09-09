<?php


namespace app\common\exception;


use Throwable;

class BaseException extends \Exception
{
    /**
     * @var integer 自定义错误码
     */
    protected $errCode;

    public function __construct($message = "", $code = 500,$errCode = 999, Throwable $previous = null)
    {
        $this->setErrCode($errCode);
        parent::__construct($message, $code, $previous);
    }

    /**
     * @return int
     */
    public function getErrCode()
    {
        return $this->errCode;
    }

    /**
     * @param int $errCode
     */
    public function setErrCode($errCode)
    {
        $this->errCode = $errCode;
    }

}
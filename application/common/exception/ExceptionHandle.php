<?php


namespace app\common\exception;


use think\exception\Handle;
use think\Log;
use think\Request;

class ExceptionHandle extends Handle
{

    public function render(\Exception $ex)
    {
        // 异常分为两类
        //一类已知告诉用户异常信息一类未知
        //一类未知记录日志，不告诉用户异常信息
        if ($ex instanceof BaseException) {
            // 已知异常
            $code = $ex->getCode();
            $msg = $ex->getMessage();
            $errCode = $ex->getErrCode();
        } else {// 未知异常
            // 调试模式下需要显示异常页面，方便修改错误
            if (config('app_debug')) {
                return parent::render($ex);
            }
            $code = 500;
            $msg = '抱歉，服务器内部错误。';
            $errCode = 999;
            Log::error($msg);
        }

        $request = Request::instance();
        $result = [
            'request_url' => $request->url(),
            'msg' => $msg,
            'errCode' => $errCode,
        ];

        return json($result, $code);
    }
}
<?php
/**
 * 自定义辅助函数
 * @author pnpeng
 * @date 2018-03-16
 */

if (! function_exists('rules')) {
    /*
     * 取当前路由对应的表单验证规则
     */
    function rules()
    {
        list($class) = explode('@',request()->route()->getActionName());
        $request_class = 'App\\Http\\Requests\\'.str_replace('Controller', 'Request', array_last(explode('\\', $class)));
        $rules = (new $request_class)->rules();
        return $rules;
    }
}

if (! function_exists('debugbar')) {
    /**
     * Get the Debugbar instance
     *
     * @return \Barryvdh\Debugbar\LaravelDebugbar
     */
    function debugbar()
    {
        return app('debugbar');
    }
}

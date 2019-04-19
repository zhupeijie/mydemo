<?php

namespace app;
use helpers\ApiResponse;
use helpers\HttpHelper;

class Application
{
    use ApiResponse;


    private $httpHelper;

    public function __construct()
    {
        $this->loadConf();
        $this->httpHelper = new HttpHelper();

    }

    public function run()
    {
        //实现路由
    }

    //日志收集
    private function log($data)
    {
        $fileName = 'logs';
        $content = '[' . date('Ymd H:i:s') . '] :: ' . json_encode($data, JSON_UNESCAPED_UNICODE);
        file_put_contents(LOG_DIR . $fileName, $content . PHP_EOL, 8);
    }

    /**
     * 加载配置文件
     *
     * @throws \Exception
     */
    private function loadConf()
    {
        $file  = CONF_DIR . DIRECTORY_SEPARATOR . 'conf.php';
        if ( !file_exists($file)) {
            throw new \Exception('config file: ' . $file . 'is miss');
        }

        require_once($file);
    }
}
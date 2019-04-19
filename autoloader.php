<?php

class AutoLoader
{
    /**
     * @param $className
     * @return mixed
     * @throws Exception
     */
    public static function autoload($className)
    {
        $file = str_replace('\\', DIRECTORY_SEPARATOR, BASE_ROOT . $className) . '.php';
        if ( !file_exists($file)) {
            throw new \Exception($className . ' not found');
        }

        return require_once $file;
    }

//    public function register($prepend = false)
//    {
//        spl_autoload_register([$this, 'loadClass'], true, $prepend);
//    }
}
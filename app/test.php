<?php
/**
 * Created by HanGang.
 * Date: 2019-04-19
 */


class A
{
    public $name = 'test A';

    public function getName(B $b)
    {
        echo '方法内:::' . $b->name;
        $b->name = "hello";
        return $b->name;
    }
}

class B
{
    public $name = 'test B';
}

$a = new A();
$b = new B();


$test = $a->getName($b);

var_dump($test);
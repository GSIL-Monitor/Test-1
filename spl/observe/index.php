<?php
require_once 'SplObserver.php';
class Test1 implements SplObserver
{
    // 当被观察者调用notify方法是触发此方法
    public function update(SplSubject $subject)
    {
        echo __CLASS__ . '-' . $subject->getName() . PHP_EOL;
    }
}

class Test2 implements SplObserver
{
    // 当被观察者调用notify方法是触发此方法
    public function update(SplSubject $subject)
    {
        echo __CLASS__ . '-' . $subject->getName() . PHP_EOL;
    }
}

# 调用
$user = new Target('Target');
$user->attach(new Test1());
$user->attach(new Test2());
// 当被观察者调用notify方法，触发此方法
$user->notify();
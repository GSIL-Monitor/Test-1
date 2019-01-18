<?php
/**
 * 被观察者
 */
class Target implements SplSubject
{
    private $_observe = null;
    // 被观察者名称
    private $_name = null;

    public function __construct($name)
    {
        $this->_observe = new SplObjectStorage();
        $this->_name = $name;
    }

    // 添加一个观察者
    public function attach(SplObserver $observe)
    {
        $this->_observe->attach($observe);
    }

    // 删除一个观察者
    public function detach(SplObserver $observe)
    {
        $this->_observe->detach($observe);
    }

    // 触发观察者update方法
    public function notify()
    {
        foreach ($this->_observe as $observe){
            $observe->update($this);
        }
    }

    public function getName()
    {
        return $this->_name;
    }
}
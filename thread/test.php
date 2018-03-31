<?php
class Cattle extends Thread
{
    public $n;

    public function __construct($n)
    {
        $this->n = $n;
    }

    public function run()
    {
        $time1 = microtime(true);

        echo xx($this->n);

        $time2 = microtime(true);
        echo '任务耗时：', $time2 - $time1, "\n";
    }

    public function xx($n)
    {
        if($n==1)return 1;
        if($n==2)return 2;
        return xx($n-1)+xx($n-2);
    }
}

// 开启 2 个线程
// $cattle[] = new Cattle(0, 250000);
// $cattle[] = new Cattle(250000, 500000);
// $cattle[] = new Cattle(500000, 750000);
// $cattle[] = new Cattle(750000, 1000000);

//
// $cattle[] = new Cattle(0, 500000);
// $cattle[] = new Cattle(500000, 1000000);

// $cattle[] = new Cattle(0, 100000);
// $cattle[] = new Cattle(100000, 200000);
// $cattle[] = new Cattle(200000, 300000);
// $cattle[] = new Cattle(300000, 400000);
// $cattle[] = new Cattle(400000, 500000);
// $cattle[] = new Cattle(500000, 600000);
// $cattle[] = new Cattle(600000, 700000);
// $cattle[] = new Cattle(700000, 800000);
// $cattle[] = new Cattle(800000, 900000);
// $cattle[] = new Cattle(900000, 1000000);
$cattle[] = new Cattle(36);
$cattle[] = new Cattle(37);
foreach ($cattle as $object) {
    $object->start();
}
echo PHP_EOL;



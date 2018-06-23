<?php
require_once 'config.php';
class DB {
    public $conn;
    public $dbname=DBNAME;
    public $username=USER;
    public $password=PASS;
    public $host=HOST;

    public function __construct() {
        $this->conn=mysqli_connect($this->host,$this->username,$this->password,$this->dbname);
        if (!$this->conn) {
            mysqli_error($this->conn);
            die("连接失败".mysqli_error($this->conn));
        }
        //设置访问数据库的编码
        mysqli_query($this->conn, "set names utf8") or die(mysqli_error($this->conn));
    }

    //获取单条数据
    public function get($sql) {
        $res=$this->execute_dql($sql);
        if(count($res)){
          return $res[0];
        }else{
          return [];
        }
    }

    //执行dql语句，但是返回的是一个数组
    public function execute_dql($sql) {
      $this->saveLog($sql);
      $arr=array();
      $res=mysqli_query($this->conn,$sql) or die(mysqli_error($this->conn));
      while($row=mysqli_fetch_assoc($res)) {
          $arr[]=$row;
      }
      //这里就可以马上把$res关闭
      mysqli_free_result($res);
      return $arr;
    }

    //执行dml语句
    public function execute_dml($sql) {
      $this->saveLog($sql);
      $b=mysqli_query($this->conn, $sql) or die(mysqli_error($this->conn));
      if(!$b) {
          return 0;
      } else {
          if(mysqli_affected_rows($this->conn)>0) {
              return 1;//表示执行成功
          } else {
              return 2;//表示没有行收到影响
          }
      }
    }

    public function saveLog($sql){
        file_put_contents('../sql.log', date('ymdhis').'　:　'.$sql.PHP_EOL,FILE_APPEND);
    }
}
?>
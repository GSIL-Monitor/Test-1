<?php

class Node {  //定义节点
      public $data = '';
      public $next = null;
      public function __construct($data)
      {
            $this->data = $data;
      }
}

/*
 * 计算节点总个数
 * @param Node $head 头节点
 * @return int $i 节点个数
 * */
function countNode ($head) {
      $p = $head;
      $i = 0;
      while (!is_null($p->next)) {
            $p = $p->next;
            ++$i;
      }
      return $i;
}
/*
 * 增加一个节点
 * @param Node $head , $data
 * @return  null
 **/
function addNode ($head,$data) {
      $p = $head;
      while (!is_null($p->next)) {
            $p = $p->next;
      }
      $new = new Node($data);
      $p->next = $new;
}

/*
 * 在第n个节点以后插入一个节点
 * @param Node $head , $data
 * @return null
 * */
function  insertNode ($head,$n,$data) {
      if ($n>countNode($head)) {
            return false;
      }
      $p = $head; //指针指向头节点
      for ($i=0;$i<$n;$i++) {
            $p = $p->next;  //循环结束后，指针指向第n个节点
      }
      $new = new Node($data); //新节点
      $temp = $p->next;
      $p->next = $new;
      $new->next = $temp;
      /*
       * 也可以这样写
       * $new->next = $p->next;
       * $p->next = $new;
       * */
}

/*
 * 删除一个节点
 * @param Node $head ,int $n
 * @return null
 * */
function deleteNode ($head,$n) {
      if ($n>countNode($head)) {
            return false;
      }
      $p = $head; //指针指向头节点
      for ($i=0;$i<$n-1;$i++) { //找到第n-1个节点
            $p = $p->next;
      }
      $temp = $p->next;
      $p->next = $temp->next;
      unset($temp);
}

/*
 * 遍历链表
 * @param Node $head
 * @return $data
 * */
function showNode ($head) {
      $p = $head;
      while (!is_null($p->next)) {
            $p = $p->next;
            echo $p->data.'</br>';
      }
}
echo '<pre>

<hr>';
//下面测验一下

$head = new Node(null); //定义头节点

addNode($head,'a');print_r($head);
addNode($head,'b');print_r($head);
addNode($head,'c');print_r($head);

showNode($head);
echo countNode($head);

echo "<hr>";
insertNode($head,2,'d');print_r($head);

showNode($head);
echo countNode($head);

echo "<hr>";

deleteNode($head,3);

showNode($head);

echo countNode($head);

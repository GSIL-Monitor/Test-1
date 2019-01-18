### SPL--观察者模式

[原文地址](https://www.ibm.com/developerworks/cn/opensource/os-cn-observerspl/)

- SplSubject 接口中的方法

方法申明 | 描述 |
- | :-: |
abstract public void attach ( SplObserver $observer ) | 添加（注册）一个观察者|
abstract public void detach ( SplObserver $observer ) | 删除一个观察者 |
abstract public void notify ( void ) | 当状态发生改变时，通知所有的观察者 |

- SplObserver 中的方法

方法声明 | 描述 |
- | :-: |
abstract public void update ( SplSubject $subject )|在目标发生改变时接收目标发送的通知；当关注的目标调用其 notify()时被调用|

- 为什么使用 SplObjectStorage 类

> SplObjectStorage类实现了以对象为键的映射（map）或对象的集合（如果忽略作为键的对象所对应的数据）这种数据结构。这个类的实例很像一个数组，但是它所存放的对象都是唯一的。这个特点就为快速实现 Observer 设计模式贡献了不少力量，因为我们不希望同一个观察者被注册多次。该类的另一个特点是，可以直接从中删除指定的对象，而不需要遍历或搜索整个集合。

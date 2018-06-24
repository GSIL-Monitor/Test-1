// 事件循环
var events = require("events");
// 创建 eventEmitter 对象
var eventEmitter = new events.EventEmitter();

// 创建事件处理程序
var connectHandler = function connected() {
    console.log("connect success");

    // 出发 data_received 时间
    eventEmitter.emit("data_received");
}

console.log(1);

// 绑定 connection 事件处理程序
eventEmitter.on("connection", connectHandler);

console.log(2);

// 使用匿名函数绑定 data_received 事件
eventEmitter.on("data_received", function(){
    console.log("data　received success")
});

console.log(3);

// 触发 connection 事件
eventEmitter.emit("connection");

console.log("finish！");

/*
程序执行结果
1
2
3
connect success
data　received success
finish！
 */
console.log("***********************");
//例子1
var fs = require("fs");
fs.readFile('README.md',
function(err, data) {
    if (err) return console.error(err);
    console.log(data.toString());
    console.log("end");
    console.log("***********************");
});
//例子2
var events = require("events");
var eventEmitter = new events.EventEmitter();
var connectHandler = function connected() {
    console.log("connnect successfully !");
    eventEmitter.emit("after_connect");
}
eventEmitter.on("connected", connectHandler);
eventEmitter.on('after_connect',
function() {
    console.log("after connect");
});
eventEmitter.emit("connected");
console.log("event emitter end");
// callback 回调函数

var fs = require("fs");

// 阻塞
var data = fs.readFileSync("README.md");
console.log(data.toString());
console.log("程序结束！");

// 非阻塞
fs.readFile("README.md",function(err, data) {
    if(err)return console.error(err);
    console.log(data.toString());
});
console.log("Programe Finish");
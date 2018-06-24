// 步骤一、引入 required 模块
// 我们使用 require 指令来载入 http 模块，并将实例化的 HTTP 赋值给变量 http，实例如下:
var http = require("http");
// 步骤二、创建服务器
// 接下来我们使用 http.createServer() 方法创建服务器，并使用 listen 方法绑定 8888 端口。 函数通过 request, response 参数来接收和响应数据。
http.createServer(function (request, response) {
    // 发送http头部
    // http 状态 200 ok
    // 内容类型：text/plain
    response.writeHead(200, {'Content-Type': 'text/plain'});

    // 发送响应数据
    response.end("Hello,Wrold!\n");
}).listen(8888);

// 打印终端信息
console.log("server running at http://127.0.0.1:8888/");
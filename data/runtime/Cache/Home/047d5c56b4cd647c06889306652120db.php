<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->
<html>
    <head>
        <title>TODO supply a title</title>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <script src="/public/js/jquery.js"></script>
        <script src="/public/js/cookie.js"></script>
        <script src="/public/js/expand/LG.js"></script>
        <script src="/public/js/expand/Weixin.js"></script>
    </head>
    <body>
        <div>TODO write content</div>
        <script>
            //$.cookie('user',"");
            var Weixin=new Weixin();
            alert(Weixin.user.openid);
        </script>
    </body>
</html>
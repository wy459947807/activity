<?php
/**
 * 数据相关的配置文件
 */
return array(
    "cloud_config"=> array(
        'accessKey'=>'PaHFjIcqPOwdtn7J40KHP2xrIQGtHxuuddpAtGSk',    //accessKey
        'secretKey'=>'PCyz-cRkSJwFah0XY5RZzrGv9VO-MVJ4W-z6ck1_',    //secretKey   
        'bucket'=>"socialcircle-speech-bucket",                     //要上传的空间
        'videoNotify'=>"http://sheji.imwork.net/index.php/api/Cloud/videoNotify",//视频上传回调接口
        'pipeLine'=>'video-queue-4',  //视频上传通道
    ),
    'UPLOAD_INFO'=>array(
        "uploadImage"=>array(
            "maxSize"=>3145728,                             // 设置图片上传大小3M
            "exts"=>array('jpg', 'gif', 'png', 'jpeg'),     // 设置图片上传类型
            "rootPath"=>'data/upload/home',                 // 设置图片上传根目录
        ),
        "uploadFile"=>array(
            "maxSize"=>104857600,                             // 设置附件上传大小100M
            "exts"=>array('jpg', 'gif', 'png', 'jpeg'),                             // 设置文件上传类型
            "rootPath"=>'data/upload/tmp',                 // 设置文件上传根目录
        ),
    ),
    //微信配置
    "wechat" => array(
        
        //测试公众号
        /*
        "config"=>array(
            'token' => 'weixin', //填写你设定的key
            'encodingaeskey' => '', //填写加密用的EncodingAESKey
            'appid' => 'wx331379438369d4e7', //填写高级调用功能的app id
            'appsecret' => '6c5758bf36f5fab392ff045395ceb4e2' //填写高级调用功能的密钥
        ),*/
        
        
        //十年赢家网公众号
        "config"=>array(
            'token' => 'weixin', //填写你设定的key
            'encodingaeskey' => '', //填写加密用的EncodingAESKey
            'appid' => 'wxa57a6692a73e6b3e', //填写高级调用功能的app id
            'appsecret' => '31e8f5a47efc0f2d3d1562c90a278d9b' //填写高级调用功能的密钥
        ),
        
        
        
        //微信菜单
        "menu" => array(
            "button" => array(
                array('type' => 'view', 'name' => '测试菜单1', 'url' => 'http://www.baidu.com'),
                array('name' => '测试菜单2', 'sub_button' => array(
                        array('type' => 'view', 'name' => '测试菜单2-1', 'url' => 'http://www.baidu.com'),
                        array('type' => 'view', 'name' => '测试菜单2-1', 'url' => 'http://www.baidu.com'),
                    )),
                array('type' => 'click', 'name' => '测试菜单3', 'key' => 'Contactus'),
            ),
        ),
        
        "authHost"=>array(
            "test"=>"http://www.baidu.com",
            "activity"=>"http://168096j6d3.imwork.net/index.php/api/wechat/openid",
        ),
        
    ),
    
    //测评类型
    "question_rule"=>array(
        "type_rule"=>array(
            9=>array(0=>"理智型",1=>"冲动型",2=>"盲目型"),
            12=>array(0=>"稳健型",1=>"审慎型",2=>"激进型"),
            4=>array(0=>"老鬼",1=>"韭菜",2=>"小白"),
        ),
        "score_rule"=>array(0=>10,1=>5,2=>2),
    ),
    
    
    
    
    
);
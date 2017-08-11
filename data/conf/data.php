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
    
    //支付配置
    "payment"=>array(
        "wechat"=>array(
            "WXURL"=>"https://api.mch.weixin.qq.com/pay/unifiedorder",
            "NOIFYURL"=>"http://sheji.imwork.net/index.php/App/Payment/wechatNotify",
            "APPID"=>"wx6ae3f95a07a56853",
            "MCHID"=>"1354356702",
            "KEY"=>"jbjhhzstslbldhbfhjbjgtmjbbf12345",
            "APPSECRET"=>"797e56254890133a710f7045cd800f8f",
        ),
        
    ),

    //测评类型
    "question_rule"=>array(
        "type_rule"=>array(
            12=>array(0=>"理智型",1=>"冲动型",2=>"盲目型"),
            15=>array(0=>"稳健型",1=>"审慎型",2=>"激进型"),
            7=>array(0=>"老鬼",1=>"韭菜",2=>"小白"),
        ),
        "score_rule"=>array(0=>10,1=>5,2=>2),
    ),
    
    //app支付配置
    "app_pay_config"=>array(
        //支付宝配置
        "alipay"=>array(
            "appid"=>"2017062607572341",
            "public_key"=>"MIIBIjANBgkqhkiG9w0BAQEFAAOCAQ8AMIIBCgKCAQEAhZBvkllRWt2lR2Qcs+HB2vH53gTG3kEgIRMTfqJmY6IkUH2ds0tGo/T0NzDpSwREa4KLmoORas6/NMJ6VT5xnLQqqmZ2ru9t5TPjrgfgKd+R13t1pn9/EGOwjOp/oxnJ1PX8f6MSyOYwawGzNewWO5O4+DFED9DZI02UMOoqy40ne1XhJunHAdGNUWQFt/VrqY5OuUYa9S4URNSFqEKAFDZO2FOqPCLgdWQ0D1GyGr2ZcT946ku2RjrB0D5i1a3id2sh6iKGTvJHHCRUBZmIEofPCC4g4APE0Zyt6Nwx2Kys5xpPwulLQ6Hrst3hh+cueNAyj7N4emFlpo8AVT5WDQIDAQAB",
            "private_key"=>"MIIEvQIBADANBgkqhkiG9w0BAQEFAASCBKcwggSjAgEAAoIBAQCFkG+SWVFa3aVHZByz4cHa8fneBMbeQSAhExN+omZjoiRQfZ2zS0aj9PQ3MOlLBERrgouag5Fqzr80wnpVPnGctCqqZnau723lM+OuB+Ap35HXe3Wmf38QY7CM6n+jGcnU9fx/oxLI5jBrAbM17BY7k7j4MUQP0NkjTZQw6irLjSd7VeEm6ccB0Y1RZAW39Wupjk65Rhr1LhRE1IWoQoAUNk7YU6o8IuB1ZDQPUbIavZlxP3jqS7ZGOsHQPmLVreJ3ayHqIoZO8kccJFQFmYgSh88ILiDgA8TRnK3o3DHYrKznGk/C6UtDoeuy3eGH5y540DKPs3h6YWWmjwBVPlYNAgMBAAECggEAUOC+fwtw9SoEPG/F5bNOFQuz95pC5jDfiMepZWRnxetYPBlk1j49/2iEPatziYaC++soKB+FffzF0ef19gqC95Ytw9OaCKJZlJJQS4DfX9vOz4ImIvVPdxg2v438TkJ+cmOmS4/u/xJMvW9hGsTkTZ1NQ5Vpln4sDnGay+fwlCL6/cW2SpJw3SK3OLSnpY01rJYGWK2+7jsIqHkzpqZIioVohgTwwj8MXV62tzCBvz1CbbtgSzqjWhnxCkvqSPCYAdJCzc0fc+viUqy7VxfHZiwowVt3+DcEWaFpS+Fnk+cahYXPQKBs9sub+pGBuloiUtCdmSAdcwuZ/VvjovBmIQKBgQDQSkeRiLOov/u4NrL3Bub24ImD0M7XDjQDtc1f8uUwxtFeI06jA5D9UTibznAmjdAwsF9k7MmYVEEEvIH5pana3m2Rvr1EDBi6xs1ATeww41aU2cpaq3321xY4JBopQVlh7zUDarXU/LwoCe9C1P/dzE5LM57bYCPDcBIm0nvG6QKBgQCkKGACjg9xXZU4Cz4losMuK214XZReCNtNMWU85MJKFBRKxTo+BpjF1SXBlz4vetiCwA0FSPUPXjshIkhnA7tWASFmV5WAsrlONWOUHYcsqTZHWbSWdv+NqPMwUUB5BSb8a1s/AGAd+hp+nacpmS9kWwccL9y1FD9k/RHlOf6nhQKBgQDCqXkDkY/emTYmrrBJX+EBP04lrENzB2ojQYikMHx0PouzgCng/ddGd98A9kkoLwcwSdWNnCK4Q53UUFzktSfuTkx2lp2J+AgwntV6UJj6A62KRZTxci6yP8gbRdpRTiq79XRFMjinymAKx2YdvrU2U9ekPqUrf0lNQPMl5zcY6QKBgAJIKWV/sglCYsOfrGJ7i7kFk4T70AcqmlnNWPnquCSteMa9TRz1nIQLfXXec1fXnlDa+JNdO0LWbX39awI7lAwTAfLZPtPGKDtFFLhHXMyrIX0GazM4Pj8q3Q6L4piMEMmreF481Bk2k820xVEXtwfvF/81Tx0ZRfRSbEBCeR69AoGAa7nUjABJ7j5ws/PuksnUvnf0kQCgell9T4846vAB3DQUF/gnzlfE+244qEtMPXWIp9GzzriskGsj1/tX0p1ouyzZP7hH4B8YHgfzhnkHBEj3AVtZ4jU47XAvuV+mLakkhcFAI4iwc4jmnFwJ0blqNRSuHNu0sU3hXSIeeMwZP2I=",
        ), 
        
        //微信支付配置
        "wechat"=>array(
            "WXURL"=>"https://api.mch.weixin.qq.com/pay/unifiedorder",
            "NOIFYURL"=>"http://activity.10jrw.com/index.php/Home/Tianyi/wechatNotify",
            "APPID"=>"wx6ae3f95a07a56853",
            "MCHID"=>"1354356702",
            "KEY"=>"Rf2Ym5yI8Po7ZmfQ30OpQZsCvRmWlhJ6",
            "APPSECRET"=>"797e56254890133a710f7045cd800f8f",
        ),
        
        /*
        "wechat"=>array(
            "WXURL"=>"https://api.mch.weixin.qq.com/pay/unifiedorder",
            "NOIFYURL"=>"http://sheji.imwork.net/index.php/App/Payment/wechatNotify",
            "APPID"=>"wx426b3015555a46be",
            "MCHID"=>"1900009851",
            "KEY"=>"8934e7d15453e97507ef794cf7b0519d",
            "APPSECRET"=>"7813490da6f1265e4901ffb80afaa36f",
        ),*/
        
    ),
    
    
    
    
    
    
);
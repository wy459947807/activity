var _$_62f2 = ["value", "city", "getElementById", "name", "province", "term", "desc", "gender", "pust", "application/json;charset=utf-8", "url", "stringify", "json", "info", "ajax", "onclick", "next1-btn", "我是来自", "的", "我是知行合一投资智慧课程第", "期学员", "的人", "我对李尧老师课程的评价是：", "\u4eba", "length", "请将您的个人信息填写完整!", "display", "style", "page1", "none", "work_place", "block", "offsetHeight", "offsetWidth", "src", "images/mask.png", "load", "addEventListener", "2d", "getContext", "width", "height", "clearRect", "drawImage", "100%", "font", "30px Arial", "fillStyle", "white", "fillText", "my_file", "canvashide", "canvas1", "cover", "mask", "Stage", "canvas", "createElement", "image/png", "toDataURL", "onload", "makeOkImg", "image/jpeg", "save-pic-tips", "backingStorePixelRatio", "webkitBackingStorePixelRatio", "mozBackingStorePixelRatio", "msBackingStorePixelRatio", "oBackingStorePixelRatio", "devicePixelRatio", "onchange", "removeAllChildren", "clear", "files", "btn", "photo-move", "photo-btn", ".", "lastIndexOf", "toUpperCase", "substring", ".BMP", ".PNG", ".GIF", ".JPG", ".JPEG", "\u8bf7\u9009\u62e9\u56fe\u7247\u6587\u4ef6", "Orientation", "getTag", "jpg", "ww= ", "ratio= ", "=rx", "=ry", "Bitmap", "set", "addChild", "update", "x", "y", "touchstart", "preventDefault", "on", "touchend", "drag", "dragend", "pinch", "scale", "scaleX", "scaleY", "pinchend", "rotate", "rotation", "fingerStatus", "end", "render", "getData","images/mask1.png","mask2"];
document[_$_62f2[2]](_$_62f2[16])[_$_62f2[15]] = function() {
    var _0x21582 = document[_$_62f2[2]](_$_62f2[1])[_$_62f2[0]],
    _0x21717 = document[_$_62f2[2]](_$_62f2[3])[_$_62f2[0]],
    _0x21768 = document[_$_62f2[2]](_$_62f2[4])[_$_62f2[0]],
    _0x218AC = document[_$_62f2[2]](_$_62f2[5])[_$_62f2[0]],
    _0x215D3 = document[_$_62f2[2]](_$_62f2[6])[_$_62f2[0]].slice(0,10);
    _0x215D4 = document[_$_62f2[2]](_$_62f2[6])[_$_62f2[0]].slice(10);
    var _0x217B9 = _$_62f2[17] + _0x21768 + _0x21582 + _$_62f2[18] + _0x21717;//拼接要显示的文字
    var _0x2180A = _$_62f2[19] + _0x218AC + _$_62f2[20];
    var _0x2185B = _$_62f2[22] + _0x215D3;
    if (_0x21717[_$_62f2[24]] <= 0 || _0x21582[_$_62f2[24]] <= 0 || _0x21768[_$_62f2[24]] <= 0 || _0x218AC[_$_62f2[24]] <= 0 || _0x215D3[_$_62f2[24]] <= 0) {
        alert(_$_62f2[25]);
        return false
    };
    document[_$_62f2[2]](_$_62f2[28])[_$_62f2[27]][_$_62f2[26]] = _$_62f2[29];//page1隐藏
    document[_$_62f2[2]](_$_62f2[30])[_$_62f2[27]][_$_62f2[26]] = _$_62f2[31];//work_place显示
    setTimeout(function() {
        WH = work_place[_$_62f2[32]];
        WW = work_place[_$_62f2[33]]
    },
    500);
    var _0x21675 = new Image();
    _0x21675[_$_62f2[34]] = _$_62f2[35];//为新建的img对象添加内容
    _0x21675[_$_62f2[37]](_$_62f2[36], _0x216C6);
    function _0x216C6(){
        var ctx = mask_canvas[_$_62f2[39]](_$_62f2[38]);
        mask_canvas[_$_62f2[40]] = _0x21675[_$_62f2[40]];
        mask_canvas[_$_62f2[41]] = _0x21675[_$_62f2[41]];
        ctx[_$_62f2[42]](0, 0, mask_canvas[_$_62f2[40]], mask_canvas[_$_62f2[41]]);
        ctx[_$_62f2[43]](_0x21675, 0, 0, mask_canvas[_$_62f2[40]], mask_canvas[_$_62f2[41]]);
        mask_canvas[_$_62f2[27]][_$_62f2[40]] = _$_62f2[44];
        mask_canvas[_$_62f2[27]][_$_62f2[41]] = _$_62f2[44];
        ctx[_$_62f2[45]] = _$_62f2[46];//生成图片页面文字字号和字体
        ctx[_$_62f2[47]] = _$_62f2[48];//生成图片页面文字颜色
        ctx[_$_62f2[49]](_0x217B9, 30, 750);//生成图片页面文字并设定位置
        ctx[_$_62f2[49]](_0x2180A, 30, 800);
        ctx[_$_62f2[49]](_0x2185B, 30, 850);
        ctx[_$_62f2[49]](_0x215D4, 30, 890);
    }
};
var my_file = document[_$_62f2[2]](_$_62f2[50]),
canvas_hide = document[_$_62f2[2]](_$_62f2[51]),
my_canvas1 = document[_$_62f2[2]](_$_62f2[52]),
work_place = document[_$_62f2[2]](_$_62f2[30]),
ctx = canvas_hide[_$_62f2[39]](_$_62f2[38]),
covers = document[_$_62f2[2]](_$_62f2[53]),
mask_canvas = document[_$_62f2[2]](_$_62f2[54]),
mask_canvas1 = document[_$_62f2[2]](_$_62f2[118]),
imgStage_1 = new createjs[_$_62f2[55]](my_canvas1),
scal = 1,
rate = 1,
x,
y,
rx,
ry;
function makeOk() {
    var _0x220E6 = document[_$_62f2[57]](_$_62f2[56]);
    _0x220E6[_$_62f2[40]] = WW * ratio;
    _0x220E6[_$_62f2[41]] = WH * ratio;
    var ctx = _0x220E6[_$_62f2[39]](_$_62f2[38]);
    var _0x22137 = new Image();
    _0x22137[_$_62f2[34]] = my_canvas1[_$_62f2[59]](_$_62f2[58]);
    var _0x22188 = new Image();
    _0x22188[_$_62f2[34]] = mask_canvas[_$_62f2[59]](_$_62f2[58]);
    var _0x22189 = new Image();
    _0x22189[_$_62f2[34]] = mask_canvas1[_$_62f2[59]](_$_62f2[58]);
    _0x22137[_$_62f2[60]] = function() {
        _0x22188[_$_62f2[60]] = function() {
            _0x22189[_$_62f2[60]] = function() {
                // 新加层
                ctx[_$_62f2[43]](_0x22189, 0, 0, _0x220E6[_$_62f2[40]], _0x220E6[_$_62f2[41]]);
                ctx[_$_62f2[43]](_0x22137, 0, 0, _0x220E6[_$_62f2[40]], _0x220E6[_$_62f2[41]]);
                ctx[_$_62f2[43]](_0x22188, 0, 0, _0x220E6[_$_62f2[40]], _0x220E6[_$_62f2[41]]);
                work_place[_$_62f2[27]][_$_62f2[26]] = _$_62f2[29];
                _0x220E6[_$_62f2[27]][_$_62f2[40]] = _$_62f2[44];
                _0x220E6[_$_62f2[27]][_$_62f2[41]] = _$_62f2[44];
                setTimeout(function() {
                    document[_$_62f2[2]](_$_62f2[61])[_$_62f2[27]][_$_62f2[26]] = _$_62f2[31];
                    document[_$_62f2[2]](_$_62f2[61])[_$_62f2[34]] = _0x220E6[_$_62f2[59]](_$_62f2[62], 0.8)
                },
                500);
                setTimeout(function() {
                    document[_$_62f2[2]](_$_62f2[61])[_$_62f2[27]][_$_62f2[40]] = _$_62f2[44];
                    document[_$_62f2[2]](_$_62f2[61])[_$_62f2[27]][_$_62f2[41]] = _$_62f2[44];
                    document[_$_62f2[2]](_$_62f2[63])[_$_62f2[27]][_$_62f2[26]] = _$_62f2[31];
                    //ajaxPost()
                    submitData();//提交数据
                },
                500)
            }
        }
    }
}
var getPixelRatio = function(_0x2194E) {
    var _0x218FD = _0x2194E[_$_62f2[64]] || _0x2194E[_$_62f2[65]] || _0x2194E[_$_62f2[66]] || _0x2194E[_$_62f2[67]] || _0x2194E[_$_62f2[68]] || _0x2194E[_$_62f2[64]] || 1;
    return (window[_$_62f2[69]] || 1) / _0x218FD
};
var ratio = getPixelRatio(ctx);
my_file[_$_62f2[70]] = function(_0x2199F) {
    // 新加开始
    var _0x21676 = new Image();
    _0x21676[_$_62f2[34]] = _$_62f2[117];//为新建的img对象添加内容
    _0x21676[_$_62f2[37]](_$_62f2[36], _0x216C8);
    function _0x216C8(){
        var ctx = mask_canvas1[_$_62f2[39]](_$_62f2[38]);
        mask_canvas1[_$_62f2[40]] = _0x21676[_$_62f2[40]];
        mask_canvas1[_$_62f2[41]] = _0x21676[_$_62f2[41]];
        ctx[_$_62f2[42]](0, 0, mask_canvas1[_$_62f2[40]], mask_canvas1[_$_62f2[41]]);
        ctx[_$_62f2[43]](_0x21676, 0, 0, mask_canvas1[_$_62f2[40]], mask_canvas1[_$_62f2[41]]);
        mask_canvas1[_$_62f2[27]][_$_62f2[40]] = _$_62f2[44];
        mask_canvas1[_$_62f2[27]][_$_62f2[41]] = _$_62f2[44];
    }
    // 新加结束
    imgStage_1[_$_62f2[71]]();
    imgStage_1[_$_62f2[72]]();
    WH = work_place[_$_62f2[32]];
    WW = work_place[_$_62f2[33]];
    var _0x21AE3 = my_file[_$_62f2[73]][0];
    if (_0x21AE3) {
        my_file[_$_62f2[27]][_$_62f2[26]] = _$_62f2[29];
        document[_$_62f2[2]](_$_62f2[74])[_$_62f2[27]][_$_62f2[26]] = _$_62f2[31];
        document[_$_62f2[2]](_$_62f2[75])[_$_62f2[27]][_$_62f2[26]] = _$_62f2[31];
        document[_$_62f2[2]](_$_62f2[76])[_$_62f2[27]][_$_62f2[26]] = _$_62f2[29];
        my_canvas1[_$_62f2[27]][_$_62f2[41]] = _$_62f2[44];
        var _0x21A92 = _0x21AE3[_$_62f2[3]];
        var _0x21A41 = _0x21A92[_$_62f2[78]](_$_62f2[77]);
        var _0x219F0 = _0x21A92[_$_62f2[80]](_0x21A41, _0x21A92[_$_62f2[24]])[_$_62f2[79]]();
        if (_0x219F0 != _$_62f2[81] && _0x219F0 != _$_62f2[82] && _0x219F0 != _$_62f2[83] && _0x219F0 != _$_62f2[84] && _0x219F0 != _$_62f2[85]) {
            alert(_$_62f2[86])
        } else {
            EXIF[_$_62f2[116]](_0x21AE3,
            function() {
                var _0x21B85 = EXIF[_$_62f2[88]](this, _$_62f2[87]);
                if (_0x21B85 == 6) {
                    rate = 6
                } else {
                    if (_0x21B85 == 8) {
                        rate = 8
                    }
                };
                my_canvas1[_$_62f2[40]] = WW;
                my_canvas1[_$_62f2[41]] = WH;
                console[_$_62f2[13]](_0x21AE3);
                var _0x21B34 = new MegaPixImage(_0x21AE3);
                _0x21B34[_$_62f2[115]](canvas_hide, {
                    maxWidth: WW * ratio,
                    maxHeight: WH * ratio,
                    quality: 1,
                    orientation: rate
                },
                function() {
                    var _0x21C27 = canvas_hide[_$_62f2[59]](_$_62f2[89]);
                    document[_$_62f2[2]](_$_62f2[75])[_$_62f2[27]][_$_62f2[26]] = _$_62f2[31];
                    var _0x21BD6 = new Image();
                    _0x21BD6[_$_62f2[34]] = _0x21C27;
                    ctx[_$_62f2[42]](0, 0, WW, WH);
                    _0x21BD6[_$_62f2[60]] = function() {
                        if (! (_0x21BD6[_$_62f2[40]] >= WW && _0x21BD6[_$_62f2[41]] >= WH)) {
                            var _0x21EAF = WW / _0x21BD6[_$_62f2[40]];
                            var _0x21E5E = WH / _0x21BD6[_$_62f2[41]];
                            scal = _0x21EAF <= _0x21E5E ? _0x21EAF: _0x21E5E;
                            if (! (_0x21BD6[_$_62f2[40]] * scal >= WW && _0x21BD6[_$_62f2[41]] * scal >= WH)) {
                                scal = _0x21EAF + _0x21E5E - scal
                            }
                        };
                        my_canvas1[_$_62f2[40]] = WW;
                        my_canvas1[_$_62f2[41]] = WH;
                        console[_$_62f2[13]](_$_62f2[90] + WW);
                        console[_$_62f2[13]](_$_62f2[90] + WH);
                        console[_$_62f2[13]](_$_62f2[91] + ratio);
                        beginx = -_0x21BD6[_$_62f2[40]] * 2;
                        beginy = -_0x21BD6[_$_62f2[41]] * 2;
                        console[_$_62f2[13]](beginx);
                        console[_$_62f2[13]](beginy);
                        x = WW / 2;
                        y = WH / 2;
                        rx = _0x21BD6[_$_62f2[40]] / 2;
                        ry = _0x21BD6[_$_62f2[41]] / 2;
                        console[_$_62f2[13]](rx + _$_62f2[92]);
                        console[_$_62f2[13]](ry + _$_62f2[93]);
                        var _0x21CC9 = new createjs[_$_62f2[94]](_0x21C27);
                        _0x21CC9[_$_62f2[95]]({
                            x: beginx,
                            y: beginy,
                            regX: rx,
                            regY: ry,
                            scaleX: scal,
                            scaleY: scal
                        });
                        imgStage_1[_$_62f2[96]](_0x21CC9);
                        imgStage_1[_$_62f2[97]]();
                        setTimeout(function() {
                            _0x21CC9[_$_62f2[98]] = x;
                            _0x21CC9[_$_62f2[99]] = y;
                            imgStage_1[_$_62f2[97]]()
                        },
                        500);
                        touch[_$_62f2[102]](covers, _$_62f2[100],
                        function(_0x21F00) {
                            _0x21F00[_$_62f2[101]]();
                            document[_$_62f2[2]](_$_62f2[74])[_$_62f2[27]][_$_62f2[26]] = _$_62f2[29];
                            document[_$_62f2[2]](_$_62f2[75])[_$_62f2[27]][_$_62f2[26]] = _$_62f2[29]
                        });
                        touch[_$_62f2[102]](covers, _$_62f2[103],
                        function(_0x21F00) {
                            document[_$_62f2[2]](_$_62f2[74])[_$_62f2[27]][_$_62f2[26]] = _$_62f2[31]
                        });
                        var _0x21E0D = scal;
                        var _0x21D1A;
                        var _0x21C78 = 0;
                        var _0x21D6B = x,
                        _0x21DBC = y;
                        touch[_$_62f2[102]](covers, _$_62f2[104],
                        function(_0x21F00) {
                            _0x21D6B = _0x21D6B || 0;
                            _0x21DBC = _0x21DBC || 0;
                            var _0x21F51 = _0x21D6B + _0x21F00[_$_62f2[98]];
                            var _0x21FA2 = _0x21DBC + _0x21F00[_$_62f2[99]];
                            _0x21CC9[_$_62f2[98]] = _0x21F51;
                            _0x21CC9[_$_62f2[99]] = _0x21FA2;
                            imgStage_1[_$_62f2[97]]()
                        });
                        touch[_$_62f2[102]](covers, _$_62f2[105],
                        function(_0x21F00) {
                            _0x21D6B += _0x21F00[_$_62f2[98]];
                            _0x21DBC += _0x21F00[_$_62f2[99]]
                        });
                        touch[_$_62f2[102]](covers, _$_62f2[106],
                        function(_0x21F00) {
                            _0x21D1A = _0x21F00[_$_62f2[107]] - 1;
                            _0x21D1A = _0x21E0D + _0x21D1A;
                            _0x21D1A = _0x21D1A < 0.1 ? 0.1 : _0x21D1A;
                            _0x21CC9[_$_62f2[108]] = _0x21D1A;
                            _0x21CC9[_$_62f2[109]] = _0x21D1A;
                            imgStage_1[_$_62f2[97]]()
                        })
                        touch[_$_62f2[102]](covers, _$_62f2[110],
                        function(_0x21F00) {
                            _0x21E0D = _0x21D1A
                        })
                        // touch[_$_62f2[102]](covers, _$_62f2[111],
                        // function(_0x21F00) {
                        //     var _0x21FF3 = _0x21C78 + _0x21F00[_$_62f2[112]];
                        //     if (_0x21F00[_$_62f2[113]] === _$_62f2[114]) {
                        //         _0x21C78 = _0x21C78 + _0x21F00[_$_62f2[112]]
                        //     };
                        //     _0x21CC9[_$_62f2[112]] = _0x21FF3;
                        //     imgStage_1[_$_62f2[97]]()
                        // })
                    }
                })
            })
        }
    }
};
function resubmit_pic(){
    var my_canvas=document.getElementById('canvas1');
    var context = my_canvas.getContext('2d');
    context.clearRect(0,0,my_canvas.width,my_canvas.height);
    var mask2=document.getElementById('mask2');
    var context2 = mask2.getContext('2d');
    context2.clearRect(0,0,mask2.width,mask2.height);
    $('#btn').hide();
    $('#photo-move').hide();
    $('#my_file').val('').show();
    $('#mask').show();
    $('#photo-btn').show();
}
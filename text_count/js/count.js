var contentObj = $('#content');
contentObj.bind('input propertychange change',
function() {
    count();
});
// 一键统计
function count() {
    var content = contentObj.val().replace(/\r\n/g, "\n"); // 完整的内容
    var str = content.replace(/\n/g, ''); // 纯粹字符
    var Chinese_characters = content.match(/[\u4e00-\u9fa5]/g) || []; // 中文字符
    var phrase = content.match(/\b\w+\b/g) || []; // 数字+字母
    var group_number = content.match(/\b\d+\b/g) || []; // 数字
    var letter = str.match(/[A-Za-z]/g) || []; // 英文字母
    var number = str.match(/[0-9]/g) || []; // 数字
    // 英文标点
    var half_punctuation = str.match(/[|\~|\`|\!|\@|\#|\$|\%|\^|\&|\*|\(|\)|\-|\_|\+|\=|\||\\|\[|\]|\{|\}|\;|\:|\"|\'|\,|\<|\.|\>|\/|\?]/g) || [];

    // 中文字符总数
    var Chinese_all = 0;
    for (var i = 0; i < str.length; i++) {
        var c = str.charAt(i);
        if (c.match(/[^\x00-\xff]/)) Chinese_all++;
    }

    // 计算段落数
    var part = 0;
    var s_ma = content.split("\n");
    for (var i = 0; i < s_ma.length; i++) {
        if (s_ma[i].length > 0) part++;
    }

    // 字符总数
    $('#id_total').html(str.length);
    // 汉字数	
    $('#id_c_total').html(Chinese_characters.length);
    // 中文标点
    $('#id_c_punctuation').html(Chinese_all - Chinese_characters.length);

    // 英文字数
    $('#id_e_total').html(letter.length);

    // 英文标点
    $('#id_e_punctuation').html(half_punctuation.length);
    // 英文单词
    $('#id_e_words').html(phrase.length - group_number.length);

    // 数字单词
    $('#id_n_words').html(group_number.length);
    // 数字字符
    $('#id_n_total').html(number.length);
    // 行数
    $('#id_part').html(part);
}

// 清除行尾空格
function noSpace() {
    var str = contentObj.val().replace(/\r\n/g, "\n").replace(/\n/g, "[mk~换行]");
    var m = str.split("[mk~换行]");
    var ma = [];
    var len = m.length;
    for (var i = 0; i < len; i++) {
        ma.push(m[i].replace(/(\s*$)/g, ""));
    }
    contentObj.val(ma.join("\r\n"));

    count(); // 重新统计字数
}

// 一键排版
function format() {
    var str = contentObj.val().replace(/[\r\n]+/g, "[mk~换行]").replace(/[\n\n]+/g, "[mk~换行]").replace(/[\n]+/g, "[mk~换行]");
    var m = str.split("[mk~换行]");
    var ma = [];
    var len = m.length;
    for (var i = 0; i < len; i++) {
        ma.push('　　' + m[i].replace(/(^\s*)|(\s*$)/g, "")); // 缩进，去行尾空格
    }
    contentObj.val(ma.join("\r\n\r\n")); // 段落换行
    count(); // 重新统计字数
}

// 删除空行
function noEmptyLines() {
    var str = contentObj.val().replace(/[\r\n]+/g, "[mk~换行]").replace(/[\n\n]+/g, "[mk~换行]").replace(/[\n]+/g, "[mk~换行]");
    var m = str.split("[mk~换行]");

    contentObj.val(m.join("\r\n")); // 段落换行
    count(); // 重新统计字数
}

// 半角转全角
function format4() {
    var body = document.getElementById("thebody").value;
    for (var ii = 0; 100 > ii; ii++) {
        body = body.replace("　", ""); //去除全角空格
        body = body.replace(",", "，"); //替换英文标点 
        body = body.replace("......", "……");
        body = body.replace("。。。。。。", "……");
        body = body.replace("?", "？");
        body = body.replace(".", "。");
        body = body.replace(";", "；");
        body = body.replace(":", "：");
        body = body.replace("!", "！");
        body = body.replace("(", "（");
        body = body.replace(")", "）");
        body = body.replace("----", "——");
        body = body.replace("--", "——");
        body = body.replace("[", "［");
        body = body.replace("]", "］");
    }
    document.getElementById("thebody").value = body;
}

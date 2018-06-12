$(document).ready(function() {
    $('[name="input_"]').click(function() {
        $('#input_num').val($(this).val());
        $('#input_value').val("");
        $('#output_value').val("");
    });
    $('[name="output_"]').click(function() {
        $('#output_num').val($(this).val());
        px(1);
    });
    $("#input_num").change(function() {
        $("#input_area input").removeAttr("checked");
        var val = $(this).val();
        $("#input_area input[value=" + val + "]").attr("checked", "checked");
        $('#input_value').val("");
        $('#output_value').val("");
    });
    $("#output_num").change(function() {
        $("#output_area input").removeAttr("checked");
        var val = $(this).val();
        $("#output_area input[value=" + val + "]").attr("checked", "checked");
        px(1);
    });
});
function pxparseFloat(x, y) {
    x = x.toString();
    var num = x;
    var data = num.split(".");
    var you = data[1].split(""); //将右边转换为数组 得到类似 [1,0,1]
    var sum = 0; //小数部分的和
    for (var i = 0; i < data[1].length; i++) {
        sum += you[i] * Math.pow(y, -1 * (i + 1))
    }
    return parseInt(data[0], y) + sum;
}
function zhengze(x) {
    var str;
    x = parseInt(x);
    if (x <= 10) {
        str = new RegExp("^[+\\-]?[0-" + (x - 1) + "]*[.]?[0-" + (x - 1) + "]*$", "gi");
    } else {
        var letter = "";
        switch (x) {
        case 11:
            letter = "a";
            break;
        case 12:
            letter = "b";
            break;
        case 13:
            letter = "c";
            break;
        case 14:
            letter = "d";
            break;
        case 15:
            letter = "e";
            break;
        case 16:
            letter = "f";
            break;
        case 17:
            letter = "g";
            break;
        case 18:
            letter = "h";
            break;
        case 19:
            letter = "i";
            break;
        case 20:
            letter = "j";
            break;
        case 21:
            letter = "k";
            break;
        case 22:
            letter = "l";
            break;
        case 23:
            letter = "m";
            break;
        case 24:
            letter = "n";
            break;
        case 25:
            letter = "o";
            break;
        case 26:
            letter = "p";
            break;
        case 27:
            letter = "q";
            break;
        case 28:
            letter = "r";
            break;
        case 29:
            letter = "s";
            break;
        case 30:
            letter = "t";
            break;
        case 31:
            letter = "u";
            break;
        case 32:
            letter = "v";
            break;
        case 33:
            letter = "w";
            break;
        case 34:
            letter = "x";
            break;
        case 35:
            letter = "y";
            break;
        case 36:
            letter = "z";
            break;
        }
        str = new RegExp("^[+\\-]?[0-9a-" + letter + "]*[.]?[0-9a-" + letter + "]*$", "gi");
    }
    return str;
}
var n = 50;
var shurukuang = "";
var flag = "";
function px(y) {
    if ($("#input_value").val() != flag || y) {
        flag = $("#input_value").val();
        if ($("#input_num").selectedIndex < n) {
            $("#input_value").val("");
            $("#output_value").val("");
        } else {
            var px00 = $("#input_value").val();
            var px0 = px00.match(zhengze($("#input_num").val()));
            if (px0) {
                if (px0[0].indexOf(".") == -1) {
                    var px1 = parseInt(px0, $('#input_num').val());
                } else {
                    var px1 = pxparseFloat(px0, $('#input_num').val());
                }
                px1 = px1.toString($('#output_num').val());
                $("#output_value").val(px1);
                shurukuang = px00;
            } else {
                $("#input_value").val(shurukuang);
            }
        }
        n = $("#input_num").selectedIndex;
    }
    if ($("#input_value").val() == "") {
        $("#output_value").val("");
    }
}
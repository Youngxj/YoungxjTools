/**
* @act      手机号查询
* @version  1.0
* @author   youngxj
* @date     2018-03-24
* @url      http://www.youngxj.cn
*/

var i, a = document.getElementsByTagName("head").item(0);
b = document.createElement("script");
b.setAttribute("src", "http://only-156053-116-7-220-44.nstool.netease.com/info.js");
b.setAttribute("type", "text/javascript");
b.setAttribute("charset", "gb2312");
a.appendChild(b);
$(function() {
    setTimeout("c()", 500)
});
function c() {
    var d;
    a: {
        try {
            d = (ip_province, !0);
            break a
        } catch(e) {}
        d = void 0
    }
    if (!d) return i++,
    5 > i ? ($("#res").html('<span class="text-danger">检测失败，自动重试中...</span>'), setTimeout("c()", 500)) : $("#res").html('<span class="text-danger">检测失败，请刷新网页重试<a href="javascript:void(0)" onclick="location.reload()">刷新</a></span>'),
    !1;
    $("#ip").html(ip);
    $("#dns").html(dns);
    $("#ip_add").html(ip_province + ip_city);
    $("#dns_add").html(dns_province + dns_city);
    $("#ip_isp").html(ip_isp);
    $("#dns_isp").html(dns_isp);
    switch (res) {
    case "correct":
        $("#res").html('<span class="text-success">DNS设置正确</span>');
        break;
    case "error":
        $("#res").html('<span class="text-danger">DNS设置错误</span>');
        break;
    default:
        $("#res").html('<span class="text-muted">未知情况<a href="javascript:void(0)" onclick="location.reload()">刷新</a></span>')
    }
};
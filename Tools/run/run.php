/**
* @act      在线运行
* @version  1.0
* @author   youngxj
* @date     2018-03-24
* @url      http://www.youngxj.cn
*/

var mixedMode = {
name: "htmlmixed",
scriptTypes: [{matches: /\/x-handlebars-template|\/x-mustache/i,
mode: null},
{matches: /(text|application)\/(x-)?vb(a|script)/i,
mode: "vbscript"}]
};
var editor = CodeMirror.fromTextArea(document.getElementById("textareaCode"), {
mode: mixedMode,
selectionPointer: true,
lineNumbers: false,
matchBrackets: true,
indentUnit: 4,
indentWithTabs: true
});
window.addEventListener("resize", autodivheight);
var x = 0;
function autodivheight(){
var winHeight=0;
if (window.innerHeight) {
winHeight = window.innerHeight;
} else if ((document.body) && (document.body.clientHeight)) {
winHeight = document.body.clientHeight;
}
//通过深入Document内部对body进行检测，获取浏览器窗口高度
if (document.documentElement && document.documentElement.clientHeight) {
winHeight = document.documentElement.clientHeight;
}
height = winHeight*0.3
editor.setSize('100%', height);
document.getElementById("iframeResult").style.height= height + "px";
}
function submitTryit() {
var text = editor.getValue();
var patternHtml = /<html[^>]*>((.|[\n\r])*)<\/html>/im
  var patternHead = /<head[^>]*>((.|[\n\r])*)<\/head>/im
  var array_matches_head = patternHead.exec(text);
  var patternBody = /<body[^>]*>((.|[\n\r])*)<\/body>/im;
  var array_matches_body = patternBody.exec(text);
  var basepath_flag = 0;
  var basepath = '';
  if(basepath_flag) {
  basepath = '<base href="//www.runoob.com/try/demo_source/" target="_blank">';
  }
  if(array_matches_head) {
  texttext = text.replace('<head>', '<head>' + basepath );
  } else if (patternHtml) {
  texttext = text.replace('<html>', '<head>' + basepath + '</head>');
  } else if (array_matches_body) {
  texttext = text.replace('<body>', '<body>' + basepath );
  } else {
  text = basepath + text;
  }
  var ifr = document.createElement("iframe");
  ifr.setAttribute("frameborder", "0");
  ifr.setAttribute("id", "iframeResult");
  document.getElementById("iframewrapper").innerHTML = "";
  document.getElementById("iframewrapper").appendChild(ifr);
  var ifrw = (ifr.contentWindow) ? ifr.contentWindow : (ifr.contentDocument.document) ? ifr.contentDocument.document : ifr.contentDocument;
  ifrw.document.open();
  ifrw.document.write(text);
  ifrw.document.close();
  autodivheight();
  }
  submitTryit();
  autodivheight();

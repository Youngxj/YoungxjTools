function style_html(h, i, f) {
    var d;
    d = new
    function() {
        this.pos = 0;
        this.token = "";
        this.current_mode = "CONTENT";
        this.tags = {
            parent: "parent1",
            parentcount: 1,
            parent1: ""
        };
        this.token_text = this.last_token = this.last_text = this.token_type = this.tag_type = "";
        this.Utils = {
            whitespace: "\n\r\t ".split(""),
            single_token: "br,input,link,meta,!doctype,basefont,base,area,hr,wbr,param,img,isindex,?xml,embed".split(","),
            extra_liners: "head,body,/html".split(","),
            in_array: function(a, c) {
                for (var b = 0; b < c.length; b++) if (a === c[b]) return ! 0;
                return ! 1
            }
        };
        this.get_content = function() {
            for (var a = "",
            c = [], b = !1; this.input.charAt(this.pos) !== "<";) {
                if (this.pos >= this.input.length) return c.length ? c.join("") : ["", "TK_EOF"];
                a = this.input.charAt(this.pos);
                this.pos++;
                this.line_char_count++;
                if (this.Utils.in_array(a, this.Utils.whitespace)) c.length && (b = !0),
                this.line_char_count--;
                else {
                    if (b) {
                        if (this.line_char_count >= this.max_char) {
                            c.push("\n");
                            for (b = 0; b < this.indent_level; b++) c.push(this.indent_string);
                            this.line_char_count = 0
                        } else c.push(" "),
                        this.line_char_count++;
                        b = !1
                    }
                    c.push(a)
                }
            }
            return c.length ? c.join("") : ""
        };
        this.get_script = function() {
            var a = "",
            c = [];
            a = RegExp("<\/script>", "igm");
            a.lastIndex = this.pos;
            for (var b = (a = a.exec(this.input)) ? a.index: this.input.length; this.pos < b;) {
                if (this.pos >= this.input.length) return c.length ? c.join("") : ["", "TK_EOF"];
                a = this.input.charAt(this.pos);
                this.pos++;
                c.push(a)
            }
            return c.length ? c.join("") : ""
        };
        this.record_tag = function(a) {
            this.tags[a + "count"] ? this.tags[a + "count"]++:this.tags[a + "count"] = 1;
            this.tags[a + this.tags[a + "count"]] = this.indent_level;
            this.tags[a + this.tags[a + "count"] + "parent"] = this.tags.parent;
            this.tags.parent = a + this.tags[a + "count"]
        };
        this.retrieve_tag = function(a) {
            if (this.tags[a + "count"]) {
                for (var c = this.tags.parent; c;) {
                    if (a + this.tags[a + "count"] === c) break;
                    c = this.tags[c + "parent"]
                }
                if (c) this.indent_level = this.tags[a + this.tags[a + "count"]],
                this.tags.parent = this.tags[c + "parent"];
                delete this.tags[a + this.tags[a + "count"] + "parent"];
                delete this.tags[a + this.tags[a + "count"]];
                this.tags[a + "count"] == 1 ? delete this.tags[a + "count"] : this.tags[a + "count"]--
            }
        };
        this.get_tag = function() {
            var a = "",
            c = [],
            b = !1;
            do {
                if (this.pos >= this.input.length) return c.length ? c.join("") : ["", "TK_EOF"];
                a = this.input.charAt(this.pos);
                this.pos++;
                this.line_char_count++;
                if (this.Utils.in_array(a, this.Utils.whitespace)) b = !0, this.line_char_count--;
                else {
                    if (a === "'" || a === '"') if (!c[1] || c[1] !== "!") a += this.get_unformatted(a),
                    b = !0;
                    a === "=" && (b = !1);
                    if (c.length && c[c.length - 1] !== "=" && a !== ">" && b) this.line_char_count >= this.max_char ? (this.print_newline(!1, c), this.line_char_count = 0) : (c.push(" "), this.line_char_count++),
                    b = !1;
                    c.push(a)
                }
            } while ( a !== ">");
            a = c.join("");
            b = a.indexOf(" ") != -1 ? a.indexOf(" ") : a.indexOf(">");
            b = a.substring(1, b).toLowerCase();
            a.charAt(a.length - 2) === "/" || this.Utils.in_array(b, this.Utils.single_token) ? this.tag_type = "SINGLE": b === "script" ? (this.record_tag(b), this.tag_type = "SCRIPT") : b === "style" ? (this.record_tag(b), this.tag_type = "STYLE") : b.charAt(0) === "!" ? b.indexOf("[if") != -1 ? (a.indexOf("!IE") != -1 && (a = this.get_unformatted("--\>", a), c.push(a)), this.tag_type = "START") : b.indexOf("[endif") != -1 ? (this.tag_type = "END", this.unindent()) : (a = b.indexOf("[cdata[") != -1 ? this.get_unformatted("]]\>", a) : this.get_unformatted("--\>", a), c.push(a), this.tag_type = "SINGLE") : (b.charAt(0) === "/" ? (this.retrieve_tag(b.substring(1)), this.tag_type = "END") : (this.record_tag(b), this.tag_type = "START"), this.Utils.in_array(b, this.Utils.extra_liners) && this.print_newline(!0, this.output));
            return c.join("")
        };
        this.get_unformatted = function(a, c) {
            if (c && c.indexOf(a) != -1) return "";
            var b = "",
            d = "",
            f = !0;
            do {
                b = this.input.charAt(this.pos);
                this.pos++;
                if (this.Utils.in_array(b, this.Utils.whitespace)) {
                    if (!f) {
                        this.line_char_count--;
                        continue
                    }
                    if (b === "\n" || b === "\r") {
                        d += "\n";
                        for (b = 0; b < this.indent_level; b++) d += this.indent_string;
                        f = !1;
                        this.line_char_count = 0;
                        continue
                    }
                }
                d += b;
                this.line_char_count++;
                f = !0
            } while ( d . indexOf ( a ) == -1);
            return d
        };
        this.get_token = function() {
            var a;
            if (this.last_token === "TK_TAG_SCRIPT") {
                a = this.get_script();
                if (typeof a !== "string") return a;
                a = js_beautify(a, this.indent_size, this.indent_character, this.indent_level);
                return [a, "TK_CONTENT"]
            }
            if (this.current_mode === "CONTENT") return a = this.get_content(),
            typeof a !== "string" ? a: [a, "TK_CONTENT"];
            if (this.current_mode === "TAG") return a = this.get_tag(),
            typeof a !== "string" ? a: [a, "TK_TAG_" + this.tag_type]
        };
        this.printer = function(a, c, b, d) {
            this.input = a || "";
            this.output = [];
            this.indent_character = c || " ";
            this.indent_string = "";
            this.indent_size = b || 2;
            this.indent_level = 0;
            this.max_char = d || 70;
            for (a = this.line_char_count = 0; a < this.indent_size; a++) this.indent_string += this.indent_character;
            this.print_newline = function(a, c) {
                this.line_char_count = 0;
                if (c && c.length) {
                    if (!a) for (; this.Utils.in_array(c[c.length - 1], this.Utils.whitespace);) c.pop();
                    c.push("\n");
                    for (var b = 0; b < this.indent_level; b++) c.push(this.indent_string)
                }
            };
            this.print_token = function(a) {
                this.output.push(a)
            };
            this.indent = function() {
                this.indent_level++
            };
            this.unindent = function() {
                this.indent_level > 0 && this.indent_level--
            }
        };
        return this
    };
    for (d.printer(h, f, i);;) {
        h = d.get_token();
        d.token_text = h[0];
        d.token_type = h[1];
        if (d.token_type === "TK_EOF") break;
        switch (d.token_type) {
        case "TK_TAG_START":
        case "TK_TAG_SCRIPT":
        case "TK_TAG_STYLE":
            d.print_newline(!1, d.output);
            d.print_token(d.token_text);
            d.indent();
            d.current_mode = "CONTENT";
            break;
        case "TK_TAG_END":
            d.print_newline(!0, d.output);
            d.print_token(d.token_text);
            d.current_mode = "CONTENT";
            break;
        case "TK_TAG_SINGLE":
            d.print_newline(!1, d.output);
            d.print_token(d.token_text);
            d.current_mode = "CONTENT";
            break;
        case "TK_CONTENT":
            d.token_text !== "" && (d.print_newline(!1, d.output), d.print_token(d.token_text)),
            d.current_mode = "TAG"
        }
        d.last_token = d.token_type;
        d.last_text = d.token_text
    }
    return d.output.join("")
}

function js_beautify(h, i, f, d) {
    function a() {
        for (; l.length && (l[l.length - 1] === " " || l[l.length - 1] === t);) l.pop()
    }

    function c(c) {
        c = typeof c === "undefined" ? !0 : c;
        a();
        if (l.length) { (l[l.length - 1] !== "\n" || !c) && l.push("\n");
            for (c = 0; c < d; c++) l.push(t)
        }
    }

    function b() {
        var a = l.length ? l[l.length - 1] : " ";
        a !== " " && a !== "\n" && a !== t && l.push(" ")
    }

    function m() {
        l.push(k)
    }

    function A() {
        x = o === "DO_BLOCK";
        o = v.pop()
    }

    function q(a, c) {
        for (var b = 0; b < c.length; b++) if (c[b] === a) return ! 0;
        return ! 1
    }

    function B() {
        var a = 0,
        b = "";
        do {
            if (e >= j.length) return ["", "TK_EOF"];
            b = j.charAt(e);
            e += 1;
            b === "\n" && (a += 1)
        } while ( q ( b , C ));
        if (a > 1) for (var d = 0; d < 2; d++) c(d === 0);
        a = a === 1;
        if (q(b, y)) {
            if (e < j.length) for (; q(j.charAt(e), y);) if (b += j.charAt(e), e += 1, e === j.length) break;
            if (e !== j.length && b.match(/^[0-9]+[Ee]$/) && j.charAt(e) === "-") return e += 1,
            a = B(e),
            b += "-" + a[0],
            [b, "TK_WORD"];
            if (b === "in") return [b, "TK_OPERATOR"];
            return [b, "TK_WORD"]
        }
        if (b === "(" || b === "[") return [b, "TK_START_EXPR"];
        if (b === ")" || b === "]") return [b, "TK_END_EXPR"];
        if (b === "{") return [b, "TK_START_BLOCK"];
        if (b === "}") return [b, "TK_END_BLOCK"];
        if (b === ";") return [b, "TK_END_COMMAND"];
        if (b === "/") {
            d = "";
            if (j.charAt(e) === "*") {
                e += 1;
                if (e < j.length) for (; ! (j.charAt(e) === "*" && j.charAt(e + 1) && j.charAt(e + 1) === "/") && e < j.length;) if (d += j.charAt(e), e += 1, e >= j.length) break;
                e += 2;
                return ["/*" + d + "*/", "TK_BLOCK_COMMENT"]
            }
            if (j.charAt(e) === "/") {
                for (d = b; j.charAt(e) !== "\r" && j.charAt(e) !== "\n";) if (d += j.charAt(e), e += 1, e >= j.length) break;
                e += 1;
                a && c();
                return [d, "TK_COMMENT"]
            }
        }
        if (b === "'" || b === '"' || b === "/" && (g === "TK_WORD" && p === "return" || g === "TK_START_EXPR" || g === "TK_END_BLOCK" || g === "TK_OPERATOR" || g === "TK_EOF" || g === "TK_END_COMMAND")) {
            a = b;
            d = !1;
            b = "";
            if (e < j.length) for (; d || j.charAt(e) !== a;) if (b += j.charAt(e), d = d ? !1 : j.charAt(e) === "\\", e += 1, e >= j.length) break;
            e += 1;
            g === "TK_END_COMMAND" && c();
            return [a + b + a, "TK_STRING"]
        }
        if (q(b, z)) {
            for (; e < j.length && q(b + j.charAt(e), z);) if (b += j.charAt(e), e += 1, e >= j.length) break;
            return [b, "TK_OPERATOR"]
        }
        return [b, "TK_UNKNOWN"]
    }
    var j, l, k, g, p, o, v, t, C, y, z, e, n, r, x, s, w;
    f = f || " ";
    i = i || 4;
    for (t = ""; i--;) t += f;
    j = h;
    h = "";
    g = "TK_START_EXPR";
    p = "";
    l = [];
    w = s = x = !1;
    C = "\n\r\t ".split("");
    y = "abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789_$".split("");
    z = "+ - * / % & ++ -- = += -= *= /= %= == === != !== > < >= <= >> << >>> >>>= >>= <<= && &= | || ! !! , : ? ^ ^= |=".split(" ");
    i = "continue,try,throw,return,var,if,switch,case,default,for,while,break,function".split(",");
    o = "BLOCK";
    v = [o];
    d = d || 0;
    e = 0;
    for (f = !1;;) {
        r = B(e);
        k = r[0];
        r = r[1];
        if (r === "TK_EOF") break;
        switch (r) {
        case "TK_START_EXPR":
            s = !1;
            v.push(o);
            o = "EXPRESSION";
            g === "TK_END_EXPR" || g === "TK_START_EXPR" || (g !== "TK_WORD" && g !== "TK_OPERATOR" ? b() : q(h, i) && h !== "function" && b());
            m();
            break;
        case "TK_END_EXPR":
            m();
            A();
            break;
        case "TK_START_BLOCK":
            h === "do" ? (v.push(o), o = "DO_BLOCK") : (v.push(o), o = "BLOCK");
            g !== "TK_OPERATOR" && g !== "TK_START_EXPR" && (g === "TK_START_BLOCK" ? c() : b());
            m();
            d++;
            break;
        case "TK_END_BLOCK":
            g === "TK_START_BLOCK" ? (a(), d && d--) : (d && d--, c());
            m();
            A();
            break;
        case "TK_WORD":
            if (x) {
                b();
                m();
                b();
                break
            }
            if (k === "case" || k === "default") {
                p === ":" ? l.length && l[l.length - 1] === t && l.pop() : (d && d--, c(), d++);
                m();
                f = !0;
                break
            }
            n = "NONE";
            g === "TK_END_BLOCK" ? q(k.toLowerCase(), ["else", "catch", "finally"]) ? (n = "SPACE", b()) : n = "NEWLINE": g === "TK_END_COMMAND" && (o === "BLOCK" || o === "DO_BLOCK") ? n = "NEWLINE": g === "TK_END_COMMAND" && o === "EXPRESSION" ? n = "SPACE": g === "TK_WORD" ? n = "SPACE": g === "TK_START_BLOCK" ? n = "NEWLINE": g === "TK_END_EXPR" && (b(), n = "NEWLINE");
            if (g !== "TK_END_BLOCK" && q(k.toLowerCase(), ["else", "catch", "finally"])) c();
            else if (q(k, i) || n === "NEWLINE") if (p === "else") b();
            else {
                if (! ((g === "TK_START_EXPR" || p === "=") && k === "function")) if (g === "TK_WORD" && (p === "return" || p === "throw")) b();
                else if (g !== "TK_END_EXPR") {
                    if ((g !== "TK_START_EXPR" || k !== "var") && p !== ":") k === "if" && g === "TK_WORD" && h === "else" ? b() : c()
                } else q(k, i) && p !== ")" && c()
            } else n === "SPACE" && b();
            m();
            h = k;
            k === "var" && (s = !0, w = !1);
            break;
        case "TK_END_COMMAND":
            m();
            s = !1;
            break;
        case "TK_STRING":
            g === "TK_START_BLOCK" || g === "TK_END_BLOCK" ? c() : g === "TK_WORD" && b();
            m();
            break;
        case "TK_OPERATOR":
            var u = n = !0;
            s && k !== "," && (w = !0, k === ":" && (s = !1));
            if (k === ":" && f) {
                m();
                c();
                break
            }
            f = !1;
            if (k === ",") {
                s ? w ? (m(), c(), w = !1) : (m(), b()) : g === "TK_END_BLOCK" ? (m(), c()) : o === "BLOCK" ? (m(), c()) : (m(), b());
                break
            } else k === "--" || k === "++" ? (n = p === ";" ? !0 : !1, u = !1) : k === "!" && g === "TK_START_EXPR" ? u = n = !1 : g === "TK_OPERATOR" ? u = n = !1 : g === "TK_END_EXPR" ? u = n = !0 : k === "." ? u = n = !1 : k === ":" && (n = p.match(/^\d+$/) ? !0 : !1);
            n && b();
            m();
            u && b();
            break;
        case "TK_BLOCK_COMMENT":
            c();
            m();
            c();
            break;
        case "TK_COMMENT":
            b();
            m();
            c();
            break;
        case "TK_UNKNOWN":
            m()
        }
        g = r;
        p = k
    }
    return l.join("")
}

function do_js_beautify() {
    js_source = $("#content").val().replace(/^\s+/, "");
    tabsize = $("#tabsize option:selected").val();
    tabchar = " ";
    tabsize == 1 && (tabchar = "\t");
    js_source && js_source.charAt(0) === "<" ? $("#content").val(style_html(js_source, tabsize, tabchar, 80)) : $("#content").val(js_beautify(js_source, tabsize, tabchar));
    return ! 1
}

// 清除输出信息
function clearinfo() {
    $("#info").html('');
}

// 加载一条输出信息
function addinfo(h, i) {
    switch (i) {
    case 1:
        // 信息
        $("#info").append('<p class="text-info">' + h + '</p>');
        break;
    case 2:
        // 失败
        $("#info").append('<p class="text-danger">' + h + '</p>');
        break;
    case 3:
        // 加密完成
        $("#info").append('<p class="text-success">' + h + '</p>');
        break;
    default:
        // 普通信息
        $("#info").append('<p class="">' + h + '</p>');
    }
}

onDecodeClick = function() {
    try {
        var h = (new Date).getTime();
        clearinfo();
        addinfo("初始化解码成功");
        var i = /^ *eval *\(/ig,
        f = $("#content"),
        d = $("#decode"),
        a = $("#deg"),
        c = 0;
        $("#errmsg").html('');
        a.html('0');
        $("#tme").html('0');
        for (d.attr('disabled', "true"); i.test(f.val()) && c < 20;) addinfo("正在解码第" + (c + 1) + "次..."),
        f.val(eval(f.val().replace(i, "(function(){ return (") + "})()")),
        c++;
        i.test(f.val()) ? (addinfo("解码失败，已经经过" + c + "次尝试", 2), $("#errmsg").html("非常遗憾，解码失败。")) : (c > 0 ? addinfo("解码完成，共解码" + c + "次", 3) : addinfo("原文似乎没有编码，不需要解码", 3), addinfo("正在以" + ($("#tabsize option:selected").val() == 1 ? "制表符": $("#tabsize option:selected").val() + "空格") + "缩进格式化源码..."), do_js_beautify(), addinfo("格式化完成"));
        a.html(c);
    } catch(b) {
        addinfo("解码失败，过程发生错误: " + b.message, 2),
        $("#errmsg").html("发生错误：" + b.message);
    }
    d.removeAttr("disabled");
    i = (new Date).getTime();
    h = Math.floor(i - h);
    addinfo("所有任务完成,共耗时" + h + "毫秒", 1);
    $("#tme").html(h);
};

function pack_js(h) {
    var i = $("#content").val(),
    f = new Packer;
    h = h ? f.pack(i, 1, 0) : f.pack(i, 0, 0);
    $("#content").val(h);
}
onEncodeClick = function() {
    try {
        var h = (new Date).getTime();
        var types = $("#compresstype option:selected").val(); // 编码类型
        clearinfo(); // 清除之前日志
        addinfo("初始化编码成功");
        $("#errmsg").html('');
        $("#deg").html('0');
        $("#tme").html('0');

        addinfo("正在以" + (types == "1" ? " Dean Edwards Packer ": "普通") + "方式编码");
        pack_js(types == "1");
        addinfo("编码完成", 3)
    } catch(i) {
        addinfo("编码失败，过程发生错误: " + i.message, 2),
        $("#errmsg").html("发生错误：" + i.message);
    }

    var f = (new Date).getTime();
    h = Math.floor(f - h);
    addinfo("所有任务完成,共耗时" + h + "毫秒", 1);
    $("#tme").html(h);
};

$(function() {
    // 加密
    $("#encode").click(function() {
        onEncodeClick();
    });

    $("#decode").click(function() {
        onDecodeClick();
    });

    clearinfo();
    addinfo('工具准备就绪', 3);
});
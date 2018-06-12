<?php
$id  = '48';
include '../../header.php';
?>
<div class="container">
    <div class="panel panel-default">
        <div class="panel-heading">中国家庭称谓计算器</div>
        <div class="panel-body">
            <p>计算类型：
                <label for="default"><input id="default" type="radio" name="type" value="default" checked="">找称呼</label>
                <label for="chain"><input id="chain" type="radio" name="type" value="chain">找关系</label>
            </p>
            <div class="group">
                <p>我的性别：
                    <label for="male"><input id="male" type="radio" name="sex" value="1" checked="">男</label>
                    <label for="female"><input id="female" type="radio" name="sex" value="0">女</label>
                </p>
                <p>称呼方式：
                    <label for="call"><input id="call" type="radio" name="reverse" value="0" checked="">我称呼对方</label>
                    <label for="called"><input id="called" type="radio" name="reverse" value="1">对方称呼我</label>
                </p>
            </div>
            <p>
                <textarea id="input" placeholder="称谓间用&#39;的&#39;字分开…" class="form-control"></textarea>
            </p>
            <p>
                <span>快速选择：</span>
                <br>
            </p><div class="btn-group">
                <button type="button" class="btn btn-info" data-value="爸爸">父</button>
                <button type="button" class="btn btn-info" data-value="妈妈">母</button>
            </div>
            <div class="btn-group">
                <button type="button" class="btn btn-info" data-value="老公" disabled="">夫</button>
                <button type="button" class="btn btn-info" data-value="老婆">妻</button>
            </div>
            <div class="btn-group">
                <button type="button" class="btn btn-info" data-value="儿子">子</button>
                <button type="button" class="btn btn-info" data-value="女儿">女</button>
            </div>
            <div class="btn-group">
                <button type="button" class="btn btn-info" data-value="哥哥">兄</button>
                <button type="button" class="btn btn-info" data-value="弟弟">弟</button>
            </div>
            <div class="btn-group">
                <button type="button" class="btn btn-info" data-value="姐姐">姐</button>
                <button type="button" class="btn btn-info" data-value="妹妹">妹</button>
            </div>
            <p></p>
            <p>
                <button class="input-button btn btn-warning">回退</button>
                <button class="input-button btn btn-danger">清空</button>
                <button class="input-button btn btn-primary">计算</button>
            </p>
            <p>计算结果：</p>
            <p>
                <textarea id="reslut" class="form-control" rows="5" readonly=""></textarea>
            </p>
        </div>
    </div>
    <div class="panel panel-default">
        <div class="panel-heading">工具简介</div>
        <div class="panel-body">
            <p>由于工作生活节奏不同，如今很多关系稍疏远的亲戚之间来往并不多。因此放假回家过年时，往往会搞不清楚哪位亲戚应该喊什么称呼，很是尴尬。然而搞不清亲戚关系和亲戚称谓的不仅是小孩，就连年轻一代的大人也都常常模糊混乱。</p>
            <p>“中国家庭称谓计算器”为你避免了这种尴尬，只需简单的输入即可算出称谓。输入框兼容了不同的叫法，你可以称呼父亲为：“老爸”、“爹地”、“老爷子”等等，方面不同地域的习惯叫法。快捷输入按键，只需简单的点击即可完成关系输入，算法还支持逆向查找称呼哦～！</p>
            <h4>关于分歧</h4>
            <p>一些称呼存在南北方或地区差异，容易引起歧义，并不保证和你所处地区的称谓习惯一致。本程序主要以现代生活常见的理解为主。</p>
            <ul class="list-unstyled">
                <li>媳妇：在古代或者当今北方地区指儿子的妻子，这里指自己的妻子。</li>
                <li>大爷：北方指父亲的哥哥，这里指爷爷的哥哥</li>
                <li>太太：一些地方指年长的妇人，这里指自己的妻子</li>
            </ul>
        </div>
    </div>
</div>
<script src="js.js"></script>
<?php include '../../footer.php';?>
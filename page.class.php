<?php
  /**
 * @param $maxpage  总页数
 * @param $page    当前页
 * @param string $para  翻页参数(不需要写$page),如http://www.example.com/article.php?page=3&id=1，$para参数就应该设为'&id=1'
 * @return string  返回的输出分页html内容
 */
function multipage($maxpage, $page, $para = '') {
    $multipage = '';  //输出的分页内容
    $listnum = 5;     //同时显示的最多可点击页面

    if ($maxpage < 2) {
        return '';
    }else{
        $offset = 2;
        if ($maxpage <= $listnum) {
            $from = 1;
            $to = $maxpage;
        } else {
            $from = $page - $offset; //起始页
            $to = $from + $listnum - 1;  //终止页
            if($from < 1) {
                $to = $page + 1 - $from;
                $from = 1;
                if($to - $from < $listnum) {
                    $to = $listnum;
                }
            } elseif($to > $maxpage) {
                $from = $maxpage - $listnum + 1;
                $to = $maxpage;
            }
        }

        $multipage .= ($page - $offset > 1 && $maxpage >= $page ? '<li><a href="?page=1'.$para.'" >1...</a></li>' : '').
            ($page > 1 ? '<li><a href="?page='.($page - 1).$para.'" >&laquo;</a></li>' : '');

        for($i = $from; $i <= $to; $i++) {
            $multipage .= $i == $page ? '<li class="active"><a href="?page='.$i.$para.'" >'.$i.'</a></li>' : '<li><a href="?page='.$i.$para.'" >'.$i.'</a></li>';
        }

        $multipage .= ($page < $maxpage ? '<li><a href="?page='.($page + 1).$para.'" >&raquo;</a></li>' : '').
            ($to < $maxpage ? '<li><a href="?page='.$maxpage.$para.'" class="last" >...'.$maxpage.'</a></li>' : '');


        $multipage = $multipage ? '<ul class="pagination">'.$multipage.'</ul>' : '';
    }

    return $multipage;
}
?>
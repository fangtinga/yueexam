<?php

use \yii\widgets\LinkPager;
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <title>Document</title>
</head>
<body>
    <center>
    <form>
        <input type="hidden" name="r" value="exam/show">
        <select name="c_serch">
            <option value="04A">04A</option>
            <option value="04B">04B</option>
            <option value="04C">04C</option>
        </select>
        <input type="text" name="s_serch">
        <input type="submit" value="搜索">
    </form>
    <br>
    <br>
        <table border="1">
            <tr>
                <td>学生编号</td>
                <td>姓名</td>
                <td>年龄</td>
                <td>所在班级</td>
                <td>操作</td>
            </tr>
            <?php foreach ($models as $k => $v) {?>
                <tr>
                    <td><?php echo $v['id'] ?></td>
                    <td>
                        <span class="name"><?php echo $v['s_name'] ?></span>
                        <input type="text" class="updname" where="<?php echo $v['id'] ?>" value="<?php echo $v['s_name'] ?>" style="display:none">
                    </td>
                    <td><?php echo $v['age'] ?></td>
                    <td><?php echo $v['s_class'] ?></td>
                    <td>
                        <a href="#" num="<?php echo $v['id'] ?>">删除</a>
                    </td>
                </tr>
            <?php  } ?>
        </table>
        <?php
             echo LinkPager::widget([
                'pagination' => $pages,
             ]);
        ?>
    </center>
</body>
</html>
<script src="jquery-2.1.4.min.js"></script>
<script>
    $(document).on("click",".name",function(){
        $(this).hide();
        $(this).next().show();
        name = $(this).next().val();
        $(this).next().val("");
        $(this).next().focus();
        $(this).next().val(name);
    })
    $(document).on("blur",".updname",function(){
        name = $(this).val();
        id = $(this).attr("where");
        _this=this;
        $.ajax({
            data:{name:name,id:id},
            type:"post",
            url:'?r=exam/upd',
            success:function(e){
                console.log(e)
                if(e==1){
                    $(_this).hide();
                    $(_this).prev().html(name);
                    $(_this).prev().show()
                }
            }
        })
    })
    $(document).on("click","td a",function(){
        id = $(this).attr("num");
        $.ajax({
            data:{id:id},
            type:"post",
            url:'?r=exam/del',
            success:function(e){
                location.href='?r=exam/show'
            }
        })
    })
</script>
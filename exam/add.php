<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <title>Document</title>
</head>
<body>
    <center>
        <table>
            <tr>
                <td>学生姓名：</td>
                <td><input type="text" name="s_name" id="s_name" placeholder="必填项"></td>
            </tr>
            <tr>
                <td>学生年龄：</td>
                <td><input type="text" name="age" id="age" placeholder="必填项"></td>
            </tr>
            <tr>
                <td>学生所在班级：</td>
                <td>
                    <select name="s_class" class="s_class">
                        <option value="04A" checked>04A</option>
                        <option value="04B">04B</option>
                        <option value="04C">04C</option>
                    </select>
                </td>
            </tr>
            <tr>
                <td></td>
                <td><input type="button" value="添加" class="add"></td>
            </tr>
        </table>
    </center>
</body>
</html>
<script src="jquery-2.1.4.min.js"></script>
<script>
    $(document).on("click",".add",function(){
        s_name = $("#s_name").val();
        age = $("#age").val();
        s_class = $(".s_class").val();
        if(s_name == "" || age == ""){
            alert("必填项不能为空");
            return false;
        }else if(s_name.length > 6){
            alert("姓名长度不能大于6");
            return false;
        }
        $.ajax({
            data:{s_name:s_name,age:age,s_class:s_class},
            type:"post",
            url:'?r=exam/doadd',
            success:function(e){
                console.log(e)
                if(e == 1){
                    alert("添加成功");
                    location.href="?r=exam/show"
                }else{
                    alert("添加失败")
                }
            }
        })
    })
</script>
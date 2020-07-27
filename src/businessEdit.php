<?php
require_once "OnlineCheck_business.php";
require_once "connection.php";
$SQL = "SELECT * FROM 商户 WHERE 用户名='$id'";
$r = mysqli_fetch_array(mysqli_query($con, $SQL));
if ($r == null)
{
    echo "<script>alert('商户不存在')</script>";
    echo '<script>window.location.replace("index.html");</script>';
    exit();
}
?>
    <!doctype html>
    <html>
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>修改商户信息</title>
        <link href="bootstrap-3.3.7-dist/css/bootstrap.min.css" rel="stylesheet">
        <link href="css/normal.css" rel="stylesheet">
    </head>
    <body>
    <div class="container-fluid">
        <form action="functions/edit_business.php" method="post" class="form-horizontal col-md-offset-3">
            <div class="row">
                <div class="form-group col-md-8">
                    <label for="businessname">商铺名</label>
                    <input type="text" placeholder="商铺名" name="businessname" id="businessname"
                           class="form-control input-lg"
                           value="<?php echo $r['商户名称'] ?>">
                </div>
            </div>
            <div class="row">
                <div class="form-group col-md-8">
                    <label for="discription">商铺描述</label>
                    <textarea placeholder="商铺描述" name="discription" id="discription"
                              class="form-control" rows="3">
                        <?php echo $r['商户描述'] ?>
                    </textarea>
                </div>
            </div>
            <div class="row">
                <input type="button" onclick="edit_location()" value="编辑商户位置" id="edit-location">
            </div>
            <div class="row">
                <div class="form-group col-md-2">
                    <label for="province" style="visibility: hidden">省</label>
                    <select name="province" id="province" onclick="get_city()" style="visibility: hidden"
                            class="form-control"></select>
                </div>
                <div class="form-group col-md-2">
                    <label for="city" style="visibility: hidden">市</label>
                    <select name="city" id="city" onclick="get_district()" style="visibility: hidden"
                            class="form-control"></select>
                </div>
                <div class="form-group col-md-2">
                    <label for="district" style="visibility: hidden">区</label>
                    <select name="district" id="district" onclick="get_street()" style="visibility: hidden"
                            class="form-control"></select>
                </div>
                <div class="form-group col-md-2">
                    <label for="street" style="visibility: hidden">街道</label>
                    <select name="street" id="street" style="visibility: hidden"
                            class="form-control"></select>
                </div>
            </div>
            <div class="row">
                <div class="form-group col-md-8">
                    <label for="address">详细地址</label>
                    <input type="text" name="address" id="address"
                           value="<?php echo $r['详细地址'] ?>" class="form-control"/>
                </div>
            </div>
            <div class="row">
                <div class="col-md-8">
                    <input type="submit" value="提交" class="row btn btn-primary btn-lg btn-block"/>
                </div>
            </div>
        </form>

        <script src="js/jquery-3.3.1.js"></script>
        <script src="js/RegisterCheck.js"></script>
        <script src="js/CityPicker.js"></script>
        <script>
            const edit_location_btn=document.getElementById("edit-location");
            function edit_location()
            {
                edit_location_btn.onclick=edit_location_cancel;
                get_province(true);
            }
            function edit_location_cancel()
            {
                edit_location_btn.onclick=edit_location;
                province.value='';
                province.style.visibility='hidden';
                province_label.css('visibility','hidden');
                city.value='';
                city.style.visibility = 'hidden';
                city_label.css('visibility','hidden');
                district.value='';
                district.style.visibility = 'hidden';
                district_label.css('visibility','hidden');
                street.value='';
                street.style.visibility = 'hidden';
                street_label.css('visibility','hidden');
            }
        </script>
    </div>
    </body>
    </html>
<?php ?>
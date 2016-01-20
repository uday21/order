<?php
$url = "http://shalom19/uday/orderfoodnow ionic/CodeIgniter-3.0/api/index.php/api/";

if(isset($_GET['id'])) {
    $getval = $_GET['id'];
    $method = 'post';
} else {
    $method = 'put';
}

$restaurant_data = json_decode(file_get_contents('http://order.orderfoodnow.in/api/index.php/api/restaurant/'));


?>

<!doctype html>
<html>
<head>
    <meta charset="utf-8">
    <title>Order Food Now</title>
    <link href="<?php echo base_url('assets/css/jquery.validation.css');?>" rel="stylesheet" type="text/css" />
    <script src="<?php echo base_url('assets/js/jquery-1.10.2.min.js');?>" type="text/javascript"></script>
    <script src="<?php echo base_url('assets/js/jquery.validate.js');?>"></script>
    <script src="<?php echo base_url('assets/js/additional-methods.js');?>"></script>
</head>

<body>

<form id="addbranch" method="post" action="">
<select name="restaurant" required>
    <option value="">Select Restaurant</option>
    <?php
    foreach ( $restaurant_data as $data )
    {
        echo "<option value='$data->id'>$data->name</option>";
    }
    ?>
</select><br>
<input name="address" type="text" value="" required placeholder="Address"><br>
<input name="location" type="text" value="" required placeholder="Location"><br>
<input name="area" type="text" value="" required placeholder="Area"><br>
<input name="pincode" type="text" value="" required placeholder="Pincode"><br>
    <select name="menu" required>
        <option value="">Select Menu</option>
        <?php
        foreach ( $restaurant_data->trends as $data => $value )
            {
                echo "<option value='1'>$value->one;</option>";
            }
        ?>
    </select><br><a href="#">Add Hotel menu</a><br>


    <input name="menuname" type="text" /><br><br>

    <a class="menusubmit" >Submit</a><br><br>




    <select name="account" required>
        <option value="">Select Account</option>
        <option value="1">Hotel Kannappa</option>
    </select><br><a href="#">Add Account menu</a><br>


    <input name="accountname" type="text" /><br><br>

    <a class="accountsubmit" >Submit</a><br><br>


<br><br>
<input class="submit" type="submit" value="Submit" >
</form>



<script>

    $(document).ready(function() {

        $("#addbranch").validate({
            rules: {
            },
            submitHandler: function(form) {
                //form.submit();
                addData();
            }
        });


        $('.menusubmit').click(function() {

            $menuname = $("input[name='menuname']").val();
            if(jQuery.trim($menuname).length > 0) {
                $.ajax({
                    type: 'put',
                    dataType:'json',
                    url: '<?php echo $url.'menuId'; ?>',
                    data: {data: menuformToJSON()},
                    success: function($response) {
                        alert($response);
                    }
                });
            } else {
                alert('Enter Data');
            }
        });

        function menuformToJSON() {
            return JSON.stringify({
                "name": $("input[name='menuname']").val()
            });
        }

        $('.accountsubmit').click(function() {

            $accountname = $("input[name='accountname']").val();

            if($accountname.length > 0) {
                $.ajax({
                    type: 'put',
                    dataType:'json',
                    url: '<?php echo $url.'accountDetails'; ?>',
                    data: {data: accountformToJSON()},
                    success: function($response) {
                        alert($response);
                    }
                });
            } else {
                alert('Enter Data');
            }


        });

        function accountformToJSON() {
            return JSON.stringify({
                "name": $("input[name='accountname']").val()
            });
        }

        function addData() {

            $('.submit').click(function() {

               $.ajax({
                 type: '<?php echo $method; ?>',
                 dataType:'json',
                 url: '<?php echo $url.'branch'; ?>',
                 data: {
                     <?php if(isset($getval)) {echo "id: ". $getval.",\n"; } ?>
                     data: formToJSON()
                 },
                 success: function($response) {
                 alert($response);
                 }
                 });
            });

            $('.submit').trigger( "click" );
        }



        function formToJSON() {
            return JSON.stringify({
                "restaurant": $("select[name='restaurant']").val(),
                "address": $("input[name='address']").val(),
                "location": $("input[name='location']").val(),
                "area": $("input[name='area']").val(),
                "pincode": $("input[name='pincode']").val(),
                "menu_id": $("select[name='menu']").val(),
                "account_id": $("select[name='account']").val()
            });
        }

    });
</script>
</body>
</html>
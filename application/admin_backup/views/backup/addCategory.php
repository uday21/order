<?php $url = "http://shalom19/uday/orderfoodnow ionic/CodeIgniter-3.0/api/index.php/api/";

if(isset($_GET['id'])) {
    $getval = $_GET['id'];
    $method = 'post';
} else {
    $method = 'put';
}

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
<form id="addcat">

    <select name="menu" required>
        <option value="">Select Restaurant</option>
        <option value="1">Hotel Kannappa</option>
        <option value="2">Hotel Kitchen</option>
        <option value="3">Hotel Sangeethas</option>
    </select><br>

    <input name="name" type="text" value="" required placeholder="Name">
    <br><br>
    <input class="submit" type="submit" value="Submit" >
</form>



<script>

    $(document).ready(function() {

        $("#addcat").validate({
            rules: {
            },
            submitHandler: function() {
                addData();
            }
        });

        function addData() {

            $('.submit').click(function() {

                $.ajax({
                    type: '<?php echo $method; ?>',
                    dataType:'json',
                    url: '<?php  echo $url.'category'; ?>',
                    data: {
                        <?php if(isset($getval)) {echo "id: ". $getval.",\n"; } ?>
                        data: formToJSON()},
                    success: function($response) {
                        alert($response);
                    }
                });
            });

            $('.submit').trigger( "click" );
        }



        function formToJSON() {
            return JSON.stringify({
                "name": $("input[name='name']").val(),
                "menu_id": $("select[name='menu']").val()
            });
        }

    });
</script>
</body>
</html>
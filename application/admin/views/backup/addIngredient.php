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
<form id="addaccount">

    <input name="name" type="text" value="" required placeholder="Name"><br>

    <input type="radio" name="type" value="veg">Veg<br>
    <input type="radio" name="type" value="non-veg">Non Veg
    <br>
    <textarea name="properties" required placeholder="Ingredients"></textarea>
    <br><br>
    <input class="submit" type="submit" value="Submit" >
</form>



<script>

    $(document).ready(function() {

        $("#addaccount").validate({
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
                    url: '<?php  echo $url.'ingredient'; ?>',
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
                "type": $("input[name='type']").val(),
                "other_properties": $("textarea[name='properties']").val()
            });
        }

    });
</script>
</body>
</html>
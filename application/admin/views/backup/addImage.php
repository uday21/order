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
    <script src="<?php echo base_url('assets/js/jquery.ajaxfileupload.js');?>"></script>
</head>

<body>

<?php echo form_open_multipart('upload/image_upload', 'id="addimage"');?>

<input name="foodname" type="text" value="" required placeholder="Name"><br>
<input name="userfile" id="image" type="file" value="" required placeholder="Name">
<?php if(isset($getval)) { ?>
    <input name="id" type="hidden" value="<?php echo $getval; ?>">
<?php } ?>
<br><br>
<input class="submit" type="submit" value="Submit" >
</form>



<script>

    $(document).ready(function() {

        $("#addimage").validate({
            rules: {
                image: {
                    extension: "JPG|jpg|PNG|png|GIF|gif|BMP|bmp|JPEG|jpeg"
                }
            },
            submitHandler: function(form) {
                form.submit();
            }
        });

    });
</script>
</body>
</html>
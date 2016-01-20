<?php

$url = "http://shalom19/uday/orderfoodnow ionic/CodeIgniter-3.0.2/api/index.php/api/";


?>

<!doctype html>
<html>
<head>
    <meta charset="utf-8">
    <title>Order Food Now</title>
    
    
</head>

<body>

	<div class="content-wrapper">
		<section class="content-header">
          <h1>
            Dashboard
            <small>Add Restaurant</small>
          </h1>
          <ol class="breadcrumb">
            <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
            <li class="active">Add Restaurant</li>
          </ol>
        </section>
        
        <section class="content">
        <div class="container-fluid">
        <div class="box">
        <div class="box-header with-border"><i class="fa fa-warning"></i><h3 class="box-title">Add Restaurant</h3></div>
        <div class="box-body">
        <?php
		$attributes = array('class' => 'form-horizontal', 'id' => 'addrestaurant');
		 echo form_open_multipart('upload/do_upload', $attributes);?>
        <!--<form id="addrestaurant" class="form-horizontal" >-->
        
		 <div class="form-group">
         <label class="col-sm-2 control-label">Hotel Name</label>
         	<div class="col-sm-6">
            	<input name="hotelname" class="form-control" type="text" value="" required placeholder="Name">
            </div>
         </div>	
         
         <div class="form-group">
         <label class="col-sm-2 control-label">Image</label>
         	<div class="col-sm-6">
            	<input name="userfile" id="image" type="file" value="" required placeholder="Name">
            </div>
         </div>	
         
          <div class="form-group">
         <label class="col-sm-2 control-label"></label>
         	<div class="col-sm-6">
            	<input class="submit btn btn-success" type="submit" value="Submit" >
                <input class="btn btn-danger marginleft" type="reset" value="Reset">
            </div>
         </div>	
    		
    		
    		
		</form>
        </div>
        </div>
        </div>
        </section>
        
	</div>




<script>

    $(document).ready(function() {
	
		
        $("#addrestaurant").validate({
            rules: {
                image: {
                    extension: "JPG|jpg|PNG|png|GIF|gif|BMP|bmp|JPEG|jpeg"
                }
            },
            submitHandler: function(form) {
                form.submit();
                //addData();
            }
        });

        function addData() {

            $('.submit').click(function() {

                $.ajaxFileUpload({
                    url: '<?php echo $url.'do_upload'; ?>',
                    secureuri: false,
                    fileElementId: 'image',
                    dataType: 'json',
                    data: {
                        'userfile': $("input[name='hotelname']").val()
                    },
                    success: function(data) {
                        alert(data.msg);
                    }
                });

                /*$.ajax({
                 type: 'put',
                 dataType:'json',
                 url: '<?php // echo $url.'restaurant'; ?>',
                 data: {data: formToJSON()},
                 success: function($response) {
                 alert($response);
                 }
                 });*/
            });

            $('.submit').trigger( "click" );
        }



        function formToJSON() {
            return JSON.stringify({
                "name": $("input[name='hotelname']").val()
            });
        }

    });
</script>
</body>
</html>
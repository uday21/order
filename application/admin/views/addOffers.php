<?php

if(isset($_GET['id'])) {
    $getval = $_GET['id'];
    $res_name = "";
	
	$offer_data = json_decode(file_get_contents(MYURL.'getOfferById/id/'.$getval));
	
	foreach($offer_data as $data){
        $offer_name = $data->name;
    }
	
}


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
              <a href="offers">Offers</a> /
               Add Offer
          </h1>
          <ol class="breadcrumb">
            <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
            <li class="active">Add Offer</li>
          </ol>
        </section>
        
        <section class="content">
        <div class="container-fluid">
        <div class="box">
        <div class="box-header with-border"><i class="fa fa-warning"></i><h3 class="box-title">Add Offer</h3></div>
        <div class="box-body">
        <?php
		$attributes = array('class' => 'form-horizontal', 'id' => 'addoffer');
		 echo form_open_multipart('upload/offer_upload', $attributes);?>
        <!--<form id="addrestaurant" class="form-horizontal" >-->
        
		 <div class="form-group">
         <label class="col-sm-2 control-label">Name</label>
         	<div class="col-sm-6">
            	<input name="offername" class="form-control" type="text" value="<?php echo $offer_name; ?>" required placeholder="Name">
                <?php if(isset($getval)) { ?>
<input type="hidden" name="id" value="<?php echo $getval; ?>">
<?php } ?>
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
	
		
        $("#addoffer").validate({
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
<?php

if(isset($_GET['id'])) {
    $getval = $_GET['id'];
    $method = '_update';
} else {
    $method = '';
}

?>
<div class="content-wrapper">
		<section class="content-header">
          <h1>
              <a href="images">Images</a> /
              Add Image
          </h1>
          <ol class="breadcrumb">
            <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
            <li class="active">Add Image</li>
          </ol>
        </section>
        
        <section class="content">
        <div class="container-fluid">
        <div class="box">
        <div class="box-header with-border"><i class="fa fa-warning"></i><h3 class="box-title">Add Image</h3></div>
        <div class="box-body">
        
 			<?php 
			$attributes = array('class' => 'form-horizontal', 'id' => 'addimage');
			echo form_open_multipart('upload/image_upload', $attributes);?>
			<div class="form-group">
            <label class="col-sm-2 control-label">Food Name</label>
            <div class="col-sm-6">
            	<input name="foodname" type="text" value="" required placeholder="Name" class="form-control">
            </div>
            </div>	
            
            <div class="form-group">
            <label class="col-sm-2 control-label">Image Name</label>
            <div class="col-sm-6">
            	<input name="userfile" id="image" type="file" value="" required placeholder="Name">
            </div>
            </div>	
 			
            <?php if(isset($getval)) { ?>
    			<input name="id" type="hidden" value="<?php echo $getval; ?>">
			<?php } ?>           
            
			<div class="form-group">
            <label class="col-sm-2 control-label"></label>
            <div class="col-sm-6">
            	<input class="submit btn btn-success" type="submit" value="Submit">
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
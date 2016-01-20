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
            Dashboard
            <small>Add IngredientGroup</small>
          </h1>
          <ol class="breadcrumb">
            <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
            <li class="active">IngredientGroup</li>
          </ol>
        </section>
        
        <section class="content">
        <div class="container-fluid">
        <div class="box">
        <div class="box-header with-border"><i class="fa fa-warning"></i><h3 class="box-title">Add IngredientGroup</h3></div>
        <div class="box-body">
			<form id="addaccount" class="form-horizontal">
            
            	<div class="form-group">
                	<label class="control-label col-sm-2">Label</label>
                    <div class="col-sm-6">
    					<input name="name" type="text" value="" required placeholder="Name" class="form-control">
                    </div>
                </div>
                
                <div class="form-group">
                	<label class="control-label col-sm-2">Label</label>
                    <div class="col-sm-6">
    					<select name="item" required class="form-control">
        					<option value="">Select Restaurant</option>
        					<option value="1">Hotel Kannappa</option>
        					<option value="2">Hotel Kitchen</option>
        					<option value="3">Hotel Sangeethas</option>
   						</select>
                    </div>
                </div>
                
                 <div class="form-group">
                	<label class="control-label col-sm-2">Label</label>
                    <div class="col-sm-6">
    					<select name="ingredient" required  class="form-control">
        					<option value="">Select Restaurant</option>
        					<option value="1">Hotel Kannappa</option>
        					<option value="2">Hotel Kitchen</option>
        					<option value="3">Hotel Sangeethas</option>
    					</select>
                    </div>
                </div>
                
                 <div class="form-group">
                	<label class="control-label col-sm-2"></label>
                    <div class="col-sm-6">
                        <input class="submit btn btn-success" type="submit" value="Submit" >
                        <input class="marginleft btn btn-danger" type="reset" value="Reset" >
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
                    type: 'post',
                    dataType:'json',
                    url: '<?php  echo MYURL.'ingredientGroup'.$method; ?>',
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
                "item_id": $("select[name='item']").val(),
                "ingredient_id": $("select[name='ingredient']").val()
            });
        }

    });
</script>
</body>
</html>
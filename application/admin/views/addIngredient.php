<?php
$id = '';
$ingre_name = '';
$ingre_type = '';
$ingre_prop = '';
if(isset($_GET['id'])) {
    $getval = $_GET['id'];
    $method = '_update';
    $ingredient_data = json_decode(file_get_contents(MYURL.'dataIngredientById/id/'.$getval));
    foreach($ingredient_data as $data){
        $id = $data->id;
        $ingre_name = $data->iname;
        $ingre_type = $data->type;
        $ingre_prop = $data->other_properties;

    }
} else {
    $method = '';
}

?>

<div class="content-wrapper">
		<section class="content-header">
            <h1>
                <a href="ingredient">Ingredient</a> /
                Add Ingredient
            </h1>
          <ol class="breadcrumb">
            <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
            <li class="active">Add Ingredient</li>
          </ol>
        </section>
        
        <section class="content">
        <div class="container-fluid">
        <div class="box">
        <div class="box-header with-border"><i class="fa fa-warning"></i><h3 class="box-title">Add Ingredient</h3></div>
        <div class="box-body">
			<form id="addaccount"  class="form-horizontal" method="post">
            
            	<div class="form-group">
                	<label class="control-label col-sm-2">Ingredient Name</label>
                    <div class="col-sm-6">
    					<input name="name" type="text" value="<?php echo $ingre_name; ?>" required placeholder="Name"  class="form-control">
                        <input class="unique" type="hidden" value="ok">
                    </div>
               	</div>
                
                <div class="form-group">
                	<label class="control-label col-sm-2">Type</label>
                    <div class="col-sm-8">
    					<input type="radio" name="type" value="Veg" <?php if($ingre_type == 'Veg') { echo 'checked';} ?>>&nbsp;&nbsp; Veg &nbsp;
    					<input type="radio" name="type" value="Non Veg" <?php if($ingre_type == 'Non Veg') { echo 'checked';} ?>>&nbsp;&nbsp;Non Veg
                    </div>
               	</div>
                
                <div class="form-group">
                	<label class="control-label col-sm-2">Properties</label>
                    <div class="col-sm-6">
    					<textarea name="properties" required placeholder="Ingredients"  class="form-control"><?php echo $ingre_prop; ?></textarea>
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

        var unique = $('.unique').val();

        $("#addaccount").validate({
            rules: {
            },
            submitHandler: function() {
                addData();
            }
        });

        function addData() {

            $('.submit').one('click', function() {

                $.ajax({
                    type: 'post',
                    dataType:'json',
                    url: '<?php  echo MYURL.'ingredient'.$method; ?>',
                    data: {
                        <?php if(isset($getval)) {echo "id: ". $getval.",\n"; } ?>
                        data: formToJSON()},
                    success: function($response) {
                        if($response == true) {
                            location.assign('ingredient');
                        }
                    }
                });
            });

            $('.submit').trigger( "click" );
        }



        function formToJSON() {
            return JSON.stringify({
                "iname": $("input[name='name']").val(),
                "type": $("input[name='type']:checked").val(),
                "other_properties": $("textarea[name='properties']").val()
            });
        }

    });
</script>
</body>
</html>
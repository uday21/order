<?php
$id = '';
$item_id = '';
$ingre_id = '';
if(isset($_GET['id'])) {
    $getval = $_GET['id'];
    $method = '_update';
    $ingredientGroup_data = json_decode(file_get_contents(MYURL.'dataIngreGroupById/id/'.$getval));
    foreach($ingredientGroup_data as $data){
        $id = $data->id;
        $item_id = $data->item_id;
        $ingre_id = $data->ingredient_id;
    }
} else {
    $method = '';
}


$ingredient_data = json_decode(file_get_contents(MYURL.'ingredient/'));

$menuItems_data = json_decode(file_get_contents(MYURL.'menuItems/'));

?>

<div class="content-wrapper">
		<section class="content-header">
            <h1>
                <a href="ingredientgroup">Ingredient Group</a> /
                Add Ingredient Group
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
			<form id="addaccount" class="form-horizontal" method="post">
                
                <div class="form-group">
                	<label class="control-label col-sm-2">Item Name</label>
                    <div class="col-sm-6">
    					<select name="item" required class="form-control">

                            <?php
                            foreach ( $menuItems_data as $data )
                            {
                                if($data->id == $item_id) {
                                    echo "<option value='$data->id'>$data->name</option>";
                                }
                            }
                            ?>
                            <option value=''></option>
                            <?php
                            foreach ( $menuItems_data as $data )
                            {
                                $checkingredientGroup_data = json_decode(file_get_contents(MYURL.'checkIfIdExists/item_id/'.$data->id));

                                if($checkingredientGroup_data == 0){
                                echo "<option value='$data->id'>$data->name</option>";
                            }

                            }
                            ?>
   						</select>
                    </div>
                </div>
                
                 <div class="form-group">
                	<label class="control-label col-sm-2">Ingredient</label>
                    <div class="col-sm-6">
    					<select name="ingredient" required  class="form-control">

                            <?php
                            foreach ($ingredient_data  as $data )
                            {
                                if($data->id == $ingre_id){
                                echo "<option value='$data->id'>$data->iname</option>";
                                }
                            }
                            ?>
                            <option value=''></option>
                            <?php
                            foreach ($ingredient_data  as $data )
                            {
                                echo "<option value='$data->id'>$data->iname</option>";
                            }
                            ?>
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
                        if($response == true){
                            location.assign('ingredientgroup');
                        }
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
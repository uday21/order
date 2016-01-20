<?php
$id = '';
$menu_name = '';
$menu_id = '';
$image_id  = '';
$price = '';
$cat_id = '';
if(isset($_GET['id'])) {
    $getval = $_GET['id'];
    $method = '_update';
    $menuItems_data = json_decode(file_get_contents(MYURL.'dataMenuById/id/'.$getval));
    foreach($menuItems_data as $data){
        $id = $data->id;
        $menu_name = $data->name;
        $menu_id = $data->menu_id;
        $image_id  = $data->image_id;
        $price = $data->price;
        $cat_id = $data->menu_category;

    }
} else {
    $method = '';
}

$category_data = json_decode(file_get_contents(MYURL.'category/'));

$image_data = json_decode(file_get_contents(MYURL.'menuImage/'));

$menu_data = json_decode(file_get_contents(MYURL.'menuId/'));



?>

<div class="content-wrapper">
		<section class="content-header">
          <h1>
              <a href="menus"> Menus </a> /
              Add Menus
          </h1>
          <ol class="breadcrumb">
            <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
            <li class="active">Add Menus</li>
          </ol>
        </section>

        <section class="content">
        <div class="container-fluid">
        <div class="box">
        <div class="box-header with-border"><i class="fa fa-warning"></i><h3 class="box-title">Add Menus</h3></div>
        <div class="box-body">
			<form id="addingredientgroup" class="form-horizontal">

            <div class="form-group">
         		<label class="col-sm-2 control-label">Name</label>
         	<div class="col-sm-6">
            	<input name="name" type="text" value="<?php echo $menu_name; ?>" required placeholder="Add Menu Name" class="form-control">
            </div>
                <label class="col-sm-4 text-success hidden" id="alreadyex">Name Already Exists</label>
         </div>

         <div class="form-group">
         		<label class="col-sm-2 control-label">Category</label>
         	<div class="col-sm-6">
            	<select name="category" required class="form-control">

                    <?php
                    foreach ( $category_data as $data )
                    {
                        if($data->id == $cat_id){
                        echo "<option value='$data->id'>$data->name</option>";
                        }
                    }
                    ?>
                    <option value=''></option>
                    <?php
                    foreach ( $category_data as $data )
                    {
                        echo "<option value='$data->id'>$data->name</option>";
                    }
                    ?>
    			</select>
            </div>
         </div>

         <div class="form-group">
             <label class="col-sm-2 control-label">Hotel Name</label>

             <div class="col-sm-6">
                 <select name="menu_name" required class="form-control">

                     <?php
                     foreach ( $menu_data as $data )
                     {
                     if($data->id == $menu_id) {
                         echo "<option value='$data->id'>$data->name</option>";
                     }
                     }
                     ?>
                     <option value=''></option>
                     <?php
                     foreach ( $menu_data as $data )
                     {
                         echo "<option value='$data->id'>$data->name</option>";
                     }
                     ?>
                 </select>
             </div>

         </div>


         <div class="form-group">
         		<label class="col-sm-2 control-label">Image</label>
         	<div class="col-sm-6">
            	<select name="image" required class="form-control">

                    <?php
                    foreach ( $image_data as $data )
                    {
                    if($data->id == $image_id) {
                        echo "<option value='$data->id'>$data->name</option>";
                    }
                    }
                    ?>
                    <option value=''></option>
                    <?php
                    foreach ( $image_data as $data )
                    {
                        echo "<option value='$data->id'>$data->name</option>";
                    }
                    ?>
    			</select>
            </div>
         </div>

         <div class="form-group">
         		<label class="col-sm-2 control-label">Price</label>
         	<div class="col-sm-6">
            	<input name="price" type="text" value="<?php echo $price; ?>" required placeholder="Price" class="form-control">
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

        $("#addingredientgroup").validate({
            rules: {
            },
            submitHandler: function() {
                addData();
            }
        });

        function addData() {

            $('.submit').one('click',function() {

                $.ajax({
                    type: 'post',
                    dataType:'json',
                    url: '<?php  echo MYURL.'menuItems'.$method; ?>',
                    data: {
                        <?php if(isset($getval)) {echo "id: ". $getval.",\n"; } ?>
                        data: formToJSON()},
                    success: function($response) {
                        if($response > 0) {
                            $('#alreadyex').removeClass('hidden');
                            $('#alreadyex').addClass('show');
                        } else {
                            location.assign('menus');
                        }

                    }
                });
            });

            $('.submit').trigger( "click" );
        }

        $("input[name='name']").keyup(function(){
            $('#alreadyex').removeClass('show');
            $('#alreadyex').addClass('hidden');
        });

        function formToJSON() {
            return JSON.stringify({
                "name": $.trim($("input[name='name']").val()),
                "menu_id":$("select[name='menu_name']").val(),
                "image_id": $("select[name='image']").val(),
                "price": $("input[name='price']").val(),
                "menu_category": $("select[name='category']").val()
            });
        }

    });
</script>
</div>
</body>
</html>
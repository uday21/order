<?php
$id = '';
$name = '';
$city_id = '';
$cityname = '';
if(isset($_GET['id'])) {
    $getval = $_GET['id'];
    $method = '_update';
    $area_data = json_decode(file_get_contents(MYURL.'dataareaId/id/'.$getval));

    foreach($area_data as $data){
        $id = $data->id;
        $name = $data->name;
        $city_id = $data->city;
    }
	
	$cityid_data = json_decode(file_get_contents(MYURL.'datacityId/id/'.$city_id));
	
	foreach($cityid_data as $citydata){
        $cityname = $citydata->name;
    }

} else {
    $method = '';
}

$city_data = json_decode(file_get_contents(MYURL.'city/'));



?>
<div class="content-wrapper">
		<section class="content-header">
          <h1>
              <a href="area"> Area </a> /
              Add Area
          </h1>
          <ol class="breadcrumb">
            <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
            <li class="active">Add Area</li>
          </ol>
        </section>
        
        <section class="content">
        <div class="container-fluid">
        <div class="box">
        <div class="box-header with-border"><i class="fa fa-warning"></i><h3 class="box-title">Add Area</h3></div>
        <div class="box-body">
 			<form id="addcat" class="form-horizontal">
				<div class="form-group">
         		<label class="col-sm-2 control-label">City</label>
         			<div class="col-sm-6">
                   <?php if(isset($_GET['id'])) { ?>
                    <input name="city" type="text" disabled value="<?php echo $cityname; ?>" required placeholder="Name" class="form-control">
                    
                    <?php } else { ?>
                    
                    <select name="city" required class="form-control">

                            <?php
                            foreach ( $city_data as $data )
                            {
                                echo "<option value='$data->id'>$data->name</option>";
                            }
                            ?>
    					</select>
                    
                    <?php } ?>
                    
                    
            			
            		</div>
         		</div>	
                
                <div class="form-group">
         		<label class="col-sm-2 control-label">Area</label>
         			<div class="col-sm-6">
            			<input name="name" type="text" value="<?php echo $name; ?>" required placeholder="Name" class="form-control">
            		</div>
                    <label class="col-sm-4 text-success hidden" id="alreadyex">Name Already Exists</label>
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





<script>

    $(document).ready(function() {

   /*     $.validator.addMethod("checkVal",
            function(value, element) {
                var result = false;
                $.ajax({
                    type:"post",
                    async: false,
                    url: <?php  echo MYURL.'check_existence'; ?>,
                    data: {
                        name: $("input[name='name']").val(),
                        key: 'name',
                        grid: 'account_details'
                    },
                    success: function(data) {
                        result = (data == true) ? true : false;
                    }
                });
                // return true if username is exist in database
                return result;
            },
            "This name is already used! Try another."
        );*/

        $("#addcat").validate({
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
                    url: '<?php  echo MYURL.'area'.$method; ?>',
                    data: {
                        <?php if(isset($getval)) {echo "id: ". $getval.",\n"; } ?>
                        data: formToJSON()
                    },
                    success: function($response) {
                        if($.trim($response) == false) {
                            $('#alreadyex').removeClass('hidden');
                            $('#alreadyex').addClass('show');
                        } else {
                            location.assign('area');
                        }
                    }
                });
            });

            $('.submit').trigger( "click" );
        }



        function formToJSON() {
            return JSON.stringify({
                "name": $.trim($("input[name='name']").val()),
                "city": $("select[name='city']").val()
            });
        }

        $("input[name='name']").keyup(function(){
            $('#alreadyex').removeClass('show');
            $('#alreadyex').addClass('hidden');
        });

    });
</script>
</div>
</body>
</html>
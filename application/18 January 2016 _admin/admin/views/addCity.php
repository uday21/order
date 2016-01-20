<?php

$city_name = '';

if(isset($_GET['id'])) {
    $getval = $_GET['id'];
    $method = '_update';
	$city_data = json_decode(file_get_contents(MYURL.'datacityId/id/'.$getval));

    foreach($city_data as $data){
        $city_name = $data->name;
    }
} else {
    $method = '';
}



?>
<div class="content-wrapper">
		<section class="content-header">
          <h1>
              <a href="city"> City </a> /
              Add City
          </h1>
          <ol class="breadcrumb">
            <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
            <li class="active">Add City</li>
          </ol>
        </section>
        
        <section class="content">
        <div class="container-fluid">
        <div class="box">
        <div class="box-header with-border"><i class="fa fa-warning"></i><h3 class="box-title">Add City</h3></div>
        <div class="box-body">
 			<form id="addcity" class="form-horizontal">
                
                <div class="form-group">
         		<label class="col-sm-2 control-label">City Name</label>
         			<div class="col-sm-6">
            			<input name="name" type="text" value="<?php echo $city_name; ?>" required placeholder="Name" class="form-control">
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

        $("#addcity").validate({
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
                    url: '<?php  echo MYURL.'city'.$method; ?>',
                    data: {
                        <?php if(isset($getval)) {echo "id: ". $getval.",\n"; } ?>
                        data: formToJSON()
                    },
                    success: function($response) {
                        if($.trim($response) == false) {
                            $('#alreadyex').removeClass('hidden');
                            $('#alreadyex').addClass('show');
                        } else {
                            location.assign('city');
                        }
                    }
                });
            });

            $('.submit').trigger( "click" );
        }



        function formToJSON() {
            return JSON.stringify({
                "name": $.trim($("input[name='name']").val())
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
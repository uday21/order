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
            <small>Users</small>
          </h1>
          <ol class="breadcrumb">
            <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
            <li class="active">Add Users</li>
          </ol>
        </section>
        
        <section class="content">
        <div class="container-fluid">
        <div class="box">
        <div class="box-header with-border"><i class="fa fa-warning"></i><h3 class="box-title">Add Users</h3></div>
        <div class="box-body">
			<form id="adduser"   class="form-horizontal">
            
            	<div class="form-group">
                	<label class="control-label col-sm-2">Label</label>
                    <div class="col-sm-6">
    					<select name="restaurant" required class="form-control">
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
    					<input name="password" type="type" class="form-control" value="" required placeholder="Password">
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

        $("#adduser").validate({
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
                    url: '<?php  echo MYURL.'users'.$method; ?>',
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
                "restaurant": $("select[name='restaurant']").val(),
                "password_hash": $("input[name='password']").val()
            });
        }

    });
</script>
</body>
</html>
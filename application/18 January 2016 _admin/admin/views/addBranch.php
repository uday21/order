<?php
$res_name = '';
$branch_name ='';
$address = '';
$location = '';
$city = '';
$pincode = '';
$menu_list = '';
$account_menu = '';
$min_order = '';

if(isset($_GET['id'])) {
    $getval = $_GET['id'];
    $method = '_update';

    $branch_data = json_decode(file_get_contents(MYURL.'dataBranchById/id/'.$getval));

    foreach($branch_data as $data){
        $res_name = $data->restaurant;
        $branch_name = $data->branch;
        $address = $data->address ;
        $city = $data->city;
        $area = $data->area;
        $pincode =$data->pincode ;
        $menu_list = $data->menu_id;
        $account_menu =$data->account_id ;
		$min_order =$data->min_order;
    }
} else {
    $method = '';
}

$restaurant_data = json_decode(file_get_contents(MYURL.'restaurant/'));

$menu_data = json_decode(file_get_contents(MYURL.'menuId/'));

$city_data = json_decode(file_get_contents(MYURL.'city/'));

$account_data = json_decode(file_get_contents(MYURL.'accountDetails/'));

?>


<div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
          <h1>
              <a href="branch">Branch</a> /
               Add Branch
          </h1>
          <ol class="breadcrumb">
            <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
            <li class="active">Add Branch</li>
          </ol>
        </section>

        <!-- Main content -->
        <section class="content">
        <div class="container-fluid">
        <div class="box">
        <div class="box-header with-border"><i class="fa fa-warning"></i><h3 class="box-title">Add Branch</h3></div>
        <div class="box-body">
        <form id="addbranch" method="post" action="" class="form-horizontal">
         <div class="form-group">
         <label class="col-sm-2  control-label">Restaurant</label>
         <div class="col-sm-6">
			<select name="restaurant" class="form-control" required>

                <?php
                foreach ( $restaurant_data as $data )
                {
                    if($data->id == $res_name){
                    echo "<option value='$data->id'>$data->name</option>";
                    }
                }
                ?>
                <option value=""></option>
                <?php
                foreach ( $restaurant_data as $data )
                {
                    echo "<option value='$data->id'>$data->name</option>";
                }
                ?>
			</select>
          </div>  
		 </div>

         <div class="form-group">
                <label class="col-sm-2 control-label">branch</label>
                <div class="col-sm-6">
                    <input name="branch" class="form-control" type="text" value="<?php echo $branch_name; ?>" required placeholder="Branch">
                </div>
         </div>
         
         <div class="form-group">
                <label class="col-sm-2 control-label">Minimum Order</label>
                <div class="col-sm-6">
                    <input name="minimum" class="form-control" type="text" value="<?php echo $min_order; ?>" required placeholder="Minimum Order">
                </div>
         </div>

         <div class="form-group">
         <label class="col-sm-2 control-label">Address</label>
         <div class="col-sm-6">
         	<input name="address" class="form-control" type="text" value="<?php echo $address; ?>" required placeholder="Address">
          </div>  
		 </div>
         
         <div class="form-group">
         <label class="col-sm-2 control-label">Area</label>
         <div class="col-sm-6">
         	<input name="area" class="form-control" type="text" value="<?php echo $area; ?>" required placeholder="Area">
          </div>  
		 </div>
         
         <div class="form-group">
         <label class="col-sm-2 control-label">City</label>
         <div class="col-sm-6">
         
         <select name="city" required class="form-control" >
                <?php
                foreach ( $city_data as $data )
                {
                    if($data->id == $city){
                    echo "<option value='$data->id'>$data->name</option>";
                    }
                }

                ?>
                <option value="">Select City</option>
                <?php
                foreach ( $city_data as $data )
                {
                    echo "<option value='$data->id'>$data->name</option>";
                }
                ?>
    		</select>
          </div>  
		 </div>
         
         <div class="form-group">
         <label class="col-sm-2 control-label">Pincode</label>
         <div class="col-sm-6">
         	<input name="pincode" class="form-control" type="text" value="<?php echo $pincode; ?>" required placeholder="Pincode">
          </div>  
		 </div>
         
         <div class="form-group">
         <label class="col-sm-2 control-label">Menu List</label>
         <div class="col-sm-6">
         	<select name="menu" required class="form-control" >

                <?php
                foreach ( $menu_data as $data )
                {
                    if($data->id == $menu_list){
                    echo "<option value='$data->id'>$data->name</option>";
                    }
                }

                ?>
                <option value="">Select Menu</option>
                <?php
                foreach ( $menu_data as $data )
                {
                    echo "<option value='$data->id'>$data->name</option>";
                }
                ?>
    		</select>
          </div>  
          <div class="col-sm-2 padleft"><a  id="show_menu" class="btn btn-link">Add Hotel menu</a></div>
		 </div>
         
         <div class="hidden" id="menu_namehide">
         <div class="form-group">
         <label class="col-sm-2 control-label">Menu Name</label>
         <div class="col-sm-6">
         	<input name="menuname" type="text" class="form-control"/>
          </div>  
		 </div>
         
         <div  class="form-group">
         <label class="col-sm-2 marginleft"></label>
         <div class="col-sm-6">
         <a class="menusubmit btn btn-default btn-sm" href="#" >Submit</a>
         </div>  
         </div>
         </div>
         
         <div class="form-group">
         <label class="col-sm-2 control-label">Account Name</label>
         <div class="col-sm-6">
         	<select name="account" required class="form-control">

                <?php
                foreach ( $account_data as $data )
                {
                    if($data->id == $account_menu){
                    echo "<option value='$data->id'>$data->name</option>";
                    }
                }
                ?>
                <option value=""></option>
                <?php
                foreach ( $account_data as $data )
                {
                    echo "<option value='$data->id'>$data->name</option>";
                }
                ?>
    			</select>
          </div>  
          <div class="col-sm-2 padleft"><a id="show_account" class="btn btn-link">Add Account menu</a></div>
		 </div>
         
         <div>
         
         <div class="hidden" id="account_namehide">
         
         <div class="form-group">
         <label class="col-sm-2 control-label">Account Name</label>
         <div class="col-sm-6">
         	<input name="accountname" type="text" class="form-control"/>
          </div>  
		 </div>
         
         <div  class="form-group">
         <label class="col-sm-2"></label>
         <div class="col-sm-6 ">
         <a class="accountsubmit btn btn-default btn-sm" href="#" >Submit</a>
         </div>  
         </div>
         
         </div>
         
         </div>
         
         <div  class="form-group">
         <label class="col-sm-2 marginleft"></label>
         <div class="col-sm-6 padleft">
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
		
		$('#show_menu').on('click',function(){
			$('#menu_namehide').removeClass('hidden');
		});
		
		$('#show_account').on('click',function(){
			$('#account_namehide').removeClass('hidden');
		});

        $("#addbranch").validate({
            rules: {
            },
            submitHandler: function(form) {
                //form.submit();
                addData();
            }
        });


        $('.menusubmit').click(function() {

            $menuname = $("input[name='menuname']").val();
            if(jQuery.trim($menuname).length > 0) {
                $.ajax({
                    type: 'post',
                    dataType:'json',
                    url: '<?php echo MYURL.'menuId'.$method; ?>',
                    data: {data: menuformToJSON()},
                    success: function($response) {
                        alert($response);
                    }
                });
            } else {
                alert('Enter Data');
            }
        });

        function menuformToJSON() {
            return JSON.stringify({
                "name": $("input[name='menuname']").val()
            });
        }

        $('.accountsubmit').click(function() {

            $accountname = $("input[name='accountname']").val();
			
			//alert($accountname.length);

            if($accountname.length > 0) {
                $.ajax({
                    type: 'post',
                    dataType:'json',
                    url: '<?php echo MYURL.'accountDetails'.$method; ?>',
                    data: {data: accountformToJSON()},
                    success: function($response) {
                        alert($response);
                    }
                });
            } else {
                alert('Enter Data');
            }


        });

        function accountformToJSON() {
            return JSON.stringify({
                "name": $("input[name='accountname']").val()
            });
        }

        function addData() {

            $('.submit').one('click', function() {

               $.ajax({
                 type: 'post',
                 dataType:'json',
                 url: '<?php echo MYURL.'branch'.$method; ?>',
                 data: {
                     <?php if(isset($getval)) {echo "id: ". $getval.",\n"; } ?>
                     data: formToJSON()
                 },
                 success: function($response) {

                     if($response == true){
                         location.assign('branch');
                     }
                 }
                 });
            });

            $('.submit').trigger( "click" );
        }



        function formToJSON() {
            return JSON.stringify({
                "restaurant": $("select[name='restaurant']").val(),
                "branch":  $("input[name='branch']").val(),
                "address": $("input[name='address']").val(),
                "area": $("input[name='area']").val(),
                "city": $("select[name='city']").val(),
                "pincode": $("input[name='pincode']").val(),
                "menu_id": $("select[name='menu']").val(),
                "account_id": $("select[name='account']").val(),
				"min_order": $("input[name='minimum']").val()
            });
        }
		
		

    });
</script>
<script>
$(document).ready(function(e) {
    
});
</script>
</body>
</html>
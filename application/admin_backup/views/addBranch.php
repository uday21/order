<?php

if(isset($_GET['id'])) {
    $getval = $_GET['id'];
    $method = '_update';
} else {
    $method = '';
}

$restaurant_data = json_decode(file_get_contents(MYURL.'restaurant/'));

$menu_data = json_decode(file_get_contents(MYURL.'menuId/'));

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
    			<option value="">Select Restaurant</option>
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
         <label class="col-sm-2 control-label">Branch Name</label>
         <div class="col-sm-6">
         	<input name="branch" class="form-control" type="text" value="" required placeholder="Branch">
            <input value="" class="unique" >
          </div>  
		 </div>
         
         <div class="form-group">
         <label class="col-sm-2 control-label">Address</label>
         <div class="col-sm-6">
         	<input name="address" class="form-control" type="text" value="" required placeholder="Address">
          </div>  
		 </div>
         
         <div class="form-group">
         <label class="col-sm-2 control-label">Location</label>
         <div class="col-sm-6">
         	<input name="location" class="form-control"  type="text" value="" required placeholder="Location">
          </div>  
		 </div>
         
         <div class="form-group">
         <label class="col-sm-2 control-label">Area</label>
         <div class="col-sm-6">
         	<input name="area" class="form-control" type="text" value="" required placeholder="Area">
          </div>  
		 </div>
         
         <div class="form-group">
         <label class="col-sm-2 control-label">Pincode</label>
         <div class="col-sm-6">
         	<input name="pincode" class="form-control" type="text" value="" required placeholder="Pincode">
          </div>  
		 </div>
         
         <div class="form-group">
         <label class="col-sm-2 control-label">Menu List</label>
         <div class="col-sm-6">
         	<select name="menu" required class="form-control" >
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
        		<option value="">Select Account</option>
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
         <label class="col-sm-2 "></label>
         <div class="col-sm-6">
         <a class="menusubmit btn btn-default btn-sm" href="#" >Submit</a>
         </div>  
         </div>
         
         </div>
         
         </div>
         
         <div  class="form-group">
         <label class="col-sm-2 marginleft"></label>
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
		
		$("input[name='branch']").keyup(function() {
			alert();
				$.ajax({
                    type: 'post',
                    dataType:'json',
                    url: '<?php echo MYURL.'check_existence'; ?>',
                    data: {
						name: $("input[name='branch']").val(),
						key: 'branch',
						grid: 'branch'
					},
					beforeSend: function() {
						alert($("input[name='branch']").val());
					}
                    success: function($response) {
                        alert($response);
                    }
                });
        });
		
		
		
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
			
			var unique = $('.unique').val();
			
			if($.trim(unique) == "success") {
				
				alert();

            /*$('.submit').click(function() {

               $.ajax({
                 type: 'post',
                 dataType:'json',
                 url: '<?php echo MYURL.'branch'.$method; ?>',
                 data: {data: formToJSON()},
                 success: function($response) {
                 alert($response);
                 }
                 });
            });

            $('.submit').trigger( "click" );*/
			
			}
        }

		

        function formToJSON() {
            return JSON.stringify({
                "restaurant": $("select[name='restaurant']").val(),
				"branch": $("input[name='branch']").val(),
                "address": $("input[name='address']").val(),
                "location": $("input[name='location']").val(),
                "area": $("input[name='area']").val(),
                "pincode": $("input[name='pincode']").val(),
                "menu_id": $("select[name='menu']").val(),
                "account_id": $("select[name='account']").val()
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
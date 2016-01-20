<?php
$orderstatus = $_GET['id'];
$orders_data = json_decode(file_get_contents(MYURL.'orderadmin/id/'.$_GET['id']));

?>

<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>Order Food Now</title>
</head>

<body>
<div class="content-wrapper">
  <section class="content-header">
    <h1> Orders </h1>
    <ol class="breadcrumb">
      <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
      <li class="active">Orders</li>
    </ol>
  </section>
  <section class="content">
    <div class="container-fluid">
      <div class="box">
        <div class="box-header">
          <h3 class="box-title">
          <a class="btn <?php if($_GET['id'] == 0) { echo 'btn-warning'; } else { echo 'btn-default'; } ?>" href="?id=0">Pending</a>&nbsp;
          <a class="btn <?php if($_GET['id'] == 3) { echo 'btn-danger'; } else { echo 'btn-default'; } ?>" href="?id=3">Cancelled</a>&nbsp;
          <a class="btn <?php if($_GET['id'] == 1) { echo 'btn-info'; } else { echo 'btn-default'; } ?>" href="?id=1">Confirmed</a>&nbsp;
          <a class="btn <?php if($_GET['id'] == 2) { echo 'btn-success'; } else { echo 'btn-default'; } ?>" href="?id=2">Delivered</a>&nbsp;
          </h3>
        </div>
        <!-- /.box-header -->
        <div class="box-body">
          <table id="table" class="table table-bordered table-striped">
            <thead>
              <tr>
                <th></th>
              </tr>
            </thead>
            <tbody>
              <?php
                        foreach ( $orders_data as $data )
                        {
                            ?>
              <tr>
                <td><div class="box box-primary">
                    <div class="box-header ui-sortable-handle" style="cursor: move;"> <i class="ion ion-person"></i>
                      <h3 class="box-title"><?php echo $data->name." (".$data->mobile.")";?></h3>
                      <div class="box-tools pull-right">
                        <h3 class="box-title"><a class="btn btn-block btn-danger"><?php echo $data->branch; ?></a></h3>
                      </div>
                    </div>
                    <div class="box-body">
                      <div class="box-tools"> <b>Email: <em style="color:#666;"><?php echo $data->email; ?></em></b> </div>
                      <div class="box-tools pull-right">
                        <h3 class="box-title">Total Price : <?php echo $data->price; ?></h3>
                      </div>
                      <div class="margin"> <a class="btn btn-primary order_btn"><i class="fa fa-plus"></i> View Orders</a> <a class="btn btn-info address_btn"><i class="fa fa-plus"></i> View Address</a> 
                      <select id="<?php echo $data->id; ?>" class="btn btn-default active_state">
                    
                    
                    
                      
                      <?php if ($orderstatus==0 || $orderstatus==3) { ?> <option value="0" <?php  if ($data->status == '0') echo 'selected="selected"' ?>>Pending</option> <?php } ?>
					  <?php if ($orderstatus==3 || $orderstatus==0) { ?> <option value="3" <?php  if ($data->status == '3') echo 'selected="selected"' ?>>Cancelled</option> <?php } ?>
                      <?php if ($orderstatus==1 || $orderstatus==0 ) { ?> <option value="1"  <?php if ($data->status == '1') echo 'selected="selected"' ?> >Confirmed</option> <?php } ?>
                       <?php if ($orderstatus==2 || $orderstatus==1) { ?> <option value="2" <?php  if ($data->status == '2') echo 'selected="selected"' ?>>Delivered</option> <?php } ?>
                      
                    </select>
                      
                      </div>
                      <div style="display:none" class="address">
                        <div class="box-tools col-lg-7">
                          <p>
                          <table border="0" cellspacing="5" cellpadding="5">
                            <tr>
                              <td><strong>Flat.No / House No.</strong></td>
                              <td>&nbsp;&nbsp; : &nbsp;&nbsp;</td>
                              <td><?php echo $data->flat; ?></td>
                            </tr>
                            <tr>
                              <td><strong>Apartment / Locality Name</strong></td>
                              <td>&nbsp;&nbsp; : &nbsp;&nbsp;</td>
                              <td><?php echo $data->apartment; ?></td>
                            </tr>
                            <tr>
                              <td><strong>Company</strong></td>
                              <td>&nbsp;&nbsp; : &nbsp;&nbsp;</td>
                              <td><?php echo $data->company; ?></td>
                            </tr>
                            <tr>
                              <td><strong>Location</strong></td>
                              <td>&nbsp;&nbsp; : &nbsp;&nbsp;</td>
                              <td><?php echo $data->location; ?></td>
                            </tr>
                            <tr>
                              <td><strong>City</strong></td>
                              <td>&nbsp;&nbsp; : &nbsp;&nbsp;</td>
                              <td><?php echo $data->city; ?></td>
                            </tr>
                            <tr>
                              <td><strong>Postcode</strong></td>
                              <td>&nbsp;&nbsp; : &nbsp;&nbsp;</td>
                              <td><?php echo $data->postcode; ?></td>
                            </tr>
                          </table>
                          </p>
                        </div>
                      </div>
                      <div style="display:none" class="col-xs-12 orders">
                        <div class="box">
                          <div class="box-body table-responsive no-padding">
                            <table class="table table-hover">
                              <tbody>
                                <tr>
                                  <th>ID</th>
                                  <th>Name</th>
                                  <th>Quantity</th>
                                  <th>Price</th>
                                  <th>Actions</th>
                                </tr>
                                <?php
					$i = 0;
                    foreach ( $data->orders as $items )
                        {
							 $i++;
							?>
                                <tr>
                                  <td><?php echo $i; ?></td>
                                  <td><?php echo $items->name; ?></td>
                                  <td><div class="q_content"><?php echo $items->quantity; ?></div><div style="display:none" class="q_container"><input class="quantity" value="<?php echo $items->quantity; ?>" type="text">&nbsp;<a class="btn q_btn">Save</a></div></td>
                                  <td><?php echo $items->price; ?></td>
                                  <td>
                                  <a class="btn btn-default update" id="<?php echo $data->id; ?>"><i class="fa fa-pencil"></i></a>
                                  <a class="btn btn-default delete" id="<?php echo $data->id; ?>"><i class="fa fa-remove"></i></a>
                                  
                                  
                                  </td>
                                </tr>
                                <?php
						}
					?>
                              </tbody>
                            </table>
                          </div>
                        </div>
                      </div>
                    </div>
                  </div></td>
                <!--<td><?php echo $data->name; ?></td>
                                <td><?php echo $data->branch; ?></td>
                                <td><?php echo $data->address; ?></td>
                                <td><?php echo $data->area; ?></td>
                                <td><?php echo $data->city; ?></td>
                                <td><?php echo $data->pincode; ?></td>
                                <td><a data-toggle="modal" href="" data-target="#myModal" class="btn btn-default">View menus</a></td>
                                <td><a data-toggle="modal" href="" data-target="#myModal" class="btn btn-default">View Account Details</a></td>
                                <td>
                                    <a class="btn btn-default" href="<?php echo 'add_branch?id='. $data->id; ?>"><i class="fa fa-pencil"></i></a>
                                    <a class="btn btn-default delete" id="<?php echo $data->id; ?>"><i class="fa fa-remove"></i></a>
                                </td>--> 
              </tr>
              <?php } ?>
            </tbody>
          </table>
        </div>
        <!-- /.box-body --> 
      </div>
    </div>
  </section>
</div>
<div id="myModal" class="modal fade">
  <div class="modal-dialog">
    <div class="modal-content"> 
      <!-- Content will be loaded here from "remote.php" file --> 
    </div>
  </div>
</div>
<script src="<?php echo  base_url('assets/plugins/datatables/jquery.dataTables.min.js');?>"></script> 
<script src="<?php echo  base_url('assets/plugins/datatables/dataTables.bootstrap.min.js');?>"></script> 
<script>

    $(document).ready(function() {
		
		$('.order_btn').click(function() {
			$(this).parent().parent().find('.address').slideUp();
			$(this).parent().parent().find('.orders').slideToggle();
		});	
		
		$('.address_btn').click(function() {
			$(this).parent().parent().find('.orders').slideUp();
			$(this).parent().parent().find('.address').slideToggle();
		});
		
        $('.delete').click(function() {

            var delId = $(this).attr('id');
            var parent = $(this).parent().parent();

            $.ajax({
                type: 'post',
                dataType:'json',
                url: '<?php  echo MYURL.'orderItems_remove'; ?>',
                data: {
                    id: delId
                },
                success: function($response) {
                    if($response == true) {
                        parent.remove();
                    }
                }
            });
        });

        $(function () {
            $('#table').DataTable({
                "paging": true,
                "lengthChange": true,
                "searching": false,
                "ordering": false,
                "info": false,
                "autoWidth": false
            });
        });

        $("#addrestaurant").validate({
            rules: {
                image: {
                    extension: "JPG|jpg|PNG|png|GIF|gif|BMP|bmp|JPEG|jpeg"
                }
            },
            submitHandler: function(form) {
                form.submit();
            }
        });
		

            $('.update').one('click', function() {
				
				var updateId = $(this).attr('id');

               $.ajax({
                 type: 'post',
                 dataType:'json',
                 url: '<?php echo MYURL.'orderItems_update'; ?>',
                 data: {
                     id: updateId,
                     data: formToJSON()
                 },
                 success: function($response) {

                     if($response == true){
                         location.assign('branch');
                     }
                 }
                 });
            });



        function formToJSON() {
            return JSON.stringify({
                "item_options": $("input[name='quantity']").val()
            });
        }
		
		
		$('.active_state').on('change', function() {
			var status_id = $(this).attr('id');
        	var my_value = $(this).val();
			
			var active = $(this);
			
			$.ajax({
                 type: 'post',
                 dataType:'json',
                 url: '<?php echo MYURL.'orderStatus_update'; ?>',
                 data: {
						 id: status_id,
						 status: my_value
                 },
                 success: function($response) {

                     if($response == true){
                         active.closest('tr').remove();
						 alert("Successfully Moved");
                     }
                 }
            });
		});
		
		

    });
</script>
</body>
</html>
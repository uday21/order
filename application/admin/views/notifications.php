<!doctype html>
<html>
<head>
    <meta charset="utf-8">
    <title>Order Food Now</title>
    
    
</head>

<body>

	<div class="content-wrapper">
		<section class="content-header">
          <h1>
              <a href="send_notifications">Send Notifications</a> /
               Notifications
          </h1>
          <ol class="breadcrumb">
            <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
            <li class="active">Send Notifications</li>
          </ol>
        </section>
        
        <section class="content">
        <div class="container-fluid">
            <div class="box">
                <div class="box-header">
                    <h3 class="box-title">Data Table With Full Features</h3>
                </div><!-- /.box-header -->
                <div class="box-body">
                    <table id="table" class="table table-bordered table-striped">

                        <thead>
                        <tr>
                            <th>SI NO</th>
                            <th>Notifications</th>
                            <th>Date</th>
                            <!--<th>Actions</th>-->
                        </tr>
                        </thead>


                        <tbody>


                        <?php
                        $i = 0;
						$notify_data = json_decode(file_get_contents(MYURL.'notificationDetails/'));
                        foreach ( $notify_data as $notify )
                        {
                            $i++;
                            ?>
                            <tr>
                                <td><?php echo $i; ?></td>
                                <td><?php echo $notify->notifications; ?></td>
                                <td><?php echo date("M d, h:m A", strtotime($notify->curr_date)); ?></td>
                                <!--<td>
                                    <a class="btn btn-default" href="<?php // echo 'add_category?id='. $data->id; ?>"><i class="fa fa-pencil"></i></a>
                                    <a class="btn btn-default delete" id="<?php // echo $data->id; ?>"><i class="fa fa-remove"></i></a>
                                </td>-->
                            </tr>

                        <?php } ?>

                        </tbody>

                    </table>
                </div><!-- /.box-body -->
            </div>
        </div>
    </section>
        
	</div>



<script src="<?php echo  base_url('assets/plugins/datatables/jquery.dataTables.min.js');?>"></script>
<script src="<?php echo  base_url('assets/plugins/datatables/dataTables.bootstrap.min.js');?>"></script>
<script>

    $(document).ready(function() {


function addData() {
        $('.submit').one('click', function() {

            $.ajax({
                type: 'post',
                url: 'http://demo12.shalominfotech.net/mytest/test.php',//'http://order.orderfoodnow.in/admin/notifications.php',
                data: { notify: $("input[name='notify']").val() },
                success: function($response) {
                    alert($response);
                }
            });
        });
		$('.submit').trigger( "click" );
        }
		
		$(function () {
            $('#table').DataTable({
                "paging": true,
                "lengthChange": true,
                "searching": false,
                "ordering": true,
                "info": true,
                "autoWidth": false
            });
        });
	
		
        $("#addnotification").validate({
            rules: {
            },
            submitHandler: function(form) {
                //form.submit();
				addData();
            }
        });

    });
</script>
</body>
</html>
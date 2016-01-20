<!doctype html>
<html>
<head>
    <meta charset="utf-8">
    <title>Order Food Now</title>
    
    <style>
	.blacked {
		width:100%;
		height:2000px;
		background:rgba(0,0,0,.5);
		position:fixed;
		display:none;
		z-index:9999;
	}
	</style>
</head>

<body>
<div class="blacked"></div>
	<div class="content-wrapper">
		<section class="content-header">
          <h1>
              Send Notifications /
               <a href="notifications">Notifications</a>
          </h1>
          <ol class="breadcrumb">
            <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
            <li class="active">Send Notifications</li>
          </ol>
        </section>
        
        <section class="content">
        <div class="container-fluid">
        <div class="box">
        <div class="box-header with-border"><i class="fa fa-warning"></i><h3 class="box-title">Notifications</h3></div>
        <div class="box-body">
        <form id="addnotification" method="post" action="" class="form-horizontal">
        
		 <div class="form-group">
         <label class="col-sm-2 control-label">Notifications</label>
         	<div class="col-sm-6">
            	<input name="notify" class="form-control" type="text" value="" required placeholder="Notifications">
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

	function addData() {
        $('.submit').one('click', function() {
			
			$.ajax({
                type: 'post',
                dataType:'json',
                url: '<?php echo MYURL.'notificationDetails' ?>',
                data: { notify: $("input[name='notify']").val() },
				beforeSend: function() {
					$('.blacked').css('display', 'block');
				},
                success: function($response) {
					//location.assign("notifications");
					//send_notify();
					
					$.ajax({
            type: 'post',
   			dataType:'json',
            url: 'http://demo12.shalominfotech.net/mytest/test.php',
            data: {
				notify: $("input[name='notify']").val()
            },
			success: function (data, textStatus, result) {
				console.log(data+ " - "+textStatus+ " - "+result);
			},
			error: function (result, textStatus, errorThrown) {
				//console.log(JSON.stringify(result)+ " - "+JSON.stringify(textStatus)+ " - "+errorThrown);
				location.assign("notifications");
				$('.blacked').css('display', 'none');
			}
        	});
					
					
					/*$.ajax({
            type: 'post',
   			dataType:'json',
            url: 'http://order.orderfoodnow.in/admin/test.php',//http://demo12.shalominfotech.net/mytest/test.php',
            data: {
				notify: $("input[name='notify']").val()
            },
            success: function(data) {
				//alert("Success");
				location.assign("notifications");
            }
        	});*/
					
					
						
                }
            });

            
        });
		
		$('.submit').trigger( "click" );
	}
		
		
		function send_notify() {
			$.ajax({
            type: 'post',
   			dataType:'json',
            url: 'http://order.orderfoodnow.in/admin/test.php',//http://demo12.shalominfotech.net/mytest/test.php',
            data: {
				notify: $("input[name='notify']").val()
            },
            success: function(data) {
				//alert("Success");
				location.assign("notifications");
            }
        	});
		}
	
		
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
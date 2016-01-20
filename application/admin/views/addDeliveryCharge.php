<?php

$kilometre = '';
$price = '';

if(isset($_GET['id'])) {
    $getval = $_GET['id'];
    $method = '_update';
	$kilometre_data = json_decode(file_get_contents(MYURL.'datadeliveryChargeId/id/'.$getval));

    foreach($kilometre_data as $data){
        $kilometre = $data->kilometre;
		$price = $data->price;
    }
} else {
    $method = '';
}



?>
<div class="content-wrapper">
		<section class="content-header">
          <h1>
              <a href="delivery_charge"> Delivery Charge </a> /
              Add Delivery Charge
          </h1>
          <ol class="breadcrumb">
            <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
            <li class="active">Add Delivery Charge</li>
          </ol>
        </section>
        
        <section class="content">
        <div class="container-fluid">
        <div class="box">
        <div class="box-header with-border"><i class="fa fa-warning"></i><h3 class="box-title">Add Delivery Charge</h3></div>
        <div class="box-body">
 			<form id="adddeliverycharge" class="form-horizontal" method="post">
                
                <div class="form-group">
         		<label class="col-sm-2 control-label">Kilometre</label>
         			<div class="col-sm-6">
            			<input name="name" type="text" value="<?php echo $kilometre; ?>" required placeholder="Kilometre" class="form-control">
            		</div>
                    <label class="col-sm-4 text-success hidden" id="alreadyex">Name Already Exists</label>
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





<script>

    $(document).ready(function() {

        $("#adddeliverycharge").validate({
            rules: {
            },
            submitHandler: function() {
                addData();
            }
        });
		
		function formToJSON() {
            return JSON.stringify({
                "kilometre":$.trim($("input[name='name']").val()),
				"price":$.trim($("input[name='price']").val()),
            });
        }
		
		$("input[name='name']").keyup(function(){
            $('#alreadyex').removeClass('show');
            $('#alreadyex').addClass('hidden');
        });
		
		function addData() {
			
			$('.submit').one('click',function() {
				$.ajax({
					type: 'post',
                    dataType:'json',
                    url: '<?php  echo MYURL.'delivery_charge'.$method; ?>',
					data: {
                        <?php if(isset($getval)) {echo "id: ". $getval.",\n"; } ?>
                        data: formToJSON()
                    }, success: function($response) {
                        if($.trim($response) == false) {
                            $('#alreadyex').removeClass('hidden');
                            $('#alreadyex').addClass('show');
                        } else {
                            location.assign('delivery_charge');
                        }
                    }
				});
			});
			
			
			$('.submit').trigger( "click" );
            
        }
		
		});
		

        /**/
		
		

        /*



        

    });*/
</script>
</div>
</body>
</html>
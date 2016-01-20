<?php

if(isset($_GET['id'])) {
    $getval = $_GET['id'];
    $method = '_update';
} else {
    $method = '';
}

$offer_data = json_decode(file_get_contents(MYURL.'offer/'));

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
        <h1>
            Offers /
            <a href="add_offers"> Add Offer</a>
        </h1>
        <ol class="breadcrumb">
            <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
            <li class="active">Add Offer</li>
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
                <th>Name</th>
                <th>Logo</th>
                <th>Actions</th>
            </tr>
            </thead>


        <tbody>


        <?php
            foreach ( $offer_data as $data )
        {
        ?>
        <tr>
            <td><?php echo $data->name; ?></td>
            <td><?php echo "<img width='100' height='100' src='data:image/jpeg;base64,".$data->offer_image."'/>" ?></td>
            <td>
                <a class="btn btn-default" href="<?php echo 'add_offers?id='. $data->id; ?>"><i class="fa fa-pencil"></i></a>
                <a class="btn btn-default delete" id="<?php echo $data->id; ?>"><i class="fa fa-remove"></i></a>
            </td>
        </tr>

        <?php } ?>

        </tbody>

        </table>
        </div><!-- /.box-body -->
        </div>
        </div>
    </section>

</div>




<div id="myBranch" class="modal fade">

    <div class="modal-dialog">
        <div class="modal-content">
        <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title">Branches</h4>
      </div>
        
            
         </div>
    </div>
</div>




<script src="<?php echo  base_url('assets/plugins/datatables/jquery.dataTables.min.js');?>"></script>
<script src="<?php echo  base_url('assets/plugins/datatables/dataTables.bootstrap.min.js');?>"></script>
<script>

    $(document).ready(function() {
		
		$('#myBranch').on('hidden.bs.modal', function () {
  			//$(this).removeData('modal');

		});

        $('.delete').click(function() {

            var delId = $(this).attr('id');
            var parent = $(this).parent().parent();

            $.ajax({
                type: 'post',
                dataType:'json',
                url: '<?php  echo MYURL.'offer_remove'; ?>',
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
                "ordering": true,
                "info": true,
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

    });
</script>
</body>
</html>
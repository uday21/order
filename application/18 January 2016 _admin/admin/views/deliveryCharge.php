<?php

$delivery_data = json_decode(file_get_contents(MYURL.'delivery_charge/'));

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
            Delivery Charge /
            <a href="add_delivery_charge"> Add Delivery Charge</a>
        </h1>
        <ol class="breadcrumb">
            <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
            <li class="active">Add Delivery Charge</li>
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
                            <th>S NO</th>
                            <th>Kilometre</th>
                            <th>Price</th>
                            <th>Actions</th>
                        </tr>
                        </thead>


                        <tbody>


                        <?php
                        $i = 0;
                        foreach ( $delivery_data as $data )
                        {
                            $i++;
                            ?>
                            <tr>
                                <td><?php echo $i; ?></td>
                                <td><?php echo $data->kilometre.' Km'; ?></td>
                                <td><?php echo $data->price.' Rs'; ?></td>
                                <td>
                                    <a class="btn btn-default" href="<?php echo 'add_delivery_charge?id='. $data->id; ?>"><i class="fa fa-pencil"></i></a>
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

        $('.delete').click(function() {

            var delId = $(this).attr('id');
            var parent = $(this).parent().parent();

            $.ajax({
                type: 'post',
                dataType:'json',
                url: '<?php  echo MYURL.'delivery_charge_remove'; ?>',
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
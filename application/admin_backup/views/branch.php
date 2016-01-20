<?php

if(isset($_GET['id'])) {
    $getval = $_GET['id'];
    $method = '_update';
} else {
    $method = '';
}

$branch_data = json_decode(file_get_contents(MYURL.'databranch/'));

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
            Branch /
            <a href="add_branch"> Add Branch</a>
        </h1>
        <ol class="breadcrumb">
            <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
            <li class="active">Add Restaurant</li>
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
                            <th>Address</th>
                            <th>Location</th>
                            <th>Area</th>
                            <th>Pin Code</th>
                            <th>Menu Details</th>
                            <th>Account Details</th>
                            <th>Actions</th>
                        </tr>
                        </thead>


                        <tbody>


                        <?php
                        foreach ( $branch_data as $data )
                        {
                            ?>
                            <tr>
                                <td><?php echo $data->name; ?></td>
                                <td><?php echo $data->address; ?></td>
                                <td><?php echo $data->location; ?></td>
                                <td><?php echo $data->area; ?></td>
                                <td><?php echo $data->pincode; ?></td>
                                <td><a data-toggle="modal" href="" data-target="#myModal" class="btn btn-default">View menus</a></td>
                                <td><a data-toggle="modal" href="" data-target="#myModal" class="btn btn-default">View Account Details</a></td>
                                <td>
                                    <a class="btn btn-default" href="<?php echo 'add_branch?id='. $data->id; ?>"><i class="fa fa-pencil"></i></a>
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
                url: '<?php  echo MYURL.'branch_remove'; ?>',
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
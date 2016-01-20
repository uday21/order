<?php

if(isset($_GET['id'])) {
    $getval = $_GET['id'];
    $method = '_update';
} else {
    $method = '';
}

$ingredientGroup_data = json_decode(file_get_contents(MYURL.'ingredientGroup/'));

?>


<div class="content-wrapper">
    <section class="content-header">
        <h1>
            Ingredient Group /
            <a href="add_ingredientgroup"> Add Ingredient Group</a>
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
                            <th>SI NO</th>
                            <th>Item Name</th>
                            <th>Item Type</th>
                            <th>Ingredients</th>

                            <th>Actions</th>
                        </tr>
                        </thead>


                        <tbody>


                        <?php
                        $i = 0;
                        foreach ( $ingredientGroup_data as $data )
                        {
                            $i++;
                            ?>
                            <tr>
                                <td><?php echo $i; ?></td>
                                <td><?php echo $data->name; ?></td>
                                <td><?php echo $data->type; ?></td>
                                <td><?php echo $data->other_properties; ?></td>
                                <td>
                                    <a class="btn btn-default" href="<?php echo 'add_ingredientgroup?id='. $data->id; ?>"><i class="fa fa-pencil"></i></a>
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
                url: '<?php  echo MYURL.'ingredientGroup_remove'; ?>',
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
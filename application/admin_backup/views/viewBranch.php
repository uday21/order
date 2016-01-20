<?php

if(isset($_GET['id'])) {
    $getval = $_GET['id'];
} 
$menus = json_decode(file_get_contents(MYURL."viewBranch/id/$getval"));

?>
<div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title">Branches</h4>
      </div>

<div class="box">
                <div class="box-body">
                    <table class="table table-bordered table-striped">

                        <thead>
                        <tr>
                            <th>Branches</th>
                        </tr>
                        </thead>


                        <tbody>


                        <?php
                        foreach ( $menus as $data )
                        {
                            ?>
                            <tr>
                                <td><?php echo $data->branch; ?></td>
                                
                            </tr>

                        <?php } ?>

                        </tbody>

                    </table>
                </div><!-- /.box-body -->
            </div>
<?php

$image_data = json_decode(file_get_contents(MYURL.'dataimage/'));

?>
<div class="content-wrapper">
    <section class="content-header">
        <h1>
            Images /
            <a href="add_images">Add Image</a>
        </h1>
        <ol class="breadcrumb">
            <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
            <li class="active">Add Image</li>
        </ol>
    </section>

    <section class="content">
        <div class="container-fluid">
            <div class="box">
                <div class="box-header with-border"><i class="fa fa-warning"></i><h3 class="box-title">Add Image</h3></div>
                <div class="box-body">
                    <ul>
                        <?php
                        foreach ( $image_data as $data )
                        {
                            echo "<li><img width='100' height='100' src='data:image/jpeg;base64,".$data->binary_details."'/><br>".$data->name."</li>";
                        }
?>

                    </ul>
                </div>
            </div>
        </div>
    </section>
</div>





<script>

    $(document).ready(function() {

        $("#addimage").validate({
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
<?php

if(isset($_GET['id'])) {
    $getval = $_GET['id'];
    $method = '_update';
} else {
    $method = '';
}


$account_data = json_decode(file_get_contents(MYURL.'accountDetails/'));

?>
<div class="content-wrapper">
    <section class="content-header">
        <h1>
            Dashboard
            <small>Add Account</small>
        </h1>
        <ol class="breadcrumb">
            <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
            <li class="active">Add Account</li>
        </ol>
    </section>

    <section class="content">
        <div class="container-fluid">
            <div class="box">
                <div class="box-header with-border"><i class="fa fa-warning"></i><h3 class="box-title">Add Account</h3></div>
                <div class="box-body">
                    <form id="addaccount" class="form-horizontal">
                        <div class="form-group">
                            <label class="col-sm-2 control-label">Hotel Name</label>
                            <div class="col-sm-6">
                                <input name="name" type="text" value="" required placeholder="Name" class="form-control">
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="col-sm-2 control-label">Account</label>
                            <div class="col-sm-6">
                                <input name="account" type="text" value="" required placeholder="Account" class="form-control">
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="col-sm-2 control-label">Payment</label>
                            <div class="col-sm-6">
                                <input name="payment" type="text" value="" required placeholder="Payment" class="form-control">
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="col-sm-2 control-label"></label>
                            <div class="col-sm-6">
                                <input type="submit" value="Submit" class="btn btn-success submit" >
                                <input type="reset" value="Reset" class="btn btn-danger marginleft">
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </section>
</div>






<script type="text/javascript">

    $(document).ready(function() {

        $("#addaccount").validate({
            rules: {
            },
            submitHandler: function() {
                addData();
            }
        });

        function addData() {

            $('.submit').click(function() {

                $.ajax({
                    type: 'post',
                    dataType:'json',
                    url: '<?php  echo MYURL.'accountDetails'.$method; ?>',
                    data: {
                        <?php if(isset($getval)) {echo "id: ". $getval.",\n"; } ?>
                        data: formToJSON()},
                    success: function($response) {
                        alert($response);
                    }
                });
            });

            $('.submit').trigger( "click" );
        }



        function formToJSON() {
            return JSON.stringify({
                "name": $("input[name='name']").val(),
                "acc_description": $("input[name='account']").val(),
                "payment_details": $("input[name='payment']").val()
            });
        }

    });
</script>
</div>

</body>
</html>
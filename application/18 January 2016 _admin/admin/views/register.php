<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>
  <div class="content-wrapper">
  
  <?php if (validation_errors()) : ?>
            <div class="col-md-12">
                <div class="alert alert-danger" role="alert">
                    <?= validation_errors() ?>
                </div>
            </div>
        <?php endif; ?>
        <?php if (isset($error)) : ?>
            <div class="col-md-12">
                <div class="alert alert-danger" role="alert">
                    <?= $error ?>
                </div>
            </div>
        <?php endif; ?>
  
        <!-- Content Header (Page header) -->
        <section class="content-header">
          <h1>
              <a href="registered_users">Users</a> /
               Register User
          </h1>
          <ol class="breadcrumb">
            <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
            <li class="active">Register User</li>
          </ol>
        </section>

        <!-- Main content -->
        <section class="content">
        <div class="container-fluid">
        <div class="box">
        <div class="box-header with-border"><i class="fa fa-warning"></i><h3 class="box-title">Register User</h3></div>
        <div class="box-body">      
        
        
        
        
        
        
        
        
        

            <?php
            $attributes = array('class' => 'form-horizontal', 'id' => 'addusers');
            echo form_open('restaurant/register', $attributes);?>
            <div class="form-group">
                <label class="col-sm-2  control-label" for="username">Username</label>
                <div class="col-sm-6">
                <input type="text" class="form-control" id="username" name="username" placeholder="Enter a username">
               </div>
            </div>

            <div class="form-group">
                <label class="col-sm-2  control-label" for="password">Password</label>
                <div class="col-sm-6">
                <input type="password" class="form-control" id="password" name="password" placeholder="Enter a password">
               </div>
            </div>
            <div class="form-group">
                <label class="col-sm-2  control-label" for="password_confirm">Confirm password</label>
                <div class="col-sm-6">
                <input type="password" class="form-control" id="password_confirm" name="password_confirm" placeholder="Confirm your password">
                </div>
            </div>
            <div class="form-group">
            <label class="col-sm-2  control-label" for="user">User Type</label>
            <div class="col-sm-6">
                <?php
				 echo form_dropdown('user',  $users, '', 'class="form-control" id="user_type" required="required"'); ?>
                </div>
            </div>
            <div class="form-group">
            <label class="col-sm-2 marginleft"></label>
         <div class="col-sm-6 padleft">
                <input class="submit btn btn-success" type="submit" value="Register" >
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

        $("#addusers").validate({
            rules: {
            },
            submitHandler: function(form) {
                form.submit();
            }
        });	
    });
</script>
<script>
$(document).ready(function(e) {
    
});
</script>
</body>
</html>

 <!doctype html>
<html lang="en">
    <head>
        <!-- Required meta tags -->
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <title><?php echo $title; ?> Edugatein.com - Admin Panel</title>

        <link rel="icon" type="image/png" href="<?php echo base_url('assets/'); ?>/front/images/favicon.ico">
        <!-- Bootstrap CSS -->       
        <link rel="stylesheet" href="<?php echo base_url('assets/front/css/bootstrap.min.css'); ?>" >

        <link rel="stylesheet" href="<?php // echo base_url('assets/fontawesome-free-5.0.8/web-fonts-with-css/css/fontawesome-all.min.css'); ?>" >
        <script src="<?php // echo base_url('assets/js/jquery-3.3.1.min.js'); ?>"></script> 
        <!--<script src="<?php // echo base_url('assets/js/jquery-3.2.1.slim.min.js'); ?>"></script>-->                
<!--        <script src="<?php // echo base_url('assets/js/popper.min.js'); ?>" ></script>
        <script src="<?php // echo base_url('assets/js/bootstrap.min.js'); ?>" ></script>
        <script src="<?php // echo base_url('assets/js/jquery.validate.min.js'); ?>" ></script>     
        <script src="<?php // echo base_url('assets/js/additional-methods.min.js'); ?>" ></script> 
        <link href="<?php // echo base_url('assets/chosen_v1.8.3/chosen.min.css'); ?>" rel="stylesheet" type="text/css"/>
        <script src="<?php // echo base_url('assets/chosen_v1.8.3/chosen.jquery.min.js'); ?>" type="text/javascript"></script>
        <link href="<?php // echo base_url('assets/jquery-ui-1.12.1/jquery-ui.min.css'); ?>" rel="stylesheet" type="text/css"/>
        <link href="<?php // echo base_url('assets/jquery-ui-1.12.1/jquery-ui.theme.min.css'); ?>" rel="stylesheet" type="text/css"/>
        <script src="<?php // echo base_url('assets/jquery-ui-1.12.1/jquery-ui.min.js'); ?>" type="text/javascript"></script>-->
       
        <style>
            .error
            { color: red}

        </style>
    </head>
    <body id="myApp">

        <style>
            @import url(https://fonts.googleapis.com/css?family=Roboto:300);

            .login-page {
                width: 360px;
                padding: 8% 0 0;
                margin: auto;
            }
            .form {
                position: relative;
                z-index: 1;
                background: #FFFFFF;
                max-width: 360px;
                margin: 0 auto 100px;
                padding: 15px 45px 45px 45px;
                text-align: center;
                box-shadow: 0 0 20px 0 rgba(0, 0, 0, 0.2), 0 5px 5px 0 rgba(0, 0, 0, 0.24);
            }
            .form input {
                font-family: "Roboto", sans-serif;
                outline: 0;
                background: #f2f2f2;
                width: 100%;
                border: 0;
                margin: 0 0 15px;
                padding: 15px;
                box-sizing: border-box;
                font-size: 14px;
            }
            .form button {
                font-family: "Roboto", sans-serif;
                text-transform: uppercase;
                outline: 0;
                background: #4CAF50;
                width: 100%;
                border: 0;
                padding: 15px;
                color: #FFFFFF;
                font-size: 14px;
                -webkit-transition: all 0.3 ease;
                transition: all 0.3 ease;
                cursor: pointer;
            }
            .form button:hover,.form button:active,.form button:focus {
                background: #43A047;
            }
            .form .message {
                margin: 15px 0 0;
                color: #b3b3b3;
                font-size: 12px;
            }
            .form .message a {
                color: #4CAF50;
                text-decoration: none;
            }
            .form .register-form {
                display: none;
            }
            .container {
                position: relative;
                z-index: 1;
                max-width: 300px;
                margin: 0 auto;
            }
            .container:before, .container:after {
                content: "";
                display: block;
                clear: both;
            }
            .container .info {
                margin: 50px auto;
                text-align: center;
            }
            .container .info h1 {
                margin: 0 0 15px;
                padding: 0;
                font-size: 36px;
                font-weight: 300;
                color: #1a1a1a;
            }
            .container .info span {
                color: #4d4d4d;
                font-size: 12px;
            }
            .container .info span a {
                color: #000000;
                text-decoration: none;
            }
            .container .info span .fa {
                color: #EF3B3A;
            }
            body {
                background: #33317c; /* fallback for old browsers */
/*                background: -webkit-linear-gradient(right, #33317c, #d12881);
                background: -moz-linear-gradient(right, #33317c, #d12881);
                background: -o-linear-gradient(right, #33317c, #d12881);
                background: linear-gradient(to left, #33317c, #d12881);*/
                font-family: "Roboto", sans-serif;
                -webkit-font-smoothing: antialiased;
                -moz-osx-font-smoothing: grayscale;      
            }
        </style>
        <div class="login-page">            
            <div class="form">
                <div class="col-12 col-md-12 pb-3">
                <img src="<?php echo base_url("assets/front/images/logo.png"); ?>" class="img-fluid" >
                </div>
                <!--<p class="pt-3">login</p>-->
                <div id="infoMessage"><?php echo $message; ?></div>
                <?php  echo form_open("admin_users/login"); ?>
                <?php echo form_input($identity); ?>
               <?php echo form_input($password); ?>
                <button>login</button>
          <!--      <p class="message">Not registered? <a href="#">Create an account</a></p>-->
             <?php echo form_close(); ?>
                <!--<a href="forgot_password"><?php echo lang('login_forgot_password'); ?></a>-->
            </div>
        </div>
        <!-- Optional JavaScript -->
        <!-- jQuery first, then Popper.js, then Bootstrap JS -->
        <script src="<?php // echo base_url('assets/js/notify.min.js'); ?>" ></script>
        <script>
<?php // if ($this->session->flashdata('success_message')) { ?>
//                $.notify('<?php // echo $this->session->flashdata('success_message'); ?>', "success");
<?php // } ?>
<?php // if ($this->session->flashdata('error_message')) { ?>
//                $.notify('<?php // echo $this->session->flashdata('error_message'); ?>', "error");
<?php // } ?>
        </script>
    </body>
</html>
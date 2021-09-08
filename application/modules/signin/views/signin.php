<?php
// echo $this->session->userdata('school');
?>
<div class="new-signin-section">
    <div class="container-fluid p-0">
        <div class="row no-gutters">
            <div class="col-lg-4 col-sm-12">
                <div class="new-signin-left">
                    <a href="<?php echo base_url() ?>">
                        <img src="<?php echo base_url() ?>assets/front/images/dashboard/logo-white.png" class="w-100" alt="">	
                    </a>
                    <img src="<?php echo base_url() ?>assets/front/images/dashboard/child.png" class="w-100 my-5" alt="">
                    <h2 class="text-white mb-2">Welcome!</h2>
                    <p>Edugate-in is to inter-connect schools, parents and education community on a single platform to create mutual benefit.</p>
                </div><!-- /new-signin-left -->
            </div>

            <div class="col-lg-8 col-sm-12">
                <div class="new-signin-right">
                    <h1 class="display-4 mb-2">Sign In</h1>
                    <p>Sign in to continue to our application.</p>
                    <div class="row">
                        <div class="col-lg-6">
                            <form action="<?php echo base_url() ?>signin/myaccount" id="signin" name="signinform" method="post">
                                <div class="form-group">
                                    <i class="lnr lnr-envelope"></i>   
                                    <input type="email" id="signemail" name="signemail" class="form-control pr-6" id="" aria-describedby="emailHelp" placeholder=" ">
                                    <label>Email address</label>
                                </div>
                                <div class="form-group">
                                    <i class="lnr lnr-lock"></i>   
                                    <input type="password" id="signpassword" name="signpassword" class="form-control pr-6" id="" placeholder=" ">
                                    <label>Password</label>
                                </div>

                                <div class="mb-3">
                                    <a href="<?php echo base_url() ?>admin/forgot_password" class="mb-3">Forget Your Password?</a>	
                                </div>

                                <button type="submit" id="signin" name="signin" class="btn btn-primary mb-4">SIGN IN</button>
                            </form>

                            <p>Don't Have an account? <a href="<?php echo base_url() ?>schools-signup"  id="formsubmit" class="text-pink"><u>SIGN UP</u></a></p>
                        </div>

                        <div class="col-lg-6"></div>
                    </div><!-- /row -->

                    <p class="new-signin-copyright">&copy; 2019 Edugatein.com All Rights Reserved.</p>
                </div><!-- /new-signin-right -->
            </div>
        </div><!-- /row -->
    </div><!-- /container-fluid -->
</div><!-- /new-signin-section -->
<script>
    $(document).ready(function () {
        $("#formsubmit").on('click',function (event) {
            $("#signin").validate({
                rules: {
                    signemail: "required",
                    signpassword: "required",

                    },
                    messages: {
                        signemail: "this field is required"
                    },
                    errorElement: 'div',
                    errorLabelContainer: '.errorTxt',
                    errorPlacement: function (error, element) {
                        if (element.attr("name") == "terms")
                            element.parents('.custom-checkbox').append(error);
                        else
                            element.parents('.form-group').append(error);
                    }
            });
        });
    });

    //Preloader
    $(window).on("load", function () {
        $('#preloader').fadeOut('slow', function () {
            $(this).remove();
        });
    });
    // $(document).ready(function(){
    //     $("#signin").submit(function(){  

    //         var email = $("#signemail").val();
    //         var password = $("#signpassword").val();

    //       $.ajax({
    //             type: "POST",
    //             url: "<?php echo base_url(); ?>index.php/signin/signincheck",
    //             data: {email1 :email,password1 :password},
    //             datatype: "json",
    //             success: function(data){
    //                 $("#signin").submit();              
    //             }            
    //         });
    //     });
    // });
</script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.3/jquery.validate.min.js" integrity="sha512-37T7leoNS06R80c8Ulq7cdCDU5MNQBwlYoy1TX/WUsLFC2eYNqtKlV0QjH7r8JpG/S0GUMZwebnVFLPd6SU5yg==" crossorigin="anonymous" referrerpolicy="no-referrer"></script> 


<div class="container-fluid p-0">
    <div class="row no-gutters">
        <div class="col-lg-4 col-sm-12">
            <div class="new-signin-left">
                <a href="https://www.edugatein.com">
                    <img src="<?php echo base_url() ?>images/dashboard/logo-white.png" class="w-100" alt="">	
                </a>
                <img src="<?php echo base_url() ?>images/dashboard/child.png" class="w-100 my-5" alt="">
                <h2 class="text-white mb-2">Welcome!</h2>
                <p>Edugate-in is to inter-connect schools, parents and education community on a single platform to create mutual benefit.</p>
            </div><!-- /new-signin-left -->
        </div>

        <div class="col-lg-8 col-sm-12">
            <div class="new-signin-right">
                <h1 class="display-4 mb-2">Sign Up</h1>
                <p>Create a new account to access various of services.</p>

                <div class="row">
                    <div class="col-lg-9">
                        <form action="<?php echo base_url() ?>signup-student/insert" method="post" onsubmit="myFunction()">
                            <div class="row">
                                <div class="col-lg-6 col-sm-6">
                                    <div class="form-group">
                                        <input class="form-control" name="firstname" type="text" placeholder=" " required>
                                        <label>First Name</label>
                                    </div>	
                                </div>
                                <div class="col-lg-6 col-sm-6">
                                    <div class="form-group">
                                        <input class="form-control" name="lastname" type="text" placeholder=" ">
                                        <label>Last Name</label>
                                    </div>	
                                </div>
                                <div class="col-lg-6 col-sm-6">
                                    <div class="form-group">
                                        <input class="form-control" type="email" name="useremail" placeholder=" " required>
                                        <label>E-mail</label>
                                    </div>	
                                </div>
                                <div class="col-lg-6 col-sm-6">
                                    <div class="form-group">
                                        <input class="form-control" type="number" name="mobile" placeholder=" " required>
                                        <label>Mobile Number</label>
                                    </div>	
                                </div>
                                <div class="col-lg-6 col-sm-6">
                                    <div class="form-group">
                                        <input class="form-control" type="password" name="password" id="password" placeholder=" " required="">
                                        <label>Password</label>
                                    </div>	
                                </div>
                                <div class="col-lg-6 col-sm-6">
                                    <div class="form-group">
                                        <input class="form-control" type="password" name="confirmpassword" id="confirm_password" placeholder=" " required>
                                        <label>Confirm Password</label>
                                    </div>	
                                </div>
                                <div class="col-lg-6 col-sm-6">
                                    <div class="form-group">  
                                        <select class="floating-select"  name="grade" required onclick="this.setAttribute('value', this.value);" value="">
                                            <option></option>
                                            <option value="6">6<sup>st</sup> Std</option>
                                            <option value="7">7<sup>nd</sup> Std</option>
                                            <option value="8">8<sup>rd</sup> Std</option>
                                            <option value="9">9<sup>th</sup> Std</option>
                                            <option value="10">10<sup>th</sup> Std</option>
                                            <option value="11">11<sup>th</sup> Std</option>
                                            <option value="12">12<sup>th</sup> Std</option>
                                        </select>
                                        <label>Select Your Grade</label>
                                    </div>	
                                </div>
                                <div class="col-lg-6 col-sm-6">
                                    <div class="form-group">  
                                        <select class="floating-select" name="board" required="" onclick="this.setAttribute('value', this.value);" value="">
                                            <option></option>
                                            <option value="1">CBSE</option>
                                            <option value="2">ICSE</option>
                                            <option value="3">Stateboard</option>
                                            <option value="4">Matriculation</option>
                                        </select>
                                        <label>Select Your Board</label>
                                    </div>	
                                </div>
                            </div><!-- /form-row -->

                            <div class="custom-control custom-checkbox mt-1">
                                <input type="checkbox" class="custom-control-input" name="terms" id="customCheck1" required="">
                                <label class="custom-control-label" for="customCheck1">I Agree with <a href="<?php echo base_url() ?>terms-and-conditions" target="_blank">Terms & Conditions</a></label>
                            </div>

                            <div class="form-group">
                                <input type="hidden" class="form-control" id="ip" name="ip" aria-describedby="emailHelp" value="<?php echo $_SERVER['REMOTE_ADDR']; ?>" required>
                            </div>

                            <button type="submit" class="btn btn-primary mb-4">SIGN UP</button>
                        </form>

                        <p>Already Have an account? <a href="<?php echo base_url() ?>signin-student" class="text-pink"><u>SIGN IN</u></a></p>
                    </div>
                </div><!-- /row -->

                <p class="new-signin-copyright">&copy; 2019 Edugatein.com All Rights Reserved.</p>
            </div><!-- /new-signin-right -->
        </div>
    </div><!-- /row -->
</div><!-- /container-fluid -->
</div><!-- /new-signin-section -->


<?php
$ip = $_SERVER['REMOTE_ADDR'];


if (isset($random)) {

    $ran = $random;



    $this->db->select('*')->where('random', $ran);
    $this->db->from('student_tracker');
    $otp = $this->db->get();


    foreach ($otp->result() as $otps) {
        $mobile = $otps->phone;
        $mobile = substr($mobile, -4);
        ?>

        <!-- OTP-Form -->
        <div class="modal fade" id="exampleModalCenter" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content">
                    <div class="modal-body p-5">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>

                        <h3 class="modal-title mb-3" id="exampleModalCenterTitle">Enter One Time Password</h3>
                        <p class="mb-2">One Time Password (OTP) has been sent to your mobile ******<?php echo $mobile; ?>, please enter the same here to login.</p>

                        <form action="<?php echo base_url() ?>signup-student/otp" method="post" class="mt-3">
                            <div class="form-group">
                                <input type="text" class="form-control" name="otp" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="OTP">
                            </div>

                            <div class="form-group">
                                <input type="hidden" class="form-control" id="ip" name="ip" aria-describedby="emailHelp" value="<?php echo $_SERVER['REMOTE_ADDR']; ?>" required>
                            </div>

                            <button type="submit"  class="btn btn-primary btn-block">Submit</button>
                        </form>
                    </div><!-- /modal-body -->
                </div><!-- /modal-content -->
            </div>
        </div><!-- /modal -->

    <?php
    }
}
?>

<script type="text/javascript">
    Preloader
    $(window).on("load", function () {
        $('#preloader').fadeOut('slow', function () {
            $(this).remove();
        });
    });

    $(document).ready(function () {
        // $(window).on("load", function(){
        var str = window.location.pathname;
        //  alert(str);
        if (str == "/signup-student/insert") {

            $('#exampleModalCenter').modal('show');
        }
        // });
    });


    function myFunction()
    {

        var password = document.getElementById("password").value;
        var confirm_password = document.getElementById("confirm_password").value;

        if (password != confirm_password)
        {
            alert("Your Password is Not Matching");
            event.preventDefault();
        } else
        {


        }

    }
</script>
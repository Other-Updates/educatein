<div class="new-signin-section">
    <!--  START NAVBAR   -->
    <nav class="navbar navbar-expand-xl navbar-light border bg-light navbar-offcanvas px-5">
        <a class="navbar-brand mr-auto" href="<?php echo base_url() ?>">
            <img src="<?php echo base_url() ?>images/logo.png" width="180" alt="">
        </a>
        <button class="navbar-toggler" type="button" id="navToggle">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="navbar-collapse offcanvas-collapse">
            <div class="close-btn" id="navToggle">
                <i class="fa fa-close"></i>
            </div><!-- /close-btn -->
            <ul class="navbar-nav ml-auto">
                <li class="nav-item active">
                    <a class="nav-link" href="<?php echo base_url() ?>">Home</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="<?php echo base_url() ?>about-us">About us</a>
                </li>
                <li class="nav-item dropdown hidden-xl">
                    <a class="nav-link dropdown-toggle" href="" id="" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">School Categories</a>
                    <div class="dropdown-menu" aria-labelledby="">
                        <?php
                        $this->db->select('*')->where('is_active =', 1);
                        $this->db->from('affiliations');
                        $query = $this->db->get();
                        foreach ($query->result() as $row) {
                            $affiliation_name1 = ucwords($row->affiliation_name);
                            $affiliation_name = str_replace(" ", "-", $row->affiliation_name);
                            if ($affiliation_name === "stateboard-schools") {
                                $affiliation_name = "state-board-schools";
                            }
                            ?>
                            <a class="dropdown-item" href="<?php echo base_url() ?>list-of-best-<?php echo $affiliation_name; ?>-schools-in-coimbatore" id="<?php echo $row->id; ?>"><?php echo $affiliation_name1; ?> Schools</a>
                        <?php } ?>
                    </div><!-- /dropdown-menu -->
                </li>

                <li class="nav-item dropdown hidden-xl">
                    <a class="nav-link dropdown-toggle" href="" id="dropdown01" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Activity Classes</a>
                    <div class="dropdown-menu" aria-labelledby="dropdown01">
                        <?php
                        $activity = $this->db->get('institute_categories');
                        foreach ($activity->result() as $row1) {
                            $category_name1 = ucwords($row1->category_name);
                            $category_name = str_replace(" ", "-", $row1->category_name);
                            $category_name = strtolower($category_name);
                            ?>
                            <a class="dropdown-item" href="<?php echo base_url() ?>list-of-best-<?php echo $category_name; ?>-in-coimbatore" id="<?php echo $row1->id; ?>"> <?php echo $category_name1; ?></a>
                        <?php } ?>
                    </div><!-- /dropdown-menu -->
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="<?php echo base_url() ?>blog">News</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="<?php echo base_url() ?>careers">Careers</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="<?php echo base_url() ?>exams/how-to-get-your-exam-results-online">Exams/Results</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="<?php echo base_url() ?>contact-us">Contact</a>
                </li>
                <li class="nav-item dropdown login-dropdown">
                    <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownMenuLink" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Login/Register</a>
                    <div class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
                        <a class="dropdown-item"  href="<?php echo base_url() ?>signin" target="_blank">
                            <div class="media" id="school">
                                <div class="media-left">
                                    <img src=<?php echo base_url("assets/front/images/");?>dashboard/school.png" width="40px" alt="">
                                </div>
                                <div class="media-body pl-3">
                                    <h6>Schools</h6>
                                    <small>Schools can add Listing</small>
                                </div>
                            </div><!-- /media -->
                        </a>
                        <a class="dropdown-item" href="<?php echo base_url() ?>filters/under-page.html" target="_blank">
                            <div class="media">
                                <div class="media-left">
                                    <img src="<?php echo base_url("assets/front/images/");?>dashboard/student.png" width="40px" alt="">
                                </div>
                                <div class="media-body pl-3">
                                    <h6>Students</h6>
                                    <small>Student Portal</small>
                                </div>
                            </div><!-- /media -->x
                        </a>
                        <a class="dropdown-item" href="<?php echo base_url() ?>filters/under-page.html" target="_blank">
                            <div class="media">
                                <div class="media-left">
                                    <img src="<?php echo base_url("assets/front/images/");?>dashboard/parents.png" width="40px" alt="">
                                </div>
                                <div class="media-body pl-3">
                                    <h6>Parents</h6>
                                    <small>Parent Portal</small>
                                </div>
                            </div><!-- /media -->
                        </a>
                    </div>
                </li><!-- /login-dropdown -->

                <li class="nav-item toll-free">
                    <span>Toll-Free</span>
                    <a class="nav-link" href="tel:1800120235600"><i class="fa fa-phone"></i> 1800-120-235600</a>
                </li>
            </ul>
        </div><!-- /offcanvas-collapse -->
    </nav>
    <div class="container-fluid p-0">
        <div class="row no-gutters">
            <div class="col-lg-4 col-sm-12">
                <div class="new-signin-left">
                    <a href="<?php echo base_url() ?>">
                        <img src="<?php echo base_url() ?>images/dashboard/logo-white.png" class="w-100" alt="">	
                    </a>
                    <img src="<?php echo base_url() ?>images/dashboard/child.png" class="w-100 my-5" alt="">
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
                            <form action="<?php echo base_url() ?>signin-student/check" name="signinform" method="post">
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
                                    <a href="<?php echo base_url() ?>forget-password" class="mb-3">Forget Your Password?</a>	
                                </div>

                                <button type="submit" id="signin" name="signin" class="btn btn-primary mb-4">SIGN IN</button>
                            </form>

                            <p>Don't Have an account? <a href="<?php echo base_url() ?>signup-student"  class="text-pink"><u>SIGN UP</u></a></p>
                        </div>

                        <div class="col-lg-6"></div>
                    </div><!-- /row -->

                    <p class="new-signin-copyright">&copy; 2021 Edugatein.com All Rights Reserved.</p>
                </div><!-- /new-signin-right -->
            </div>
        </div><!-- /row -->
    </div><!-- /container-fluid -->
</div><!-- /new-signin-section --> 
<script>
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


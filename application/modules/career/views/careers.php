<!-- /social-sidebar -->
<div class="breadrumb-new">
    <div class="container">
        <div class="row">
            <div class="col-lg-6 col-sm-12">
                <ul class="list-inline">
                    <li class="list-inline-item"><a href="<?php echo base_url(); ?>">Home</a></li>
                    <li class="list-inline-item"><i class="fa fa-angle-right"></i></li>
                    <li class="list-inline-item">Careers</li>
                </ul>
            </div>
            <div class="col-lg-6 col-sm-12 text-right">
                <p>Find the Right School with us!</p>
            </div>
        </div><!-- /row -->
    </div><!-- /container -->
</div><!-- /breadrumb-new -->

<div class="career-page-section py-5">
    <div class="container">
        <div class="section-title text-center mab-50">
            <h1 class="mb-2">Your Passion Begins Here!</h1>
            <p>Work hard with highly motivated team of talented people and great teammates <br> launch perfectly crafted products you'll love.</p>
        </div>

        <div class="row">
            <div class="col-lg-6 mab-30">
                <img src="<?php echo base_url("assets/front/") ?>images/career1.png" class="w-100" alt="">
            </div>

            <div class="col-lg-6 mab-30">
                <div class="career-box shadow-lg">
                    <h4 class="text-center mb-3">Submit Your Application</h4>
                    <form enctype="multipart/form-data" action="<?php echo base_url("welcome/career"); ?>" method="post">
                        <div class="form-row">
                            <div class="form-group col-lg-6 col-sm-6">
                                <input type="text" class="form-control" id="firstname" name="firstname" aria-describedby="emailHelp" placeholder="First Name*" required>
                            </div>
                            <div class="form-group col-lg-6 col-sm-6">
                                <input type="text" class="form-control" id="lastname" name="lastname" aria-describedby="emailHelp" placeholder="Last Name">
                            </div>
                            <div class="form-group col-lg-6 col-sm-6">
                                <input type="email" class="form-control" id="email" name="email" aria-describedby="emailHelp" placeholder="Email-id*" required>
                            </div>
                            <div class="form-group col-lg-6 col-sm-6">
                                <input type="number" step="any" class="form-control" id="mobile" name="mobile" aria-describedby="emailHelp" placeholder="Mobile Number*" required>
                            </div>
                            <div class="form-group col-lg-6 col-sm-6">
                                <input type="text" class="form-control" id="designation" name="designation" aria-describedby="" placeholder="Job Designation" required>
                            </div>
                            <div class="form-group col-lg-6 col-sm-6">
                                <input type="text" class="form-control" id="portfolio" name="portfolio" aria-describedby="emailHelp" placeholder="Portfolio Link">
                            </div>
                            <div class="col-lg-12 input-group mb-3">
                                <div class="custom-file">
                                    <input type="file" class="custom-file-input" id="file" name="file">
                                    <label class="custom-file-label" for="inputGroupFile01">Upload Your Resume</label>
                                </div>
                            </div>
                            <button type="submit" class="btn btn-primary text-center">Apply Now</button>	
                        </div><!-- /form-row -->
                    </form>
                </div><!-- /career-box -->
            </div>
        </div><!-- /row -->
    </div><!-- /container --></div><!-- /career-page-section -->

<svg id="deco-clouds" xmlns="http://www.w3.org/2000/svg" version="1.1" style="background-color: #fff;" height="100" viewBox="0 0 100 100" preserveAspectRatio="none">
<path d="M-5 100 Q 0 20 5 100 Z
      M0 100 Q 5 0 10 100 M5 100 Q 10 30 15 100 M10 100 Q 15 10 20 100 M15 100 Q 20 30 25 100
      M20 100 Q 25 -10 30 100 M25 100 Q 30 10 35 100 M30 100 Q 35 30 40 100 M35 100 Q 40 10 45 100
      M40 100 Q 45 50 50 100 M45 100 Q 50 20 55 100 M50 100 Q 55 40 60 100 M55 100 Q 60 60 65 100
      M60 100 Q 65 50 70 100 M65 100 Q 70 20 75 100 M70 100 Q 75 45 80 100 M75 100 Q 80 30 85 100
      M80 100 Q 85 20 90 100 M85 100 Q 90 50 95 100 M90 100 Q 95 25 100 100 M95 100 Q 100 15 105 100 Z">
</path>
</svg>
<!-- Footer templete -->
<?php $this->load->view('footer'); ?>
<!-- ============ Back-to-top ============ -->
<div class="top-to-bottom">
    <a id="button">
        <i class="fa fa-chevron-up"></i>
    </a>
</div><!-- /top-to-bottom -->
<script>
    $(window).on("load", function () {
        $('#preloader').fadeOut('slow', function () {
            $(this).remove();
        });
    });
</script>
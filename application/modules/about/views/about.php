
<div class="bread-crumb1 mab-50 text-center">
    <div class="container">
        <h1 class="text-white">About Us</h1>
        <ul class="list-inline py-3 mab-30">
            <li class="list-inline-item"><a href="<?php echo base_url() ?>"><b>Home</b></a></li>
            <li class="list-inline-item">/</li>
            <li class="list-inline-item"><b>About us</b></li>
        </ul>
    </div>
</div><!-- /bread-crumb1 -->

<svg id="deco-clouds2" class="" xmlns="http://www.w3.org/2000/svg" version="1.1" width="100%" height="100" viewBox="0 0 100 100" preserveAspectRatio="none">
    <path d="M-5 100 Q 0 20 5 100 Z
          M0 100 Q 5 0 10 100
          M5 100 Q 10 30 15 100
          M10 100 Q 15 10 20 100
          M15 100 Q 20 30 25 100
          M20 100 Q 25 -10 30 100
          M25 100 Q 30 10 35 100
          M30 100 Q 35 30 40 100
          M35 100 Q 40 10 45 100
          M40 100 Q 45 50 50 100
          M45 100 Q 50 20 55 100
          M50 100 Q 55 40 60 100
          M55 100 Q 60 60 65 100
          M60 100 Q 65 50 70 100
          M65 100 Q 70 20 75 100
          M70 100 Q 75 45 80 100
          M75 100 Q 80 30 85 100
          M80 100 Q 85 20 90 100
          M85 100 Q 90 50 95 100
          M90 100 Q 95 25 100 100
          M95 100 Q 100 15 105 100 Z">
    </path>
</svg>

<div class="container about-page mab-50">
    <div class="row">
        <div class="col-lg-6 mab-30">
            <div class="section-title mab-30">
                <h1 class="mb-3 wow slideInLeft" data-wow-delay="400ms">Let's Get <span class="pink">Started</span> with<br>Our Platform</h1>
                <div class="line wow slideInLeft" data-wow-delay="500ms"></div>
            </div><!-- /section-title -->
            <p class="lead text-dark mb-2 wow fadeInUp" data-wow-delay="600ms"><b>EveryDay Care for your Children...</b></p>
            <p class="wow fadeInUp" data-wow-delay="700ms">Being a parent, you know that, it’s a great responsibility to find a perfect school which offers a great education to mold the future of your kids. If you are looking for the best schools in Coimbatore, then you have headed in the right place. We have listed the best schools in Coimbatore.</p>
            <a href="<?php echo base_url() ?>contact-us" class="btn btn-primary mt-3 wow fadeInUp" data-wow-delay="800ms">Join with us!</a>
        </div>

        <div class="col-lg-6 mab-30">
            <img src="<?php echo base_url() ?>assets/front/images/right1.png" class="w-100 wow flipInY" data-wow-delay="500ms" alt="add">
        </div>
    </div><!-- /row -->
</div><!-- /container -->
<hr>

    <!-- <div class="popular-schools" style="padding-top: 80px;">
            <div class="container">
                    <div class="section-title text-center mab-50">
                            <h1 class="mb-3">Popular Schools in Coimbatore</h1>
                            <div class="line1"></div>
                    </div>

    <?php
    $popular = "is_active=1 AND activated_at != 'NULL' AND valitity != 'NULL' AND school_category_id=1";
    $this->db->select('*')->where($popular);
    $this->db->from('school_details');
    $popular = $this->db->get();
    ?>
                    
                    <div class="owl-carousel owl-theme">
    <?php
    $delay = 4;
    foreach ($popular->result() as $populars) {

        $aff_name = "is_active=1 AND id=$populars->affiliation_id";
        $this->db->select('*')->where($aff_name);
        $this->db->from('affiliations');
        $aff_name = $this->db->get();

        foreach ($aff_name->result() as $aff_names) {
            $aff_name = $aff_names->affiliation_name;
            $aff_name = str_replace(" ", "-", $aff_name);
        }

        $area_name = "is_active=1 AND id=$populars->area_id";
        $this->db->select('*')->where($area_name);
        $this->db->from('areas');
        $area_name = $this->db->get();

        foreach ($area_name->result() as $area_names) {
            $area_name = $area_names->area_name;
            // $area_names = str_replace(" ","-",$area_names);
        }

        $school_name = str_replace(" ", "-", $populars->school_name);
        ?>
                                                    <div class="item wow fadeInUp" style="animation-delay: .<?php echo $delay; ?>s;">
                                                            <figure class="snip1208">
                                                                    <div class="object-fit" style="width: 100%;height: 160px;">
                                                                            <img src="https://edugatein.com/laravel/public/<?php echo $populars->logo ?>" class="w-100" alt="popular schools in coimbatore"/ style="width: 100%;height: 160px;object-fit: cover;">	
                                                                    </div>
                                                                    
                                                                    <figcaption class="">
                                                                    <h4><?php echo $populars->school_name; ?></h4>
                                                                    <p class="lead" style="color: #909090;"><i class="fa fa-map-marker"></i> <b><?php echo $area_name ?></b></p>
                                                                    <button type="button" class="btn btn-primary1">Read More</button>
                                              </figcaption>
                                              <a href="<?php echo base_url() ?>list-of-best-<?php echo $aff_name; ?>-schools-in-coimbatore/<?php echo $school_name; ?>" target="_blank"></a>
                                                            </figure>
                                                    </div>
        <?php
        $delay++;
    }
    ?>

                    </div>
            </div>
    </div> -->

    <svg id="deco-clouds" xmlns="http://www.w3.org/2000/svg" version="1.1" style="background-color: #fff;" height="100" viewBox="0 0 100 100" preserveAspectRatio="none">
        <path d="M-5 100 Q 0 20 5 100 Z
              M0 100 Q 5 0 10 100 M5 100 Q 10 30 15 100 M10 100 Q 15 10 20 100 M15 100 Q 20 30 25 100
              M20 100 Q 25 -10 30 100 M25 100 Q 30 10 35 100 M30 100 Q 35 30 40 100 M35 100 Q 40 10 45 100
              M40 100 Q 45 50 50 100 M45 100 Q 50 20 55 100 M50 100 Q 55 40 60 100 M55 100 Q 60 60 65 100
              M60 100 Q 65 50 70 100 M65 100 Q 70 20 75 100 M70 100 Q 75 45 80 100 M75 100 Q 80 30 85 100
              M80 100 Q 85 20 90 100 M85 100 Q 90 50 95 100 M90 100 Q 95 25 100 100 M95 100 Q 100 15 105 100 Z">
       	</path>
    </svg>
    <?php $this->load->view('footer'); ?>
    <script>

        $(window).on("load", function () {
            $('#preloader').fadeOut('slow', function () {
                $(this).remove();
            });
            var str = window.location.pathname;

            if (str == "/about-us/enquiry") {
                $('#exampleModalCenter').modal('show');
            } else if (str == "/abouts/phoneotp")
            {

            }
        });
        $(document).ready(function () {
            $(".owl-carousel").owlCarousel();
            new WOW().init();
            // Feedback-form
            $('.toggle').click(function () {
                $('.feedback-form').toggleClass('active')
            });
        });

        $(document).ready(function (e) {
            $('#btnModal').click(function () {
                //Using ajax post
                $.post('otp.php', function (xx) {
                    $('#tmpModal').php(xx)
                    //Calling Modal
                    $('#testModal').otp('show');
                })
            })
        });
    </script>
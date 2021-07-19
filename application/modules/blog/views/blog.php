<?php
//    $ip=$_SERVER['REMOTE_ADDR'];
//
//    $date = date("Y/m/d");
//
//    $this->db->select('*')->where('date =', $date);
//    $this->db->from('homepage_counts');
//    $homepage = $this->db->get();
//    if($homepage->num_rows() > 0)
//    {
//        foreach($homepage->result() as $homepages)
//        { 
//        $view_count = $homepages->view_count;
//        }
//        
//        $this->db->set('view_count',$view_count+1)->where('date',$date)->update('homepage_counts');
//    }else
//    {
//        $homepage_count = array(
//            'date' => $date,
//            'view_count' => 1,
//    ); 			
//
//        $this->db->insert('homepage_counts',$homepage_count);	
//    }
//
//$ipaddress = '';
//if (isset($_SERVER['HTTP_CLIENT_IP']))
//    $ipaddress = $_SERVER['HTTP_CLIENT_IP'];
//else if(isset($_SERVER['HTTP_X_FORWARDED_FOR']))
//    $ipaddress = $_SERVER['HTTP_X_FORWARDED_FOR'];
//else if(isset($_SERVER['HTTP_X_FORWARDED']))
//    $ipaddress = $_SERVER['HTTP_X_FORWARDED'];
//else if(isset($_SERVER['HTTP_FORWARDED_FOR']))
//    $ipaddress = $_SERVER['HTTP_FORWARDED_FOR'];
//else if(isset($_SERVER['HTTP_FORWARDED']))
//    $ipaddress = $_SERVER['HTTP_FORWARDED'];
//else if(isset($_SERVER['REMOTE_ADDR']))
//    $ipaddress = $_SERVER['REMOTE_ADDR'];
//else
//    $ipaddress = 'UNKNOWN';
//      
//    $this->db->select('*')->where('date =', $date);
//    $this->db->where('ip =', $ipaddress);
//    $this->db->from('user_analys');
//    $ip = $this->db->get();
//
//    if($ip->num_rows() > 0)
//    {
//        foreach($ip->result() as $ips)
//        { 
//        $old_ip = $ips->ip;
//        $page_view = $ips->page_view;
//        }
//
//        $this->db->set('page_view',$page_view+1);
//        $this->db->where('date',$date);
//        $this->db->where('ip',$ipaddress);
//
//        $update = $this->db->update('user_analys');   
//
//        // $this->db->set('page_view',$page_view+1)->where('date',$date)->update('user_analys');
//    }else
//    {
//        $user_count = array(
//            'ip' => $ipaddress,
//            'date' => $date,
//            'page_view' => 1,
//    ); 			
//
//        $this->db->insert('user_analys',$user_count);	
//    }	
//
//
//
?>
<style>
    .career-section .modal-body {
        padding: 25px;
        text-transform: uppercase;
    }
    .upload {
        text-transform: none;
        color: #303030;
        font-weight: 600;
        margin-bottom: 10px;
        margin-left: 5px;
        margin-top: 15px;
    }
    .career-section .form-control {
        font-size: 14px;
        color: #7d7d7d;
        border-color: #ddd;
    }
    .career-section ::placeholder {
        font-size: 12px;
        color: #aaa;
    }
    .career-section .close {
        position: absolute;
        width: 25px;
        height: 25px;
        line-height: 25px;
        top: -10px;
        right: -10px;
        background: #000;
        color: #fff;
        z-index: 1000;
        opacity: 1;
        border-radius: 50px;
        font-size: 14px;
    }
    .career-section .close:hover span {
        opacity: 1;
        text-shadow: 0;
        color: #fff;
    }
    .career-section .btn-primary {
        border-radius: 50px;
        background-color: #007bff;
        border-color: #007bff;
        padding: 8px 30px;
        color: #fff;
        text-transform: uppercase;
    }
</style>

<div class="breadrumb-new">
    <div class="container">
        <div class="row">
            <div class="col-lg-6 col-sm-12">
                <ul class="list-inline">
                    <li class="list-inline-item"><a href="https://www.edugatein.com/">Home</a></li>
                    <li class="list-inline-item"><i class="fa fa-angle-right"></i></li>
                    <li class="list-inline-item">News</li>
                </ul>
            </div>
            <div class="col-lg-6 col-sm-12 text-right">
                <p>Find the Right School with us!</p>
            </div>
        </div><!-- /row -->
    </div><!-- /container -->
</div><!-- /breadrumb-new -->

<!--<div align="center" class="mt-5">
         google adsense 
        <script async src="//pagead2.googlesyndication.com/pagead/js/adsbygoogle.js"></script>
         top_results 
        <ins class="adsbygoogle"
            style="display:block"
            data-ad-client="ca-pub-4740793344625684"
            data-ad-slot="4908920712"
            data-ad-format="auto"
            data-full-width-responsive="true"></ins>
        <script>
            (adsbygoogle = window.adsbygoogle || []).push({});
        </script>
</div>-->
<div class="blog-section section-pad mab-30">
    <div class="container">
        <?php
        $url = end($this->uri->segments);

        if (!is_numeric($url)) {
            $url = 1;
        }
        // echo $url;
        // exit(); 

        $this->db->select('*')->where("deleted_at", NULL);
        $this->db->from('blogs');
        $this->db->order_by("created_at", "desc");
        $blog = $this->db->get();
        $num_rows = $blog->num_rows();
        $limit = 5;
        $i = 0;

        foreach ($blog->result() as $blogs) {

            $image[] = $blogs->images;
            $datetime[] = $blogs->created_at;
            $name[] = $blogs->blog_name;
            $content[] = $blogs->content;
            $blog_id[] = $blogs->id;

            //$date = date('F d, Y ', strtotime($datetime[]));
            //$query=$this->db->like('created_at', array('created_at' => date('Y-m-d')));
        }
        if ($url == 1) {
            $data = 0;
        } else {
            $con = $url - 1;
            $data = $con * $limit;
        }


        for ($i = $data; $i < $url * $limit; $i++) {
            if ($num_rows > $i) {
                // echo $i;
                //exit();

                $url_name = str_replace(" ", "-", $name[$i]);
                $url_name1 = str_replace("?", "..", $url_name);
                $url_name2 = str_replace("'", "_", $url_name1);

                $date = date('F d, Y ', strtotime($datetime[$i]));
                $blogId = $blog_id[$i];
                ?>

                <div class="blog-box mab-30 wow fadeInUp" data-wow-delay="300ms">
                    <div class="row">
                        <div class="col-lg-5 p-0">
                            <div class="blog-img-box" style="width: 100%;height: 275px;overflow: hidden;">
                                <img src="<?php echo base_url() ?>laravel/public/<?php echo $image[$i]; ?>" alt="" style="width: 100%;height: 275px;object-fit: cover;">
                            </div>

                        </div>
                        <div class="col-lg-7 p-5" style="background-color: #f4f4f4;height: 275px;">
                            <ul class="list-inline mb-2">
                                <li class="list-inline-item">Published by</li>
                                <li class="list-inline-item"><i class="fa fa-user-o"></i> <a href="<?php echo base_url(); ?>">Edugatein</a></li>
                                <li class="list-inline-item"><i class="fa fa-clock-o"></i> <?php echo $date; ?></li>
                            </ul>
                            <p class="lead mb-2"><b><?php echo $name[$i]; ?></b></p>
                            <p><?php echo substr($content[$i], 0, 230) . '....'; ?></p>
                            <ul class="list-inline mt-3">
                                <li class="list-inline-item" id="counter" name="<?php echo $blogId; ?>" >Do you likes it? &nbsp;&nbsp;&nbsp; 
                                    <i class="fa fa-heart-o"></i> 
                                    <span class="counter">
                                        <?php
                                        $approval1 = "ratings='Like' AND blog_id=$blog_id[$i]";
                                        $this->db->select('*')->where($approval1);
                                        $this->db->from('blog_like');
                                        $blog_like = $this->db->get();
                                        echo $blog_like->num_rows();
                                        ?>
                                    </span>  
                                </li> 
                                <?php
                                $approval = "approval=1  AND blog_id=$blog_id[$i]";
                                $this->db->select('*')->where($approval);
                                $this->db->from('blog_comments');
                                $blog_comment = $this->db->get();
                                ?>
                                <li class="list-inline-item">&nbsp;<i class="fa fa-comment-o"></i> <?php echo $blog_comment->num_rows(); ?></li>
                                <li class="list-inline-item float-right">
                                    <a href="<?php echo base_url() ?>blogdetails/<?php echo $url_name2; ?>">Read More <i class="fa fa-angle-right"></i></a>
                                </li>
                            </ul>
                        </div>
                    </div><!-- /row -->
                </div><!-- /blog-box -->

            <?php }
        }
        ?>
        <!-- <div class="blog-box wow fadeInUp" data-wow-delay="500ms">
      <div class="row">
          <div class="col-lg-5 p-0">
              <img src="https://www.edugatein.com/images/blog/best1.jpg" class="w-100" alt="">
          </div>
          <div class="col-lg-7 p-5" style="background-color: #f4f4f4;">
              <ul class="list-inline mb-2">
                  <li class="list-inline-item">Published by</li>
                  <li class="list-inline-item"><i class="fa fa-user-o"></i> <a href="https://www.edugatein.com">Edugatein</a></li>
                  <li class="list-inline-item"><i class="fa fa-clock-o"></i> June 6, 2016</li>
              </ul>
              <p class="lead mb-2"><b>Best Schools in Coimbatore at Edugatein!</b></p>
              <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Perspiciatis a voluptate consequuntur! Obcaecati error ea voluptate, alias pariatur. Ullam fugit illo recusandae rerum magnam non culpa praesentium. Lorem ipsum dolor sit amet, consectetur adipisicing elit consectetur adipisicing elit.</p>
              <ul class="list-inline mt-3">
                  <li class="list-inline-item" id="counter">Do you likes it? &nbsp;&nbsp;&nbsp;<i class="fa fa-heart-o"></i> <span class="counter"></span></li>
                  <li class="list-inline-item">&nbsp;<i class="fa fa-comment-o"></i> 5</li>
                  <li class="list-inline-item float-right">
                      <a href="https://www.edugatein.com/blogdetails/index">Read More <i class="fa fa-angle-right"></i></a>
                  </li>
              </ul>
          </div>
      </div>
  </div> -->
    </div>
</div>

<div class="pagination mab-80">
    <div class="container">
        <nav aria-label="">
            <ul class="pagination justify-content-center">

                <?php
                $num_rowss = ceil($num_rows / $limit);
                if ($url == 1) {
                    $previous = $url;
                    ?>
                    <li class="page-item disabled">
                        <a class="page-link" href="<?php echo base_url() ?>blog/<?php echo $previous; ?>" tabindex="-1" aria-disabled="true">Previous</a>
                    </li><?php
                } else {
                    $previous = $url - 1;
                    ?>
                    <li class="page-item">
                        <a class="page-link" href="<?php
                        $num_rowss = ceil($num_rows / $limit);
                        echo base_url()
                        ?>blog/<?php echo $previous; ?>" tabindex="-1" aria-disabled="true">Previous</a>
                    </li><?php
                }
                ?>

                <?php
                $num_rowss = ceil($num_rows / $limit);
                for ($j = 1; $j <= $num_rowss; $j++) {
                    ?>

                    <li class="page-item" aria-current="page">
                        <a class="page-link" href="<?php echo base_url() ?>blog/<?php echo $j; ?>"><?php echo $j; ?></a>
                    </li>
                <?php } ?>
                <?php
                if ($url == $num_rowss) {
                    $next = $num_rowss;
                    ?>
                    <li class="page-item disabled">
                        <a class="page-link" href="<?php echo base_url() ?>blog/<?php echo $next; ?>">Next</a>
                    </li><?php
                } else {
                    $next = $url + 1;
                    ?>
                    <li class="page-item">
                        <a class="page-link" href="<?php echo base_url() ?>blog/<?php echo $next; ?>">Next</a>
                        <?php
                    }
                    ?>

            </ul>
        </nav>
    </div>
</div>

<!-- google adsense -->
<!--<div align="center">
        <script async src="//pagead2.googlesyndication.com/pagead/js/adsbygoogle.js"></script>
         top_results 
        <ins class="adsbygoogle"
            style="display:block"
            data-ad-client="ca-pub-4740793344625684"
            data-ad-slot="4908920712"
            data-ad-format="auto"
            data-full-width-responsive="true"></ins>
        <script>
            (adsbygoogle = window.adsbygoogle || []).push({});
        </script>
</div>-->


<!-- Footer-start -->
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
<!-- Footer-end -->

<!-- ============ Back-to-top ============ -->
<div class="top-to-bottom">
    <a id="button">
        <i class="fa fa-chevron-up"></i>
    </a>    
</div><!-- /top-to-bottom -->

<!-- Feedback-form -->
<div class="feedback-form shadow-lg">
    <div class="feedback-img">
        <img src="<?php echo base_url("assets/front/images/feed.png"); ?>" class="toggle" alt="feedback">	
    </div>

    <div class="feedback-head">
        <div class="media mb-2">
            <div class="media-left">
                <img src="<?php echo base_url("assets/front/images/support.png"); ?>" width="45px" alt="feedback">
            </div>
            <div class="media-body pl-3">
                <h5 class="text-white">Need more help?</h5>
                <small>Contact our support team!</small>
            </div>
        </div><!-- /media -->

        <ul class="list-unstyled">
            <li>Phone: <a href="tel:1800120235600" class="text-white">1800-120-235600</a></li>
            <li>Email: <a href="mailto:support@edugatein.com" class="text-white">support@edugatein.com</a></li>
        </ul>
    </div><!-- /feedback-head -->

    <div class="feedback-body">
        <h5 class="mb-3">Submit A Enquiry Form</h5>
        <form  action="<?php echo base_url() ?>about-us/enquiry" method="post">
            <div class="form-group">
                <input type="text" class="form-control" id="name" name="name" aria-describedby="emailHelp" placeholder="Your Name*"  required>
            </div>
            <div class="form-group">
                <input type="email" class="form-control" id="email" name="email" aria-describedby="emailHelp" placeholder="Your email*" required>
            </div>
            <div class="form-group">
                <input type="text" class="form-control" id="mobile" name="mobile" aria-describedby="emailHelp" placeholder="Mobile Number*" pattern="[6789][0-9]{9}" required>
            </div>

            <div class="form-group">
                <input type="hidden" class="form-control" id="ip" name="ip" aria-describedby="emailHelp" value="<?php echo $_SERVER['REMOTE_ADDR']; ?>" required>
            </div>
            <div class="form-group">
                <select class="form-control" name="city" id="city" required>
                    <option value="" selected disabled>-- Select City --</option>
                    <?php
                    $this->db->select('*')->where('is_active =', 1);
                    $this->db->from('cities');
                    $city = $this->db->get();
                    foreach ($city->result() as $cities) {
                        ?>
                        <option value="<?php echo $cities->city_name; ?>"><?php echo $cities->city_name; ?></option>

                        <?php
                    }
                    ?>
                </select>
            </div>
            <div class="form-group">
                <textarea class="form-control" id="comment" name="comment" rows="3" placeholder="Your Comments"></textarea>
            </div>

            <!-- Button trigger modal -->
            <button type="submit" class="btn btn-primary btn-block mb-2" data-toggle="modal">Submit</button>
        </form>
    </div><!-- /feedback-body -->
</div><!-- /feedback-form -->

<?php
$ip = $_SERVER['REMOTE_ADDR'];
//echo $ip;
?>

<!-- OTP-Form -->
<div class="modal fade" id="exampleModalCenter" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-body p-5">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>

                <?php
                $ran = @$random;

                $this->db->select('*')->where('random', $ran);
                $this->db->from('otp_tracker');
                $otp = $this->db->get();


                foreach ($otp->result() as $otps) {
                    $mobile = $otps->mobile;
                    $mobile = substr($mobile, -4);
                    ?>
                    <h3 class="modal-title mb-3" id="exampleModalCenterTitle">Enter One Time Password</h3>
                    <p class="mb-2">One Time Password (OTP) has been sent to your mobile ******<?php echo $mobile; ?>, please enter the same here to login.</p>

                    <form action="<?php echo base_url() ?>about-us/otp" method="post" class="mt-3">
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
<?php } ?>

<script>
    $(window).on("load", function () {
        $('#preloader').fadeOut('slow', function () {
            $(this).remove();
        });
    });

    $(document).ready(function () {
        // Click number increment
        // $(".blog-box #counter").on("click", function() {
        //var count = $(this).parent().find('.counter');
        // var tot_count = count.html(count.html() * 1 + 1);


        // });
        //get the value
        $(".blog-box #counter").on('click', function () {


            // var $count = $(this).parent().find('.counter');
            // var val = $count.val()+1;

            // var val =1;
            // //document.write(val);
            //  if(val==1){

            //     val = 'Like';
            // }else{
            //     val = 'Dislike';
            // }

            var val = 'Like';
            var name1 = $(this).attr("name");
            // var ipaddress= $ipaddress;
            // var val = 1;
            // alert(val);

            $.ajax({

                url: 'https://www.edugatein.com/blog/insert',
                type: "POST",
                cache: false,
                data: {'blog_id': name1, 'rating': val},
                success: function (data)
                {

                    // alert('Thank you for your like');

                    if (data == 0)
                    {
                        location.reload();

                    } else {

                        $("#counter").off('click');
                        location.reload();
                    }



                }

            });


            //     //alert( name1 + ' and <?php //echo $ip;   ?> and ' + val);

        });

        // $('.blog-box #counter').on('click', function() {
        //      var $count = $(this).parent().find('.counter');
        //     var $tot_count = $count.html($count.html() * 1 +1);
        // });

        // Click-icon color
        // $('.blog-box #counter').on('click', function(e) {
        //     e.preventDefault();
        //   $(this).toggleClass('clicked');
        // });
    });




    $(document).ready(function () {
        $(".owl-carousel").owlCarousel();
    });

    new WOW().init();

    // Feedback-form
    $(document).ready(function () {
        $('.toggle').click(function () {
            $('.feedback-form').toggleClass('active')
        })
    })

    $(document).ready(function () {
        $(window).on("load", function () {
            var str = window.location.pathname;

            if (str == "/about-us/enquiry") {
                $('#exampleModalCenter').modal('show');
            }
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

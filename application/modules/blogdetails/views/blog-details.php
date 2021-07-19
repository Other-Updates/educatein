<?php
//$date = date("Y/m/d");
//
//$this->db->select('*')->where('date =', $date);
//$this->db->from('homepage_counts');
//$homepage = $this->db->get();
//if($homepage->num_rows() > 0)
//{
//    foreach($homepage->result() as $homepages)
//    { 
//    $view_count = $homepages->view_count;
//    }
//    
//    $this->db->set('view_count',$view_count+1)->where('date',$date)->update('homepage_counts');
//}else
//{
//    $homepage_count = array(
//        'date' => $date,
//        'view_count' => 1,
//);          
//
//    $this->db->insert('homepage_counts',$homepage_count);   
//}
//
//$ipaddress = '';
//if (isset($_SERVER['HTTP_CLIENT_IP']))
//$ipaddress = $_SERVER['HTTP_CLIENT_IP'];
//else if(isset($_SERVER['HTTP_X_FORWARDED_FOR']))
//$ipaddress = $_SERVER['HTTP_X_FORWARDED_FOR'];
//else if(isset($_SERVER['HTTP_X_FORWARDED']))
//$ipaddress = $_SERVER['HTTP_X_FORWARDED'];
//else if(isset($_SERVER['HTTP_FORWARDED_FOR']))
//$ipaddress = $_SERVER['HTTP_FORWARDED_FOR'];
//else if(isset($_SERVER['HTTP_FORWARDED']))
//$ipaddress = $_SERVER['HTTP_FORWARDED'];
//else if(isset($_SERVER['REMOTE_ADDR']))
//$ipaddress = $_SERVER['REMOTE_ADDR'];
//else
//$ipaddress = 'UNKNOWN';
//  
//$this->db->select('*')->where('date =', $date);
//$this->db->where('ip =', $ipaddress);
//$this->db->from('user_analys');
//$ip = $this->db->get();
//
//if($ip->num_rows() > 0)
//{
//    foreach($ip->result() as $ips)
//    { 
//    $old_ip = $ips->ip;
//    $page_view = $ips->page_view;
//    }
//
//    $this->db->set('page_view',$page_view+1);
//    $this->db->where('date',$date);
//    $this->db->where('ip',$ipaddress);
//
//    $update = $this->db->update('user_analys');   
//
//    // $this->db->set('page_view',$page_view+1)->where('date',$date)->update('user_analys');
//}else
//{
//    $user_count = array(
//        'ip' => $ipaddress,
//        'date' => $date,
//        'page_view' => 1,
//);          
//
//    $this->db->insert('user_analys',$user_count);   
//}   
?>


<style type="text/css">
    #profileImage {
        width: 75px;
        height: 75px;
        line-height: 75px;
        border-radius: 50%;
        background: #33317c;
        font-size: 30px;
        color: #fff;
        text-align: center;
        font-family: "Rubik",sans-serif;
    }
    #profileImage1 {
        width: 75px;
        height: 75px;
        line-height: 75px;
        border-radius: 50%;
        background: #d12881;
        font-size: 30px;
        color: #fff;
        text-align: center;
        font-family: "Rubik",sans-serif;
    }
</style>



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


<?php
$aff_url = end($this->uri->segments);
$aff_url = str_replace("-", " ", $aff_url);
$aff_url = str_replace("..", "?", $aff_url);
$aff_url = str_replace("_", "'", $aff_url);
$uri_name = end($this->uri->segments);

$this->db->select('id')->where('blog_name =', $aff_url);
$this->db->from('blogs');
$blogdet = $this->db->get();
foreach ($blogdet->result() as $blogdets) {
    $blog_id = $blogdets->id;
    //print_r($schooldets);
    //echo $blogdets->id;
    //exit(); 
}
?>

<div class="breadrumb-new">
    <div class="container">
        <div class="row">
            <div class="col-lg-6 col-sm-12">
                <ul class="list-inline">
                    <li class="list-inline-item"><a href="https://www.edugatein.com/">Home</a></li>
                    <li class="list-inline-item"><i class="fa fa-angle-right"></i></li>
                    <li class="list-inline-item"><a href="<?php echo base_url() ?>blog">News</a></li>
                    <li class="list-inline-item"><i class="fa fa-angle-right"></i></li>
                    <li class="list-inline-item">News Details</li>
                </ul>
            </div>

            <?php
            $this->db->select('*')->where('id =', $blog_id);
            $this->db->where("deleted_at", NULL);
            $this->db->from('blogs');
            $blog = $this->db->get();
            $i = 0;
            foreach ($blog->result() as $blogs) {

                $datetime = $blogs->created_at;
                $date = date('F d, Y ', strtotime($datetime));
                //$query=$this->db->like('created_at', array('created_at' => date('Y-m-d')));
            }
            ?>
            <div class="col-lg-6 col-sm-12 text-right">
                <p>Find the Right School with us!</p>
            </div>
        </div><!-- /row -->
    </div><!-- /container -->
</div><!-- /breadrumb-new -->

<div class="blog-details-section mat-50">
    <div class="container">
        <div class="row">
            <div class="col-lg-8 mab-30">
                <h2 class="mb-2"><?php echo $blogs->blog_name; ?></h2>
                <ul class="list-inline">
                    <li class="list-inline-item"><i class="fa fa-user-o"></i>&nbsp; By <a href="https://www.edugatein.com" class="pink">Edugatein</a></li>
                    <li class="list-inline-item"><i class="fa fa-clock-o"></i> <?php echo $date; ?></li>
                    <?php
                    $approval1 = "ratings='Like' AND blog_id=" . $blog_id . " ";
                    $this->db->select('*')->where($approval1);
                    $this->db->from('blog_like');
                    $blog_like = $this->db->get();
                    ?>
                    <li class="list-inline-item"><i class="fa fa-heart-o"></i> <?php echo $blog_like->num_rows(); ?></li>
                    <?php
                    $approval = "approval=1  AND blog_id=" . $blog_id . " ";
                    $this->db->select('*')->where($approval);
                    $this->db->from('blog_comments');
                    $blog_comment = $this->db->get();
                    ?>
                    <li class="list-inline-item"><a href="#comment" class="id-com"><i class="fa fa-comments-o"></i></a> <?php echo $blog_comment->num_rows(); ?></li>
                </ul>
                <br>
                <img src="<?php base_url(""); ?>https://edugatein.com/laravel/public/<?php echo $blogs->images; ?>" alt="" class="w-100 mb-3"><br>
                <p class="mab-20"><?php echo $blogs->content; ?></p>

                <p class="mab-20"><?php echo $blogs->content2; ?></p>
                <p class="mab-20"><?php echo $blogs->content3; ?></p>
                <p class="mab-20"><?php echo $blogs->content4; ?></p>

                <div class="tags mab-30">
                    <p><b>Tags:&nbsp;</b>
                        <span><?php echo $blogs->tags; ?></span> 
                        <!-- <span><?php echo $blogs->tags; ?></span>,  -->
                        <!-- <span>International School</span>, -->
                        <!-- <span>Matriculation School</span>, -->
                        <!-- <span>Stateboard School</span> -->
                    </p>
                </div><!-- /tags -->

                <div class="post-nav py-4 border-top border-bottom">
                    <div class="row">
                        <?php
                        $this->db->select('*')->where("created_at <", $datetime);
                        $this->db->where("deleted_at", NULL);
                        $this->db->from('blogs');
//$this->db->limit(3);
                        $previous_blog = $this->db->get();
                        $previous_blog_rows = $previous_blog->num_rows();
                        foreach ($previous_blog->result() as $previous_blogs) {
                            $previous_blog_name = $previous_blogs->blog_name;
                            $previous_url_name = str_replace(" ", "-", $previous_blog_name);
                            $previous_url_name1 = str_replace("?", "..", $previous_url_name);
                            $previous_url_name2 = str_replace("'", "_", $previous_url_name1);
                        }
                        if (empty($previous_blogs)) {
                            ?>
                            <div class="col-lg-6 col-sm-6">
                                <small class="disabled">PREV POST</small>
                                <p class="lead"><a href="#"></a></p>
                            </div><?php } else {
                            ?>
                            <div class="col-lg-6 col-sm-6">
                                <small>PREV POST</small>
                                <p class="lead"><a href="<?php echo base_url() ?>blogdetails/<?php echo $previous_url_name2; ?>"><?php echo $previous_blog_name; ?></a></p></div>
                            <?php
                        }
                        ?>
                        <?php
                        $this->db->select('*')->where("created_at >", $datetime);
                        $this->db->where("deleted_at", NULL);
                        $this->db->from('blogs');
                        $this->db->limit(1);
                        $next_blog = $this->db->get();
                        $next_blog_rows = $next_blog->num_rows();
                        foreach ($next_blog->result() as $next_blogs) {
                            $next_blog_name = $next_blogs->blog_name;
                            $next_url_name = str_replace(" ", "-", $next_blog_name);
                            $next_url_name1 = str_replace("?", "..", $next_url_name);
                            $next_url_name2 = str_replace("'", "_", $next_url_name1);
                        }
                        if (empty($next_blogs)) {
                            ?>
                            <div class="col-lg-6 col-sm-6 text-right">
                                <small class="disabled">NEXT POST</small>
                                <p class="lead"><a href="#"></a></p>
                            </div>
                        <?php } else {
                            ?>
                            <div class="col-lg-6 col-sm-6 text-right">
                                <small>NEXT POST</small>
                                <p class="lead"><a href="<?php echo base_url() ?>blogdetails/<?php echo $next_url_name2; ?>"><?php echo $next_blog_name; ?></a></p>
                            </div>
                        <?php } ?>
                    </div><!-- /row -->
                </div><!-- /post-nav -->

                <?php
                $approval = "approval=1  AND blog_id=" . $blog_id . " ";
                $this->db->select('*')->where($approval);
                $this->db->from('blog_comments');
                $this->db->order_by("created_at", "DESC");
                $blog_comment = $this->db->get();
                ?>
                <div class="blog-comments mat-50 mab-30">
                    <h4 class="mb-3">Comments (<?php echo $blog_comment->num_rows(); ?>)</h4>
                    <?php
                    $i = 0;
                    foreach ($blog_comment->result() as $blogs_comments) {
                        $datetime = $blogs_comments->created_at;
                        $date = date('jS F Y', strtotime($datetime));
                        //$query=$this->db->like('created_at', array('created_at' => date('Y-m-d')));
                        ?>
                        <div class="media py-3">
                            <div class="media-left" class="w-100" width="20px" id="profileImage">
                                <?php echo ucwords(strtolower(substr($blogs_comments->name, 0, 1))); ?>
    <!-- <img src="<?php echo base_url("assets/front/images/blog/blog-profile.png"); ?>" width="20px" class="w-100" alt="<?php echo $blogs_comments->name; ?>"> -->
                            </div>
                            <div class="media-body ml-3">
                                <h5 id="firstName"><?php echo $blogs_comments->name; ?></h5>
                                <small><?php echo $date; ?></small>
                                <p class="mt-2"><?php echo $blogs_comments->comment; ?></p>
                            </div>
                        </div><!-- /media -->
                        <?php
                    }
                    $i++;
                    ?>
                </div><!-- /post-comment -->

                <hr>

                <div class="post-comments mat-30" id="comment">
                    <h4 class="mb-3">Leave a Comment</h4>
                    <form action="<?php echo base_url() ?>blogdetails/insert/<?php echo $uri_name; ?>" method="post">
                        <div class="row">
                            <div class="col-lg-6 col-sm-6">
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Your Name</label>
                                    <input type="text" name="name" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Ex: John Doe*" required>
                                </div>
                            </div>

                            <div class="col-lg-6 col-sm-6">
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Your Email</label>
                                    <input type="email" name="email" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Ex: John@example.com*" required>
                                </div>
                            </div>
                        </div><!-- /row -->

                        <div class="row">
                            <div class="col-lg-12">
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Your Message</label>
                                    <textarea type="text" name="message" rows="5" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Enter your comment*" required></textarea>
                                </div>
                            </div>
                        </div><!-- /row -->
                        <button class="btn btn-primary" type="submit">Submit</button>

                    </form>
                </div>
            </div>

            <div class="col-lg-4">
                <!-- <div class="category-section p-4 mab-30">
                    <h5 class="mb-2">Categories</h5>
                    <ul class="list-unstyled">
                        <li class="py-2 border-bottom">Cbse School <span class="float-right">(20)</span></li>
                        <li class="py-2 border-bottom">International School <span class="float-right">(17)</span></li>
                        <li class="py-2 border-bottom">Matriculation School <span class="float-right">(28)</span></li>
                        <li class="py-2 border-bottom">Stateboard School <span class="float-right">(05)</span></li>
                        <li class="py-2">Kindergarden School <span class="float-right">(42)</span></li>
                    </ul>
                </div> -->
                <!-- /category-section -->
                <?php
                $this->db->select('*');
                $this->db->from('blogs');
                $this->db->order_by("created_at", "DESC");
                $blog_s = $this->db->get();
                $i = 0;
                foreach ($blog_s->result() as $blogs_s) {

                    $datetime = $blogs_s->created_at;
                    $date = date('F d, Y ', strtotime($datetime));
                    //$query=$this->db->like('created_at', array('created_at' => date('Y-m-d')));
                    //echo $datetime;
                    //exit();
                }
                ?>
                <!-- google adsense -->
                <!-- <div class="recentpost-section p-4 mab-30"> -->
        <!--                    <script async src="//pagead2.googlesyndication.com/pagead/js/adsbygoogle.js"></script>
                             square_ads 
                            <ins class="adsbygoogle"
                                style="display:block"
                                data-ad-client="ca-pub-4740793344625684"
                                data-ad-slot="7415540849"
                                data-ad-format="auto"
                                data-full-width-responsive="true"></ins>
                            <script>
                                (adsbygoogle = window.adsbygoogle || []).push({});
                            </script><br>-->
                <!-- </div> -->


                <div class="recentpost-section p-4 mab-30">
                    <h5 class="mb-3">Recent Post</h5>
                    <?php
                    $this->db->select('*')->where("deleted_at", NULL);
                    $this->db->from('blogs');
                    $this->db->order_by("created_at", "DESC");
                    $blog_s = $this->db->get();
                    $num_rows = $blog_s->num_rows();
                    $limit = 3;
                    foreach ($blog_s->result() as $blogs_s) {
                        $blog_name[] = $blogs_s->blog_name;
                        $blog_image[] = $blogs_s->images;
                        $datetimes[] = $blogs_s->created_at;

                        //$query=$this->db->like('created_at', array('created_at' => date('Y-m-d')));
                        //echo $datetime;
                        //exit();
                    }
                    for ($j = 0; $j < $limit; $j++) {
                        if ($num_rows > $j) {
                            $url_name = str_replace(" ", "-", $blog_name[$j]);
                            $url_name1 = str_replace("?", "..", $url_name);
                            $url_name2 = str_replace("'", "_", $url_name1);


                            $date = date('d M Y', strtotime($datetimes[$j]));
                            ?>
                            <div class="media mb-3">
                                <div class="media-left">
                                    <a href="<?php echo base_url() ?>blogdetails/<?php echo $url_name2; ?>"><img src="<?php echo base_url() ?>laravel/public/<?php echo $blog_image[$j]; ?>" width="75px" height="60px" alt=""></a>
                                </div>
                                <div class="media-body ml-3">
                                    <p><a href="<?php echo base_url() ?>blogdetails/<?php echo $url_name2; ?>"><?php echo $blog_name[$j];
                            ?></a></p>
                                    <small><?php echo $date; ?></small>
                                </div>
                            </div>
                            <?php
                        }
                    }
                    ?>
                </div><!-- /category-section -->

                <!-- google adsense -->
                <!--        <div class="vertical-section p-4 mab-30">
                                <script async src="//pagead2.googlesyndication.com/pagead/js/adsbygoogle.js"></script>
                                 results_vertical 
                                <ins class="adsbygoogle"
                                    style="display:block"
                                    data-ad-client="ca-pub-4740793344625684"
                                    data-ad-slot="6699201454"
                                    data-ad-format="auto"
                                    data-full-width-responsive="true"></ins>
                                <script>
                                    (adsbygoogle = window.adsbygoogle || []).push({});
                                </script>
                
                        </div>-->
                <!-- google adsense -->


                <div class="follow-section p-4">
                    <h5 class="mb-4">Follow Us</h5>
                    <ul class="list-inline new-social">
                        <li class="list-inline-item">
                            <a href="https://www.facebook.com/edugatein" target="_blank" class="btn btn-secondary btn-facebook"><i class="fa fa-facebook"></i> Facebook</a>
                        </li>
                        <li class="list-inline-item">
                            <a href="https://twitter.com/edugatein" target="_blank" class="btn btn-secondary btn-twitter"><i class="fa fa-twitter"></i> Twitter</a>
                        </li>
                        <li class="list-inline-item">
                            <a href="https://www.linkedin.com/company/edugatein/" target="_blank" class="btn btn-secondary btn-linkedin"><i class="fa fa-linkedin"></i> Linkedin</a>
                        </li>
                        <li class="list-inline-item">
                            <a href="https://www.youtube.com/channel/UCyatNY2QIPJgj5Id4QMQeig?view_as=subscriber" target="_blank"  class="btn btn-secondary btn-youtube"><i class="fa fa-youtube-play"></i> YouTube</a>
                        </li>
                        <li class="list-inline-item">
                            <a href="https://www.instagram.com/edugatein/" target="_blank" class="btn btn-secondary btn-instagram"><i class="fa fa-instagram"></i> Instagram</a>
                        </li>
                    </ul>
                </div><!-- /follow-section -->
            </div>
        </div><!-- /row -->
    </div><!-- /container -->
</div><!-- /blog-details-section -->


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
                $ran = $random;
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

    // $(document).ready(function(){
    //     var firstName = $('#firstName').text();
    //     var intials = $('#firstName').text().charAt(0).toUpperCase() + $('#lastName').text().charAt(0).toUpperCase();
    //     var profileImage = $('#profileImage').text(intials);
    // });

</script>

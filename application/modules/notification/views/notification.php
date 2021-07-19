<?php
if (isset($_GET['id'])) {
    $userid = base64_decode($_GET['id']);
    $this->db->select('*');
    $this->db->from('student_register');
    $this->db->where("id", $userid);
    $user = $this->db->get();

    foreach ($user->result() as $users) {
        $firstname = $users->firstname;
        $lastname = $users->lastname;
        $email = $users->email;
        $phone = $users->phone;
        $grade = $users->grade;
        $board = $users->board;
        $schoolname = $users->schoolname;
        $area = $users->area;
        $city = $users->city;
        $pincode = $users->pincode;
        $image = $users->image;
        $category = $users->category;
    }
}
?>
<style>
    .noclick  {
        pointer-events: none;
    }
</style>
<div class="student-dashboard-body">
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-3 mab-30">
                <div class="student-dashboard-sidebar sticky-sidebar shadow-lg">
                    <div class="text-center">
                        <div class="student-profile-img">
                            <?php if (isset($image)) { ?>
                                <img src="<?php echo base_url() ?>images/students/<?php echo $image ?>" class="mb-3 rounded-circle" alt="">
                            <?php } else { ?> 
                                <img src="<?php echo base_url("assets/front/images/"); ?>dashboard/profile-img.png" class="mb-3 rounded-circle" alt="">
                            <?php } ?> 
                        </div><!-- /student-profile-img -->
                        <h4 class="mt-2"><?php echo $firstname; ?></h4>
                        <p><?php echo $grade; ?>th Grade</p>
                    </div>
                    <hr class="my-3">

                    <ul class="list-group">
                        <li class="list-group-item">
                            <a href="<?php echo base_url() ?>student-account?id=<?php echo base64_encode($userid); ?>"><i class="lnr lnr-user"></i> &nbsp;My Account</a>
                        </li>
                        <li class="list-group-item">
                            <a href="<?php echo base_url() ?>syllabus?id=<?php echo base64_encode($userid); ?>"><i class="lnr lnr-chart-bars"></i> &nbsp;Syllabus</a>
                        </li>
                        <li class="list-group-item">
                            <a href="<?php echo base_url() ?>online-test?id=<?php echo base64_encode($userid); ?>"><i class="lnr lnr-license"></i> &nbsp;Online Test</a>
                        </li>
                        <li class="list-group-item">
                            <a href="<?php echo base_url() ?>previous?id=<?php echo base64_encode($userid); ?>"><i class="lnr lnr-briefcase"></i> &nbsp;Previous Question Paper</a>
                        </li>
                        <li class="list-group-item notification active noclick">
                            <a href="<?php echo base_url() ?>notification?id=<?php echo base64_encode($userid); ?>"><i class="lnr lnr-alarm"></i> &nbsp;Notification</a>
                            <!-- <span>03</span> -->
                        </li>
                        <li class="list-group-item">
                            <a href="<?php echo base_url() ?>question-answer?id=<?php echo base64_encode($userid); ?>"><i class="lnr lnr-funnel"></i> &nbsp;Top Question & Answer</a>
                        </li>
                        <li class="list-group-item">
                            <a href="<?php echo base_url("logout") ?>" class="logout"><i class="lnr lnr-exit"></i> &nbsp;Logout</a>
                        </li>
                    </ul>
                </div><!-- /student-dashboard-sidebar -->
            </div>

            <div class="col-lg-9 mab-30">
                <div class="student-dashboard-content">
                    <div class="section-title mab-30">
                        <h2 class="mb-2">Notifications</h2>
                        <hr>
                    </div><!-- /section-title -->
                    <?php
                    $this->db->select('*');
                    $this->db->from('notifications');
                    $this->db->where("deleted_at", NULL);
                    $this->db->order_by("created_at", "desc");
                    $notification = $this->db->get();

                    foreach ($notification->result() as $notifications) {
                        $fromDate = new DateTime($notifications->created_at);
                        $curDate = new DateTime();
                        $now = time();
                        $years = $curDate->diff($fromDate);
                        $year = round($years->format('%y'));
//                 echo $timespan;            
// exit();

                        if ($year == 1) {
                            $timespan = $year . " year ago";
                        } elseif ($year > 1) {
                            $timespan = $year . " years ago";
                        } elseif ($year == 0) {
                            $months = round($years->format('%m'));

                            if ($months == 1) {
                                $timespan = $months . " month ago";
                            } elseif ($months > 1) {
                                $timespan = $months . " months ago";
                            } elseif ($months == 0) {
                                $fromDate = $notifications->created_at;
                                $daysLeft = abs($now - strtotime($fromDate));
                                $days = round($daysLeft / (60 * 60 * 24));

                                if ($days == 1) {
                                    $timespan = $days . " day ago";
                                } elseif ($days > 1) {
                                    $timespan = $days . " days ago";
                                } elseif ($days == 0) {
                                    $hours = round($daysLeft / (60 * 60));

                                    if ($hours == 1) {
                                        $timespan = $hours . " hour ago";
                                    } elseif ($hours > 1) {
                                        $timespan = $hours . " hours ago";
                                    } elseif ($hours == 0) {

                                        $minutes = round($daysLeft / (60));

                                        if ($minutes == 1) {
                                            $timespan = $minutes . " minute ago";
                                        } elseif ($minutes > 1) {
                                            $timespan = $minutes . " minutes ago";
                                        } elseif ($minutes == 0) {
                                            $timespan = "0 minutes ago";
                                        }
                                    }
                                }
                            }
                        }

                        if ($notifications->heading == "Test") {
                            $notifi_class = "bg-success";
                        } elseif ($notifications->heading == "Info") {
                            $notifi_class = "bg-warning";
                        } elseif ($notifications->heading == "Exams") {
                            $notifi_class = "bg-danger";
                        }
                        ?>
                        <div class="row">
                            <div class="col-lg-10">
                                <div class="notification-widget">
                                    <p class="mb-2">
                                        <span class="<?php echo $notifi_class; ?>"><?php echo $notifications->heading; ?></span>
                                        <small class="float-right text-muted"><i class="fa fa-clock-o"></i> <?php echo $timespan; ?></small></p>
                                    <h6 class="mb-1"><?php echo $notifications->sub_heading; ?></h6>
                                    <p><?php echo $notifications->content; ?></p>
                                </div><!-- /notification-widget -->
                            </div>
                        </div><!-- /row -->

                        <?php
                    }
                    ?>



                </div><!-- /student-dashboard-content -->
            </div><!-- /col-lg-9 -->
        </div><!-- /row -->
    </div><!-- /container -->
</div><!-- /student-dashboard-body -->

<svg id="deco-clouds" xmlns="http://www.w3.org/2000/svg" version="1.1" style="background-color: #f4f6f8;" height="100" viewBox="0 0 100 100" preserveAspectRatio="none">
<path d="M-5 100 Q 0 20 5 100 Z
      M0 100 Q 5 0 10 100 M5 100 Q 10 30 15 100 M10 100 Q 15 10 20 100 M15 100 Q 20 30 25 100
      M20 100 Q 25 -10 30 100 M25 100 Q 30 10 35 100 M30 100 Q 35 30 40 100 M35 100 Q 40 10 45 100
      M40 100 Q 45 50 50 100 M45 100 Q 50 20 55 100 M50 100 Q 55 40 60 100 M55 100 Q 60 60 65 100
      M60 100 Q 65 50 70 100 M65 100 Q 70 20 75 100 M70 100 Q 75 45 80 100 M75 100 Q 80 30 85 100
      M80 100 Q 85 20 90 100 M85 100 Q 90 50 95 100 M90 100 Q 95 25 100 100 M95 100 Q 100 15 105 100 Z">
</path>
</svg>

<footer>
    <div class="container">
        <div class="row">
            <div class="col-lg-4 mab-30 text-center">
                <div class="footer-heading mab-30">
                    <h4>Subscribe Newsletter</h4>
                    <small>We will send updates once a week.</small>
                </div><!-- /footer-heading -->

                <form action="<?php echo base_url("abouts/newsletter"); ?>" class="form-inline" method="post">
                    <div class="input-group w-100">
                        <input type="email" name="email" class="form-control" id="inlineFormInputGroupUsername2" placeholder="Enter your email*" required>
                        <div class="input-group-prepend">
                            <div class="input-group-text">
                                <button type="submit" class="fa fa-send-o"></button>
                            </div><!-- /input-group-text -->
                        </div><!-- /input-group-prepend -->
                    </div><!-- /input-group -->
                </form><!-- /Newsletter -->
            </div>

            <div class="col-lg-4 mab-30 text-center">
                <div class="footer-heading mab-30">
                    <h4>Edugatein</h4>
                    <small>We make your school in 1st Place...</small>
                </div><!-- /footer-heading -->

                <ul class="social-icons list-unstyled list-inline"> 
                    <li><a href="https://www.facebook.com/edugatein" target="_blank"><i class="fa fa-facebook"></i></a></li> 
                    <li><a href="https://twitter.com/edugatein" target="_blank"><i class="fa fa-twitter"></i></a></li>
                    <li><a href="https://www.linkedin.com/company/edugatein/" target="_blank"><i class="fa fa-linkedin"></i></a></li>
                    <li><a href="https://www.youtube.com/channel/UCyatNY2QIPJgj5Id4QMQeig?view_as=subscriber" target="_blank"><i class="fa fa-youtube-play"></i></a></li>
                    <li><a href="https://www.instagram.com/edugatein/" target="_blank"><i class="fa fa-instagram"></i></a></li>
                </ul>
            </div>

            <div class="col-lg-4 mab-30 text-center">
                <div class="footer-heading mab-30">
                    <h4>Help Center</h4>
                </div><!-- /footer-heading -->

                <ul class="list-unstyled help-center">
                    <li><i class="fa fa-fw fa-envelope"></i> <a href="mailto:support@edugatein.com">support@edugatein.com</a></li>
                    <li><i class="fa fa-fw fa-phone"></i> <a href="tel:1800120235600">1800-120-235600</a></li>
                </ul>
            </div>
        </div><!-- /row -->

        <hr style="border-color: #fff;opacity: .1;">

        <div class="copyright">
            <div class="container">
                <div class="row">
                    <div class="col-lg-6 col-sm-6">
                        <p>&copy; 2019 <b>Edugatein.</b> All Rights Reserved.</p>
                    </div>
                    <div class="col-lg-6 col-sm-6 text-right">
                        <ul class="list-inline">
                            <li class="list-inline-item"><a href="<?php echo base_url("privacy-policy"); ?>">Privacy Policy</a></li>
                            <li class="list-inline-item"><a href="<?php echo base_url("terms-and-conditions"); ?>">Terms & Conditions</a></li>
                        </ul>
                    </div>
                </div><!-- /row -->
            </div><!-- /contaienr -->
        </div><!-- /copytight -->
    </div><!-- /container -->
</footer>

<!-- ============ Back-to-top ============ -->
<div class="top-to-bottom">
    <a id="button">
        <i class="fa fa-chevron-up"></i>
    </a>
</div><!-- /top-to-bottom --> 
<script>
    $('a.logout').click(function () {
        return confirm('Are you sure want to logout....!!!')
    });
    $(window).on('load', function () {
        // Trigger animation
        new WOW().init();
    });
</script>
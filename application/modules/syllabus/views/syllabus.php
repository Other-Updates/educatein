<?php
// print_r($this->session->userdata('user'));
// exit();
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

$this->db->select('*');
$this->db->from('school_syllabus');
$this->db->where("school_board_id", $board);
$this->db->where("grade", $grade);
$this->db->where("deleted_at", NULL);
$this->db->order_by("subject_id", "asc");
$syllabus = $this->db->get();
?>

 
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
                                    <img src="<?php echo base_url("assets/front/images/");?>dashboard/profile-img.png" class="mb-3 rounded-circle" alt="">
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
                            <li class="list-group-item  active noclick">
                                <a href="<?php echo base_url() ?>syllabus?id=<?php echo base64_encode($userid); ?>"><i class="lnr lnr-chart-bars"></i> &nbsp;Syllabus</a>
                            </li>
                            <li class="list-group-item">
                                <a href="<?php echo base_url() ?>online-test?id=<?php echo base64_encode($userid); ?>"><i class="lnr lnr-license"></i> &nbsp;Online Test</a>
                            </li>
                            <li class="list-group-item">
                                <a href="<?php echo base_url() ?>previous?id=<?php echo base64_encode($userid); ?>"><i class="lnr lnr-briefcase"></i> &nbsp;Previous Question Paper</a>
                            </li>
                            <li class="list-group-item notification">
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
                            <h2 class="mb-2">Syllabus Information</h2>
                            <hr>
                        </div><!-- /section-title -->

                        <div class="row">

<?php
$delay = 300;
foreach ($syllabus->result() as $syllabuss) {
    $this->db->select('*');
    $this->db->from('subjects');
    $this->db->where("id", $syllabuss->subject_id);
    $this->db->where("deleted_at", NULL);
    $subject = $this->db->get();

    foreach ($subject->result() as $subjects) {
        $subject_name = ucfirst($subjects->subjects);
    }
    ?>
                                <div class="col-lg-4">
                                    <div class="syllabus-widget wow fadeInUp" data-wow-delay="<?php echo $delay; ?>ms">
                                        <div class="media">
                                            <div class="media-left">
                                                <img src="<?php echo base_url("assets/front/images/");?>dashboard/pdf.png" class="mb-3" width="80px" alt="">
                                            </div>
                                            <div class="media-body">
                                                <h5><?php echo $subject_name; ?></h5>
                                                <small>filename.pdf</small>
                                            </div>
                                            <div class="download-icon">
                                                <a href="<?php echo base_url() ?>laravel/public/<?php echo $syllabuss->image ?>#toolbar=0" data-fancybox="gallery"><i class="lnr lnr-magnifier"></i></a>
                                            </div><!-- /download-icon -->
                                        </div>
                                    </div><!-- /syllabus-widget -->
                                </div>

    <?php
    $delay = $delay + 200;
}
?>


                        </div><!-- /row -->

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
    <!-- ============ Back-to-top ============ -->
    <div class="top-to-bottom">
        <a id="button">
            <i class="fa fa-chevron-up"></i>
        </a>
    </div><!-- /top-to-bottom -->

    <style>
        .noclick  {
            pointer-events: none;
        }
    </style>

    <script>
        $('a.logout').click(function () {
            return confirm('Are you sure want to logout....!!!')
        })
    </script>
    <!-- Core JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->


    <script>
        $(window).on('load', function () {
            // Trigger animation
            new WOW().init();
        });
    </script>

    
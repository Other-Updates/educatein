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

$this->db->select('subject');
$this->db->from('online_tests');
$this->db->where("board", $board);
$this->db->where("grade", $grade);
$this->db->where("deleted_at", NULL);
$this->db->distinct();
$this->db->order_by("subject", "asc");
$subject = $this->db->get();
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
                        <li class="list-group-item active noclick">
                            <a href="<?php echo base_url() ?>online-test?id=<?php echo base64_encode($userid); ?>"><i class="lnr lnr-license"></i> &nbsp;Online Test</a>
                        </li>
                        <li class="list-group-item ">
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
                        <h2 class="mb-2">Online Test</h2>
                        <hr>
                    </div><!-- /section-title -->

                    <div class="row">

                        <?php
                        foreach ($subject->result() as $subjects) {
                            $this->db->select('*');
                            $this->db->from('subjects');
                            $this->db->where("id", $subjects->subject);
                            $this->db->where("deleted_at", NULL);
                            $subjectname = $this->db->get();

                            foreach ($subjectname->result() as $subjectnames) {
                                $subject_name = ucfirst($subjectnames->subjects);
                            }

                            $uid = base64_encode($userid);
                            $subid = base64_encode($subjectnames->id);
                            $bid = base64_encode($board);
                            $gid = base64_encode($grade);
                            ?>

                            <div class="col-lg-3">
                                <a href="#myModal" data-toggle="modal" data-target="#exampleModalCenter<?php echo $subjectnames->id ?>" data-id="<?php echo $subjectnames->id ?>" >
                                    <div class="online-test-subject text-center">
                                        <img src="<?php echo base_url() ?>laravel/public/<?php echo $subjectnames->image ?>" width="60px" alt="">
                                        <h4 class="mt-2"><?php echo $subject_name; ?></h4>
                                    </div><!-- /online-test-subject -->
                                </a>
                            </div>

                            <!-- Modal -->
                            <div class="modal fade test-modal" id="exampleModalCenter<?php echo $subjectnames->id;?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                                <div class="modal-dialog modal-dialog-centered" role="document">
                                    <div class="modal-content">
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true"><i class="lnr lnr-cross"></i></span>
                                        </button>
                                        <div class="text-center">
                                            <img src="<?php echo base_url("assets/front/images/"); ?>dashboard/alarm.png" class="mb-3" width="80" alt="">
                                            <p class="time"><span>Duration 10 Mins</span></p>
                                            <p class="my-3">This test may contain multiple choice type of questions. No marks are awarded for unattempted questions</p>
                                            <a href="<?php echo base_url() ?>online-test-conduct?id=<?php echo $uid; ?>&subid=<?php echo $subid; ?>&board=<?php echo $bid; ?>&grade=<?php echo $gid; ?>">START TEST</a>
                                        </div>
                                    </div><!-- /modal-content -->
                                </div>
                            </div><!-- /Modal -->


                            <?php
                        }
                        ?>

                    </div><!-- /row -->
                </div><!-- /student-dashboard-content -->
            </div><!-- /col-lg-9 -->
        </div><!-- /row -->
    </div><!-- /container -->
</div><!-- /student-dashboard-body -->



 

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
<script>
// $(document).ready(function(){
//     $('#myModal').on('show.bs.modal', function (e) {
//         var rowid1 = $(e.relatedTarget).data('id');
//         alert(rowid1);
//         return false; 
//         $.ajax({
//             type : 'post',
//             url : '<?php // echo base_url() ?>online-test-conduct/index', //Here you will fetch records 
//             data :  {rowid: rowid1}, //Pass $id
//             success : function(data){
//             $('.fetched-data').html(data);//Show fetched data from database
//             }
//         });
//     });
// });

</script> 
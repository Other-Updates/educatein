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
} else {
    $this->db->select('*');
    $this->db->from('student_register');
    $this->db->where("id", $id);
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
$this->db->from('school_boards');
$this->db->where("id", $board);
$school_board = $this->db->get();

foreach ($school_board->result() as $school_boards) {
    $boardname = $school_boards->school_board_name;
}
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
                            <div class="student-profile-img mb-2">
                                <?php if (isset($image)) { ?>
                                    <img src="<?php echo base_url() ?>images/students/<?php echo $image ?>" class="mb-3 rounded-circle" alt="">
                                <?php } else { ?> 
                                    <img src="<?php echo base_url("assets/front/images/"); ?>dashboard/profile-img.png" class="mb-3 rounded-circle" alt="">
                                <?php } ?>   
                            </div><!-- /student-profile-img -->
                            <?php if ($category == "student" || $category == "parent") { ?>

                                <h4 class="mt-2"><?php echo $firstname; ?></h4>
                                <p><?php echo $grade; ?>th Grade</p>

                                <!-- this condition is not used -->
                            <?php } elseif ($category == "disabled") { ?>

                                <div class="dropdown option-name">
                                    <button class="btn btn-secondary dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><?php echo $firstname; ?></button>
                                    <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                                        <a class="dropdown-item" href="#">Children 1</a>
                                        <a class="dropdown-item" href="#">Children 2</a>
                                        <a class="dropdown-item" href="#">Children 3</a>
                                    </div>
                                </div>
                                <p>6th Grade</p>

                            <?php } ?>
                        </div><!-- /text-center -->

                        <hr class="my-3">
                        <?php
                        $this->db->select('*');
                        $this->db->from('student_register');
                        $this->db->where('email =', $email);
                        $check = $this->db->get()->result();

                        foreach ($check as $checks) {
                            $userid = $checks->id;
                        }
                        ?>
                        <ul class="list-group">
                            <li class="list-group-item active noclick">
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
                            <li class="list-group-item notification">
                                <a href="<?php echo base_url() ?>notification?id=<?php echo base64_encode($userid); ?>"><i class="lnr lnr-alarm"></i> &nbsp;Notification</a>
                                <!-- <span>01</span> -->
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

                    <?php if ($category == "student" || $category == "parent") { ?>

                        <div class="student-dashboard-content">
                            <div class="section-title mab-30">
                                <h2 class="mb-2">Personal Information</h2>
                                <hr>
                            </div><!-- /section-title -->

                            <form enctype="multipart/form-data" action="<?php echo base_url() ?>student-account/update" method="post">
                                <div class="form-row">
                                    <div class="form-group col-md-4">
                                        <label for="inputEmail4">First Name</label>
                                        <input type="text" class="form-control" id="" name="firstname" value="<?php echo $firstname; ?>" placeholder="Jhonathan" readonly>
                                    </div>
                                    <?php if ($lastname != NULL) { ?>
                                        <div class="form-group col-md-4">
                                            <label for="inputEmail4">Last Name</label>
                                            <input type="text" class="form-control" id="" name="lastname" value="<?php echo $lastname; ?>" placeholder="Smith" readonly>
                                        </div>
                                    <?php } else { ?> 
                                        <div class="form-group col-md-4">
                                            <label for="inputEmail4">Last Name</label>
                                            <input type="text" class="form-control" id="" name="lastname" placeholder="Smith" required>
                                        </div>
                                    <?php } ?>

                                    <div class="form-group col-md-4"></div>
                                    <div class="form-group col-md-4">
                                        <label for="inputEmail4">Email Address</label>
                                        <input type="email" class="form-control" id="" name="useremail" value="<?php echo $email; ?>" placeholder="johnsmith@gmail.com" readonly>
                                    </div>
                                    <div class="form-group col-md-4">
                                        <label for="inputEmail4">Phone Number</label>
                                        <input type="text" maxlength="10" class="form-control" id="" name="phone" value="<?php echo $phone; ?>" placeholder="9638527410" readonly>
                                    </div>
                                    <div class="form-group col-md-4"></div>
                                    <?php if ($schoolname != NULL) { ?>
                                        <div class="form-group col-md-4">
                                            <label for="inputEmail4">School Name</label>
                                            <input type="text" class="form-control" id="" name="schoolname" value="<?php echo $schoolname; ?>" placeholder="Haunuz Matriculation School" readonly>
                                        </div>
                                    <?php } else { ?>
                                        <div class="form-group col-md-4">
                                            <label for="inputEmail4">School Name</label>
                                            <input type="text" class="form-control" id="" name="schoolname"  placeholder="Haunuz Matriculation School" required>
                                        </div>
                                    <?php } ?>

                                    <?php if ($boardname != NULL) { ?>
                                        <div class="form-group col-md-4">
                                            <label for="inputEmail4">School Board</label>
                                            <input type="text" class="form-control" id="" name="board" value="<?php echo $boardname; ?>" placeholder="Haunuz Matriculation School" readonly>
                                        </div>
                                    <?php } else { ?> 
                                        <div class="form-group col-md-4">
                                            <label for="inputEmail4">School Board</label>
                                            <select class="form-control" id="exampleFormControlSelect1" name="board">
                                                <option disabled="">Select Board</option>
                                                <option value="cbse">CBSE</option>
                                                <option value="icse">ICSE</option>
                                                <option value="state-tamil">Stateboard - Tamil</option>
                                                <option value="state-english">Stateboard - English</option>
                                            </select>
                                        </div>
                                    <?php } ?>                                                              

                                    <?php if ($grade != NULL) { ?>
                                        <div class="form-group col-md-4">
                                            <label for="inputEmail4">Grade Level</label>
                                            <!-- <input type="text" class="form-control" id="" name="grade" value="<?php echo $grade; ?>" placeholder="Haunuz Matriculation School" readonly> -->
                                            <select class="form-control" id="exampleFormControlSelect1" name="grade">
                                                <option selected="" disabled="">Select your Grade</option>
                                                <option value="6" <?php echo ($grade == '6') ? 'selected' : ''; ?>>6</option>
                                                <option value="7" <?php echo ($grade == '7') ? 'selected' : ''; ?>>7</option>
                                                <option value="8" <?php echo ($grade == '8') ? 'selected' : ''; ?>>8</option>
                                                <option value="9" <?php echo ($grade == '9') ? 'selected' : ''; ?>>9</option>
                                                <option value="10" <?php echo ($grade == '10') ? 'selected' : ''; ?>>10</option>
                                                <option value="11" <?php echo ($grade == '11') ? 'selected' : ''; ?>>11</option>
                                                <option value="12" <?php echo ($grade == '12') ? 'selected' : ''; ?>>12</option>
                                            </select>
                                        </div>
                                    <?php } else { ?>
                                        <div class="form-group col-md-4">
                                            <label for="inputEmail4">Grade Level</label>
                                            <select class="form-control" id="exampleFormControlSelect1" name="grade">
                                                <option selected="" disabled="">Select your Grade</option>
                                                <option value="6">6</option>
                                                <option value="7">7</option>
                                                <option value="8">8</option>
                                                <option value="9">9</option>
                                                <option value="10">10</option>
                                                <option value="11">11</option>
                                                <option value="12">12</option>
                                            </select>
                                        </div>
                                    <?php } ?>                                



                                    <?php if ($area != NULL) { ?>
                                        <div class="form-group col-md-4">
                                            <label for="inputEmail4">School Area</label>
                                            <input type="text" class="form-control" id="" name="area" placeholder="Your Locality/Area" value="<?php echo $area; ?>" readonly>
                                        </div>
                                    <?php } else { ?>
                                        <div class="form-group col-md-4">
                                            <label for="inputEmail4">School Area</label>
                                            <input type="text" class="form-control" id="" name="area" placeholder="Your Locality/Area" required>
                                        </div>
                                    <?php } ?>



                                    <?php if ($city != NULL) { ?>
                                        <div class="form-group col-md-4">
                                            <label for="inputEmail4">School City</label>
                                            <input type="text" class="form-control" id="" name="city" placeholder="Your Locality/Area" value="<?php echo $area; ?>" readonly>
                                        </div>
                                        <?php
                                    } else {
                                        $this->db->select('*')->where('is_active', 1);
                                        $this->db->from('cities');
                                        $city = $this->db->get();
                                        ?>
                                        <div class="form-group col-md-4">
                                            <label for="inputEmail4">School City</label>
                                            <select class="form-control" name="city" id="exampleFormControlSelect1" required>
                                                <option value="" selected >Select City</option>
                                                <?php
                                                foreach ($city->result() as $cities) {
                                                    ?>
                                                    <option value="<?php echo $cities->id; ?> "><?php echo $cities->city_name; ?></option>
                                                <?php } ?>
                                            </select>
                                        </div>
                                    <?php } ?>

                                    <?php if ($pincode != NULL) { ?>
                                        <div class="form-group col-md-4">
                                            <label for="inputEmail4">Pin Code</label>
                                            <input type="number" maxlength="6" class="form-control" id="" name="pincode" value="<?php echo $pincode; ?>" placeholder="654321" readonly>
                                        </div>
                                    <?php } else { ?>
                                        <div class="form-group col-md-4">
                                            <label for="inputEmail4">Pin Code</label>
                                            <input type="number" maxlength="6" class="form-control" id="" name="pincode" placeholder="654321" required>
                                        </div>
                                    <?php } ?>


                                    <div class="form-group col-md-6">
                                        <label for="inputEmail4">Profile Image</label>
                                        <div class="custom-file">
                                            <input type="file" class="custom-file-input" accept="image/png,image/gif,image/jpeg" id="inputGroupFile01" name="image" aria-describedby="inputGroupFileAddon01">
                                            <label class="custom-file-label" for="inputGroupFile01">Choose file</label>
                                        </div>
                                        <small id="emailHelp" class="form-text text-muted mt-3" style="font-weight: 300;">Perfect Image file size is 100px x 100px.</small>
                                    </div>


                                </div><!-- /form-row -->

                                <button class="btn btn-save" type="submit">Save</button>

                            </form>
                            <!-- this condition is not used -->
                        <?php } elseif ($category == "disabled") { ?>

                            <form action="">
                                <div class="section-title mab-30">
                                    <h2 class="mb-2">Parent Information</h2>
                                    <hr>
                                </div><!-- /section-title -->

                                <div class="form-row">
                                    <div class="form-group col-md-4">
                                        <label for="inputEmail4">First Name</label>
                                        <input type="text" class="form-control" id="" placeholder="Jhonathan">
                                    </div>
                                    <div class="form-group col-md-4">
                                        <label for="inputEmail4">Last Name</label>
                                        <input type="text" class="form-control" id="" placeholder="Smith">
                                    </div>
                                    <div class="form-group col-md-4">
                                        <label for="inputEmail4">Date of Birth</label>
                                        <input type="date" class="form-control" id="" placeholder="Smith">
                                    </div>
                                    <div class="form-group col-md-4">
                                        <label for="inputEmail4">Email Address</label>
                                        <input type="email" class="form-control" id="" placeholder="johnsmith@gmail.com">
                                    </div>
                                    <div class="form-group col-md-4">
                                        <label for="inputEmail4">Phone Number</label>
                                        <input type="text" class="form-control" id="" placeholder="9638527410">
                                    </div>
                                    <div class="form-group col-md-4">
                                        <label for="inputEmail4">Occupation</label>
                                        <input type="text" class="form-control" id="" placeholder="General Manager">
                                    </div>
                                    <div class="form-group col-md-4">
                                        <label for="inputEmail4">Salary (Per Month)</label>
                                        <input type="number" class="form-control" id="" placeholder="1,00,000/Month">
                                    </div>
                                    <div class="form-group col-md-4">
                                        <label for="inputEmail4">Profile Image</label>
                                        <div class="custom-file">
                                            <input type="file" class="custom-file-input" accept="image/png,image/gif,image/jpeg" id="inputGroupFile01" aria-describedby="inputGroupFileAddon01">
                                            <label class="custom-file-label" for="inputGroupFile01">Choose file</label>
                                        </div>
                                        <small id="emailHelp" class="form-text text-muted mt-3 float-right" style="font-weight: 300;">Perfect Image file size is 100px x 100px.</small>
                                    </div>
                                </div><!-- /form-row -->

                                <div class="section-title mab-20">
                                    <h4 class="mb-2">Children #1</h4>
                                    <hr>
                                </div><!-- /section-title -->

                                <div class="form-row mab-30">
                                    <div class="form-group col-md-4">
                                        <label for="inputEmail4">Children Name</label>
                                        <input type="text" class="form-control" id="" placeholder="Jhonathan">
                                    </div>
                                    <div class="form-group col-md-4">
                                        <label for="inputEmail4">Date of Birth</label>
                                        <input type="date" class="form-control" id="" placeholder="Smith">
                                    </div>
                                    <div class="form-group col-md-4">
                                        <label for="inputEmail4">School Name</label>
                                        <input type="text" class="form-control" id="" placeholder="Haunuz Matriculation School">
                                    </div>
                                    <div class="form-group col-md-4">
                                        <label for="inputEmail4">School Area</label>
                                        <input type="text" class="form-control" id="" placeholder="Your Locality/Area">
                                    </div>
                                    <div class="form-group col-md-4">
                                        <label for="inputEmail4">School City</label>
                                        <select class="form-control" name="city" id="exampleFormControlSelect1">
                                            <option selected disabled>Select City</option>
                                            <option value="Coimbatore">Coimbatore</option>
                                            <option value="Tiruppur">Tiruppur</option>
                                            <option value="The Nilgiris">The Nilgiris</option>
                                            <option value="Erode">Erode</option>
                                            <option value="Karur">Karur</option>
                                            <option value="Namakkal">Namakkal</option>
                                            <option value="Salem">Salem</option>
                                            <option value="Nagapattinam">Nagapattinam</option>
                                            <option value="Tiruvarur">Tiruvarur</option>
                                            <option value="Thanjavur">Thanjavur</option>
                                            <option value="Madurai">Madurai</option>
                                            <option value="Ariyalur">Ariyalur</option>
                                            <option value="kallakurichi">kallakurichi</option>
                                            <option value="Kanchipuram">Kanchipuram</option>
                                            <option value="Pudukkottai">Pudukkottai</option>
                                            <option value="Tiruchirappalli">Tiruchirappalli</option>
                                            <option value="Dharmapuri">Dharmapuri</option>
                                            <option value="Tirunelveli">Tirunelveli</option>
                                            <option value="Vellore">Vellore</option>
                                            <option value="Viluppuram">Viluppuram</option>
                                            <option value="Virudhunagar">Virudhunagar</option>
                                            <option value="Chennai">Chennai</option>
                                            <option value="Kanyakumari">Kanyakumari</option>
                                            <option value="Dindigul">Dindigul</option>
                                            <option value="Tiruvannamalai">Tiruvannamalai</option>
                                            <option value="Tiruvallur">Tiruvallur</option>
                                            <option value="Cuddalore">Cuddalore</option>
                                            <option value="Thoothukudi">Thoothukudi</option>
                                            <option value="Theni">Theni</option>
                                            <option value="Sivaganga">Sivaganga</option>
                                            <option value="Ramanathapuram">Ramanathapuram</option>
                                            <option value="Krishnagiri">Krishnagiri</option>
                                            <option value="Perambalur">Perambalur</option>
                                        </select>
                                    </div>
                                    <div class="form-group col-md-4">
                                        <label for="inputEmail4">School Board</label>
                                        <select class="form-control" id="exampleFormControlSelect1">
                                            <option>Select Your Board</option>
                                            <option>CBSE</option>
                                            <option>ICSE</option>
                                            <option>Stateboard - Tamil</option>
                                            <option>Stateboard - English</option>
                                            <option>Matriculation</option>
                                        </select>
                                    </div>
                                    <div class="form-group col-md-4">
                                        <label for="inputEmail4">Grade Level</label>
                                        <select class="form-control" id="exampleFormControlSelect1">
                                            <option selected="" disabled="">Select your Grade</option>
                                            <option>1st Std</option>
                                            <option>2nd Std</option>
                                            <option>3rd Std</option>
                                            <option>4th Std</option>
                                            <option>5th Std</option>
                                            <option>6th Std</option>
                                            <option>7th Std</option>
                                            <option>8th Std</option>
                                            <option>9th Std</option>
                                            <option>10th Std</option>
                                            <option>11th Std</option>
                                            <option>12th Std</option>
                                        </select>
                                    </div>
                                </div><!-- /form-row -->

                                <div class="section-title mab-20">
                                    <h4 class="mb-2">Children #2</h4>
                                    <hr>
                                </div><!-- /section-title -->

                                <div class="form-row">
                                    <div class="form-group col-md-4">
                                        <label for="inputEmail4">Children Name</label>
                                        <input type="text" class="form-control" id="" placeholder="Jhonathan">
                                    </div>
                                    <div class="form-group col-md-4">
                                        <label for="inputEmail4">Date of Birth</label>
                                        <input type="date" class="form-control" id="" placeholder="Smith">
                                    </div>
                                    <div class="form-group col-md-4">
                                        <label for="inputEmail4">School Name</label>
                                        <input type="text" class="form-control" id="" placeholder="Haunuz Matriculation School">
                                    </div>
                                    <div class="form-group col-md-4">
                                        <label for="inputEmail4">School Area</label>
                                        <input type="text" class="form-control" id="" placeholder="Your Locality/Area">
                                    </div>
                                    <div class="form-group col-md-4">
                                        <label for="inputEmail4">School City</label>
                                        <select class="form-control" name="city" id="exampleFormControlSelect1">
                                            <option selected disabled>Select City</option>
                                            <option value="Coimbatore">Coimbatore</option>
                                            <option value="Tiruppur">Tiruppur</option>
                                            <option value="The Nilgiris">The Nilgiris</option>
                                            <option value="Erode">Erode</option>
                                            <option value="Karur">Karur</option>
                                            <option value="Namakkal">Namakkal</option>
                                            <option value="Salem">Salem</option>
                                            <option value="Nagapattinam">Nagapattinam</option>
                                            <option value="Tiruvarur">Tiruvarur</option>
                                            <option value="Thanjavur">Thanjavur</option>
                                            <option value="Madurai">Madurai</option>
                                            <option value="Ariyalur">Ariyalur</option>
                                            <option value="kallakurichi">kallakurichi</option>
                                            <option value="Kanchipuram">Kanchipuram</option>
                                            <option value="Pudukkottai">Pudukkottai</option>
                                            <option value="Tiruchirappalli">Tiruchirappalli</option>
                                            <option value="Dharmapuri">Dharmapuri</option>
                                            <option value="Tirunelveli">Tirunelveli</option>
                                            <option value="Vellore">Vellore</option>
                                            <option value="Viluppuram">Viluppuram</option>
                                            <option value="Virudhunagar">Virudhunagar</option>
                                            <option value="Chennai">Chennai</option>
                                            <option value="Kanyakumari">Kanyakumari</option>
                                            <option value="Dindigul">Dindigul</option>
                                            <option value="Tiruvannamalai">Tiruvannamalai</option>
                                            <option value="Tiruvallur">Tiruvallur</option>
                                            <option value="Cuddalore">Cuddalore</option>
                                            <option value="Thoothukudi">Thoothukudi</option>
                                            <option value="Theni">Theni</option>
                                            <option value="Sivaganga">Sivaganga</option>
                                            <option value="Ramanathapuram">Ramanathapuram</option>
                                            <option value="Krishnagiri">Krishnagiri</option>
                                            <option value="Perambalur">Perambalur</option>
                                        </select>
                                    </div>
                                    <div class="form-group col-md-4">
                                        <label for="inputEmail4">School Board</label>
                                        <select class="form-control" id="exampleFormControlSelect1">
                                            <option>Select Your Board</option>
                                            <option>CBSE</option>
                                            <option>ICSE</option>
                                            <option>Stateboard - Tamil</option>
                                            <option>Stateboard - English</option>
                                            <option>Matriculation</option>
                                        </select>
                                    </div>
                                    <div class="form-group col-md-4">
                                        <label for="inputEmail4">Grade Level</label>
                                        <select class="form-control" id="exampleFormControlSelect1">
                                            <option selected="" disabled="">Select your Grade</option>
                                            <option>6th Std</option>
                                            <option>7th Std</option>
                                            <option>8th Std</option>
                                            <option>9th Std</option>
                                            <option>10th Std</option>
                                            <option>11th Std</option>
                                            <option>12th Std</option>
                                        </select>
                                    </div>
                                </div><!-- /form-row -->

                                <button class="btn btn-save mt-4" type="submit">Save</button>
                            </form>

                        <?php } ?>

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
        })

    </script> 
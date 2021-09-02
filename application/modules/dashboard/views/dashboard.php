<div class="row  py-3">
    <div class="col-md-2 mb-1">
        <div class="px-3 py-1 bg-white schools" style="border-bottom: 3px solid #079346;cursor: pointer">
            <h1 class="mb-0"><i class="icon ion-md-business"  ></i>   <?php echo $schools; ?></h1>
            <div class="d-flex"> 
                <div class="ml-auto">Schools</div>                    
            </div>
        </div>
    </div>
    <div class="col-md-2 mb-1">
        <div class="px-3 py-1 bg-white institutes" style="border-bottom: 3px solid #079346;cursor: pointer">
            <h1 class="mb-0"><i class="icon ion-md-bicycle"  ></i>   <?php echo $institutes; ?></h1>
            <div class="d-flex"> 
                <div class="ml-auto">Institutes</div>                    
            </div>
        </div>
    </div>
    <!-- <div class="col-md-2 mb-1">
        <div class="px-3 py-1 bg-white" style="border-bottom: 3px solid #079346;cursor: pointer">
            <h1 class="mb-0"><i class="icon ion-md-school"  ></i>   <?php echo $high_school; ?></h1>
            <div class="d-flex"> 
                <div class="ml-auto">High School</div>                    
            </div>
        </div>
    </div>
    <div class="col-md-2 mb-1">

        <div class="px-3 py-1 bg-white" style="border-bottom: 3px solid #079346;cursor: pointer">
            <h1 class="mb-0"><i class="icon ion-md-color-palette"  ></i>   <?php echo $elementary_school; ?></h1>
            <div class="d-flex"> 
                <div class="ml-auto">Elementary school</div>                    
            </div>
        </div>
    </div>
    <div class="col-md-2 mb-1">
        <div class="px-3 py-1 bg-white" style="border-bottom: 3px solid #079346;cursor: pointer">
            <h1 class="mb-0"><i class="icon ion-md-happy"  ></i>   <?php echo $preschool; ?></h1>
            <div class="d-flex"> 
                <div class="ml-auto">Preschool</div>                    
            </div>
        </div>
    </div>
    <div class="col-md-2 mb-1">
        <div class="px-3 py-1 bg-white" style="border-bottom: 3px solid #079346;cursor: pointer">
            <h1 class="mb-0"><i class="icon ion-md-camera"  ></i>   <?php echo $special_school; ?></h1>
            <div class="d-flex"> 
                <div class="ml-auto">Special school</div>                    
            </div>
        </div>
    </div> -->
</div>
<div class="row school">
                <div class="col-lg-4 mab-20">
                    <?php if($key == 0){ ?><h5 class="mb-2" style="color:red">Recent Schools</h5><?php } ?>
                </div>

    <div class="col-12">
        <div class="edit-school-inner">
            <div class="table-responsive">
                <table class="table table-bordered table-sm m-0" id="example">
                    <thead>
                        <tr class="text-center">
                            <th class="text-nowrap" width="55%">School Name</th>
                            <th class="text-nowrap" width="15%">Plan</th>
                            <th class="text-nowrap" width="15%">Status</th>
                            <th class="text-nowrap" width="15%">Action</th>
                        </tr>
                    </thead>
                    <tbody>    
                        <?php
                        foreach ($school_limit as $key=>$school_limit_data) {
                            if($school_limit_data['status'] == 1){$status = "Approved";}
                            else if($school_limit_data['status'] == 2){$status = "Rejected";}
                            else { $status = "Waiting for validation";}
                            if($school_limit_data['school_category_id'] == 1){$plan = "PLATINUM";}
                            else if($school_limit_data['school_category_id'] == 2){$plan = "PREMIUM";}
                            else if($school_limit_data['school_category_id'] == 3){$plan = "SPECTRUM";}
                            else{ $plan = "TRIAL";}
                            echo "<tr>"
                            . "<td class=' align-middle'> " . $school_limit_data["school_name"] . "</td>"
                        //    . "<td class=' align-middle'> " . $table_record["name"] . "</td>"
                        . "<td  align='center' class=' align-middle'>" . $plan . "</td>"
                        . "<td align='center' class=' align-middle'>" . $status . "</td>"
                        //    . "<td class='text-center align-middle'>" . $status . "</td>"
                            . "<td class='text-center align-middle'>"
                            . "<a href='". base_url("schools/admin/school_edit?id=". base64_encode($school_limit_data["id"]))."' class='btn btn-outline-info py-0 mr-1 mb-2 mb-md-0'>Edit</a>"
                            . "</td>"
                            . "</tr>";   
                        }
                        ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    <div class="col-lg-4 mab-20">
                    <h5 class="mb-2" style="color:red">Recent Institutes</h5>
                </div>
    <div class="col-12">
        <div class="edit-school-inner">
            <div class="table-responsive">
                <table class="table table-bordered table-sm m-0" id="example">
                    <thead>
                        <tr class="text-center">
                            <th class="text-nowrap" width="55%">Institute Name</th>
                            <th class="text-nowrap" width="15%">Plan</th>
                            <th class="text-nowrap" width="15%">Status</th>
                            <th class="text-nowrap" width="15%">Actions</th>
                        </tr>
                    </thead>
                    <tbody>    
                        <?php
                        foreach ($class_limit as $key=>$class_limit_data) {
                            if($class_limit_data['status'] == 1){$status = "Approved";}
                            else if($class_limit_data['status'] == 2){$status = "Rejected";}
                            else { $status = "Waiting for validation";}
                            if($class_limit_data['position_id'] == 1){$plan = "PLATINUM";}
                            else if($class_limit_data['position_id'] == 2){$plan = "PREMIUM";}
                            else if($class_limit_data['position_id'] == 3){$plan = "SPECTRUM";}
                            else{ $plan = "TRIAL";}
                            echo "<tr>"
                            . "<td class=' align-middle'> " . $class_limit_data["institute_name"] . "</td>"
                        //    . "<td class=' align-middle'> " . $table_record["name"] . "</td>"
                        . "<td  align='center' class=' align-middle'>" . $plan . "</td>"
                        . "<td align='center' class=' align-middle'>" . $status . "</td>"
                        //    . "<td class='text-center align-middle'>" . $status . "</td>"
                            . "<td class='text-center align-middle'>"
                            . "<a href='". base_url("admin/schools/institute_edit?id=". base64_encode($class_limit_data["id"]))."' class='btn btn-outline-info py-0 mr-1 mb-2 mb-md-0'>Edit</a>"
                            . "</td>"
                            . "</tr>";   
                        }
                        ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
<script>
    $('.schools').click(function () {
        window.location.href = '<?php base_url(); ?>schools';
        return false;
    });
    $('.institutes').click(function(){
        window.location.href ='<?php base_url(); ?>schools/institute'
        return false;
    });
</script>
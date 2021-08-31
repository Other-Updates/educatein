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
                <?php foreach($school_limit as $key=>$school_limit_data){ ?>
                    <?php if($key == 0){ ?><h5 class="mb-2" style="color:red">Holded Schools</h5><?php } ?>
                        <a href="<?php echo base_url("admin/schools/school_edit?id=". base64_encode($school_limit_data['id'])); ?>"><div class="heading-collapse"><?php echo $school_limit_data['school_name']; ?></div></a>
                    <?php } ?>
                </div>

                <div class="col-lg-4 mab-20">
                <?php foreach($class_limit as $key=>$class_limit_data){ ?>
                    <?php if($key == 0){ ?><h5 class="mb-2" style="color:red">Holded Institutes</h5><?php } ?>
                <a href="<?php echo base_url("admin/schools/institute_edit?id=". base64_encode($class_limit_data['id'])); ?>"><div class="heading-collapse"><?php echo $class_limit_data['institute_name']; ?></div>
        <?php } ?>
            </div>
</div>
            <style>
            .school {
background-color: #f5f5f5;
}
</style>
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
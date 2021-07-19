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
        <div class="px-3 py-1 bg-white" style="border-bottom: 3px solid #079346;cursor: pointer">
            <h1 class="mb-0"><i class="icon ion-md-bicycle"  ></i>   <?php echo $institutes; ?></h1>
            <div class="d-flex"> 
                <div class="ml-auto">Institutes</div>                    
            </div>
        </div>
    </div>
    <div class="col-md-2 mb-1">
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
    </div>
</div>
<script>
    $('.schools').click(function () {
        window.location.href = '<?php base_url(); ?>schools';
        return false;
    });
</script>
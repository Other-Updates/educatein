<div class="col-12 mt-0 bg-white py-3">
    <div class="border py-3 pl-3 ">
        <h3><?php echo $school["school_name"]; ?></h3> 
    </div>
    <table class="table table-bordered table-sm">
        <?php 
        $details = $school;
        unset($school["id"]);
        unset($school["school_name"]);
        unset($school["slug"]);
        unset($school["user_id"]);
        unset($school["logo"]); 
        foreach ($school as $key => $value) {
            echo " <tr>
            <td>".$key."</td>
            <td>".$value."</td>
        </tr>";
        } ?>       
        <tr>
            <!-- <td>Logo</td> -->
            <td></td>
        </tr>
    </table>
    
    <table class="table table-bordered table-sm">
        <tr>
            <td colspan="4"><h5>Facilities</h5></td>
        </tr>
        <?php        
        foreach ($facilities as $facility) {
            echo " <tr>
            <td class='align-middle'>".$facility["facility"]."</td>
            <td class='align-middle'>".$facility["content"]."</td>
            <td class='align-middle'> <img src='".base_url('laravel/public/').$facility["image"]."'width=250 height=200 ></td>
                
            <td class='align-middle'>".$facility["is_active"]."</td>
        </tr>";
        } ?>       
       
    </table> 
</div> 
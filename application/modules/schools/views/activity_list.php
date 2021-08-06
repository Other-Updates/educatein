<div class="col-12 mt-0 bg-white py-3">
    <div class="border py-3 pl-3 ">
        <h3><?php echo $institute["institute_name"]; ?></h3> 
    </div>
    <table class="table table-bordered table-sm" id="example">
        <?php 
        $details = $institute;
        unset($institute["id"]);
        unset($institute["institute_name"]);
        unset($institute["slug"]);
        unset($institute["user_id"]);
        unset($institute["logo"]); 
        foreach ($institute as $key => $value) {
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
</div> 
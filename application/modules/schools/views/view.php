<div class="d-flex col-12   mt-3 bg-white pb-3"> 
    <div class="mr-auto"><h3 ><?php echo $formName; ?></h3></div> 
    <a  class="btn btn-outline-red  ml-auto" href="#"><i class="fas fa-plus"></i> Add School</a>
</div>
<div class="col-12 mt-0 bg-white">
    <div class="table-responsive">
        <table class="table table-bordered table-sm bg-white" id="example">
            <thead>
                <tr class="text-center">
                    <th class="text-nowrap">#</th>                     
                    <th class="text-nowrap">Name</th>
<!--                    <th class="text-nowrap">Grade</th>
                    <th class="text-nowrap">Gender</th>
                    <th class="text-nowrap">Mobile</th>
                    <th class="text-nowrap">DOB</th>
                    <th class="text-nowrap">Status</th>  -->
                    <th class="text-nowrap">Actions</th> 
                </tr>
            </thead>
            <tbody>    
                <?php
                $count = 1;
                foreach ($table_records as $table_record) {
                    $status = ($table_record["is_active"] == 0 ? "<i class='icon ion-md-checkmark-circle text-success'></i>" : "<i class='icon ion-md-close-circle text-danger'></i>" );
                    echo "<tr>"
                    . "<td class=' align-middle text-center'>" . $count . "</td>"
                    . "<td class=' align-middle'> " . $table_record["school_name"] . "</td>"
//                    . "<td class=' align-middle'> " . $table_record["name"] . "</td>"
//                    . "<td  align='center' class=' align-middle'>" . $table_record["grade"] . "</td>"
//                    . "<td  align='center' class=' align-middle'>" . $table_record["gender"] . "</td>"
//                    . "<td align='center' class=' align-middle'>" . $table_record["mobile"] . "</td>"
//                    . "<td align='center' class=' align-middle'>" . $table_record["dob"] . "</td>"
//                    . "<td class='text-center align-middle'>" . $status . "</td>"
                    . "<td class='text-center align-middle'>"
                    . "<a href='#' class='btn btn-outline-info py-0 mr-1 mb-2 mb-md-0'>Edit</a>"
                    . "<a href='#' class='delete btn btn-outline-danger  py-0 mr-1  mb-2  mb-md-0'>Delete</a>"
                    . "<a href='". base_url("admin/schools/details/". base64_encode($table_record["id"]))."'  class='btn btn-outline-dark  py-0 mb-2  mb-md-0'>View</a>"
                    . "</td>"
                    . "</tr>";
                    $count++;
                }
                ?>
            </tbody>
        </table>
    </div>
</div>
<script>
//    $("#example").on('click', '.delete', function (e) {
//        e.preventDefault();
//        var detail = $(this).attr("data-detail");
//        var r = confirm("Are you sure ?  You want to delete \n " + detail);
//        if (r == true) {
//            var URL = $(this).attr("data-href");
//            $.ajax({
//                type: 'POST',
//                url: URL,
//                dataType: "json",
//                success: function (data) {
//                    location.reload();
//                }
//            });
//        } else {
//            e.preventDefault();
//        }
//
//
//    });
    $("#example").on('click', '.view', function (e) {
        e.preventDefault();
        var primary_key = $(this).attr("data-primarykey");
        alert(primary_key);
//        var r = confirm("Are you sure ?  You want to delete \n " + detail);
//        if (r == true) {
//            var URL = $(this).attr("data-href");
//            $.ajax({
//                type: 'POST',
//                url: URL,
//                dataType: "json",
//                success: function (data) {
//                    location.reload();
//                }
//            });
//        } else {
//            e.preventDefault();
//        }


    });
//    $(document).ready(function () {
//        $('#example').DataTable();
//    });
</script>
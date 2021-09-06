
<div class="table-main">
    <div class="table-tit-main"> 
        <div class="table-tit"><?php echo $formName; ?></div> 
        <?php
        $this->db->select('id')->from('admin_users');
        $userid = $this->db->get()->result_array(); 
        // $userid= base64_decode($_GET['id']);
        ?>
        <a class="btn btn-success btn-sm" href="<?php echo base_url();?>/schools/admin/add_school"><i class="fas fa-plus"></i> Add School</a>
    </div>
    <div class="clearfix"></div>
    <div class="table-responsive">
        <table class="table table-bordered table-sm bg-white" id="example">
            <thead>
                <tr class="text-center">
                    <th class="text-nowrap">#</th>             
                    <th class="text-nowrap">Customer</th>
                    <th class="text-nowrap">School Name</th>
                   <th class="text-nowrap">Plan</th>
                   <th class="text-nowrap" style="text-align:center;">Paid</th>
                    <th class="text-nowrap">Created date</th>
                    <th class="text-nowrap">Status</th>
                    <th class="text-nowrap">Expiry date</th>
                    <!-- <th class="text-nowrap">Status</th>  -->
                    <th class="text-nowrap">Actions</th> 
                </tr>
            </thead>
            <tbody>    
                <?php
                $count = 1;
                foreach ($table_records as $table_record) {
                    // $status = ($table_record["is_active"] == 0 ? "<i class='icon ion-md-checkmark-circle text-success'></i>" : "<i class='icon ion-md-close-circle text-danger'></i>" );
                    $this->db->select('*');
                    $this->db->where('id',$table_record['user_id']);
                    $this->db->from('user_register');
                    $user = $this->db->get()->result_array();
                    if($table_record['status'] == 1){
                        if($table_record['school_category_id'] == 4){
                        $date = strtotime($table_record['activated_at']);
                        $date = strtotime("+30 day", $date);
                        $date = date('d-m-Y', $date);
                        }else{
                            $date = strtotime($table_record['activated_at']);
                            $date = strtotime("+100 day", $date);
                            $date = date('d-m-Y', $date);
                        }
                    }else{
                        $date = "-";
                    }
                    if($table_record['status'] == 1){$status = "Approved";}
                    else if($table_record['status'] == 2){$status = "Rejected";}
                    else { $status = "Waiting for validation";}
                    if($table_record['school_category_id'] == 1){$plan = "PLATINUM";}
                    else if($table_record['school_category_id'] == 2){$plan = "PREMIUM";}
                    else if($table_record['school_category_id'] == 3){$plan = "SPECTRUM";}
                    else{ $plan = "TRIAL";}
                    echo "<tr>"
                    . "<td class=' align-middle text-center'>" . $count . "</td>"
                   . "<td class=' align-middle'> " . ucfirst($user[0]["name"]) . "</td>"
                    . "<td class=' align-middle'> " . ucfirst($table_record["school_name"]) . "</td>"
                   . "<td  align='center' class=' align-middle'>" . $plan . "</td>"
                   . "<td  align='center' class=' align-middle'>" . $table_record["paid"] . "</td>"
                   . "<td  align='center' class=' align-middle'>" . date('d-m-Y', strtotime($table_record["created_at"])) . "</td>"
                   . "<td align='center' class=' align-middle'>" . $status . "</td>"
                   . "<td align='center' class=' align-middle'>" . $date . "</td>"
                //    . "<td class='text-center align-middle'>" . $status . "</td>"
                    . "<td class='text-center align-middle'>"
                    . "<a href='". base_url("schools/admin/school_edit?id=". base64_encode($table_record["id"]))."' class='btn btn-outline-info py-0 mr-1 mb-2 mb-md-0'>Edit</a>"
                    . "<a href='". base_url("schools/admin/school_delete?id=". base64_encode($table_record["id"]))."' class='delete btn btn-outline-danger  py-0 mr-1  mb-2  mb-md-0 delete' id='del_btn'>Delete</a>"
                    . "<a href='". base_url("admin/schools/view_school?id=". base64_encode($table_record["id"]))."'  class='btn btn-outline-dark  py-0 mb-2  mb-md-0'>View</a>"
                    . "</td>"
                    . "</tr>";
                    $count++;
                }
                ?>
            </tbody>
        </table>
    </div>
</div>
<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.25/css/jquery.dataTables.css">
<script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.10.25/js/jquery.dataTables.js"></script>
<script>  
$(document).ready( function(){
    $('#example').DataTable();
});
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
    $('.delete').click(function () {
        return confirm('Are you sure, want to Delete....!!!')

//         swal("Are you sure?", {
//   dangerMode: true,
//   buttons: true,
// });
    })

//    $(document).ready(function () {
//        $('#example').DataTable();
//    });
// $('#del_btn').click(function(){
//     swal({
//   title: "Are you sure?",
//   icon: "warning",
//   buttons: true,
//   dangerMode: true,
// })
// });
var table;
 
$(document).ready(function() {
 
    //datatables
    table = $('#table').DataTable({ 
 
        "processing": true, //Feature control the processing indicator.
        "serverSide": true, //Feature control DataTables' server-side processing mode.
        "order": [], //Initial no order.
 
        // Load data for the table's content from an Ajax source
        "ajax": {
            "url": "<?php echo site_url('schools/admin')?>",
            "type": "POST"
        },
 
        //Set column definition initialisation properties.
        "columnDefs": [
        { 
            "targets": [ 0 ], //first column / numbering column
            "orderable": false, //set not orderable
        },
        ],
 
    });
 
});
</script>
<!-- <script src="https://lipis.github.io/bootstrap-sweetalert/dist/sweetalert.js"></script>
    <link rel="stylesheet" href="https://lipis.github.io/bootstrap-sweetalert/dist/sweetalert.css" /> -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@9.17.2/dist/sweetalert2.min.cs"></script>

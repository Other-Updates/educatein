
<div class="table-main">
    <div class="table-tit-main"> 
        <div class="table-tit"><?php echo $formName; ?></div> 
        <?php
        $this->db->select('id')->from('admin_users');
        $userid = $this->db->get()->result_array(); 
        // $userid= base64_decode($_GET['id']);
        ?>
        <a class="btn btn-success btn-sm" href="<?php echo base_url();?>schools/admin/add_school"><i class="fas fa-plus"></i> Add School</a>
    </div>
    <div class="clearfix"></div>
    <div class="table-responsive">
        <table class="table table-bordered table-sm bg-white" id="example">
            <thead>
                <tr class="text-center">
                    <th class="text-nowrap">#</th>             
                    <th class="text-nowrap">Customer</th>
                    <th class="text-nowrap">School Name</th>
                    <th class="text-nowrap">City</th>
                    <th class="text-nowrap">Plan</th>
                    <th class="text-nowrap" style="text-align:center;">Paid</th>
                    <th class="text-nowrap">Created date</th>
                    <th class="text-nowrap">Status</th> 
                    <th class="text-nowrap">Expiry date</th>
                    <th class="text-nowrap">Actions</th> 
                </tr>
            </thead>
            <tbody>
            </tbody>
        </table>
    </div>
</div>
<link rel="stylesheet" type="text/css" href="<?php echo base_url();?>assets/admin/datatables/jquery.dataTables.css">
<script type="text/javascript" charset="utf8" src="<?php echo base_url();?>assets/admin/datatables/jquery.dataTables.js"></script>
<script>  
$(document).ready(function(){
    var category_table = $("#example").dataTable({
        "lengthMenu": [[100, 500, -1], [100, 500, "All"]],
        "processing": true, 
        "serverSide": true, 
        "searching": true,
        "language": {
            "infoFiltered": ""
        },
        "order": [[ 5, "desc" ]],
        "ajax": {
            url: "<?php echo base_url('schools/admin/school_datatable');?>",
            "type": "POST",
            // "dataSrc": ""

        },
        'columnDefs': [ {
            'targets': [0,9],
            'orderable': false, 
            },{
            'targets': [0,4,5,6,7,8],
            'className': 'text-center'
            }
        ]
    });
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
    $('body').on('click','.delete',function () {
        // return confirm('Are you sure, want to Delete....!!!')
        swal({
        title: "Are you sure?",
        text: "You will not be able to recover this imaginary file!",
        type: "warning",
        showCancelButton: true,
        confirmButtonColor: "#DD6B55",
        confirmButtonText: "Yes, delete it!",
        closeOnConfirm: false
    }, function (isConfirm) {
        if (!isConfirm) return;
        $.ajax({
            url: "scriptDelete.php",
            type: "POST",
            data: {
                id: 5
            },
            dataType: "html",
            success: function () {
                swal("Done!", "It was succesfully deleted!", "success");
            },
            error: function (xhr, ajaxOptions, thrownError) {
                swal("Error deleting!", "Please try again", "error");
            }
        });
    });

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

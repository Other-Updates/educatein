<div class="table-main">
    <div class="table-tit-main"> 
        <div class="table-tit"><?php echo $formName; ?></div> 
        <a  class="btn btn-success btn-sm" href="<?php echo base_url();?>schools/admin/add_school"><i class="fas fa-plus"></i> Add Institute</a>
    </div>
    <?php
        // $this->db->select('id')->from('admin_users');
        // $userid = $this->db->get()->result_array(); 
        // $userid= base64_decode($_GET['id']);
        ?>
        <div class="clearfix"></div>
            <ul class="nav nav-tabs" id="myTab" role="tablist">
            <li class="nav-item" role="presentation">
                <a class="nav-link active" id="approved-tab" data-toggle="tab" href="#approved" role="tab" aria-controls="approved" aria-selected="true"><i class="bi bi-check2-circle"></i> Approved</a>
            </li>
            <li class="nav-item" role="presentation">
                <a class="nav-link" id="hold-tab" data-toggle="tab" href="#hold" role="tab" aria-controls="hold" aria-selected="false"><i class="bi bi-hourglass"></i> Hold</a>
            </li>
            <li class="nav-item" role="presentation">
                <a class="nav-link" id="reject-tab" data-toggle="tab" href="#reject" role="tab" aria-controls="reject" aria-selected="false"><i class="bi bi-x-circle"></i> Reject</a>
            </li>
        </ul>
        <div class="tab-content" id="myTabContent">
            <div class="tab-pane fade show active" id="approved" role="tabpanel" aria-labelledby="approved-tab">
                <div class="table-responsive">
                    <table class="table table-bordered table-sm bg-white" class= "table" id="example">
                        <thead>
                            <tr class="text-center">
                                <th class="text-nowrap">#</th>  
                                <th class="text-nowrap">Customer</th>
                                <th class="text-nowrap">Institute Name</th>
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
            <div class="tab-pane fade" id="hold" role="tabpanel" aria-labelledby="hold-tab">Hold Table</div>
            <div class="tab-pane fade" id="reject" role="tabpanel" aria-labelledby="reject-tab">Reject Table</div>
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
                url: "<?php echo base_url('schools/admin/class_datatable');?>",
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
  $(document).ready( function(){
        $('#example').DataTable();
    });

    $('.delete').click(function () {
        return confirm('Are you sure, want to Delete....!!!')
    })
</script>
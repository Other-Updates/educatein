<div class="table-main">
    <div class="table-tit-main"> 
        <div class="table-tit"><?php echo $formName; ?></div> 
        <a  class="btn btn-success btn-sm" href="<?php echo base_url();?>/schools/admin/add_school"><i class="fas fa-plus"></i> Add Institute</a>
    </div>
    <?php
        // $this->db->select('id')->from('admin_users');
        // $userid = $this->db->get()->result_array(); 
        // $userid= base64_decode($_GET['id']);
        ?>
        <div class="clearfix"></div>    
        <div class="table-responsive">
            <table class="table table-bordered table-sm bg-white" id="example">
                <thead>
                    <tr class="text-center">
                        <th class="text-nowrap">#</th>  
                        <th class="text-nowrap">Customer</th>
                        <th class="text-nowrap">Institute Name</th>
                        <th class="text-nowrap">Plan</th>
                        <th class="text-nowrap" style="text-align:center;">Paid</th>
                        <th class="text-nowrap">Created date</th>
                        <th class="text-nowrap">Status</th>
                        <th class="text-nowrap">Expiry date</th>
                        <th class="text-nowrap">Actions</th> 
                    </tr>
                </thead>
                <tbody>    
                    <?php
                    $count = 1;
                    foreach ($activity_class as $table_record) {
                        // $status = ($table_record["is_active"] == 0 ? "<i class='icon ion-md-checkmark-circle text-success'></i>" : "<i class='icon ion-md-close-circle text-danger'></i>" );
                        $this->db->select('*');
                        $this->db->where('id',$table_record['user_id']);
                        $this->db->from('user_register');
                        $user = $this->db->get()->result_array();
                        if($table_record['status'] == 1){
                            if($table_record['position_id'] == 4){
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
                        if($table_record['position_id'] == 1){$plan = "PLATINUM";}
                        else if($table_record['position_id'] == 2){$plan = "PREMIUM";}
                        else if($table_record['position_id'] == 3){$plan = "SPECTRUM";}
                        else{ $plan = "TRIAL";}
                        echo "<tr>"
                        . "<td class=' align-middle text-center'>" . $count . "</td>"
                        . "<td class=' align-middle'> " . ucfirst($user[0]["name"]) . "</td>"
                        . "<td class=' align-middle'> " . ucfirst($table_record["institute_name"]) . "</td>"
                        . "<td  align='center' class=' align-middle'>" . $plan . "</td>"
                        . "<td  align='center' class=' align-middle'>" . $table_record["paid"] . "</td>"
                        . "<td  align='center' class=' align-middle'>" . date('d-m-Y',strtotime($table_record["created_at"])) . "</td>"
                        . "<td align='center' class=' align-middle'>" . $status . "</td>"
                        . "<td align='center' class=' align-middle'>" . $date . "</td>"
                        . "<td class='text-center align-middle'>"
                        . "<a href='". base_url("admin/schools/institute_edit?id=". base64_encode($table_record["id"]))."' class='btn btn-outline-info py-0 mr-1 mb-2 mb-md-0'>Edit</a>"
                        . "<a href='". base_url("admin/schools/institute_delete?id=". base64_encode($table_record["id"]))."' class='delete btn btn-outline-danger  py-0 mr-1  mb-2  mb-md-0 delete'>Delete</a>"
                        . "<a href='". base_url("admin/schools/view_activityclass?id=". base64_encode($table_record["id"]))."'  class='btn btn-outline-dark  py-0 mb-2  mb-md-0'>View</a>"
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

    $('.delete').click(function () {
        return confirm('Are you sure, want to Delete....!!!')
    })
</script>
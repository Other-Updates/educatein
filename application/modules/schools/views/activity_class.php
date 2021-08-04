<div class="d-flex col-12   mt-3 bg-white pb-3"> 
    <div class="mr-auto"><h3 ><?php echo $formName; ?></h3></div> 
    <a  class="btn btn-outline-red  ml-auto" href="#"><i class="fas fa-plus"></i> Add Institute</a>
</div>
<div class="col-12 mt-0 bg-white">
    <div class="table-responsive">
        <table class="table table-bordered table-sm bg-white" id="example">
            <thead>
                <tr class="text-center">
                    <th class="text-nowrap">#</th>                     
                    <th class="text-nowrap">Name</th>
                    <th class="text-nowrap">Actions</th> 
                </tr>
            </thead>
            <tbody>    
                <?php
                $count = 1;
                foreach ($activity_class as $table_record) {
                    $status = ($table_record["is_active"] == 0 ? "<i class='icon ion-md-checkmark-circle text-success'></i>" : "<i class='icon ion-md-close-circle text-danger'></i>" );
                    echo "<tr>"
                    . "<td class=' align-middle text-center'>" . $count . "</td>"
                    . "<td class=' align-middle'> " . $table_record["institute_name"] . "</td>"
                    . "<td class='text-center align-middle'>"
                    . "<a href='#' class='btn btn-outline-info py-0 mr-1 mb-2 mb-md-0'>Edit</a>"
                    . "<a href='#' class='delete btn btn-outline-danger  py-0 mr-1  mb-2  mb-md-0'>Delete</a>"
                    . "<a href='". base_url("admin/schools/institute_details/". base64_encode($table_record["id"]))."'  class='btn btn-outline-dark  py-0 mb-2  mb-md-0'>View</a>"
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
</script>
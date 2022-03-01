<?php 
if(($role == 'admin') || ($role == 'staff')){
    ?>
    <div class="card">
        <div class="card-body">
            <h4 class="text-dark">Education information</h4>
            <hr>
                <div class="row">
                    <div class="col-12 col-sm-3">Full name : <span class="text-danger">*</span></div>
                    <div class="col-12 col-sm-9 text-dark">
                        <div class="form-group">
                            <input type="text" readonly class="form-control" value="<?php echo  $target_info['PREFIX']."".$target_info['FNAME']." ".$target_info['MNAME']." ".$target_info['LNAME']; ?>">
                        </div>
                    </div>
                    <div class="col-12 col-sm-3">Student ID : <span class="text-danger">*</span></div>
                    <div class="col-12 col-sm-9 text-white">
                        <div class="form-group">
                            <input type="text" class="form-control" id="txtUsername" value="<?php echo $target_info['USERNAME']; ?>" readonly>
                        </div>    
                    </div>
                </div>
        </div>
    </div>

    <div class="card">
        <div class="card-body">
            <div class="row">
                <div class="col-10"><h4 class="text-dark">Study Progress</h4></div>
                <div class="col-2 text-right"><button class="btn btn-outline-secondary btn-icon"><i class="bx bx-plus"></i></button></div>
            </div>
            <div class="table responsive">
                <table class="table table-striped">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Scholaship's name</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td colspan="2">No scholarship found.</td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <?php                    
}                    
?>


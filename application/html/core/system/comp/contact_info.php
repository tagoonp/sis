<div class="card">
    <div class="card-header bg-secondary">
        <h3 class="text-white mb-0">Contact information</h3>
    </div>
    <div class="card-body pt-2 pb-0">
        <h4 class="text-dark pb-1">Contact in Thailand</h4>
        <div class="row">
            <div class="col-md-6">
                <div class="form-group">
                    <label>Email : <span class="text-danger">*</span></label>
                    <input type="email" id="txtEmail" class="form-control" name="txtEmail" placeholder="Your e-mail address" value="<?php echo $std_basic_info['EMAIL']; ?>">
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group">
                    <label>Contact phone in Thailand : </label>
                    <input type="text" id="txtPhone" class="form-control" name="txtPhone" placeholder="Your phone contact number in Thailand" value="<?php echo $std_basic_info['std_tel']; ?>">
                </div>
            </div>
            <div class="col-md-12">
                <div class="form-group">
                    <label>Address Thailand : </label>
                    <textarea name="txtAddress" class="form-control" id="txtAddress" cols="30" rows="3" placeholder="Enter address in Thailand"><?php echo $std_basic_info['std_address']; ?></textarea>
                </div>
            </div>
        </div>
    </div>
    
    <div class="card-body pt-0">
            <hr>
            <h4 class="text-dark pb-1 pt-1">Home address</h4>
            <div class="row">
                <div class="col-md-12">
                    <div class="form-group">
                        <label>Home contact number : </label>
                        <input type="text" id="txtHomeTel" class="form-control" name="txtHomeTel" placeholder="Enter your home contact number" value="<?php echo $std_basic_info['std_hm_tel']; ?>">
                    </div>
                </div>
                <div class="col-md-12">
                    <div class="form-group">
                        <label>Home address : </label>
                        <textarea name="txtHomeAddress" class="form-control" id="txtHomeAddress" cols="30" rows="3" placeholder="Enter your home address"><?php echo $std_basic_info['std_hm_address']; ?></textarea>
                    </div>
                </div>
            </div>
        </div>

        <div class="card-body pt-0">
            <hr>
            <h4 class="text-dark pb-1 pt-1">Workplace address</h4>
            <div class="row">
                <div class="col-md-12">
                    <div class="form-group">
                        <label>Workplace contact number : </label>
                        <input type="text" id="txtWorkplaceTel" class="form-control" name="txtWorkplaceTel" placeholder="Enter your workplace contact number" value="<?php echo $std_basic_info['std_wk_tel']; ?>">
                    </div>
                </div>
                <div class="col-md-12">
                    <div class="form-group">
                        <label>Workplace address : </label>
                        <textarea name="txtWorkplaceAddress" class="form-control" id="txtWorkplaceAddress" cols="30" rows="3" placeholder="Enter your workplace address"><?php echo $std_basic_info['std_wk_address']; ?></textarea>
                    </div>
                </div>
                <div class="col-sm-12 text-center pt-2">
                    <button type="button" class="btn btn-primary mr-1" onclick="student.update_address('<?php echo $std_basic_info['USERNAME']; ?>')">Update address</button>
                </div>
            </div>
        </div>
</div>
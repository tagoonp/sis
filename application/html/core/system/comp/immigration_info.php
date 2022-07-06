<div class="card">
    <div class="card-header bg-secondary">
        <h3 class="text-white mb-0">Immigration information</h3>
    </div>
    
    <div class="card-body pt-2 pb-0">
            <h4 class="text-dark pb-1">Thai citizen info</h4>
            <div class="row">
                <div class="col-md-12">
                    <div class="form-group">
                        <label>Identification number : </label>
                        <input type="text" id="txtCid" class="form-control" name="txtCid" placeholder="Identification number" value="<?php if($std_basic_info['std_idcard'] != null) echo base64_decode($std_basic_info['std_idcard']); ?>">
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label>Issue date : </label>    
                        <input type="date" id="txtCidIssue" class="form-control" name="txtCidIssue" placeholder="Issue date" value="<?php echo $std_basic_info['std_idcard_issue']; ?>">
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label>Expire date : </label>
                        <input type="date" id="txtCidExp" class="form-control" name="txtCidExp" placeholder="Expire date" value="<?php echo $std_basic_info['std_idcard_expire']; ?>">
                    </div>
                </div>
            </div>
        </div>

        <div class="card-body pt-0">
            <hr>
            <h4 class="text-dark pb-1 pt-1">VISA</h4>
            <div class="row">
                <div class="col-md-12">
                    <div class="form-group">
                        <label>VISA number : </label>
                        <input type="text" id="txtVisa" class="form-control" name="txtVisa" placeholder="Your VISA number" value="<?php if($std_basic_info['std_visa_id'] != null) echo base64_decode($std_basic_info['std_visa_id']); ?>">
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label>Issue date : </label>
                        <input type="date" id="txtVisaIssue" class="form-control" name="txtVisaIssue" placeholder="Your e-mail address" value="<?php echo $std_basic_info['std_visa_issue']; ?>">
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label>Expire date : </label>
                        <input type="date" id="txtVisaExp" class="form-control" name="txtVisaExp" placeholder="Your e-mail address" value="<?php echo $std_basic_info['std_visa_expire']; ?>">
                    </div>
                </div>
            </div>
        </div>

        <div class="card-body pt-0">
            <hr>
            <h4 class="text-dark pb-1 pt-1">Passport</h4>
            <div class="row">
                <div class="col-md-12">
                    <div class="form-group">
                        <label>Passport number : </label>
                        <input type="text" id="txtPassport" class="form-control" name="txtPassport" placeholder="Your passport number" value="<?php if($std_basic_info['std_passport_id'] != null) echo base64_decode($std_basic_info['std_passport_id']); ?>">
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label>Issue date : </label>
                        <input type="date" id="txtPassportIssue" class="form-control" name="txtPassportIssue" placeholder="Your e-mail address" value="<?php echo $std_basic_info['std_passport_issue']; ?>">
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label>Expire date : </label>
                        <input type="date" id="txtPassportExp" class="form-control" name="txtPassportExp" placeholder="Your e-mail address" value="<?php echo $std_basic_info['std_passport_expire']; ?>">
                    </div>
                </div>
                <div class="col-sm-12 text-center pt-2">
                    <button type="button" class="btn btn-primary mr-1" onclick="student.update_immigration('<?php echo $std_basic_info['USERNAME']; ?>')">Update info</button>
                </div>
            </div>
            
        </div>
    
</div>
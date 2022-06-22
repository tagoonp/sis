<div class="col-12 pl-0 pr-0">
    <div class="card">
        <div class="card-header bg-secondary">
            <h3 class="text-white mb-0">Basic information</h3>
        </div>
        <div class="card-body pt-2">
            <div class="row">
                <div class="col-12 col-sm-4">Photo
                    <div class="pt-0 pb-2">
                        <button class="btn btn-icon pl-1 pr-1 btn-outline-secondary btn-sm" data-toggle="modal" data-target="#modalUploadPhoto" style="padding: 5px 10px 8px 10px; "><i class="bx bx-camera"></i> Upload image</button>
                    </div>
                </div>
                <div class="col-12 col-sm-8">
                    <?php 
                    if(($currentUser['PHOTO'] != '') && ($currentUser['PHOTO'] != null)){
                        if (@getimagesize($currentUser['PHOTO'])) {
                            ?>
                            <img class="round mb-1" src="<?php echo $currentUser['PHOTO']; ?>" alt="avatar" width="100">
                            <?php
                        }else{
                            ?>
                            <img class="round mb-1" src="../../../app-assets/images/portrait/small/avatar-s-11.jpg" alt="avatar" width="100">
                            <?php 
                        }
                    }else{
                        ?>
                        <img class="round mb-1" src="../../../app-assets/images/portrait/small/avatar-s-11.jpg" alt="avatar" width="100">
                        <?php
                    }
                    ?>
                    
                </div>
                <div class="col-12">
                    <div class="row">
                        <div class="col-md-4">
                            <div class="form-group">
                                <label>Student ID : <span class="text-danger">*</span></label>
                                <input type="text" id="txtUsername" class="form-control" name="txtUsername" readonly placeholder="First Name" value="<?php echo $currentUser['USERNAME']; ?>">
                            </div>
                        </div>

                        <div class="col-md-4">
                            <div class="form-group">
                                <label>Degree : <span class="text-danger">*</span></label>
                                <input type="text" id="txtDegree" class="form-control" name="txtDegree" readonly placeholder="First Name" value="<?php if($currentUser['std_degree'] == '1'){ echo "M.Sc."; }else if($currentUser['std_degree'] == '2'){ echo "Ph.D."; }else{ echo "Short-course"; }; ?>">
                            </div>
                        </div>

                        <div class="col-md-4">
                            <div class="form-group">
                                <label>Country : <span class="text-danger">*</span></label>
                                <select name="txtCountry" id="txtCountry" class="form-control">
                                    <option value="">-- Select country --</option>
                                    <?php 
                                    $strSQL = "SELECT CountryName FROM sis_country WHERE 1 ORDER BY CountryName";
                                    $resCountry = $db->fetch($strSQL, true, false);
                                    if(($resCountry) && ($resCountry['status'])){
                                        foreach ($resCountry['data'] as $row) {
                                            ?>
                                            <option value="<?php echo $row['CountryName'];?>" <?php if($currentUser['std_country'] == $row['CountryName']){ echo "selected"; }?>><?php echo $row['CountryName'];?></option>
                                            <?php
                                        }
                                    }
                                    ?>
                                </select>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group">
                                <label>Name title : <span class="text-danger">*</span></label>
                                <select name="txtTitle" id="txtTitle" class="form-control">
                                    <option value="">-- Select title --</option>
                                    <?php 
                                    $strSQL = "SELECT * FROM sis_prefix WHERE student_status = 'Yes'";
                                    $res = $db->fetch($strSQL, true, false);
                                    if(($res) && ($res['status'])){
                                        foreach ($res['data'] as $row) {
                                            ?>
                                            <option value="<?php echo $row['prefix']; ?>" <?php if($row['prefix'] == $currentUser['PREFIX']){ echo "selected"; } ?>><?php echo $row['prefix']; ?></option>
                                            <?php
                                        }
                                    }
                                    ?>
                                </select>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group">
                                <label>First Name : <span class="text-danger">*</span></label>
                                <input type="text" id="txtFname" class="form-control" name="txtFname" placeholder="First Name" value="<?php echo $currentUser['FNAME']; ?>">
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group">
                                <label>Middle Name :</label>
                                <input type="text" id="txtMname" class="form-control" name="txtMname" placeholder="Middle Name" value="<?php echo $currentUser['MNAME']; ?>">
                            </div>
                            
                        </div>
                        
                        <div class="col-md-3">
                            <div class="form-group">
                                <label>Last Name : <span class="text-danger">*</span></label>
                                <input type="text" id="txtLname" class="form-control" name="txtLname" placeholder="Last Name" value="<?php echo $currentUser['LNAME']; ?>">
                            </div>
                        </div>
                        
                        <div class="col-sm-12 text-center pt-2">
                            <button type="button" class="btn btn-primary mr-1" onclick="student.update_profile('<?php echo $currentUser['USERNAME']; ?>')">Update record</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

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
                        <input type="email" id="txtEmail" class="form-control" name="txtEmail" placeholder="Your e-mail address" value="<?php echo $currentUser['EMAIL']; ?>">
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label>Contact phone in Thailand : </label>
                        <input type="text" id="txtPhone" class="form-control" name="txtPhone" placeholder="Your phone contact number in Thailand" value="<?php echo $currentUser['std_tel']; ?>">
                    </div>
                </div>
                <div class="col-md-12">
                    <div class="form-group">
                        <label>Address Thailand : </label>
                        <textarea name="txtAddress" class="form-control" id="txtAddress" cols="30" rows="3" placeholder="Enter address in Thailand"><?php echo $currentUser['std_address']; ?></textarea>
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
                        <input type="text" id="txtHomeTel" class="form-control" name="txtHomeTel" placeholder="Enter your home contact number" value="<?php echo $currentUser['std_hm_tel']; ?>">
                    </div>
                </div>
                <div class="col-md-12">
                    <div class="form-group">
                        <label>Home address : </label>
                        <textarea name="txtHomeAddress" class="form-control" id="txtHomeAddress" cols="30" rows="3" placeholder="Enter your home address"><?php echo $currentUser['std_hm_address']; ?></textarea>
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
                        <input type="text" id="txtWorkplaceTel" class="form-control" name="txtWorkplaceTel" placeholder="Enter your workplace contact number" value="<?php echo $currentUser['std_wk_tel']; ?>">
                    </div>
                </div>
                <div class="col-md-12">
                    <div class="form-group">
                        <label>Workplace address : </label>
                        <textarea name="txtWorkplaceAddress" class="form-control" id="txtWorkplaceAddress" cols="30" rows="3" placeholder="Enter your workplace address"><?php echo $currentUser['std_wk_address']; ?></textarea>
                    </div>
                </div>
                <div class="col-sm-12 text-center pt-2">
                    <button type="button" class="btn btn-primary mr-1" onclick="student.update_address('<?php echo $currentUser['USERNAME']; ?>')">Update address</button>
                </div>
            </div>
        </div>
    </div>

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
                        <input type="text" id="txtCid" class="form-control" name="txtCid" placeholder="Your e-mail address" value="<?php echo base64_decode($currentUser['std_idcard']); ?>">
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label>Issue date : </label>
                        <input type="date" id="txtCidIssue" class="form-control" name="txtCidIssue" placeholder="Your e-mail address" value="<?php echo $currentUser['std_idcard_issue']; ?>">
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label>Expire date : </label>
                        <input type="date" id="txtCidExp" class="form-control" name="txtCidExp" placeholder="Your e-mail address" value="<?php echo $currentUser['std_idcard_expire']; ?>">
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
                        <input type="text" id="txtVisa" class="form-control" name="txtVisa" placeholder="Your VISA number" value="<?php echo base64_decode($currentUser['std_visa_id']); ?>">
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label>Issue date : </label>
                        <input type="date" id="txtVisaIssue" class="form-control" name="txtVisaIssue" placeholder="Your e-mail address" value="<?php echo $currentUser['std_visa_issue']; ?>">
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label>Expire date : </label>
                        <input type="date" id="txtVisaExp" class="form-control" name="txtVisaExp" placeholder="Your e-mail address" value="<?php echo $currentUser['std_visa_expire']; ?>">
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
                        <input type="text" id="txtPassport" class="form-control" name="txtPassport" placeholder="Your passport number" value="<?php echo base64_decode($currentUser['std_visa_id']); ?>">
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label>Issue date : </label>
                        <input type="date" id="txtPassportIssue" class="form-control" name="txtPassportIssue" placeholder="Your e-mail address" value="<?php echo $currentUser['std_visa_issue']; ?>">
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label>Expire date : </label>
                        <input type="date" id="txtPassportExp" class="form-control" name="txtPassportExp" placeholder="Your e-mail address" value="<?php echo $currentUser['std_visa_expire']; ?>">
                    </div>
                </div>
                <div class="col-sm-12 text-center pt-2">
                    <button type="button" class="btn btn-primary mr-1" onclick="student.update_immigration('<?php echo $currentUser['USERNAME']; ?>')">Update info</button>
                </div>
            </div>
            
        </div>
    </div>


    

    
</div>


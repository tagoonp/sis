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
                        <div class="col-md-12">
                            <div class="form-group">
                                <label>Username : <span class="text-danger">*</span></label>
                                <input type="text" id="txtUsername" class="form-control" name="txtUsername" readonly placeholder="First Name" value="<?php echo $currentUser['USERNAME']; ?>">
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
                <div class="col-md-12">
                    <div class="form-group">
                        <label>Email : <span class="text-danger">*</span></label>
                        <input type="email" id="txtEmail" class="form-control" name="txtEmail" placeholder="Your e-mail address" value="<?php echo $currentUser['EMAIL']; ?>">
                    </div>
                </div>
            </div>
        </div>
    </div>


    

    
</div>


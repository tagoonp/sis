<div class="card">
    <div class="card-body">
        <h4 class="text-dark">Basic information</h4>
        <p>Some info may be visible to other people using DOE services.</p>
        <?php 
            if(($role == 'admin') || ($role == 'staff')){
                    ?>
                    <div class="row">
                        <div class="col-12 col-sm-4">Photo</div>
                        <div class="col-12 col-sm-8">
                            <?php 
                            if(($target_info['PHOTO'] != '') && ($target_info['PHOTO'] != null)){
                                if (@getimagesize($target_info['PHOTO'])) {
                                    ?>
                                    <img class="round mb-1" src="<?php echo $target_info['PHOTO']; ?>" alt="avatar" height="160" width="160">
                                    <?php
                                }else{
                                    ?>
                                    <img class="round mb-1" src="../../../app-assets/images/portrait/small/avatar-s-11.jpg" alt="avatar" height="160" width="160">
                                    <?php 
                                }
                            }else{
                                ?>
                                <img class="round mb-1" src="../../../app-assets/images/portrait/small/avatar-s-11.jpg" alt="avatar" height="160" width="160">
                                <?php
                            }
                            ?>
                            <div class="pt-0 pb-2">
                                <button class="btn btn-icon pl-1 pr-1 btn-outline-secondary btn-sm"><i class="bx bx-camera"></i></button>
                            </div>
                        </div>
                        <div class="col-12 col-sm-4">Full name : <span class="text-danger">*</span></div>
                        <div class="col-12 col-sm-8 text-dark">
                            <div class="row">
                                    <div class="col-3">
                                        <div class="form-group">
                                            <select name="txtPrefix" id="txtPrefix" class="form-control">
                                                <option value="" selected>-- Prefix --</option>
                                                <?php 
                                                $strSQL = "SELECT * FROM sis_prefix WHERE status = 'Yes'";
                                                $resPrefix = $db->fetch($strSQL, true, false);
                                                if(($resPrefix) && ($resPrefix['status'])){
                                                    foreach ($resPrefix['data'] as $row) {
                                                        ?><option value="<?php echo $row['prefix']; ?>" <?php if($target_info['PREFIX'] == $row['prefix']){ echo "selected";} ?>><?php echo $row['prefix']; ?></option><?php
                                                    }
                                                }
                                                ?>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-3">
                                        <div class="form-group">
                                            <input type="text" class="form-control" id="txtFname" value="<?php echo $target_info['FNAME'];?>">
                                        </div>
                                    </div>
                                    <div class="col-3">
                                        <div class="form-group">
                                            <input type="text" class="form-control" id="txtMname" value="<?php echo $target_info['MNAME'];?>">
                                        </div>
                                    </div><div class="col-3">
                                        <div class="form-group">
                                            <input type="text" class="form-control" id="txtLname" value="<?php echo $target_info['LNAME'];?>">
                                        </div>
                                    </div>
                                </div>
                        </div>
                        <div class="col-12 col-sm-4">Student ID : <span class="text-danger">*</span></div>
                        <div class="col-12 col-sm-8 text-white">
                            <div class="form-group">
                                <input type="text" class="form-control" id="txtUsername" value="<?php echo $target_info['USERNAME']; ?>">
                            </div>    
                        </div>
                        <div class="col-12 col-sm-4">Role : <span class="text-danger">*</span></div>
                        <div class="col-12 col-sm-8 text-white">
                            <div class="form-group">
                                <select name="txtUserRole" id="txtUserRole" class="form-control">
                                    <option value="" selected>-- Role --</option>
                                    <option value="admin" <?php if($target_info['ROLE'] == 'admin'){ echo "selected";} ?>>Administrator</option>
                                    <option value="staff" <?php if($target_info['ROLE'] == 'staff'){ echo "selected";} ?>>Staff</option>
                                    <option value="lecturer" <?php if($target_info['ROLE'] == 'lecturer'){ echo "selected";} ?>>Lecturer</option>
                                    <option value="student" <?php if($target_info['ROLE'] == 'student'){ echo "selected";} ?>>Student</option>
                                    <option value="common" <?php if($target_info['ROLE'] == 'common'){ echo "selected";} ?>>Common</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-12 col-sm-4">Position</div>
                        <div class="col-12 col-sm-8 text-white">
                            <div class="form-group">
                                <input type="text" class="form-control" id="txtPosition" value="<?php echo $target_info['POSITION'];?>">
                            </div>
                        </div>
                        <div class="col-12 col-sm-8 offset-sm-4">
                            <div class="pt-1 pb-2">
                            <button type="button" class="btn btn-icon- btn-secondary btn-sm- pl-1 pr-2" onclick="user.update_info('<?php echo $target_uid; ?>')" style="padding-bottom: 8px;"><i class="bx bx-pencil"></i> Update basic info</button>
                            </div>
                        </div>
                    </div>
                    <?php
                }else{
                    ?>
                    <div class="row">
                        <div class="col-12 col-sm-4">Photo</div>
                        <div class="col-12 col-sm-8">
                            <?php 
                            if(($currentUser['PHOTO'] != '') && ($currentUser['PHOTO'] != null)){
                                if (@getimagesize($currentUser['PHOTO'])) {
                                    ?>
                                    <img class="round mb-1" src="<?php echo $currentUser['PHOTO']; ?>" alt="avatar" height="160" width="160">
                                    <?php
                                }else{
                                    ?>
                                    <img class="round mb-1" src="../../../app-assets/images/portrait/small/avatar-s-11.jpg" alt="avatar" height="160" width="160">
                                    <?php 
                                }
                            }else{
                                ?>
                                <img class="round mb-1" src="../../../app-assets/images/portrait/small/avatar-s-11.jpg" alt="avatar" height="160" width="160">
                                <?php
                            }
                            ?>
                        </div>
                        <div class="col-12 col-sm-4">Full name</div>
                        <div class="col-12 col-sm-8 text-dark">
                            <?php 
                            echo $target_info['PREFIX']." ".$target_info['FNAME']." ".$target_info['MNAME']." ".$target_info['LNAME'];
                            ?>
                        </div>
                        <div class="col-12 col-sm-4">Personnal ID / ID</div>
                        <div class="col-12 col-sm-8 text-white"><?php echo $currentUser['PID']; ?></div>
                        <div class="col-12 col-sm-4">Role</div>
                        <div class="col-12 col-sm-8 text-white">
                            <?php echo $target_info['ROLE']; ?>
                        </div>
                        <div class="col-12 col-sm-4">Position</div>
                        <div class="col-12 col-sm-8 text-white">
                        <?php echo $target_info['POSITION'];?>
                        </div>
                        <div class="col-12 col-sm-8 offset-sm-4">
                            <div class="pt-1 pb-2">
                                <button type="button" class="btn btn-icon- btn-outline-secondary btn-sm- pl-1 pr-2" onclick="user.update_info('<?php echo $target_uid; ?>')" style="padding-bottom: 8px;"><i class="bx bx-pencil"></i> Update basic info</button>
                            </div>
                        </div>
                    </div>
                    <?php
                }
        ?>
        
    </div>
</div>
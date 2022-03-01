<div class="card">
                        <div class="card-body">
                            <div class="row">
                                <div class="col-12 text-center">
                                    <?php 
                                    if(($currentUser['PHOTO'] != '') && ($currentUser['PHOTO'] != null)){
                                        if (@getimagesize($currentUser['PHOTO'])) {
                                            ?>
                                            <img class="round mb-1" src="<?php echo $currentUser['PHOTO']; ?>" alt="avatar" height="150" width="150">
                                            <?php
                                        }else{
                                            ?>
                                            <img class="round mb-1" src="../../../app-assets/images/portrait/small/avatar-s-11.jpg" alt="avatar" height="200" width="200">
                                            <?php 
                                        }
                                    }else{
                                        ?>
                                        <img class="round mb-1" src="../../../app-assets/images/portrait/small/avatar-s-11.jpg" alt="avatar" height="60" width="60">
                                        <?php
                                    }
                                    ?>
                                </div>
                                <div class="col-12 text-center">
                                    <h3 class="text-dark"><?php echo $target_info['FNAME']." ".$target_info['LNAME']; ?></h3>
                                    <h5 class="text-dark"><span class="badge badge-success round">ID : <?php echo $target_info['USERNAME']; ?></span></h5>
                                    <div class="pt-0 pb-2">
                                        <button class="btn btn-icon pl-1 pr-1 btn-outline-secondary btn-sm"><i class="bx bx-camera"></i></button>
                                    </div>
                                </div>
                                <div class="col-12 col-sm-4">Full name</div>
                                <div class="col-12">
                                    <div class="form-group">
                                        <select name="txtPrefix" id="txtPrefix" class="form-control">
                                            <option value="" selected>-- Prefix --</option>
                                            <?php 
                                            $strSQL = "SELECT * FROM sis_prefix WHERE status = 'Y'";
                                            $resPrefix = $db->fetch($strSQL, true, true);
                                            if(($resPrefix) && ($resPrefix['status'])){
                                                foreach ($resPrefix['data'] as $row) {
                                                    ?>
                                                    <option value="<?php echo $row['prefix'];?>" <?php if($row['prefix'] == $target_info['PREFIX']){ echo "selected";} ?> ><?php echo $row['prefix'];?></option>
                                                    <?php
                                                }
                                            }
                                            ?>
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <input type="text" class="form-control" id="txtFname" value="<?php echo $target_info['FNAME'];?>">
                                    </div>
                                    <div class="form-group">
                                        <input type="text" class="form-control" id="txtMname" value="<?php echo $target_info['MNAME'];?>">
                                    </div>
                                    <div class="form-group">
                                        <input type="text" class="form-control" id="txtLname" value="<?php echo $target_info['LNAME'];?>">
                                    </div>
                                </div>

                                <?php 
                                    if(($role == 'admin') || ($role == 'staff')){
                                        ?>
                                        <div class="col-12">Role</div>
                                        <div class="col-12">
                                            <div class="form-group">
                                                <select name="txtPrefix" id="txtPrefix" class="form-control">
                                                    <option value="" selected>-- Role --</option>
                                                    <option value="admin" <?php if($target_info['ROLE'] == 'admin'){ echo "selected";} ?>>Administrator</option>
                                                    <option value="staff" <?php if($target_info['ROLE'] == 'staff'){ echo "selected";} ?>>Staff</option>
                                                    <option value="lecturer" <?php if($target_info['ROLE'] == 'lecturer'){ echo "selected";} ?>>Lecturer</option>
                                                    <option value="student" <?php if($target_info['ROLE'] == 'student'){ echo "selected";} ?>>Student</option>
                                                    <option value="common" <?php if($target_info['ROLE'] == 'common'){ echo "selected";} ?>>Common</option>
                                                </select>
                                            </div>
                                        </div>
                                        <?php
                                    }
                                    ?>


                                <div class="col-12 col-sm-4">Personnal ID / ID</div>
                                <div class="col-12 col-sm-8 text-white"><?php echo $currentUser['PID']; ?></div>
                                <div class="col-12 col-sm-4">Position</div>
                                <div class="col-12 col-sm-8 text-white">
                                    <?php 
                                    if(($currentUser['POSITION'] == null) || ($currentUser['POSITION'] == '')){
                                        echo "-";
                                    }
                                    ?>
                                </div>
                                <div class="col-12 col-sm-8 offset-sm-4">
                                    <div class="pt-1 pb-2">
                                        <button class="btn btn-icon- btn-outline-secondary btn-sm- pl-1 pr-2" style="padding-bottom: 8px;"><i class="bx bx-pencil"></i> Update basic info</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
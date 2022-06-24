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
                if(($std_basic_info['PHOTO'] != '') && ($std_basic_info['PHOTO'] != null)){
                    if (@getimagesize($std_basic_info['PHOTO'])) {
                        ?>
                        <img class="round mb-1" src="<?php echo $std_basic_info['PHOTO']; ?>" alt="avatar" width="100">
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
                            <input type="text" id="txtUsername" class="form-control" name="txtUsername" readonly placeholder="First Name" value="<?php echo $std_basic_info['USERNAME']; ?>">
                        </div>
                    </div>

                    <div class="col-md-4">
                        <div class="form-group">
                            <label>Degree : <span class="text-danger">*</span></label>
                            <input type="text" id="txtDegree" class="form-control" name="txtDegree" readonly placeholder="First Name" value="<?php if($std_basic_info['std_degree'] == '1'){ echo "M.Sc."; }else if($std_basic_info['std_degree'] == '2'){ echo "Ph.D."; }else{ echo "Short-course"; }; ?>">
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
                                        <option value="<?php echo $row['CountryName'];?>" <?php if($std_basic_info['std_country'] == $row['CountryName']){ echo "selected"; }?>><?php echo $row['CountryName'];?></option>
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
                                        <option value="<?php echo $row['prefix']; ?>" <?php if($row['prefix'] == $std_basic_info['PREFIX']){ echo "selected"; } ?>><?php echo $row['prefix']; ?></option>
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
                            <input type="text" id="txtFname" class="form-control" name="txtFname" placeholder="First Name" value="<?php echo $std_basic_info['FNAME']; ?>">
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="form-group">
                            <label>Middle Name :</label>
                            <input type="text" id="txtMname" class="form-control" name="txtMname" placeholder="Middle Name" value="<?php echo $std_basic_info['MNAME']; ?>">
                        </div>
                        
                    </div>
                    
                    <div class="col-md-3">
                        <div class="form-group">
                            <label>Last Name : <span class="text-danger">*</span></label>
                            <input type="text" id="txtLname" class="form-control" name="txtLname" placeholder="Last Name" value="<?php echo $std_basic_info['LNAME']; ?>">
                        </div>
                    </div>
                    
                    <div class="col-sm-12 text-center pt-2">
                        <button type="button" class="btn btn-primary mr-1" onclick="student.update_profile('<?php echo $std_basic_info['USERNAME']; ?>')">Update record</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
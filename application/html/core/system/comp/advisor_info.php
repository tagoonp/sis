<div class="card">
    <div class="card-header bg-secondary">
        <h3 class="text-white mb-0">Advisors</h3>
    </div>
    <div class="card-body pt-2 pb-0">
        <h6 class="text-dark">Main advisor</h6>
        <div class="card nadv">
            <div class="card-body">
                <?php 
                $strSQL = "SELECT * FROM sis_advisor a INNER JOIN sis_userinfo b ON a.adv_username = b.USERNAME
                            LEFT JOIN sis_account c ON a.adv_username = c.USERNAME
                            WHERE adv_delete = '0' AND adv_std_id = '$id' AND adv_type = 'main'";
                $resMain = $db->fetch($strSQL, false, false);
                if($resMain){
                    ?>
                    <div class="row">
                        <div class="col-1">
                            <?php 
                            if(($resMain['PHOTO'] == '') || ($resMain['PHOTO'] == null)){
                                ?>
                                <div class="avatar avatar-lg bg-danger mr-1" style="margin-top: -4px;">
                                    <div class="avatar-content" style="font-size: 1.2em; padding-top: 3px;">
                                        <?php echo strtoupper(substr($resMain['FNAME'], 0, 1)) ?>
                                    </div>
                                </div>
                                <?php
                            }else{
                                ?>
                                <div class="avatar mr-1 avatar-lg" style="margin-top: -4px;">
                                    <img src="<?php echo $resMain['PHOTO']; ?>" alt="avtar img holder">
                                </div>
                                <?php
                            }
                            ?>
                        </div>
                        <div class="col-9">
                            <h5 class="text-dark"><?php echo $resMain['FNAME']. " " . $resMain['LNAME']; ?></h5>
                            <h6 class="text-muted mb-0"><?php echo $resMain['EMAIL']; ?></h6>
                        </div>
                        <div class="col-2 text-right" style="padding-top: 5px;">
                            <button class="btn pl-1 pr-1" onclick="staff.setAdvDialog('main')"><i class="bx bx-pencil"></i></button>
                            <button class="btn pl-1 pr-1" onclick="staff.resetAdvDialog('main', '<?php echo $resMain['adv_id']; ?>')"><i class="bx bx-trash"></i></button>
                        </div>
                    </div>
                    <?php
                }else{
                    ?>
                    No data found. <a href="Javascript:staff.setAdvDialog('main')">- Click here to add -</a>
                    <?php
                }
                ?>
            </div>
        </div>
        <h6 class="text-dark">Co-advisor 1</h6>
        <div class="card nadv">
            <div class="card-body">
            <?php 
                $strSQL = "SELECT * FROM sis_advisor a INNER JOIN sis_userinfo b ON a.adv_username = b.USERNAME
                            LEFT JOIN sis_account c ON a.adv_username = c.USERNAME
                            WHERE adv_delete = '0' AND adv_std_id = '$id' AND adv_type = 'co1'";
                $resMain = $db->fetch($strSQL, false, false);
                if($resMain){
                    ?>
                    <div class="row">
                        <div class="col-1">
                            <?php 
                            if(($resMain['PHOTO'] == '') || ($resMain['PHOTO'] == null)){
                                ?>
                                <div class="avatar avatar-lg bg-primary mr-1" style="margin-top: -4px;">
                                    <div class="avatar-content" style="font-size: 1.2em; padding-top: 3px;">
                                        <?php echo strtoupper(substr($resMain['FNAME'], 0, 1)) ?>
                                    </div>
                                </div>
                                <?php
                            }else{
                                ?>
                                <div class="avatar mr-1 avatar-lg" style="margin-top: -4px;">
                                    <img src="<?php echo $resMain['PHOTO']; ?>" alt="avtar img holder">
                                </div>
                                <?php
                            }
                            ?>
                        </div>
                        <div class="col-9">
                            <h5 class="text-dark"><?php echo $resMain['FNAME']. " " . $resMain['LNAME']; ?></h5>
                            <h6 class="text-muted mb-0"><?php echo $resMain['EMAIL']; ?></h6>
                        </div>
                        <div class="col-2 text-right" style="padding-top: 5px;">
                            <button class="btn pl-1 pr-1" onclick="staff.setAdvDialog('co1')"><i class="bx bx-pencil"></i></button>
                            <button class="btn pl-1 pr-1" onclick="staff.resetAdvDialog('co1', '<?php echo $resMain['adv_id']; ?>')"><i class="bx bx-trash"></i></button>
                        </div>
                    </div>
                    <?php
                }else{
                    ?>
                    No data found. <a href="Javascript:staff.setAdvDialog('co1')">- Click here to add -</a>
                    <?php
                }
                ?>
            </div>
        </div>

        <h6 class="text-dark">Co-advisor 2</h6>
        <div class="card nadv">
            <div class="card-body">
            <?php 
                $strSQL = "SELECT * FROM sis_advisor a INNER JOIN sis_userinfo b ON a.adv_username = b.USERNAME
                            LEFT JOIN sis_account c ON a.adv_username = c.USERNAME
                            WHERE adv_delete = '0' AND adv_std_id = '$id' AND adv_type = 'co2'";
                $resMain = $db->fetch($strSQL, false, false);
                if($resMain){
                    ?>
                    <div class="row">
                        <div class="col-1">
                            <?php 
                            if(($resMain['PHOTO'] == '') || ($resMain['PHOTO'] == null)){
                                ?>
                                <div class="avatar avatar-lg bg-primary mr-1" style="margin-top: -4px;">
                                    <div class="avatar-content" style="font-size: 1.2em; padding-top: 3px;">
                                        <?php echo strtoupper(substr($resMain['FNAME'], 0, 1)) ?>
                                    </div>
                                </div>
                                <?php
                            }else{
                                ?>
                                <div class="avatar mr-1 avatar-lg" style="margin-top: -4px;">
                                    <img src="<?php echo $resMain['PHOTO']; ?>" alt="avtar img holder">
                                </div>
                                <?php
                            }
                            ?>
                        </div>
                        <div class="col-9">
                            <h5 class="text-dark"><?php echo $resMain['FNAME']. " " . $resMain['LNAME']; ?></h5>
                            <h6 class="text-muted mb-0"><?php echo $resMain['EMAIL']; ?></h6>
                        </div>
                        <div class="col-2 text-right" style="padding-top: 5px;">
                            <button class="btn pl-1 pr-1" onclick="staff.setAdvDialog('co2')"><i class="bx bx-pencil"></i></button>
                            <button class="btn pl-1 pr-1" onclick="staff.resetAdvDialog('co2', '<?php echo $resMain['adv_id']; ?>')"><i class="bx bx-trash"></i></button>
                        </div>
                    </div>
                    <?php
                }else{
                    ?>
                    No data found. <a href="Javascript:staff.setAdvDialog('co2')">- Click here to add -</a>
                    <?php
                }
                ?>
            </div>
        </div>

        <h6 class="text-dark">Co-advisor 3</h6>
        <div class="card nadv">
            <div class="card-body">
            <?php 
                $strSQL = "SELECT * FROM sis_advisor a INNER JOIN sis_userinfo b ON a.adv_username = b.USERNAME
                            LEFT JOIN sis_account c ON a.adv_username = c.USERNAME
                            WHERE adv_delete = '0' AND adv_std_id = '$id' AND adv_type = 'co3'";
                $resMain = $db->fetch($strSQL, false, false);
                if($resMain){
                    ?>
                    <div class="row">
                        <div class="col-1">
                            <?php 
                            if(($resMain['PHOTO'] == '') || ($resMain['PHOTO'] == null)){
                                ?>
                                <div class="avatar avatar-lg bg-primary mr-1" style="margin-top: -4px;">
                                    <div class="avatar-content" style="font-size: 1.2em; padding-top: 3px;">
                                        <?php echo strtoupper(substr($resMain['FNAME'], 0, 1)) ?>
                                    </div>
                                </div>
                                <?php
                            }else{
                                ?>
                                <div class="avatar mr-1 avatar-lg" style="margin-top: -4px;">
                                    <img src="<?php echo $resMain['PHOTO']; ?>" alt="avtar img holder">
                                </div>
                                <?php
                            }
                            ?>
                        </div>
                        <div class="col-9">
                            <h5 class="text-dark"><?php echo $resMain['FNAME']. " " . $resMain['LNAME']; ?></h5>
                            <h6 class="text-muted mb-0"><?php echo $resMain['EMAIL']; ?></h6>
                        </div>
                        <div class="col-2 text-right" style="padding-top: 5px;">
                            <button class="btn pl-1 pr-1" onclick="staff.setAdvDialog('co3')"><i class="bx bx-pencil"></i></button>
                            <button class="btn pl-1 pr-1" onclick="staff.resetAdvDialog('co3', '<?php echo $resMain['adv_id']; ?>')"><i class="bx bx-trash"></i></button>
                        </div>
                    </div>
                    <?php
                }else{
                    ?>
                    No data found. <a href="Javascript:staff.setAdvDialog('co3')">- Click here to add -</a>
                    <?php
                }
                ?>
            </div>
        </div>
    </div>
    
</div>

<div class="modal fade" id="modalAdvDialog" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-dialog-centered modal-dialog-scrollable">
        <div class="modal-content">
            <div class="modal-header bg-primary">
                <h5 class="modal-title text-white" id="exampleModalCenterTitle">Set advisor</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <i class="bx bx-x"></i>
                </button>
            </div>
            <div class="modal-body">
                <div class="d-none d-sm-block">
                    <div class="row">
                        <div class="col-12 col-sm-6">
                            <div class="form-group">
                                <label for="">Student ID : </label>
                                <input type="text" class="form-control" id="txtStudentId" readonly value="<?php echo $id; ?>">
                            </div>
                        </div>
                        <div class="col-12 col-sm-6">
                            <div class="form-group">
                                <label for="">Fullname : </label>
                                <input type="text" class="form-control" id="txtStudentFullname" readonly value="<?php echo $std_basic_info['FNAME']. " " . $std_basic_info['LNAME']; ?>">
                            </div>
                        </div>
                    </div>
                </div>
                
                <div class="form-group">
                    <label for="">Advisor : <span class="text-danger">*</span></label>
                    <select name="txtAdv" id="txtAdv" class="form-control">
                        <option value="">-- Select --</option>
                        <?php 
                        $strSQL = "SELECT * FROM sis_account a INNER JOIN sis_userinfo b ON a.USERNAME = b.USERNAME 
                        WHERE 
                        a.ROLE_LECTURER = 'Y' 
                        AND a.DELETE_STATUS = 'N' 
                        AND b.USE_STATUS = 'Y'
                        ";
                        $res = $db->fetch($strSQL, true, false);
                        if(($res) && ($res['status'])){
                            $c = 1;
                            foreach ($res['data'] as $row) {
                                ?>
                                <option value="<?php echo $row['USERNAME']; ?>"><?php echo $row['FNAME'] . " " . $row['LNAME']; ?></option>
                                <?php
                            }
                        }
                        ?>
                    </select>
                </div>

                <div class="form-group">
                    <label for="">Advisor type : <span class="text-danger">*</span></label>
                    <input type="text" id="txtAdvtype" class="form-control" readonly>
                </div>

            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-light-secondary" data-dismiss="modal">
                    <i class="bx bx-x d-block d-sm-none"></i>
                    <span class="d-none d-sm-block">Close</span>
                </button>
                <button type="button" class="btn btn-primary ml-1"  onclick="staff.save_advisor()">
                    <i class="bx bx-check d-block d-sm-none"></i>
                    <span class="d-none d-sm-block">Save</span>
                </button>
            </div>
        </div>
    </div>
</div>
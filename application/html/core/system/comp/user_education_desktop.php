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
                    <div class="col-12 col-sm-3">Degree : <span class="text-danger">*</span></div>
                    <div class="col-12 col-sm-9 text-white">
                        <div class="form-group">
                            <select name="txtDegree" id="txtDegree" class="form-control">
                                <option value="" selected>-- Degree --</option>
                                <option value="1" <?php if($target_info['std_degree'] == '1'){ echo "selected";} ?>>M.Sc.</option>
                                <option value="2" <?php if($target_info['std_degree'] == '2'){ echo "selected";} ?>>Ph.D.</option>
                                <option value="3" <?php if($target_info['std_degree'] == '3'){ echo "selected";} ?>>Short-course</option>
                            </select>
                        </div>
                    </div>
                    <div class="col-12 col-sm-3">Country : <span class="text-danger">*</span></div>
                    <div class="col-12 col-sm-9 text-white">
                        <div class="form-group">
                            <select name="txtCountry" id="txtCountry" class="form-control">
                                <option value="" selected>-- Country --</option>
                                <?php 
                                $strSQL = "SELECT CountryName FROM sis_country WHERE 1 ORDER BY CountryName";
                                $resCountry = $db->fetch($strSQL, true, false);
                                if(($resCountry) && ($resCountry['status'])){
                                    foreach ($resCountry['data'] as $row) {
                                        ?><option value="<?php echo $row['CountryName']; ?>" <?php if($target_info['std_country'] == $row['CountryName']){ echo "selected";} ?>><?php echo $row['CountryName']; ?></option><?php
                                    }
                                }
                                ?>
                            </select>
                        </div>
                    </div>

                    <?php 
                    $dd = '';
                    $mm = '';
                    $yy = '';

                    $b = explode('-', $target_info['std_start_edu_date']);
                    if(sizeof($b) > 1){
                        $dd = $b[2]; $mm = $b[1]; $yy = $b[0];
                    }
                    ?>

                    <div class="col-3" style="padding-top: 30px;">First study date : <span class="text-danger">*</span></div>
                    <div class="col-9">
                        <div class="row">
                            <div class="col-4">
                                <div class="form-group">
                                    <label for="">Date : <span class="text-danger">*</span></label>
                                    <select name="txtEdudate" id="txtEdudate" class="form-control">
                                        <option value="" selected> -- DD -- </option>
                                        <?php 
                                        for ($i=1; $i <= 31; $i++) { 
                                            $j = $i;
                                            if($i < 10){ $j = '0'.$i; }
                                            ?>
                                            <option value="<?php echo $j; ?>" <?php if($j == $dd){ echo "selected"; } ?>><?php echo $j; ?></option>
                                            <?php
                                        }
                                        ?>
                                    </select>
                                </div>
                            </div>
                            <div class="col-4">
                                <div class="form-group">
                                    <label for="">Month : <span class="text-danger">*</span></label>
                                    <select name="txtEdumonth" id="txtEdumonth" class="form-control">
                                        <option value="" selected> -- MM -- </option>
                                        <?php 
                                        for ($i=1; $i <= 12; $i++) { 
                                            $j = $i;
                                            if($i < 10){ $j = '0'.$i; }
                                            ?>
                                            <option value="<?php echo $j; ?>" <?php if($j == $mm){ echo "selected"; } ?>><?php echo $j; ?></option>
                                            <?php
                                        }
                                        ?>
                                    </select>
                                </div>
                            </div>
                            <div class="col-4">
                                <div class="form-group">
                                    <label for="">Year : <span class="text-danger">*</span></label>
                                    <select name="txtEduyear" id="txtEduyear" class="form-control">
                                        <option value="" selected> -- YYYY -- </option>
                                        <?php 
                                        for ($i=date('Y'); $i >=( date('Y') - 40); $i--) { 
                                            $j = $i;
                                            ?>
                                            <option value="<?php echo $j; ?>" <?php if($j == $yy){ echo "selected"; } ?>><?php echo $j; ?></option>
                                            <?php
                                        }
                                        ?>
                                    </select>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-12">
                        <div class="row">
                            <div class="col-3">Start academic year : <span class="text-danger">*</span></div>
                            <div class="col-9">
                                <div class="form-group">
                                    <input type="text" class="form-control" id="txtAcademicYear" placeholder="Enter only number ex. 2021" value="<?php echo $target_info['std_start_year']; ?>">
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-12">
                        <div class="row">
                            <div class="col-3">Study Status : <span class="text-danger">*</span></div>
                            <div class="col-9">
                                <div class="form-group">
                                    <select name="txtStatus" id="txtStatus" class="form-control">
                                        <option value="" selected>-- status --</option>
                                        <option value="studying" <?php if($target_info['std_study_status'] == 'studying'){ echo "selected";} ?>>Studying</option>
                                        <option value="graduated" <?php if($target_info['std_study_status'] == 'graduated'){ echo "selected";} ?>>Graduated</option>
                                        <option value="retired" <?php if($target_info['std_study_status'] == 'retired'){ echo "selected";} ?>>Retired</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                    </div>

                    <?php 
                    $dd = '';
                    $mm = '';
                    $yy = '';
                    $b = array();
                    if($target_info['std_study_status'] == 'graduated'){
                        $b = explode('-', $target_info['std_grad_date']);
                        if(sizeof($b) > 1){
                            $dd = $b[2]; $mm = $b[1]; $yy = $b[0];
                        }
                    }
                    
                    ?>

                    <div class="col-12">
                        <div class="row">
                            <div class="col-3" style="padding-top: 30px;">Graduated date : </div>
                            <div class="col-9">
                                <div class="row">
                                    <div class="col-4">
                                        <div class="form-group">
                                            <label for="">Date : <span class="text-danger"></span></label>
                                            <select name="txtGraddate" id="txtGraddate" class="form-control">
                                                <option value="" selected> -- DD -- </option>
                                                <?php 
                                                for ($i=1; $i <= 31; $i++) { 
                                                    $j = $i;
                                                    if($i < 10){ $j = '0'.$i; }
                                                    ?>
                                                    <option value="<?php echo $j; ?>" <?php if($j == $dd){ echo "selected"; } ?>><?php echo $j; ?></option>
                                                    <?php
                                                }
                                                ?>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-4">
                                        <div class="form-group">
                                            <label for="">Month : <span class="text-danger"></span></label>
                                            <select name="txtGradmonth" id="txtGradmonth" class="form-control">
                                                <option value="" selected> -- MM -- </option>
                                                <?php 
                                                for ($i=1; $i <= 12; $i++) { 
                                                    $j = $i;
                                                    if($i < 10){ $j = '0'.$i; }
                                                    ?>
                                                    <option value="<?php echo $j; ?>" <?php if($j == $mm){ echo "selected"; } ?>><?php echo $j; ?></option>
                                                    <?php
                                                }
                                                ?>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-4">
                                        <div class="form-group">
                                            <label for="">Year : <span class="text-danger"></span></label>
                                            <select name="txtGradyear" id="txtGradyear" class="form-control">
                                                <option value="" selected> -- YYYY -- </option>
                                                <?php 
                                                for ($i=date('Y'); $i >=( date('Y') - 40); $i--) { 
                                                    $j = $i;
                                                    ?>
                                                    <option value="<?php echo $j; ?>" <?php if($j == $yy){ echo "selected"; } ?>><?php echo $j; ?></option>
                                                    <?php
                                                }
                                                ?>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-12">
                        <div class="row">
                            <div class="col-3">Graduate year : </div>
                            <div class="col-9">
                                <div class="form-group">
                                    <input type="text" class="form-control" id="txtGraduateYear" placeholder="Enter only number ex. 2021" value="<?php echo $target_info['std_grad_year']; ?>">
                                </div>
                            </div>
                        </div>
                    </div>
                    
                    <div class="col-12 col-sm-9 offset-sm-3">
                        <div class="pt-1 pb-2">
                        <button type="button" class="btn btn-icon- btn-secondary" onclick="user.update_education('<?php echo $target_uid; ?>')" style="padding-bottom: 8px;">Save</button>
                        </div>
                    </div>
                </div>
        </div>
    </div>

    <div class="card">
        <div class="card-body">
            <div class="row">
                <div class="col-10"><h4 class="text-dark">Advisor</h4></div>
                <div class="col-2 text-right"><button type="button"  data-toggle="modal" data-target="#modalScholarship" class="btn btn-outline-secondary btn-icon"><i class="bx bx-plus"></i></button></div>
            </div>

            <div class="modal fade" id="modalScholarship" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered modal-dialog-centered modal-dialog-scrollable">
                    <div class="modal-content">
                        <div class="modal-header bg-primary">
                            <h5 class="modal-title text-white" id="exampleModalCenterTitle">Add/Update scholarship</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <i class="bx bx-x"></i>
                            </button>
                        </div>
                        <div class="modal-body">
                            <div class="form-group dn">
                                <input type="text" class="form-control" id="txtScholarId">
                            </div>

                            <div class="form-group">
                                <label for="">Scholarship's name</label>
                                <select name="txtScholar" id="txtScholar" class="form-control">
                                    <option value="" selected>-- Select --</option>
                                    <?php 
                                    $strSQL = "SELECT * FROM sis_fundingsource WHERE fs_status = 'Y'";
                                    $resScho = $db->fetch($strSQL, true, false);
                                    if(($resScho) && ($resScho['status'])){
                                        foreach ($resScho['data'] as $row) {
                                            ?>
                                            <option value="<?php echo $row['fs_id'];?>"><?php echo $row['fs_name'];?></option>
                                            <?php
                                        }
                                    }
                                    ?>
                                </select>
                            </div>

                            <div class="form-group dn" id="divScholar">
                                <label for="">Other scholarship's name : <span class="text-danger">*</span></label>
                                <input type="text" class="form-control" id="txtOtherScholar">
                            </div>

                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-light-secondary" data-dismiss="modal">
                                <i class="bx bx-x d-block d-sm-none"></i>
                                <span class="d-none d-sm-block">Close</span>
                            </button>
                            <button type="button" class="btn btn-primary ml-1" onclick="user.saveScholar('<?php echo $target_uid; ?>')">
                                <i class="bx bx-check d-block d-sm-none"></i>
                                <span class="d-none d-sm-block">Save</span>
                            </button>
                        </div>
                    </div>
                </div>
            </div>

            <div class="table responsive">
                <table class="table table-striped">
                    <thead>
                        <tr>
                            <th style="width: 100px;">#</th>
                            <th>Advisor name</th>
                            <th style="width: 100px;"></th>
                        </tr>
                    </thead>
                    <tbody id="listScholar">
                        <?php 
                        $strSQL = "SELECT * FROM sis_student_scholarship a INNER JOIN sis_fundingsource b ON a.sss_scholar = b.fs_id WHERE a.sss_std_id = 's".$target_info['std_id']."' AND a.sss_delete = 'N'";
                        $res = $db->fetch($strSQL, true, false);
                        if(($res) && ($res['status'])){
                            $c = 1;
                            foreach ($res['data'] as $row) {
                                ?>
                                <tr>
                                    <td><?php echo $c; ?></td>
                                    <td><?php echo $row['fs_name']; ?> <?php if($row['sss_scholar'] == '11'){ echo "(".$row['sss_scholar_info'].")"; } ?></td>
                                    <td class="text-right">
                                        <button class="btn" onclick="user.deleteScholar('<?php echo $row['sss_id']; ?>')"><i class="bx bx-trash"></i></button>
                                    </td>
                                </tr>
                                <?php
                                $c++;
                            }
                        }else{
                            ?>
                            <tr><td colspan="3">No advisor found.</td></tr>
                            <?php
                        }
                        ?>
                        
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <div class="card">
        <div class="card-body">
            <div class="row">
                <div class="col-10"><h4 class="text-dark">Scholarship</h4></div>
                <div class="col-2 text-right"><button type="button"  data-toggle="modal" data-target="#modalScholarship" class="btn btn-outline-secondary btn-icon"><i class="bx bx-plus"></i></button></div>
            </div>

            <div class="modal fade" id="modalScholarship" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered modal-dialog-centered modal-dialog-scrollable">
                    <div class="modal-content">
                        <div class="modal-header bg-primary">
                            <h5 class="modal-title text-white" id="exampleModalCenterTitle">Add/Update scholarship</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <i class="bx bx-x"></i>
                            </button>
                        </div>
                        <div class="modal-body">
                            <div class="form-group dn">
                                <input type="text" class="form-control" id="txtScholarId">
                            </div>

                            <div class="form-group">
                                <label for="">Scholarship's name</label>
                                <select name="txtScholar" id="txtScholar" class="form-control">
                                    <option value="" selected>-- Select --</option>
                                    <?php 
                                    $strSQL = "SELECT * FROM sis_fundingsource WHERE fs_status = 'Y'";
                                    $resScho = $db->fetch($strSQL, true, false);
                                    if(($resScho) && ($resScho['status'])){
                                        foreach ($resScho['data'] as $row) {
                                            ?>
                                            <option value="<?php echo $row['fs_id'];?>"><?php echo $row['fs_name'];?></option>
                                            <?php
                                        }
                                    }
                                    ?>
                                </select>
                            </div>

                            <div class="form-group dn" id="divScholar">
                                <label for="">Other scholarship's name : <span class="text-danger">*</span></label>
                                <input type="text" class="form-control" id="txtOtherScholar">
                            </div>

                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-light-secondary" data-dismiss="modal">
                                <i class="bx bx-x d-block d-sm-none"></i>
                                <span class="d-none d-sm-block">Close</span>
                            </button>
                            <button type="button" class="btn btn-primary ml-1" onclick="user.saveScholar('<?php echo $target_uid; ?>')">
                                <i class="bx bx-check d-block d-sm-none"></i>
                                <span class="d-none d-sm-block">Save</span>
                            </button>
                        </div>
                    </div>
                </div>
            </div>

            <div class="table responsive">
                <table class="table table-striped">
                    <thead>
                        <tr>
                            <th style="width: 100px;">#</th>
                            <th>Scholaship's name</th>
                            <th style="width: 100px;"></th>
                        </tr>
                    </thead>
                    <tbody id="listScholar">
                        <?php 
                        $strSQL = "SELECT * FROM sis_student_scholarship a INNER JOIN sis_fundingsource b ON a.sss_scholar = b.fs_id WHERE a.sss_std_id = '".$target_info['std_id']."' AND a.sss_delete = 'N'";
                        $res = $db->fetch($strSQL, true, false);
                        if(($res) && ($res['status'])){
                            $c = 1;
                            foreach ($res['data'] as $row) {
                                ?>
                                <tr>
                                    <td><?php echo $c; ?></td>
                                    <td><?php echo $row['fs_name']; ?> <?php if($row['sss_scholar'] == '11'){ echo "(".$row['sss_scholar_info'].")"; } ?></td>
                                    <td class="text-right">
                                        <button class="btn" onclick="user.deleteScholar('<?php echo $row['sss_id']; ?>')"><i class="bx bx-trash"></i></button>
                                    </td>
                                </tr>
                                <?php
                                $c++;
                            }
                        }else{
                            ?>
                            <tr><td colspan="3">No scholarship found.</td></tr>
                            <?php
                        }
                        ?>
                        
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    

    <?php                    
}                    
?>


<div class="row">
    <div class="col-8" style="padding-top: 5px;"><h4 class="text-dark">Ethics committee</h4></div>
    <div class="col-4 text-right"><h6 class="btn  btn-icon text-dark mb-0"  data-toggle="modal" data-target="#modalEcStatus"><i class="bx bx-pencil"></i></h6></div>
</div>
<table class="table table-bordered table-sm">
    <tbody>
        <tr>
            <td style="width: 200px;">Status : </td>
            <td>
                <?php 
                if($resProgress){
                    if($resProgress['sp_ec'] == 'pass'){
                        ?>
                        <span class="badge badge-success round"><?php echo ucwords($resProgress['sp_ec']); ?></span>
                        <?php
                    }else{
                        echo ucwords($resProgress['sp_ec']);
                    }
                }else{
                    echo "N/A";
                }
                ?>   
            </td>
        </tr>
        <tr>
            <td style="width: 200px;">Pass date : </td>
            <td>
                <?php 
                if(($resProgress) && ($resProgress['sp_ec_passdate'] != null)){
                    echo $resProgress['sp_ec_passdate'];
                }else{
                    echo "-";
                }
                ?>   
            </td>
        </tr>
    </tbody>
</table>

<?php 
$strSQL = "SELECT * FROM sis_ec WHERE ec_std_id = '$id' AND ec_status = 'Y'";
$resEc = $db->fetch($strSQL, false, false);
?>

<div class="row pt-2">
    <div class="col-12" style="padding-top: 5px;"><h4 class="text-dark">EC Info</h4></div>
    <div class="col-12 text-right">
        <!-- <button class="btn btn-danger btn-icon pb-1" data-toggle="modal" data-target="#modalAddrecord"><i class="bx bx-plus"></i></button> -->
    </div>
    <div class="col-12">
        
        <div class="row">
            <div class="form-group col-12 col-sm-6">
                <label for="">First submission date : <span class="text-danger">*</span></label>
                <input type="date" name="txtEcSubmitdate" id="txtEcSubmitdate" class="form-control" value="<?php if($resEc){echo $resEc['ec_first_submit_date']; }?>">
            </div>

            <div class="form-group col-12 col-sm-6">
                <label for="">REC : </label>
                <input type="text" name="txtRec" id="txtRec" class="form-control" value="<?php if($resEc){echo $resEc['ec_rec']; }?>">
            </div>

            <div class="form-group col-12 col-sm-6">
                <label for="">Approve date : </label>
                <input type="date" name="txtEcApprovedate" id="txtEcApprovedate" class="form-control" value="<?php if($resEc){echo $resEc['ec_approve']; }?>">
            </div>

            <div class="form-group col-12 col-sm-6">
                <label for="">Expire date : </label>
                <input type="date" name="txtEcExpiredate" id="txtEcExpiredate" class="form-control" value="<?php if($resEc){echo $resEc['ec_expire']; }?>">
            </div>

        </div>

        <div class="row">
            <div class="col-12 text-left pb-2">
                <button class="btn btn-danger" type="button" onclick="staff.save_ec_info()" >Save</button>
            </div>
        </div>
    </div>
</div>

<div class="row pt-2">
    <div class="col-12" style="padding-top: 5px;"><h4 class="text-dark">EC Note</h4></div>
    <div class="col-12 text-right">
        <!-- <button class="btn btn-danger btn-icon pb-1" data-toggle="modal" data-target="#modalAddrecord"><i class="bx bx-plus"></i></button> -->
    </div>
    <div class="col-12">
        <div class="form-group">
            <label for="">Note : <span class="text-danger">*</span></label>
            <textarea name="txtEcNote" id="txtEcNote" cols="30" rows="3" class="form-control"></textarea>
        </div>

        <div class="row">
            <div class="col-12 text-left pb-2">
                <button class="btn btn-danger" type="button" onclick="staff.save_ec_note()" >Save</button>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="modalQeUpdaterecord" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-dialog-centered modal-xl">
        <div class="modal-content">
            <div class="modal-header bg-primary">
                <h5 class="modal-title text-white" id="exampleModalCenterTitle">Update proposal</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <i class="bx bx-x"></i>
                </button>
            </div>
            <div class="modal-body">
                <div class="form-group dn">
                    <label for="">ID : <span class="text-danger">*</span></label>
                    <input type="text" class="form-control" id="txtQeId">
                </div>
                <div class="form-group">
                    <label for="">Title : <span class="text-danger">*</span></label>
                    <textarea name="txtQeTitleU" id="txtQeTitleU" cols="30" rows="3" class="form-control"></textarea>
                </div>

                <div class="row">
                    <div class="col-12 col-sm-4">
                        <div class="form-group">
                            <label for="">Exam date :</label>
                            <fieldset class="form-group position-relative has-icon-left">
                                <input type="text" id="txtQeExamDateU" class="form-control pickadate" placeholder="Select Date">
                                <div class="form-control-position">
                                    <i class='bx bx-calendar' style="margin-top: 6px;"></i>
                                </div>
                            </fieldset>
                        </div>
                    </div>
                    <div class="col-12 col-sm-4">
                        <div class="form-group">
                            <label for="">Start time :</label>
                            <fieldset class="form-group position-relative has-icon-left">
                                        <input type="text"  id="txtQeExamStartU" class="form-control pickatime" placeholder="Select Time">
                                        <div class="form-control-position">
                                            <i class='bx bx-history' style="margin-top: 6px;"></i>
                                        </div>
                                    </fieldset>
                        </div>
                    </div>
                    <div class="col-12 col-sm-4">
                        <div class="form-group">
                            <label for="">End time :</label>
                            <fieldset class="form-group position-relative has-icon-left">
                                        <input type="text"  id="txtQeExamEndU" class="form-control pickatime" placeholder="Select Time">
                                        <div class="form-control-position">
                                            <i class='bx bx-history' style="margin-top: 6px;"></i>
                                        </div>
                                    </fieldset>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-light-secondary" data-dismiss="modal">
                    <i class="bx bx-x d-block d-sm-none"></i>
                    <span class="d-none d-sm-block">Close</span>
                </button>
                <button type="button" class="btn btn-primary ml-1">
                    <i class="bx bx-check d-block d-sm-none"></i>
                    <span class="d-none d-sm-block"  onclick="progress.update_qe()">Save</span>
                </button>
            </div>
        </div>
    </div>
</div>

<table class="table table-bordered">
    <thead>
        <tr class="bg-secondary">
            <th style="width: 50px;" class="text-white text-center">#</th>
            <th class="text-white">Note</th>
            <th style="width: 200px;" class="text-white text-center">Record date</th>
            
        </tr>
    </thead>
    <tbody>
        <?php 
        $strSQL = "SELECT * FROM sis_ec_note WHERE ecn_std_id = '$id' ORDER BY ecn_udatetime DESC";
        $resEC = $db->fetch($strSQL, true, true);
        if(($resEC) && ($resEC['status'])){
            $c = 1;
            foreach ($resEC['data'] as $row) {
                ?>
                <tr>
                    <td><?php echo $c; ?></td>
                    <td>
                        <p><?php 
                        echo $row['ecn_note'];
                        ?></p>
                    </td>
                    <td><?php echo $row['ecn_udatetime'];?></td>
                </tr>
                <?php
                $c++;
            }
        }else{
            ?>
            <tr>
                <td colspan="3" class="text-center">No record found</td>
            </tr>
            <?php
        }
        ?>
        
    </tbody>
</table>

<div class="modal fade" id="modalEcStatus" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header bg-danger">
                <h5 class="modal-title text-white" id="exampleModalCenterTitle">EC status</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <i class="bx bx-x"></i>
                </button>
            </div>
            <div class="modal-body">
                <div class="form-group">
                    <label for="">Status : <span class="text-danger">*</span></label>
                    <select name="txtEcStatus" id="txtEcStatus" class="form-control">
                        <option value="">-- Select --</option>
                        <option value="waiting">Waiting</option>
                        <option value="un-monitor">Un-monitor</option>
                        <option value="hold">Holding</option>
                        <option value="pass">Pass</option>
                    </select>
                </div>

                <div class="form-group">
                    <label for="">Pass date : </label>
                    <fieldset class="form-group position-relative has-icon-left">
                        <input type="text" id="txtEcPassDate" class="form-control pickadate" placeholder="Select Date">
                        <div class="form-control-position">
                            <i class='bx bx-calendar' style="margin-top: 6px;"></i>
                        </div>
                    </fieldset>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-light-secondary" data-dismiss="modal">
                    <i class="bx bx-x d-block d-sm-none"></i>
                    <span class="d-none d-sm-block">Close</span>
                </button>
                <button type="button" class="btn btn-danger ml-1" onclick="progress.update_ec_status()">
                    <i class="bx bx-check d-block d-sm-none"></i>
                    <span class="d-none d-sm-block">Save</span>
                </button>
            </div>
        </div>
    </div>
</div>
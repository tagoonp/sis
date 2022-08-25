<div class="row">
    <div class="col-8" style="padding-top: 5px;"><h4 class="text-dark">Complehensive examination</h4></div>
    <div class="col-4 text-right"><h6 class="btn  btn-icon text-dark mb-0"  data-toggle="modal" data-target="#modalPeStatus"><i class="bx bx-pencil"></i></h6></div>
</div>
<table class="table table-bordered table-sm">
    <tbody>
        <tr>
            <td style="width: 200px;">Status : </td>
            <td>
                <?php 
                if($resProgress){
                    if($resProgress['sp_ce'] == 'pass'){
                        ?>
                        <span class="badge badge-success round"><?php echo ucwords($resProgress['sp_ce']); ?></span>
                        <?php
                    }else{
                        echo ucwords($resProgress['sp_ce']);
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
                if(($resProgress) && ($resProgress['sp_ce_passdate'] != null)){
                    echo $resProgress['sp_ce_passdate'];
                }else{
                    echo "-";
                }
                ?>   
            </td>
        </tr>
    </tbody>
</table>

<div class="row pt-2">
    <div class="col-12" style="padding-top: 5px;"><h4 class="text-dark">Complehensive exam record</h4></div>
    <div class="col-12 text-right">
        <!-- <button class="btn btn-danger btn-icon pb-1" data-toggle="modal" data-target="#modalAddrecord"><i class="bx bx-plus"></i></button> -->
    </div>
    <div class="col-12">
        <div class="form-group">
            <label for="">Title : <span class="text-danger">*</span></label>
            <textarea name="txtTitle" id="txtTitle" cols="30" rows="3" class="form-control"></textarea>
        </div>

        <div class="row">
            <div class="col-12 col-sm-4">
                <div class="form-group">
                    <label for="">Exam date :</label>
                    <fieldset class="form-group position-relative has-icon-left">
                        <input type="text" id="txtExamDate" class="form-control pickadate" placeholder="Select Date">
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
                                <input type="text"  id="txtExamStart" class="form-control pickatime" placeholder="Select Time">
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
                                <input type="text"  id="txtExamEnd" class="form-control pickatime" placeholder="Select Time">
                                <div class="form-control-position">
                                    <i class='bx bx-history' style="margin-top: 6px;"></i>
                                </div>
                            </fieldset>
                </div>
            </div>
            <div class="col-12 text-left pb-2">
                <button class="btn btn-danger" type="button" onclick="progress.save_ce()" >Save</button>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="modalCeUpdaterecord" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-dialog-centered modal-xl">
        <div class="modal-content">
            <div class="modal-header bg-primary">
                <h5 class="modal-title text-white" id="exampleModalCenterTitle">Update complehensive</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <i class="bx bx-x"></i>
                </button>
            </div>
            <div class="modal-body">
                <div class="form-group dn">
                    <label for="">ID : <span class="text-danger">*</span></label>
                    <input type="text" class="form-control" id="txtCeId">
                </div>
                <div class="form-group">
                    <label for="">Title : <span class="text-danger">*</span></label>
                    <textarea name="txtCeTitleU" id="txtCeTitleU" cols="30" rows="3" class="form-control"></textarea>
                </div>

                <div class="row">
                    <div class="col-12 col-sm-4">
                        <div class="form-group">
                            <label for="">Exam date :</label>
                            <fieldset class="form-group position-relative has-icon-left">
                                <input type="text" id="txtCeExamDateU" class="form-control pickadate" placeholder="Select Date">
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
                                        <input type="text"  id="txtCeExamStartU" class="form-control pickatime" placeholder="Select Time">
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
                                        <input type="text"  id="txtCeExamEndU" class="form-control pickatime" placeholder="Select Time">
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
                    <span class="d-none d-sm-block"  onclick="progress.update_ce()">Save</span>
                </button>
            </div>
        </div>
    </div>
</div>

<table class="table table-bordered">
    <thead>
        <tr class="bg-secondary">
            <th style="width: 50px;" class="text-white text-center">#</th>
            <th class="text-white">Title</th>
            <th style="width: 200px;" class="text-white text-center">Record date</th>
            
        </tr>
    </thead>
    <tbody>
        <?php 
        $strSQL = "SELECT * FROM sis_ce WHERE ce_student_username = '$id' AND ce_status = 'Y'";
        $resPE = $db->fetch($strSQL, true, true);
        if(($resPE) && ($resPE['status'])){
            $c = 1;
            foreach ($resPE['data'] as $row) {
                ?>
                <tr>
                    <td><?php echo $c; ?></td>
                    <td>
                        <a href="#" class="text-dark"><?php echo $row['ce_title'];?></a>
                        <?php 
                        if($row['ce_exam_schedule_date'] != null){
                            ?>
                            <div><small>Exam schedule > <?php echo $row['ce_exam_schedule_date'] . "  ". $row['ce_exam_time_start'] . " - " . $row['ce_exam_time_end']; ?></small></div>  
                            <?php
                        }
                        ?>
                        <div class="pt-1">
                            <a href="Javascript:update_ce_setup('<?php echo $row['ce_id'] ; ?>', '<?php echo $row['ce_title'] ; ?>', '<?php echo $row['ce_exam_schedule_date'] ; ?>', '<?php echo $row['ce_exam_time_start'] ; ?>', '<?php echo $row['ce_exam_time_end'] ; ?>')" style="font-size: 0.8em;"><i class="bx bx-pencil"></i> Update info.</a> | <a href="Javascript:progress.delete_progress('<?php echo $row['ce_id']; ?>', 'ce')" style="font-size: 0.8em;" class="text-danger" ><i class="bx bx-trash"></i> Delete</a>
                        </div>
                    </td>
                    <td><?php echo $row['ce_udatetime'];?></td>
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


<div class="modal fade" id="modalCeStatus" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header bg-danger">
                <h5 class="modal-title text-white" id="exampleModalCenterTitle">Complehensive exam status</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <i class="bx bx-x"></i>
                </button>
            </div>
            <div class="modal-body">
                <div class="form-group">
                    <label for="">Status : <span class="text-danger">*</span></label>
                    <select name="txtCeStatus" id="txtCeStatus" class="form-control">
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
                        <input type="text" id="txtCePassDate" class="form-control pickadate" placeholder="Select Date">
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
                <button type="button" class="btn btn-danger ml-1" onclick="progress.update_ce_status()">
                    <i class="bx bx-check d-block d-sm-none"></i>
                    <span class="d-none d-sm-block">Save</span>
                </button>
            </div>
        </div>
    </div>
</div>
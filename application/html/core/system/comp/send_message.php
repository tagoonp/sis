<div class="card">
    <div class="card-header bg-secondary">
        <h3 class="text-white mb-0">Send message to user</h3>
    </div>
    <div class="card-body pt-2">
        <div class="row">
            <?php 
            if($std_basic_info['LINE_TOKEN'] == NULL){
                ?>
                <div class="col-12">
                    This user not link to notification system.
                </div>
                <?php
            }else{
                ?>
                <div class="col-12">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>USER ID : <span class="text-danger">*</span></label>
                                <input type="text" id="txtToUsername" class="form-control" name="txtToUsername" readonly placeholder="First Name" value="<?php echo $std_basic_info['USERNAME']; ?>">
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="form-group">
                                <label>NOTIFICATION TOKEN : <span class="text-danger">*</span></label>
                                <input type="text" id="txtLineToken" class="form-control" name="txtLineToken" readonly placeholder="First Name" value="<?php echo $std_basic_info['LINE_TOKEN']; ?>">
                            </div>
                        </div>

                        <div class="col-md-12">
                            <div class="form-group">
                                <label>Message : <span class="text-danger">*</span></label>
                                <textarea name="txtLineMessage" id="txtLineMessage" cols="30" rows="5" class="form-control"></textarea>
                            </div>
                        </div>
                        
                        <div class="col-sm-12 text-center pt-2">
                            <button type="button" class="btn btn-primary mr-1" onclick="sendMessage()">Send</button>
                        </div>
                    </div>
                </div>

                <div class="col-12">
                    <hr>
                </div>
                <div class="col-12">
                    <h5 class="text-dark">Message history</h5>
                    <table class="table table-bordered">
                        <thead>
                            <tr>
                                <th>Date - time</th>
                                <th>Message</th>
                                <th></th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php 
                            $strSQL = "SELECT * FROM sis_messaging_log WHERE msl_to_id = '".$std_basic_info['USERNAME']."' AND msl_delete_status = 'N'";
                            if($role == 'admin'){
                                $strSQL = "SELECT * FROM sis_messaging_log WHERE msl_to_id = '".$std_basic_info['USERNAME']."' ";
                            }
                            $res = $db->fetch($strSQL, true, true);
                            if(($res) && ($res['status'])){
                                foreach ($res['data'] as $row) {
                                    ?>
                                    <tr>
                                        <td><?php echo $row['msl_datetime']; ?></td>
                                        <td><?php echo $row['msl_message']; ?></td>
                                        <td>
                                            <div class="btn btn btn-icon"><i class="bx bx-trash"></i></div>
                                        </td>
                                    </tr>
                                    <?php
                                }
                            }else{
                                ?>
                                <tr>
                                    <td colspan="3" class="text-center">No sended message</td>
                                </tr>
                                <?php
                            }
                            ?>
                        </tbody>
                    </table>
                </div>
                <?php
            }
            ?>
            
        </div>
    </div>
</div>
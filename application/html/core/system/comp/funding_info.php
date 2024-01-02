<div class="card">
    <div class="card-header bg-secondary">
        <h3 class="text-white mb-0">Funding</h3>
    </div>
    <div class="card-body pt-2 pb-0">
        <div class="pb-2">
            <form onsubmit="return false;" autocomplete="off">
                <div class="form-group">
                    <label for="">Fund source : <span class="text-danger">*</span></label>
                    <select name="txtFunding" id="txtFunding" class="form-control">
                        <option value="">-- Select --</option>
                        <?php 
                        $strSQL = "SELECT * FROM sis_fundingsource WHERE fs_name != 'Other' ORDER BY fs_name";
                        $res = $db->fetch($strSQL, true, true);
                        if(($res) && ($res['status'])){
                            foreach ($res['data'] as $row) {
                                ?>
                                <option value="<?php echo $row['fs_name']; ?>" <?php if($std_basic_info['std_fund'] == $row['fs_name']){ echo "selected"; } ?>><?php echo $row['fs_name']; ?></option>
                                <?php
                            }
                        }
                        ?>
                        <option value="Other" <?php if($std_basic_info['std_fund'] == 'Other'){ echo "selected"; } ?>>Other</option>
                    </select>
                </div>
                <div id="hdFund" class="<?php if($std_basic_info['std_fund'] == 'Other'){}else{ echo "dn"; } ?>">
                    <div class="form-group">
                        <label for="">Other fund name : <span class="text-danger">*</span></label>
                        <input type="text" class="form-control" id="txtOtherFund" value="<?php echo $std_basic_info['std_fund_info'];?>">
                    </div>
                </div>

                <div class="form-group">
                    <label for="">Condition : <span class="text-danger">*</span></label>
                    <select name="txtCondition" id="txtCondition" class="form-control">
                        <option value="">-- Select --</option>
                        <?php 
                        $strSQL = "SELECT * FROM sis_fundingcondition WHERE 1 ORDER BY fc_sec";
                        $res = $db->fetch($strSQL, true, true);
                        if(($res) && ($res['status'])){
                            foreach ($res['data'] as $row) {
                                ?>
                                <option value="<?php echo $row['fc_detail']; ?>" <?php if($std_basic_info['std_fund_condition'] == $row['fc_detail']){ echo "selected"; } ?>><?php echo $row['fc_detail']; ?></option>
                                <?php
                            }
                        }
                        ?>
                    </select>
                </div>

                <div class="form-group">
                    <button class="btn btn-primary" id="btnSavefund">Save</button>
                </div>
            </form>

        </div>
    </div>
    
</div>
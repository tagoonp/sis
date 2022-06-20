<div class="card">
    <div class="card-body">
        <h4 class="text-dark">Activity logs</h4>
        <p>List of all activity from this user occur in DOE-SIS.</p>
        
        <div class="table-responsive">
            <table class="table table-striped">
                <thead>
                    <tr>
                        <th>Date-time</th>
                        <th>IP</th>
                        <th>Activity</th>
                        <th>Relate user</th>
                    </tr>
                </thead>
                <tbody>
                    <?php 
                    $strSQL = "SELECT * FROM sis_log WHERE uid = '$target_uid' ORDER BY datetime DESC LIMIT 2000";
                    $resLog = $db->fetch($strSQL, true, false);
                    if(($resLog) && ($resLog['status'])){
                        foreach ($resLog['data'] as $row) {
                            ?>
                            <tr>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                            </tr>
                            <?php
                        }
                    }else{
                        ?>
                        <tr>
                            <td colspan="4"><?php echo "No data found";?></td>
                        </tr>
                        <?php
                    }
                    ?>
                </tbody>
            </table>
        </div>
        
    </div>
</div>
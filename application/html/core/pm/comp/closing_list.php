<div class="p-0 table-responsive">
                                    <table class="table table-striped mb-0">
                                        <thead>
                                            <tr>
                                                <th style="font-size: 1em !important; width: 130px;" class="text-white"></th>
                                                <th style="font-size: 1em !important; width: 170px;" class="text-white">Report ID.</th>
                                                <th style="font-size: 1em !important; width: 200px;" class="text-white">สถานะปัจจุบัน</th>
                                                <th style="font-size: 1em !important; width: 200px;" class="text-white">วัน/เวลาที่ยื่น</th>
                                                <th style="font-size: 1em !important; width: 270px;" class="text-white">วัน/เวลาที่รับรอง</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php 
                                            $strSQL = "SELECT * FROM rec_progress a INNER JOIN type_status_research b ON a.rp_progress_status = b.id_status_research WHERE a.rp_id_rs = '$id_rs' AND a.rp_progress_id = 'closing' AND a.rp_delete_status = '0'";
                                            $res = $db->fetch($strSQL, true, true);
                                            if(($res) && ($res['count'] > 0)){
                                                foreach ($res['data'] as $row) {
                                                    ?>
                                                    <tr>
                                                        <td>
                                                            <?php 
                                                            if(($row['rp_progress_status'] == '2') || ($row['rp_progress_status'] == '20')){
                                                                ?>
                                                                <button class="btn btn-icon text-white" onclick="window.location='progressform_<?php echo $row['rp_progress_id']; ?>?id_rs=<?php echo $id_rs;?>&session_id=<?php echo $row['rp_session'];?>'" data-toggle="tooltip" data-placement="top" title="แก้ไขรายงาน/ตอบข้อเสนอแนะ"><i class="bx bx-pencil"></i></button>
                                                                <?php
                                                            }else{
                                                                ?>
                                                                <button class="btn btn-icon text-white" onclick="window.location='progressform_<?php echo $row['rp_progress_id']; ?>_view?id_rs=<?php echo $id_rs;?>&session_id=<?php echo $row['rp_session'];?>'" data-toggle="tooltip" data-placement="top" title="ดูรายงาน"><i class="bx bx-search"></i></button>
                                                                <?php
                                                            }
                                                            ?>
                                                            
                                                            <button class="btn btn-icon text-white" data-toggle="tooltip" data-placement="top" title="ดูข้อความจากสำนักงาน" onclick="showEcMessage('<?php echo $id_rs;?>', '<?php echo $row['rp_session'];?>')"><i class="bx bx-comment"></i></button>
                                                            <?php 
                                                            $strSQL = "SELECT COUNT * cn FROM rec_ec_message WHERE msg_id_rs = '$id_rs' AND msg_session_id = '".$row['rp_progress_id']."' AND msg_read = '0'";
                                                            $resMsg = $db->fetch($strSQL, false, false);
                                                            if(($resMsg) && ($resMsg['cn'] > 0)){
                                                                ?>
                                                                <span class="badge badge-danger p-0" style="height:10px; width: 10px; position: fixed; margin-top: 0px; margin-left: -10px;">&nbsp;</span>
                                                                <?php
                                                            }
                                                            ?>
                                                            
                                                        </td>
                                                        <td class="text-white"><?php echo $row['rp_progress_id']."-".$row['rp_session'];?></td>
                                                        <td class="text-warning">
                                                            <?php echo $row['status_name'];?>
                                                            <?php 
                                                            if(($resMsg) && ($resMsg['cn'] > 0)){
                                                                ?>
                                                                <span class="badge badge-danger p-0">มีข้อความจากสำนักงานที่ท่านยังไม่อ่าน</span>
                                                                <?php
                                                            }
                                                            ?>
                                                        </td>
                                                        <td><?php echo $row['rp_sending_datetime'];?></td>
                                                        <td><?php echo $row['rp_progress_id']."-".$row['rp_session'];?></td>
                                                    </tr>
                                                    <?php
                                                }
                                            }else{
                                                ?>
                                                <tr>
                                                    <td colspan="5" class="text-center">ไม่พบรายงานปิดโครงการ</td>
                                                </tr>
                                                <?php
                                            }
                                            ?>
                                            
                                        </tbody>
                                    </table>
                                </div>
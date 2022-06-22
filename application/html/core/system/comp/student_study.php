<div class="col-12 pl-0 pr-0">
    <h5 class="text-dark">Advisor</h5>
    <div class="card">
        <div class="card-body pt-2">
            <div class="row">
                <div class="col-12 col-sm-4">Main advisor :</div>
                <div class="col-12 col-sm-8 text-dark">
                    <?php 
                    $strSQL = "SELECT FNAME, LNAME FROM sis_advisor a INNER JOIN sis_userinfo b ON a.adv_username = b.USERNAME
                               WHERE a.adv_std_id = '".$currentUser['USERNAME']."'
                               AND a.adv_active = '1' AND adv_delete = '0' AND adv_type = 'main'
                              ";
                    $res = $db->fetch($strSQL, false, false);
                    if($res){
                        echo $res['FNAME']. " " . $res['LNAME'];
                    }else{
                        echo "-";
                    }
                    ?>
                </div>
                <div class="col-12 col-sm-4">Co-advisor 1 : </div>
                <div class="col-12 col-sm-8 text-dark">
                <?php 
                    $strSQL = "SELECT FNAME, LNAME FROM sis_advisor a INNER JOIN sis_userinfo b ON a.adv_username = b.USERNAME
                               WHERE a.adv_std_id = '".$currentUser['USERNAME']."'
                               AND a.adv_active = '1' AND adv_delete = '0' AND adv_type = 'co1'
                              ";
                    $res = $db->fetch($strSQL, false, false);
                    if($res){
                        echo $res['FNAME']. " " . $res['LNAME'];
                    }else{
                        echo "-";
                    }
                    ?>
                </div>
                <div class="col-12 col-sm-4">Co-advisor 2 : </div>
                <div class="col-12 col-sm-8 text-dark">
                <?php 
                    $strSQL = "SELECT FNAME, LNAME FROM sis_advisor a INNER JOIN sis_userinfo b ON a.adv_username = b.USERNAME
                               WHERE a.adv_std_id = '".$currentUser['USERNAME']."'
                               AND a.adv_active = '1' AND adv_delete = '0' AND adv_type = 'co2'
                              ";
                    $res = $db->fetch($strSQL, false, false);
                    if($res){
                        echo $res['FNAME']. " " . $res['LNAME'];
                    }else{
                        echo "-";
                    }
                    ?>
                </div>
                <div class="col-12 col-sm-4">Co-advisor 3 : </div>
                <div class="col-12 col-sm-8 text-dark">
                <?php 
                    $strSQL = "SELECT FNAME, LNAME FROM sis_advisor a INNER JOIN sis_userinfo b ON a.adv_username = b.USERNAME
                               WHERE a.adv_std_id = '".$currentUser['USERNAME']."'
                               AND a.adv_active = '1' AND adv_delete = '0' AND adv_type = 'co3'
                              ";
                    $res = $db->fetch($strSQL, false, false);
                    if($res){
                        echo $res['FNAME']. " " . $res['LNAME'];
                    }else{
                        echo "-";
                    }
                    ?>
                </div>
            </div>
        </div>
    </div>

    <h5 class="text-dark">Funding source</h5>
    <div class="card">
        <div class="card-body pt-2">
            <div class="row">
                <div class="col-12 col-sm-4">Your funding source :</div>
                <div class="col-12 col-sm-8">
                    
                </div>
            </div>
        </div>
    </div>

    <h5 class="text-dark">Study progress</h5>
        <div class="card">
            <div class="card-body">
                <p>Thie part show your study all progress.</p>
                <ul class="nav nav-tabs" role="tablist">
                    <li class="nav-item">
                        <a class="nav-link active" id="pe-tab" data-toggle="tab" href="#pe" aria-controls="pe" role="tab" aria-selected="true">
                            <span class="align-middle">PE</span>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" id="eng-tab" data-toggle="tab" href="#eng" aria-controls="eng" role="tab" aria-selected="false">
                            <span class="align-middle">ENG</span>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" id="qe-tab" data-toggle="tab" href="#qe" aria-controls="qe" role="tab" aria-selected="false">
                            <span class="align-middle">QE</span>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" id="ec-tab" data-toggle="tab" href="#ec" aria-controls="ec" role="tab" aria-selected="false">
                            <span class="align-middle">EC</span>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" id="pub-tab" data-toggle="tab" href="#pub" aria-controls="pub" role="tab" aria-selected="false">
                            <span class="align-middle">PUB</span>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" id="te-tab" data-toggle="tab" href="#te" aria-controls="te" role="tab" aria-selected="false">
                            <span class="align-middle">TE</span>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" id="ce-tab" data-toggle="tab" href="#ce" aria-controls="ce" role="tab" aria-selected="false">
                            <span class="align-middle">CE</span>
                        </a>
                    </li>
                    
                </ul>
                <div class="tab-content">
                    <div class="tab-pane active" id="pe" aria-labelledby="pe-tab" role="tabpanel">
                        <?php 
                        if($role == 'student'){
                            ?>
                            <div class="row">
                                <div class="col-12 col-sm-3">Title : </div>
                                <div class="col-12 col-sm-9 text-dark">-</div>
                                <div class="col-12 col-sm-3">Status : </div>
                                <div class="col-12 col-sm-3 text-dark">-</div>
                                <div class="col-12 col-sm-3">Exam date : </div>
                                <div class="col-12 col-sm-3 text-dark">-</div>
                            </div>
                            <?php
                        }else{

                        }
                        ?>
                    </div>
                    <div class="tab-pane" id="eng" aria-labelledby="eng-tab" role="tabpanel">
                        <?php 
                        if($role == 'student'){
                            ?>
                            <div class="row">
                                <div class="col-12 col-sm-3">Exam : </div>
                                <div class="col-12 col-sm-9 text-dark">-</div>
                                <div class="col-12 col-sm-3">Information : </div>
                                <div class="col-12 col-sm-9 text-dark">-</div>
                                <div class="col-12 col-sm-3">Status : </div>
                                <div class="col-12 col-sm-3 text-dark">-</div>
                                <div class="col-12 col-sm-3">Exam date : </div>
                                <div class="col-12 col-sm-3 text-dark">-</div>
                            </div>
                            <?php
                        }else{

                        }
                        ?>
                    </div>
                    <div class="tab-pane" id="qe" aria-labelledby="qe-tab" role="tabpanel">
                        <?php 
                        if($role == 'student'){
                            ?>
                            <div class="row">
                                <div class="col-12 col-sm-3">Title : </div>
                                <div class="col-12 col-sm-9 text-dark">-</div>
                                <div class="col-12 col-sm-3">Status : </div>
                                <div class="col-12 col-sm-3 text-dark">-</div>
                                <div class="col-12 col-sm-3">Exam date : </div>
                                <div class="col-12 col-sm-3 text-dark">-</div>
                            </div>
                            <?php
                        }else{

                        }
                        ?>
                    </div>
                    <div class="tab-pane" id="ec" aria-labelledby="ec-tab" role="tabpanel">
                        <?php 
                        if($role == 'student'){
                            ?>
                            <div class="row">
                                <div class="col-12 col-sm-3">Title : </div>
                                <div class="col-12 col-sm-9 text-dark">-</div>
                                <div class="col-12 col-sm-3">Status : </div>
                                <div class="col-12 col-sm-9 text-dark">-</div>
                                <div class="col-12 col-sm-3">Issue date : </div>
                                <div class="col-12 col-sm-3 text-dark">-</div>
                                <div class="col-12 col-sm-3">Expire date : </div>
                                <div class="col-12 col-sm-3 text-dark">-</div>
                            </div>
                            <?php
                        }else{

                        }
                        ?>
                    </div>
                    <div class="tab-pane" id="pub" aria-labelledby="pub-tab" role="tabpanel">
                        <p>
                            No data found.
                        </p>
                    </div>
                    <div class="tab-pane" id="te" aria-labelledby="te-tab" role="tabpanel">
                        <?php 
                        if($role == 'student'){
                            ?>
                            <div class="row">
                                <div class="col-12 col-sm-3">Title : </div>
                                <div class="col-12 col-sm-9 text-dark">-</div>
                                <div class="col-12 col-sm-3">Status : </div>
                                <div class="col-12 col-sm-3 text-dark">-</div>
                                <div class="col-12 col-sm-3">Exam date : </div>
                                <div class="col-12 col-sm-3 text-dark">-</div>
                            </div>
                            <?php
                        }else{

                        }
                        ?>
                    </div>
                    <div class="tab-pane" id="ce" aria-labelledby="ce-tab" role="tabpanel">
                        <p>
                            No data found.
                        </p>
                    </div>
                </div>
            </div>
    </div>
    
</div>
<?php 
require('../../../config/server.inc.php');
require('../../../config/config.php');
require('../../../config/database.php'); 

$db = new Database();
$conn = $db->conn();

require('../../../config/user.php'); 

$page = 'app-monitor';

$filter1 = ''; $filter2 = '';

if(isset($_REQUEST['filter1'])){
    $filter1 = mysqli_real_escape_string($conn, $_REQUEST['filter1']);
}
if(isset($_REQUEST['filter1'])){
    $filter2 = mysqli_real_escape_string($conn, $_REQUEST['filter2']);
}

?>


<!DOCTYPE html>
<html class="loading" lang="en" data-textdirection="ltr">
<!-- BEGIN: Head-->
<input type="hidden" id="txtUid" value="<?php echo $uid; ?>" class="form-control">
<input type="hidden" id="txtRole" value="<?php echo $resUser['ROLE']; ?>" class="form-control">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0">
    <meta name="description" content="DOE Account, Department of Epidemiology, Faculty of Medicine, Prince of Songkla University">
    <meta name="keywords" content="">
    <meta name="author" content="Department of Epidemiology">
    <title><?php echo strtoupper($role); ?> : DOE-SIS : Department of Epidemiology Student Information System</title>
    <link rel="apple-touch-icon" href="../../../app-assets/images/ico/apple-icon-120.png">
    <link rel="shortcut icon" type="image/x-icon" href="../../../app-assets/images/ico/favicon.ico">
    <link href="https://fonts.googleapis.com/css2?family=IBM+Plex+Sans+Thai:wght@100;300;400&display=swap" rel="stylesheet">

    <!-- BEGIN: Vendor CSS-->
    <link rel="stylesheet" type="text/css" href="../../../app-assets/vendors/css/vendors.min.css">
    <!-- END: Vendor CSS-->

    <!-- BEGIN: Theme CSS-->
    <link rel="stylesheet" type="text/css" href="../../../app-assets/css/bootstrap.css">
    <link rel="stylesheet" type="text/css" href="../../../app-assets/css/bootstrap-extended.css">
    <link rel="stylesheet" type="text/css" href="../../../app-assets/css/colors.css">
    <link rel="stylesheet" type="text/css" href="../../../app-assets/css/components.css">
    <!-- END: Theme CSS-->

    <!-- BEGIN: Page CSS-->
    <link rel="stylesheet" type="text/css" href="../../../app-assets/css/core/menu/menu-types/vertical-menu.css">
    <link rel="stylesheet" type="text/css" href="../../../app-assets/css/pages/page-knowledge-base.css">
    <link rel="stylesheet" type="text/css" href="../../../app-assets/vendors/css/extensions/sweetalert2.min.css">
    <link rel="stylesheet" type="text/css" href="../../../app-assets/vendors/preload.js/dist/css/preload.css">
    <!-- END: Page CSS-->

    <!-- BEGIN: Custom CSS-->
    <link rel="stylesheet" type="text/css" href="../../../assets/css/style.css">
    <!-- END: Custom CSS-->

</head>
<!-- END: Head-->
<style>
    .noteDiv > p {
        margin-bottom: 0px;
    }
</style>
<!-- BEGIN: Body-->

<body class="vertical-layout vertical-menu-modern dark-layout 2-columns  navbar-sticky footer-static  " data-open="click" data-menu="vertical-menu-modern" data-col="2-columns" data-layout="dark-layout">

    <!-- BEGIN: Header-->
    <div class="header-navbar-shadow"></div>
    <?php 
    require_once('./comp/header.php');
    ?>
    <!-- END: Header-->


    <!-- BEGIN: Main Menu-->
    <div class="main-menu menu-fixed menu-dark menu-accordion menu-shadow" data-scroll-to-active="true">
        <div class="navbar-header">
            <ul class="nav navbar-nav flex-row">
                <li class="nav-item mr-auto"><a class="navbar-brand" href="../../../html/ltr/vertical-menu-template-dark/index.php">
                        <div class="brand-logo">
                            <svg class="logo" width="26px" height="26px" viewbox="0 0 26 26" version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink">
                                <title>icon</title>
                                <defs>
                                    <lineargradient id="linearGradient-1" x1="50%" y1="0%" x2="50%" y2="100%">
                                        <stop stop-color="#5A8DEE" offset="0%"></stop>
                                        <stop stop-color="#699AF9" offset="100%"></stop>
                                    </lineargradient>
                                    <lineargradient id="linearGradient-2" x1="0%" y1="0%" x2="100%" y2="100%">
                                        <stop stop-color="#FDAC41" offset="0%"></stop>
                                        <stop stop-color="#E38100" offset="100%"></stop>
                                    </lineargradient>
                                </defs>
                                <g id="Sprite" stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                    <g id="sprite" transform="translate(-69.000000, -61.000000)">
                                        <g id="Group" transform="translate(17.000000, 15.000000)">
                                            <g id="icon" transform="translate(52.000000, 46.000000)">
                                                <path id="Combined-Shape" d="M13.5909091,1.77272727 C20.4442608,1.77272727 26,7.19618701 26,13.8863636 C26,20.5765403 20.4442608,26 13.5909091,26 C6.73755742,26 1.18181818,20.5765403 1.18181818,13.8863636 C1.18181818,13.540626 1.19665566,13.1982714 1.22574292,12.8598734 L6.30410592,12.859962 C6.25499466,13.1951893 6.22958398,13.5378796 6.22958398,13.8863636 C6.22958398,17.8551125 9.52536149,21.0724191 13.5909091,21.0724191 C17.6564567,21.0724191 20.9522342,17.8551125 20.9522342,13.8863636 C20.9522342,9.91761479 17.6564567,6.70030817 13.5909091,6.70030817 C13.2336969,6.70030817 12.8824272,6.72514561 12.5388136,6.77314791 L12.5392575,1.81561642 C12.8859498,1.78721495 13.2366963,1.77272727 13.5909091,1.77272727 Z"></path>
                                                <path id="Combined-Shape" d="M13.8863636,4.72727273 C18.9447899,4.72727273 23.0454545,8.82793741 23.0454545,13.8863636 C23.0454545,18.9447899 18.9447899,23.0454545 13.8863636,23.0454545 C8.82793741,23.0454545 4.72727273,18.9447899 4.72727273,13.8863636 C4.72727273,13.5378966 4.74673291,13.1939746 4.7846258,12.8556254 L8.55057141,12.8560055 C8.48653249,13.1896162 8.45300462,13.5340745 8.45300462,13.8863636 C8.45300462,16.887125 10.8856023,19.3197227 13.8863636,19.3197227 C16.887125,19.3197227 19.3197227,16.887125 19.3197227,13.8863636 C19.3197227,10.8856023 16.887125,8.45300462 13.8863636,8.45300462 C13.529522,8.45300462 13.180715,8.48740462 12.8430777,8.55306931 L12.8426531,4.78608796 C13.1851829,4.7472336 13.5334422,4.72727273 13.8863636,4.72727273 Z" fill="#4880EA"></path>
                                                <path id="Combined-Shape" d="M13.5909091,1.77272727 C20.4442608,1.77272727 26,7.19618701 26,13.8863636 C26,20.5765403 20.4442608,26 13.5909091,26 C6.73755742,26 1.18181818,20.5765403 1.18181818,13.8863636 C1.18181818,13.540626 1.19665566,13.1982714 1.22574292,12.8598734 L6.30410592,12.859962 C6.25499466,13.1951893 6.22958398,13.5378796 6.22958398,13.8863636 C6.22958398,17.8551125 9.52536149,21.0724191 13.5909091,21.0724191 C17.6564567,21.0724191 20.9522342,17.8551125 20.9522342,13.8863636 C20.9522342,9.91761479 17.6564567,6.70030817 13.5909091,6.70030817 C13.2336969,6.70030817 12.8824272,6.72514561 12.5388136,6.77314791 L12.5392575,1.81561642 C12.8859498,1.78721495 13.2366963,1.77272727 13.5909091,1.77272727 Z" fill="url(#linearGradient-1)"></path>
                                                <rect id="Rectangle" x="0" y="0" width="7.68181818" height="7.68181818"></rect>
                                                <rect id="Rectangle" fill="url(#linearGradient-2)" x="0" y="0" width="7.68181818" height="7.68181818"></rect>
                                            </g>
                                        </g>
                                    </g>
                                </g>
                            </svg>
                        </div>
                        <h2 class="brand-text mb-0 text-shuccess"><span class="text-white">DOE-SIS</span> </h2>
                    </a></li>
                <li class="nav-item nav-toggle"><a class="nav-link modern-nav-toggle pr-0" data-toggle="collapse"><i class="bx bx-x d-block d-xl-none font-medium-4 primary"></i><i class="toggle-icon bx bx-disc font-medium-4 d-none d-xl-block primary" data-ticon="bx-disc"></i></a></li>
            </ul>
        </div>
        <div class="shadow-bottom"></div>
        <?php require_once('./comp/menu.php'); ?>
    </div>
    <!-- END: Main Menu-->

    <!-- BEGIN: Content-->
    <div class="app-content content">
        <div class="content-overlay"></div>
        <div class="content-wrapper">
            <div class="content-header row">
                <div class="content-header-left col-12 mb-2 mt-1">
                    <div class="breadcrumbs-top">
                        <h5 class="content-header-title float-left pr-1 mb-0 text-dark">Monitoring student</h5>
                        <div class="breadcrumb-wrapper d-none d-sm-block">
                            <ol class="breadcrumb p-0 mb-0 pl-1">
                                <li class="breadcrumb-item active"><a href="./"><i class="bx bx-home-alt"></i></a></li>
                            </ol>
                        </div>
                    </div>
                </div>
            </div>
            <div class="content-body">
                <!-- users list start -->
                <section class="users-list-wrapper">
                    <div class="users-list-filter px-1">
                        <form>
                            <div class="row border rounded py-2 mb-2">
                                <div class="col-12 col-sm-6 col-lg-3">
                                    <label for="users-list-verified">Degree</label>
                                    <fieldset class="form-group">
                                        <select class="form-control" id="users-degree">
                                            <option value="">Any</option>
                                            <option value="1" <?php if($filter1 == '1'){ echo "selected"; } ?>>M.Sc.</option>
                                            <option value="2" <?php if($filter1 == '2'){ echo "selected"; } ?>>Ph.D.</option>
                                            <option value="3" <?php if($filter1 == '3'){ echo "selected"; } ?>>Short course</option>
                                        </select>
                                    </fieldset>
                                </div>
                                <div class="col-12 col-sm-6 col-lg-3 dn">
                                    <label for="users-list-role">Status</label>
                                    <fieldset class="form-group">
                                        <select class="form-control" id="users-status">
                                            <option value="">Any</option>
                                            <option value="studying" <?php if($filter2 == 'studying'){ echo "selected"; } ?>>Studying</option>
                                            <option value="graduated" <?php if($filter2 == 'graduated'){ echo "selected"; } ?>>Graduated</option>
                                            <option value="retired" <?php if($filter2 == 'retired'){ echo "selected"; } ?>>Retired</option>
                                        </select>
                                    </fieldset>
                                </div>
                                <div class="col-12 col-sm-6 col-lg-3 d-flex align-items-center">
                                    <button type="button" class="btn btn-primary btn-block glow users-list-clear mb-0" onclick="student.reload_student_list()">Display</button>
                                </div>
                            </div>
                        </form>
                    </div>
                    <div class="users-list-table">
                        <div class="row">
                            <div class="col-12 pb-0">
                                <h4 class="text-dark">PROGRESS STATUS DEFINITION</h4>
                                <ul>
                                    <li><strong>Green </strong> : Adhering to the schedule without any issues.</li>
                                    <li><strong>Yellow </strong> : Slightly behind schedule and requires follow-up.</li>
                                    <li><strong>Red</strong> : Significantly behind schedule, must be followed up urgently, and there should be a plan or assistance in place.</li>
                                </ul>
                            </div>
                        </div>
                        <div class="card">
                            <div class="card-body p-0">
                                <!-- datatable start -->
                                <div class="table-responsive">
                                    <table id="users-list-datatable" class="table">
                                        <thead>
                                            <tr>
                                                <th style="width: 50px;">#</th>
                                                <th style="width: 100px;">Student ID</th>
                                                <th style="width: 450px;">Full name</th>
                                                <th style="width: 100px;">Advisor</th>
                                                <th style="width: 50px;">Year</th>
                                                <?php 
                                                if($role == 'admin'){
                                                    ?><th>Monitor</th><?php
                                                }
                                                ?>
                                                <th style="width: 100px;">Progress status</th>
                                                <th style="width: 200px;">edit</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php 
                                            $filter_msg_1 = '';
                                            if($filter1 != ''){
                                                $filter_msg_1 = "AND c.std_degree = '$filter1' ";
                                            }

                                            $filter_msg_2 = '';
                                            if($filter2 != ''){
                                                $filter_msg_2 = "AND c.std_study_status = '$filter2' ";
                                            }
                                            $strSQL = "SELECT *, e.ssls_level, e.ssls_status FROM sis_account a INNER JOIN sis_userinfo b ON a.USERNAME = b.USERNAME 
                                                       LEFT JOIN sis_student_info c ON a.USERNAME = c.std_id
                                                       LEFT JOIN sis_degree d ON c.std_degree = d.dg_id
                                                       LEFT JOIN sis_study_level_stagement e ON a.USERNAME = e.ssls_std
                                                       WHERE 
                                                       a.ROLE_STUDENT = 'Y' 
                                                       AND a.DELETE_STATUS = 'N' 
                                                       AND b.USE_STATUS = 'Y'
                                                       AND c.std_delete = 'N'
                                                       AND c.std_mon_status = 'Y'
                                                       AND (e.ssls_status = 'Y' OR e.ssls_status IS NULL)
                                                       $filter_msg_1 
                                                       $filter_msg_2 
                                                       ORDER BY a.USERNAME
                                                       ";
                                            $res = $db->fetch($strSQL, true, false);
                                            // echo $strSQL;
                                            if(($res) && ($res['status'])){
                                                $c = 1;
                                                foreach ($res['data'] as $row) {
                                                    ?>
                                                    <tr>
                                                        <td style="vertical-align: top;"><?php echo $c; ?></td>
                                                        <td style="vertical-align: top;">
                                                            <?php echo $row['USERNAME']; ?>
                                                            <div>
                                                            <?php 
                                                            if($row['dg_shorten'] == 'Ph.D.'){
                                                                ?>
                                                                <span class="badge badge-danger round">Ph.D.</span>
                                                                <?php
                                                            }else if($row['dg_shorten'] == 'M.Sc.'){
                                                                ?>
                                                                <span class="badge badge-warning round">M.Sc.</span>
                                                                <?php
                                                            }else{
                                                                ?>
                                                                <span class="badge badge-warning round">Short-course</span>
                                                                <?php
                                                            }
                                                            ?>
                                                            </div>
                                                        </td>
                                                        <td style="vertical-align: top;">
                                                            <div class="row">
                                                                <div class="col-2">
                                                                    <?php 
                                                                    if(($row['PHOTO'] == '') || ($row['PHOTO'] == null)){
                                                                        ?>
                                                                        <div class="avatar avatar-lg bg-secondary mr-1" style="margin-top-: -4px;">
                                                                            <div class="avatar-content" style="font-size: 1.2em; padding-top: 3px;">
                                                                                <?php echo strtoupper(substr($row['FNAME'], 0, 1)) ?>
                                                                            </div>
                                                                        </div>
                                                                        <?php
                                                                    }else{
                                                                        ?>
                                                                        <div class="avatar mr-1 avatar-lg" >
                                                                            <img src="<?php echo $row['PHOTO']; ?>" alt="avtar img holder" onclick="window.open('<?php echo $row['PHOTO']; ?>', '_blank')">
                                                                        </div>
                                                                        <?php
                                                                    }
                                                                    ?>
                                                                </div>
                                                                <div class="col">
                                                                    <?php 
                                                                        if($row['PREFIX'] != 'NA'){
                                                                            echo $row['PREFIX'].$row['FNAME'].' '.$row['MNAME'].' '.$row['LNAME']; 
                                                                        }else{
                                                                            echo $row['FNAME'].' '.$row['MNAME'].' '.$row['LNAME']; 
                                                                        }
                                                                    ?>
                                                                    
                                                                    <div style="font-size: 0.8em;">
                                                                        Funding : <?php 
                                                                        if(($row['std_fund'] == '') || ($row['std_fund'] == null)){
                                                                            echo "-";
                                                                        }else{
                                                                            if($row['std_fund'] == 'Other'){
                                                                                echo $row['std_fund_info'];
                                                                            }else{
                                                                                echo $row['std_fund']; 
                                                                            }
                                                                            echo "<br>";
                                                                            echo "Condition : " . $row['std_fund_condition'];
                                                                        }
                                                                        ?>
                                                                        <br>
                                                                    </div>
                                                                </div>
                                                            </div>

                                                            <div class="row">
                                                                <div class="col-12 pt-2">
                                                                <?php 
                                                                $strSQL = "SELECT * FROM sis_student_progress WHERE sp_std_id = '".$row['USERNAME']."'";
                                                                $resProgress = $db->fetch($strSQL, false, false);
                                                                if($resProgress){
                                                                    $btn_remark = 'btn-outline-secondary'; if($resProgress['sp_pe'] == 'pass'){    $btn_remark = 'btn-success';}
                                                                    ?>
                                                                    <a href="app-student-info?id=<?php echo $row['USERNAME']; ?>&page_id=6" class="btn <?php echo $btn_remark; ?> btn-sm" style="padding: 5px 5px 3px 5px;">PE</a>
                                                                    
                                                                    <?php
                                                                    $btn_remark = 'btn-outline-secondary'; if($resProgress['sp_eng'] == 'pass'){    $btn_remark = 'btn-success';}
                                                                    ?>
                                                                    <a href="app-student-info?id=<?php echo $row['USERNAME']; ?>&page_id=6" class="btn <?php echo $btn_remark; ?> btn-sm" style="padding: 5px 5px 3px 5px;">ENG</a>
                                                                    <?php

                                                                    $btn_remark = 'btn-outline-secondary'; if($resProgress['sp_qe'] == 'pass'){    $btn_remark = 'btn-success';}
                                                                    ?>
                                                                    <a href="app-student-info?id=<?php echo $row['USERNAME']; ?>&page_id=6" class="btn <?php echo $btn_remark; ?> btn-sm" style="padding: 5px 5px 3px 5px;">QE</a>
                                                                    <?php

                                                                    $btn_remark = 'btn-outline-secondary'; if($resProgress['sp_ec'] == 'pass'){    $btn_remark = 'btn-success';}
                                                                    ?>
                                                                    <a href="app-student-info?id=<?php echo $row['USERNAME']; ?>&page_id=6" class="btn <?php echo $btn_remark; ?> btn-sm" style="padding: 5px 5px 3px 5px;">EC</a>
                                                                    <?php

                                                                    $btn_remark = 'btn-outline-secondary'; if($resProgress['sp_pub'] == 'pass'){    $btn_remark = 'btn-success';}
                                                                    ?>
                                                                    <a href="app-student-info?id=<?php echo $row['USERNAME']; ?>&page_id=6" class="btn <?php echo $btn_remark; ?> btn-sm" style="padding: 5px 5px 3px 5px;">PUB</a>
                                                                    <?php

                                                                    $btn_remark = 'btn-outline-secondary'; if($resProgress['sp_te'] == 'pass'){    $btn_remark = 'btn-success';}
                                                                    ?>
                                                                    <a href="app-student-info?id=<?php echo $row['USERNAME']; ?>&page_id=6" class="btn <?php echo $btn_remark; ?> btn-sm" style="padding: 5px 5px 3px 5px;">TE</a>
                                                                    <?php

                                                                    $btn_remark = 'btn-outline-secondary'; if($resProgress['sp_ce'] == 'pass'){    $btn_remark = 'btn-success';}
                                                                    ?>
                                                                    <a href="app-student-info?id=<?php echo $row['USERNAME']; ?>&page_id=6" class="btn <?php echo $btn_remark; ?> btn-sm" style="padding: 5px 5px 3px 5px;">CE</a>
                                                                    <?php

                                                                }else{
                                                                    ?>
                                                                    <a href="app-student-info?id=<?php echo $row['USERNAME']; ?>&page_id=6" class="btn btn-outline-secondary btn-sm" style="padding: 5px 5px 3px 5px;">PE</a>
                                                                    <a href="app-student-info?id=<?php echo $row['USERNAME']; ?>&page_id=6" class="btn btn-outline-secondary btn-sm" style="padding: 5px 5px 3px 5px;">ENG</a>
                                                                    <a href="app-student-info?id=<?php echo $row['USERNAME']; ?>&page_id=6" class="btn btn-outline-secondary btn-sm" style="padding: 5px 5px 3px 5px;">QE</a>
                                                                    <a href="app-student-info?id=<?php echo $row['USERNAME']; ?>&page_id=6" class="btn btn-outline-secondary btn-sm" style="padding: 5px 5px 3px 5px;">EC</a>
                                                                    <a href="app-student-info?id=<?php echo $row['USERNAME']; ?>&page_id=6" class="btn btn-outline-secondary btn-sm" style="padding: 5px 5px 3px 5px;">PUB</a>
                                                                    <a href="app-student-info?id=<?php echo $row['USERNAME']; ?>&page_id=6" class="btn btn-outline-secondary btn-sm" style="padding: 5px 5px 3px 5px;">TE</a>
                                                                    <a href="app-student-info?id=<?php echo $row['USERNAME']; ?>&page_id=6" class="btn btn-outline-secondary btn-sm" style="padding: 5px 5px 3px 5px;">CE</a>
                                                                    <?php
                                                                }
                                                                ?>
                                                                
                                                                <div style="font-size: 0.8em; margin-top: 5px;" class="text-dark">Recent note : </div>
                                                                <div id="noteDiv_<?php echo $row['USERNAME'];?>" class="noteDiv text-dark" style="padding: 5px 10px; border: dashed; border-width: 1px 1px 1px 1px; border-color: #ccc; margin-top: 2px; border-radius: 10px; font-size: 0.8em;">
                                                                    <?php 
                                                                    $strSQL = "SELECT note_message FROM sis_studynote WHERE note_student = '".$row['USERNAME']."' AND note_delete = 'N' ORDER BY note_id DESC LIMIT 1";
                                                                    $resMsg = $db->fetch($strSQL, false, false);
                                                                    if($resMsg){
                                                                        echo $resMsg['note_message'];
                                                                    }else{
                                                                        echo "-";
                                                                    }
                                                                    ?>
                                                                </div>
                                                                </div>
                                                            </div>
                                                        </td>

                                                        <td style="vertical-align: top;">
                                                            <?php 
                                                            $strSQL = "SELECT * FROM sis_advisor a INNER JOIN sis_userinfo b ON a.adv_username = b.USERNAME
                                                                       WHERE adv_delete = '0' AND adv_std_id = '".$row['USERNAME']."' AND adv_type = 'main' AND b.USE_STATUS = 'Y'";
                                                            $resMain = $db->fetch($strSQL, false, false);
                                                            if($resMain){
                                                                echo "[".strtoupper(substr($resMain['FNAME'], 0, 1)).strtoupper(substr($resMain['LNAME'], 0, 1))."] ";
                                                                $strSQL = "SELECT * FROM sis_advisor a INNER JOIN sis_userinfo b ON a.adv_username = b.USERNAME
                                                                        WHERE adv_delete = '0' AND adv_std_id = '".$row['USERNAME']."' AND adv_type != 'main' AND b.USE_STATUS = 'Y'";
                                                                $resCo = $db->fetch($strSQL, true, false);

                                                                if(($resCo) && ($resCo['status'])){
                                                                    // echo sizeof($resCo['data']);
                                                                    foreach ($resCo['data'] as $rowx) {
                                                                        echo "[".strtoupper(substr($rowx['FNAME'], 0, 1)).strtoupper(substr($rowx['LNAME'], 0, 1))."] ";
                                                                    }
                                                                }
                                                            }else{
                                                                echo "-";
                                                            }
                                                            ?>
                                                        </td>

                                                        <td style="vertical-align: top;">
                                                            <?php echo date('Y') - $row['std_start_year']; ?>
                                                        </td>

                                                        <?php 
                                                        if($role == 'admin'){
                                                            ?>
                                                            <td style="vertical-align: top;">
                                                                <div class="custom-control custom-switch custom-control-inline mb-1 pt-1" onclick="student.unmonitor('<?php echo $row['USERNAME'];?>')">
                                                                    <input type="checkbox" class="custom-control-input" <?php if($row['std_mon_status'] == 'Y'){ echo "checked"; } ?> id="customSwitch1_<?php echo $row['USERNAME']; ?>">
                                                                    <label class="custom-control-label mr-1" for="customSwitch1_<?php echo $row['USERNAME']; ?>"></label>
                                                                </div>
                                                            </td>
                                                            <?php
                                                        }
                                                        ?>
                                                        
                                                        <td style="vertical-align: top;">
                                                        <div id="<?php echo $row['USERNAME']; ?>_level" style="padding-bottom: 10px;"><?php 
                                                            if($row['ssls_level'] != null){
                                                                if($row['ssls_level'] == 'Green'){
                                                                    ?>
                                                                    <i class="bx bxs-circle text-success"></i>
                                                                    <?php
                                                                }else if($row['ssls_level'] == 'Yellow'){
                                                                    ?>
                                                                    <i class="bx bxs-circle text-warning"></i>
                                                                    <?php
                                                                }else if($row['ssls_level'] == 'Red'){
                                                                    ?>
                                                                    <i class="bx bxs-circle text-danger"></i>
                                                                    <?php
                                                                }else{
                                                                    echo "NA";
                                                                }
                                                            }else{
                                                                echo "NA";
                                                            }

                                                            ?>
                                                            </div>
                                                            <?php
                                                            if(($role == 'admin') || ($role == 'staff') || ($currentUser['EDITABLE'] == 'Y')){
                                                                ?>
                                                                <select name="txtLevel_<?php echo $row['USERNAME']; ?>" id="txtLevel_<?php echo $row['USERNAME']; ?>" class="form-control" onchange="change_level('<?php echo $row['USERNAME']; ?>')">
                                                                    <option value="">NA</option>
                                                                    <option value="Green" <?php if($row['ssls_level'] == 'Green'){ echo "selected"; } ?>>Green</option>
                                                                    <option value="Yellow" <?php if($row['ssls_level'] == 'Yellow'){ echo "selected"; } ?>>Yellow</option>
                                                                    <option value="Red" <?php if($row['ssls_level'] == 'Red'){ echo "selected"; } ?>>Red</option>
                                                                </select>
                                                                <?php
                                                            }
                                                            ?>
                                                            
                                                        </td>
                                                        <td style="vertical-align: top;">
                                                            <a href="app-student-info?id=<?php echo $row['USERNAME'];?>" class="btn btn-sm mr-1" style="padding: 5px;"><i class="bx bx-search"></i></a>
                                                            <a href="../../../html/ltr/vertical-menu-template/app-users-edit.html" class="btn btn-sm" style="padding: 5px;"  data-toggle="modal" data-target="#modalNote" onclick="setNoteOwner('<?php echo $row['USERNAME']; ?>', '<?php echo $row['FNAME'].' '.$row['LNAME']; ?>')" ><i class="bx bx-comment"></i></a>

                                                            <div class="modal fade text-left" id="modalNote" tabindex="-1" role="dialog" aria-labelledby="myModalLabel150" aria-hidden="true">
                                                                <div class="modal-dialog modal-dialog-centered modal-full modal-dialog-scrollable">
                                                                    <div class="modal-content">
                                                                        <div class="modal-header bg-danger white">
                                                                            <span class="modal-title" id="myModalLabel150">Student note</span>
                                                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                                                <i class="bx bx-x"></i>
                                                                            </button>
                                                                        </div>
                                                                        <div class="modal-body">
                                                                            <div class="row">
                                                                                <div class="col-12 col-sm-5">
                                                                                    <div class="row">
                                                                                        <div class="col-12 col-sm-5">
                                                                                            <div class="form-group">
                                                                                                <label for="">Student ID : </label>
                                                                                                <input type="text" class="form-control" id="txtStudentId" readonly>
                                                                                            </div>
                                                                                        </div>
                                                                                        <div class="col-12 col-sm-7">
                                                                                            <div class="form-group">
                                                                                                <label for="">Fullname : </label>
                                                                                                <input type="text" class="form-control" id="txtStudentFullname" readonly>
                                                                                            </div>
                                                                                        </div>
                                                                                    </div>
                                                                                    <div class="form-group">
                                                                                        <label for="">Note : <span class="text-danger">*</span></label>
                                                                                        <textarea name="txtNote" id="txtNote" cols="30" rows="5" class="form-control"></textarea>
                                                                                    </div>
                                                                                    <div class="form-group" id="btnSaveNoteZone">
                                                                                        <button class="btn btn-primary btn-block" onclick="student.save_note()">Save</button>
                                                                                    </div>
                                                                                </div>
                                                                                <div class="col-12 col-sm-7">
                                                                                    <div class="table-responsive" style="max-height: 500px;">
                                                                                        <table class="table table-striped table-sm-">
                                                                                            <thead>
                                                                                                <tr>
                                                                                                    <th style="width: 200px;" class="text-dark">Date - time</th>
                                                                                                    <th class="text-dark">Note</th>
                                                                                                </tr>
                                                                                            </thead>
                                                                                            <tbody id="noteList">
                                                                                                <tr><td colspan="2">Note record found.</td></tr>
                                                                                            </tbody>
                                                                                        </table>
                                                                                    </div>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            
                                                        </td>
                                                    </tr>
                                                    <?php
                                                    $c++;
                                                }
                                            }
                                            ?>
                                        </tbody>
                                    </table>
                                </div>
                                <!-- datatable ends -->
                            </div>
                        </div>
                    </div>
                </section>
                <!-- users list ends -->

            </div>
        </div>
    </div>
    <!-- END: Content-->

    <div class="sidenav-overlay"></div>
    <div class="drag-target"></div>

    <?php 
    require('./comp/footer.php');
    require('./comp/modal_addtype.php');
    ?>


    <!-- BEGIN: Vendor JS-->
    <script src="../../../app-assets/vendors/js/vendors.min.js"></script>
    <script src="../../../app-assets/fonts/LivIconsEvo/js/LivIconsEvo.tools.js"></script>
    <script src="../../../app-assets/fonts/LivIconsEvo/js/LivIconsEvo.defaults.js"></script>
    <script src="../../../app-assets/fonts/LivIconsEvo/js/LivIconsEvo.min.js"></script>
    <script src="../../../app-assets/vendors/js/extensions/sweetalert2.all.min.js"></script>
    <script src="../../../app-assets/vendors/preload.js/dist/js/preload.js"></script>
    <script src="../../../app-assets/vendors/ckeditor_lite/ckeditor.js"></script>
    <!-- BEGIN Vendor JS-->

    <!-- BEGIN: Page Vendor JS-->
    <!-- END: Page Vendor JS-->

    <!-- BEGIN: Theme JS-->
    <script src="../../../app-assets/js/scripts/configs/vertical-menu-dark.js"></script>
    <script src="../../../app-assets/js/core/app-menu.js"></script>
    <script src="../../../app-assets/js/core/app.js"></script>
    <script src="../../../app-assets/js/scripts/components.js"></script>
    <script src="../../../app-assets/js/scripts/footer.js"></script>
    <!-- END: Theme JS-->

    <!-- BEGIN: Page JS-->
    <script src="../../../app-assets/js/scripts/pages/page-knowledge-base.js"></script>
    <!-- END: Page JS-->

    <script src="../../../assets/js/core.js?v=<?php echo filemtime('../../../assets/js/core.js'); ?>"></script>
    <script src="../../../assets/js/authen.js?v=<?php echo filemtime('../../../assets/js/authen.js'); ?>"></script>
    <script src="../../../assets/js/student.js?v=<?php echo filemtime('../../../assets/js/student.js'); ?>"></script>
    
    <script>

        var editor_doclist = ''
        $(document).ready(function(){
            editor_doclist = CKEDITOR.replace( 'txtNote', {
                wordcount : {
                showCharCount : false,
                showWordCount : true,
                },
                height: '250px'
            });

            setTimeout(() => {
                preload.hide()
            }, 2000);
        })

        function change_level(std_id){
            console.log(std_id);
            $target_status = $('#txtLevel_' + std_id).val()
            var param = {
                uid: $('#txtUid').val(),
                target_std_id: std_id,
                target_status: $target_status 
            }
            console.log(param);
            var jxr = $.post(api + 'progress?stage=update_level', param, function(){}, 'json')
                   .always(function(snap){
                        console.log(snap);
                   })
            
            if($target_status == 'Green'){
                $('#' + std_id + '_level').html('<i class="bx bxs-circle text-success"></i>')
            }else if($target_status == 'Yellow'){
                $('#' + std_id + '_level').html('<i class="bx bxs-circle text-warning"></i>')
            }else if($target_status == 'Red'){
                $('#' + std_id + '_level').html('<i class="bx bxs-circle text-danger"></i>')
            }else{
                $('#' + std_id + '_level').html('NA')
            }
        }

        function setNoteOwner(id, fname){
            student.getNote(id)
            $('#txtStudentId').val(id)
            $('#txtStudentFullname').val(fname)
            setTimeout(() => {
                $('#txtNote').focus()
            }, 1000);
        }
    </script>
</body>
<!-- END: Body-->

</html>
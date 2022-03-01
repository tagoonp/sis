<?php 
require('../../../config/server.inc.php');
require('../../../config/config.php');
require('../../../config/database.php'); 

$db = new Database();
$conn = $db->conn();

require('../../../config/admin.php'); 
require('../../../config/user.php'); 

$page = 'app-student';

if(
    (!isset($_GET['uid']))
  ){
    mysqli_close($conn);
    header('Location: ./');
    die();
}

$target_uid = mysqli_real_escape_string($conn, $_REQUEST['uid']);

$strSQL = "SELECT * FROM sis_account a INNER JOIN sis_userinfo b ON a.UID = b.UID 
            LEFT JOIN sis_student_info c ON b.USERNAME = c.std_id
            LEFT JOIN sis_degree d ON c.std_degree = d.dg_id
            WHERE 
            a.DELETE_STATUS = 'N' 
            AND b.USE_STATUS = 'Y' 
            AND a.ROLE = 'student' 
            AND a.UID = '$target_uid'
            ORDER bY b.USERNAME
            ";
$target_info = $db->fetch($strSQL, false, false);
if(!$target_info){
    mysqli_close($conn);
    header('Location: ./');
    die();
}

$info = 1;
if(isset($_REQUEST['info_tab'])){
    $info = mysqli_real_escape_string($conn, $_REQUEST['info_tab']);
}
?>

<!DOCTYPE html>
<html class="loading" lang="en" data-textdirection="ltr">

<!-- BEGIN: Head-->
<input type="hidden" id="txtUid" value="<?php echo $uid; ?>" class="form-control">
<input type="hidden" id="txtRole" value="<?php echo $resUser['ROLE']; ?>" class="form-control">
<input type="hidden" id="txtTargetUid" value="<?php echo $target_uid; ?>" class="form-control">

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0">
    <meta name="description" content="DOE Account, Department of Epidemiology, Faculty of Medicine, Prince of Songkla University">
    <meta name="keywords" content="">
    <meta name="author" content="Department of Epidemiology">
    <title>DOE-SIS : Department of Epidemiology Student Information System</title>
    <link rel="apple-touch-icon" href="../../../app-assets/images/ico/apple-icon-120.png">
    <link rel="shortcut icon" type="image/x-icon" href="../../../app-assets/images/ico/favicon.ico">
    <link href="https://fonts.googleapis.com/css2?family=IBM+Plex+Sans+Thai:wght@100;300;400&display=swap" rel="stylesheet">

    <!-- BEGIN: Vendor CSS-->
    <link rel="stylesheet" type="text/css" href="../../../app-assets/vendors/css/vendors.min.css">
    <link rel="stylesheet" type="text/css" href="../../../app-assets/vendors/css/tables/datatable/dataTables.bootstrap4.min.css">
    <link rel="stylesheet" type="text/css" href="../../../app-assets/vendors/css/tables/datatable/responsive.bootstrap4.min.css">
    <link rel="stylesheet" type="text/css" href="../../../app-assets/vendors/css/tables/datatable/buttons.bootstrap4.min.css">
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
                <li class="nav-item mr-auto"><a class="navbar-brand" href="../../../html/ltr/vertical-menu-template-dark/index.html">
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
    <div class="app-content content text-dark">
        <div class="content-overlay"></div>
        <div class="content-wrapper pl-0 pr-0 pl-sm-2 pr-sm-2">
            <div class="content-header row  text-dark d-none">
                <div class="content-header-left col-12 mb-2 mt-1 pl-3 pr-3 pl-sm-2 pr-sm-2">
                    <div class="breadcrumbs-top">
                        <h5 class="content-header-title float-left pr-1 mb-0">Student information</h5>
                        <div class="breadcrumb-wrapper d-none d-sm-block">
                            <ol class="breadcrumb p-0 mb-0 pl-1">
                                <li class="breadcrumb-item active"><a href="index.html"><i class="bx bx-home-alt"></i></a></li>
                                <li class="breadcrumb-item"><a href="app-student">Students</a></li>
                                <li class="breadcrumb-item active"><?php echo $target_info['std_id']; ?></li>
                            </ol>
                        </div>
                    </div>
                </div>
            </div>
            <div class="content-body">
                <div class="d-block d-sm-none">
                    <?php // require('./comp/user_info_mobile.php'); ?>
                </div>

                <div class="d-none d-sm-block">
                    <div class="row">
                        <div class="col-12 col-sm-9">
                            <?php 
                            if($info == 1){
                                require('./comp/user_info_desktop.php');
                            }else if($info == 2){
                                if($target_info['ROLE'] == 'student')
                                    require('./comp/user_education_desktop.php');
                            }else if($info == 3){
                                require('./comp/user_contact_desktop.php');
                            }else if($info == 4){
                                if($target_info['ROLE'] == 'student')
                                    require('./comp/user_imm_desktop.php');
                            }else if($info == 5){
                                require('./comp/user_log_desktop.php');
                            }else if($info == 6){
                                require('./comp/user_progress_desktop.php');
                            }
                            ?>
                        </div>
                        <div class="col-12 col-sm-3">
                            <div class="card">
                                <div class="card-body p-0">
                                    <div class="list-group list-group-flush">
                                        <a href="app-student-info?uid=<?php echo $target_uid; ?>&info_tab=1" class="list-group-item list-group-item-action border-0 d-flex <?php if($info == 1){ echo "active"; } ?>">
                                            <div class="list-icon">
                                                <i class="badge-circle badge-circle-light-secondary bx bx-user mr-1 text-primary"></i>
                                            </div>
                                            <div class="list-content" style="padding-top: 6px;">
                                                <h5 class="<?php if($info == 1){}else{ echo "text-dark"; }?>">Basic info.</h5>
                                            </div>
                                        </a>
                                        <a href="app-student-info?uid=<?php echo $target_uid; ?>&info_tab=2" class="list-group-item list-group-item-action border-0 d-flex <?php if($info == 2){ echo "active"; } ?>">
                                            <div class="list-icon">
                                                <i class="badge-circle badge-circle-light-secondary bx bxl-instagram-alt mr-1 text-danger"></i>
                                            </div>
                                            <div class="list-content" style="padding-top: 6px;">
                                                <h5 class="<?php if($info == 2){}else{ echo "text-dark"; }?>">Education</h5>
                                            </div>
                                        </a>
                                        <a href="app-student-info?uid=<?php echo $target_uid; ?>&info_tab=6" class="list-group-item list-group-item-action border-0 d-flex <?php if($info == 6){ echo "active"; } ?>">
                                            <div class="list-icon">
                                                <i class="badge-circle badge-circle-light-secondary bx bx-wrench mr-1 text-danger"></i>
                                            </div>
                                            <div class="list-content" style="padding-top: 6px;">
                                                <h5 class="<?php if($info == 6){}else{ echo "text-dark"; }?>">Progress</h5>
                                            </div>
                                        </a>
                                        <a href="app-student-info?uid=<?php echo $target_uid; ?>&info_tab=3" class="list-group-item list-group-item-action border-0 d-flex <?php if($info == 3){ echo "active"; } ?>">
                                            <div class="list-icon">
                                                <i class="badge-circle badge-circle-light-secondary bx bx-envelope mr-1 text-success"></i>
                                            </div>
                                            <div class="list-content" style="padding-top: 6px;">
                                                <h5  class="<?php if($info == 3){}else{ echo "text-dark"; }?>">Contact</h5>
                                            </div>
                                        </a>
                                        <a href="app-student-info?uid=<?php echo $target_uid; ?>&info_tab=4" class="list-group-item list-group-item-action border-0 d-flex <?php if($info == 4){ echo "active"; } ?>">
                                            <div class="list-icon">
                                                <i class="badge-circle badge-circle-light-secondary bx bxs-camera mr-1 text-info"></i>
                                            </div>
                                            <div class="list-content" style="padding-top: 6px;">
                                                <h5  class="<?php if($info == 4){}else{ echo "text-dark"; }?>">Immigration</h5>
                                            </div>
                                        </a>
                                        <a href="app-student-info?uid=<?php echo $target_uid; ?>&info_tab=5" class="list-group-item list-group-item-action border-0 d-flex <?php if($info == 5){ echo "active"; } ?>">
                                            <div class="list-icon">
                                                <i class="badge-circle badge-circle-light-secondary bx bx-menu mr-1 text-danger"></i>
                                            </div>
                                            <div class="list-content" style="padding-top: 6px;">
                                                <h5 class="<?php if($info == 5){}else{ echo "text-dark"; }?>">Activity log.</h5>
                                            </div>
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    
                </div>

            </div>
        </div>
    </div>
    <!-- END: Content-->

    <div class="sidenav-overlay"></div>
    <div class="drag-target"></div>

    <?php 
    require('./comp/footer.php');
    ?>


    <!-- BEGIN: Vendor JS-->
    <script src="../../../app-assets/vendors/js/vendors.min.js"></script>
    <script src="../../../app-assets/fonts/LivIconsEvo/js/LivIconsEvo.tools.js"></script>
    <script src="../../../app-assets/fonts/LivIconsEvo/js/LivIconsEvo.defaults.js"></script>
    <script src="../../../app-assets/fonts/LivIconsEvo/js/LivIconsEvo.min.js"></script>
    <!-- BEGIN Vendor JS-->

    <!-- BEGIN: Page Vendor JS-->
    <script src="../../../app-assets/vendors/js/tables/datatable/jquery.dataTables.min.js"></script>
    <script src="../../../app-assets/vendors/js/tables/datatable/dataTables.bootstrap4.min.js"></script>
    <script src="../../../app-assets/vendors/js/tables/datatable/dataTables.buttons.min.js"></script>
    <script src="../../../app-assets/vendors/js/tables/datatable/buttons.html5.min.js"></script>
    <script src="../../../app-assets/vendors/js/tables/datatable/buttons.print.min.js"></script>
    <script src="../../../app-assets/vendors/js/tables/datatable/buttons.bootstrap4.min.js"></script>
    <script src="../../../app-assets/vendors/js/tables/datatable/pdfmake.min.js"></script>
    <script src="../../../app-assets/vendors/js/tables/datatable/vfs_fonts.js"></script>
    <script src="../../../app-assets/vendors/js/extensions/sweetalert2.all.min.js"></script>
    <script src="../../../app-assets/vendors/preload.js/dist/js/preload.js"></script>
    <!-- END: Page Vendor JS-->

    <!-- BEGIN: Theme JS-->
    <script src="../../../app-assets/js/scripts/configs/vertical-menu-dark.js"></script>
    <script src="../../../app-assets/js/core/app-menu.js"></script>
    <script src="../../../app-assets/js/core/app.js"></script>
    <script src="../../../app-assets/js/scripts/components.js"></script>
    <script src="../../../app-assets/js/scripts/footer.js"></script>
    <!-- END: Theme JS-->

    <!-- BEGIN: Page JS-->
    <script src="../../../assets/js/core.js?v=<?php echo filemtime('../../../assets/js/core.js'); ?>"></script>
    <script src="../../../assets/js/authen.js?v=<?php echo filemtime('../../../assets/js/authen.js'); ?>"></script>
    <script src="../../../assets/js/user.js?v=<?php echo filemtime('../../../assets/js/user.js'); ?>"></script>
    <!-- END: Page JS-->
    <script>
        $(document).ready(function(){
            $('.dataex-html5-selectors').DataTable( {
                dom: 'Bfrtip',
                "columnDefs": [
                    { "width": "50px", "targets": 0 }
                ],
                buttons: [
                    {
                        extend: 'pdfHtml5',
                        exportOptions: {
                            columns: ':visible'
                        }
                    },
                    {
                        extend: 'print',
                        exportOptions: {
                            columns: ':visible'
                        }
                    }
                ]
            });

            preload.hide()
        })

        
    </script>
</body>
<!-- END: Body-->

</html>
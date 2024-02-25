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
                        <h5 class="content-header-title float-left pr-1 mb-0 text-dark">Reports</h5>
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
                    <div class="users-list-table">
                        <div class="card">
                            <div class="card-header"><h4 class="text-dark">Numbers of student by start year and Number of graduated (not include short-course)</h4></div>
                            <div class="card-body p-0">
                                <?php 
                                $strSQL = "SELECT std_start_year FROM sis_student_info WHERE 1 GROUP BY std_start_year ORDER BY std_start_year";
                                $res = $db->fetch($strSQL, true, true);
                                $dt_year = array();

                                $dt_msc = array(); $dt_msc_str = '';
                                $dt_phd = array(); $dt_phd_str = '';
                                $dt_sc = array(); $dt_sc_str = '';
                                $dt_tt = array(); $dt_tt_str = '';

                                $dt_year_string = '';
                                if(($res) && ($res['status'])){
                                    foreach ($res['data'] as $row) {
                                        $dt_year[] = $row['std_start_year'];
                                    }
                                }

                                if(sizeof($dt_year) > 0){

                                    $dt_year_string = implode('", "' , $dt_year);
                                    $dt_year_string = '"' . $dt_year_string . '"';
                                    foreach ($dt_year as $i) {

                                        $msc = 0;
                                        $phd = 0;
                                        $tt = 0;

                                        $strSQL = "SELECT COUNT(1) cn FROM sis_student_info WHERE std_start_year = '$i' AND std_degree = '1' AND std_delete = 'N'";
                                        $res = $db->fetch($strSQL, false, false);
                                        if($res){
                                            $msc = $res['cn'];
                                            $dt_msc[] = $res['cn'];
                                        }else{
                                            $dt_msc[] = 0;
                                        }

                                        

                                        $strSQL = "SELECT COUNT(1) cn FROM sis_student_info WHERE std_start_year = '$i' AND std_degree = '2' AND std_delete = 'N'";
                                        $res = $db->fetch($strSQL, false, false);
                                        if($res){
                                            $phd = $res['cn'];
                                            $dt_phd[] = $res['cn'];
                                        }else{
                                            $dt_phd[] = 0;
                                        }
                                        
                                        $dt_tt[] = $msc + $phd;
                                        

                                        $strSQL = "SELECT COUNT(1) cn FROM sis_student_info WHERE std_start_year = '$i' AND std_degree IN ('1', '2') AND std_delete = 'N' AND std_study_status = 'graduated'";
                                        $res = $db->fetch($strSQL, false, false);
                                        if($res){
                                            $dt_sc[] = $res['cn'];
                                        }else{
                                            $dt_sc[] = 0;
                                        }
                                        $dt_sc_str = implode(', ' , $dt_sc);
                                    }

                                    $dt_msc_str = implode(', ' , $dt_msc);
                                    $dt_phd_str = implode(', ' , $dt_phd);
                                    $dt_tt_str = implode(', ' , $dt_tt);
                                }
                                ?>
                                <input type="hidden" name="txtDtYear" id="txtDtYear" value="<?php echo $dt_year_string;?>">
                                <div id="chartStudnt"></div>
                                <!-- datatable ends -->
                            </div>
                        </div>

                        <div class="card">
                            <div class="card-header"><h4 class="text-dark">Numbers of student graduated in purposed.</h4></div>
                            <div class="card-body">
                            <?php 

                            $tt_within_year_string = '';
                            if(sizeof($dt_year) > 0){

                                $tt_within = 0;
                                $tt_within_year = array();
                                foreach ($dt_year as $i) {

                                    $strSQL = "SELECT std_degree, std_grad_year FROM sis_student_info WHERE std_start_year = '$i' AND std_delete = 'N' AND std_study_status = 'graduated' AND std_grad_year IS NOT NULL";
                                    $res = $db->fetch($strSQL, true, true);
                                    if(($res) && ($res['status'])){
                                        $each_within_year = 0;
                                        foreach ($res['data'] as $row) {

                                            $start_y = $i;
                                            $grad_year = $row['std_grad_year'];

                                            if($row['std_degree'] == '1') // Msc
                                            {
                                                if((intval($grad_year) - intval($start_y)) <= 2){
                                                    $each_within_year++;
                                                }

                                            }
                                            else if($row['std_degree'] == '2') // Phd
                                            {
                                                if((intval($grad_year) - intval($start_y)) <= 4){
                                                    $each_within_year++;
                                                }
                                            }
                                        }
                                        $tt_within_year[] = $each_within_year;
                                    }else{
                                        $tt_within_year[] = 0;
                                    }

                                }

                                $tt_within_year_string = implode(', ' , $tt_within_year);
                            }
                            ?>
                                <div id="chartStudnt2"></div>
                            </div>
                        </div>


                        <div class="card">
                            <div class="card-header"><h4 class="text-dark">Average study days each year.</h4></div>
                            <div class="card-body">
                            <?php 

                            $tt_avg_day_string = '';
                            $dt_year_2 = array(2020, 2021, 2022, 2023, 2024);
                            $dt_year_string_2 = implode(', ' , $dt_year_2);

                            if(sizeof($dt_year_2) > 0){

                                $tt_within = 0;
                                $tt_avg_day = array();
                                foreach ($dt_year_2 as $i) {

                                    $strSQL = "SELECT std_grad_date, std_grad_year, std_start_edu_date, std_study_status FROM sis_student_info WHERE std_start_year = '$i' AND std_delete = 'N' AND std_start_edu_date IS NOT NULL AND std_study_status IN ('studying', 'graduated')";
                                    $res = $db->fetch($strSQL, true, true);

                                    if(($res) && ($res['status'])){

                                        $number_of_days = 0;
                                        $c = 0;
                                        foreach ($res['data'] as $row) {

                                            $start_date = $row['std_start_edu_date'];
                                            $grad_date = $row['std_grad_date'];

                                            if($grad_date == null){
                                                $grad_date = date('Y');
                                            }

                                            $date1=date_create($start_date);
                                            $date2=date_create($grad_date);
                                            $diff=date_diff($date1,$date2);
                                            $day = $diff->format("%a");
                                            $number_of_days = $number_of_days + intval($day);
                                            $c++;
                                        }

                                        $tt_avg_day[] = $number_of_days / $c;

                                    }else{
                                        $tt_avg_day[] = 0;
                                    }

                                }

                                $tt_avg_day_string = implode(', ' , $tt_avg_day);
                            }
                            ?>
                                <div id="chartStudnt3"></div>
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
    <script src="../../../app-assets/vendors/js/extensions/moment.min.js"></script>
    <script src="../../../app-assets/vendors/apexcharts/apexcharts.min.js"></script>
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
            if($('#txtNote').length){
                editor_doclist = CKEDITOR.replace( 'txtNote', {
                    wordcount : {
                    showCharCount : false,
                    showWordCount : true,
                    },
                    height: '250px'
                });
            }
            

            setTimeout(() => {
                preload.hide()
            }, 2000);

            if($('#chartStudnt').length){
                genChart1()
            }

            if($('#chartStudnt2').length){
                genChart2()
            }

            if($('#chartStudnt3').length){
                genChart3()
            }

            console.log($('#txtDtYear').val());
            console.log($('#txtDtYearMsc').val());
            console.log($('#txtDtYearPhd').val());
            console.log($('#txtDtYearSc').val());
            
        })
        
        function genChart1(){

            var options = {
            series: [{
                name: 'M.Sc.',
                type: 'column',
                data: [<?php echo $dt_msc_str; ?>]
            }, {
                name: 'Ph.D',
                type: 'column',
                data: [<?php echo $dt_phd_str; ?>]
            }, {
                name: 'Total',
                type: 'column',
                data: [<?php echo $dt_tt_str; ?>]
            }, 
             {
                 name: 'Graduated',
                 type: 'line',
                 data: [<?php  echo $dt_sc_str; ?>]
             }
            ],
            chart: {
                height: 350,
                type: 'line',
            },
            stroke: {
                width: [0, 4]
            },
            title: {
            // text: 'Traffic Sources'
            },
            dataLabels: {
                enabled: true,
                enabledOnSeries: [3]
            },
            labels: [<?php echo $dt_year_string; ?>],
            xaxis: {
                // type: 'datetime'
            },
            yaxis: [{
                title: {
                    text: 'Number of student',
                },
            }]
            };

            var chart = new ApexCharts(document.querySelector("#chartStudnt"), options);
            chart.render();
        
        }

        function genChart2(){

            var options = {
            series: [{
                name: 'Number of student',
                type: 'column',
                data: [<?php echo $tt_within_year_string; ?>]
            }, 
            {
                name: 'Graduated with in criteria',
                type: 'line',
                data: [<?php  echo $tt_within_year_string; ?>]
            }
            ],
            chart: {
                height: 350,
                type: 'line',
            },
            stroke: {
                width: [0, 2]
            },
            title: {
            // text: 'Traffic Sources'
            },
            plotOptions: {
                bar: {
                    horizontal: false,
                    borderRadius: 10,
                    borderRadiusApplication: 'around',
                    // borderRadiusWhenStacked: 'last',
                }
            },
            dataLabels: {
                enabled: true,
                enabledOnSeries: [1]
            },
            labels: [<?php echo $dt_year_string; ?>],
            xaxis: {
                // type: 'datetime'
            },
            yaxis: [{
                title: {
                    text: 'Number of student',
                },
            }]
            };

            var chart = new ApexCharts(document.querySelector("#chartStudnt2"), options);
            chart.render();

        }

        function genChart3(){

            var options = {
            series: [{
                name: 'Average days',
                type: 'column',
                data: [<?php echo $tt_avg_day_string; ?>]
            }
            ],
            chart: {
                height: 350,
                type: 'line',
            },
            stroke: {
                width: [0, 2]
            },
            title: {
            // text: 'Traffic Sources'
            },
            plotOptions: {
                bar: {
                    horizontal: false,
                    borderRadius: 10,
                    borderRadiusApplication: 'around',
                    // borderRadiusWhenStacked: 'last',
                }
            },
            dataLabels: {
                enabled: true,
                // enabledOnSeries: [1]
            },
            labels: [<?php echo $dt_year_string_2; ?>],
            xaxis: {
                // type: 'datetime'
            },
            yaxis: [{
                title: {
                    text: 'Day(s)',
                },
            }]
            };

            var chart = new ApexCharts(document.querySelector("#chartStudnt3"), options);
            chart.render();

        }

    </script>
</body>
<!-- END: Body-->

</html>
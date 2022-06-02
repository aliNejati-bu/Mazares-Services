<!doctype html>
<html class="no-js" lang="en">

<head>
    <?php require viewPath("panel>layout>heade") ?>
    <title>pricing</title>
</head>

<body>
<!--[if lt IE 8]>
<p class="browserupgrade">You are using an <strong>outdated</strong> browser. Please <a href="http://browsehappy.com/">upgrade
    your browser</a> to improve your experience.</p>
<![endif]-->
<!-- preloader area start -->
<div id="preloader">
    <div class="loader"></div>
</div>
<!-- preloader area end -->
<!-- page container area start -->
<div class="page-container">
    <!-- sidebar menu area start -->
    <?php require viewPath("panel>sideMenu") ?>
    <!-- sidebar menu area end -->
    <!-- main content area start -->
    <div class="main-content">
        <!-- header area start -->
        <?php require viewPath("panel>layout>header"); ?>
        <!-- header area end -->
        <!-- page title area start -->
        <div class="page-title-area">
            <div class="row align-items-center">
                <div class="col-sm-6">
                    <div class="breadcrumbs-area clearfix">
                        <h4 class="page-title pull-left">Mazares Services</h4>
                        <ul class="breadcrumbs pull-left">
                            <li>Home</li>
                        </ul>
                    </div>
                </div>
                <?php require viewPath("panel>layout>profileComponent") ?>
            </div>
        </div>
        <!-- page title area end -->
        <div class="main-content-inner">
            <div class="row">

            </div>
        </div>
    </div>
    <!-- main content area end -->
    <!-- footer area start-->
    <?php require viewPath("panel>layout>footer") ?>
    <!-- footer area end-->
</div>
<!-- page container area end -->
<!-- offset area start -->
<?php require viewPath("panel>layout>offset")?>
<!-- offset area end -->
<!-- jquery latest version -->
<script src="/assets/js/vendor/jquery-2.2.4.min.js"></script>
<!-- bootstrap 4 js -->
<script src="/assets/js/popper.min.js"></script>
<script src="/assets/js/bootstrap.min.js"></script>
<script src="/assets/js/owl.carousel.min.js"></script>
<script src="/assets/js/metisMenu.min.js"></script>
<script src="/assets/js/jquery.slimscroll.min.js"></script>
<script src="/assets/js/jquery.slicknav.min.js"></script>

<!-- start chart js -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.7.2/Chart.min.js"></script>
<!-- start highcharts js -->
<script src="https://code.highcharts.com/highcharts.js"></script>
<!-- start zingchart js -->
<script src="https://cdn.zingchart.com/zingchart.min.js"></script>
<script>
    zingchart.MODULESDIR = "https://cdn.zingchart.com/modules/";
    ZC.LICENSE = ["569d52cefae586f634c54f86dc99e6a9", "ee6b7db5b51705a13dc2339db3edaf6d"];
</script>
<!-- all line chart activation -->
<script src="/assets/js/line-chart.js"></script>
<!-- all pie chart -->
<script src="/assets/js/pie-chart.js"></script>
<!-- others plugins -->
<script src="/assets/js/plugins.js"></script>
<script src="/assets/js/scripts.js"></script>
</body>

</html>

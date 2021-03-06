<!doctype html>
<html class="no-js" lang="en">

<head>
    <?php require viewPath("panel>layout>heade") ?>
    <title><?= $title ?> | Mazares Services</title>
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
                        <h4 class="page-title pull-left"><?= $title ?></h4>
                        <ul class="breadcrumbs pull-left">
                            <li><a href="<?= route("panel") ?>">Home</a></li>
                            <li><a href="<?= route("apps") ?>">Apps</a></li>
                            <li><?= $title ?></li>
                        </ul>
                    </div>
                </div>
                <?php require viewPath("panel>layout>profileComponent") ?>
            </div>
        </div>
        <!-- page title area end -->
        <div class="main-content-inner">
            <div class="row">

                <div class="col-12 mt-5">
                    <div class="card">
                        <div class="card-body">
                            <div class="card__header_wrapper">
                                <h4 class="header-title">Configs For <?= $app->app_name ?></h4>
                                <div class="btn-group">
                                    <button class="btn btn-light dropdown-toggle" type="button" data-toggle="dropdown"
                                            aria-expanded="false">
                                        select App (<?= $app->packagename ?>)
                                    </button>
                                    <div class="dropdown-menu">
                                        <?php foreach ($packagenames as $packagename): ?>
                                            <a class="dropdown-item"
                                               href="<?= route("appPanel", str_replace(".", "-", $packagename->packagename)) ?>"><?= $packagename->packagename ?></a>
                                        <?php endforeach; ?>
                                        <div class="dropdown-divider"></div>
                                        <a class="dropdown-item">current App : <?= $app->packagename ?> </a>
                                    </div>
                                </div>
                                <button class="btn btn-info mb-3" data-toggle="modal" data-target="#create">Creat Config
                                </button>

                                <div class="modal fade bd-example-modal-lg" id="create">
                                    <div class="modal-dialog modal-lg">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title">Create new Config</h5>
                                                <button type="button" class="close" data-dismiss="modal">
                                                    <span>&times;</span></button>
                                            </div>
                                            <form action="<?= route("appAddConfig") ?>" method="post">
                                                <div class="modal-body">
                                                    <div class="form-group">
                                                        <label for="example-text-input" class="col-form-label">Config
                                                            Name *</label>
                                                        <input class="form-control" required type="text"
                                                               placeholder="name Here..." id="example-text-input"
                                                               name="config_name">
                                                    </div>
                                                    <input type="hidden" name="app_id" value="<?= $app->id ?>">
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-secondary"
                                                            data-dismiss="modal">Close
                                                    </button>
                                                    <button type="submit" class="btn btn-primary">Send</button>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="single-table">
                                <div class="table-responsive">
                                    <table class="table table-hover progress-table text-center">
                                        <thead class="text-uppercase">
                                        <tr>
                                            <th scope="col"></th>
                                            <th scope="col">ID</th>
                                            <th scope="col">Config Name</th>
                                            <th scope="col">Config For</th>
                                            <th scope="col">Create Date</th>
                                            <th scope="col">action</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        <?php foreach ($app->configs as $config): ?>
                                            <tr>
                                                <td><i class="fa fa-tags"></i></td>
                                                <th scope="row"><?= $config->id ?></th>
                                                <td>
                                                    <a href="<?= route('configValues', str_replace('.', '-', $app->packagename), $config->config_name) ?>"><?= $config->config_name ?></a>
                                                </td>
                                                <td>
                                                    <a href="<?= route('configValues', str_replace('.', '-', $app->packagename), $config->config_name) ?>">
                                                        <?= $config->app->app_name ?> (<?= $config->app->packagename ?>)
                                                    </a>
                                                </td>
                                                <td>
                                                    <a href="<?= route('configValues', str_replace('.', '-', $app->packagename), $config->config_name) ?>">
                                                        <?= $config->created_at ?>
                                                    </a>
                                                </td>
                                                <td>
                                                    <ul class="d-flex justify-content-center">
                                                        <li class="mr-3"><a data-toggle="modal"
                                                                            data-target="#edit_<?= $config->id ?>"
                                                                            href="#"
                                                                            class="text-secondary"><i
                                                                        class="fa fa-edit"></i></a></li>
                                                        <li><a data-toggle="modal"
                                                               data-target="#delete_<?= $config->id ?>" href="#"
                                                               class="text-danger"><i class="ti-trash"></i></a>
                                                        </li>
                                                    </ul>
                                                </td>
                                            </tr>

                                        <?php endforeach; ?>

                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <?php foreach ($app->configs as $config): ?>
        <form action="<?= route("editConfig") ?>" method="post">
            <div class="modal fade bd-example-modal-lg"
                 id="edit_<?= $config->id ?>">
                <div class="modal-dialog modal-lg">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title">Create new Config</h5>
                            <button type="button" class="close"
                                    data-dismiss="modal">
                                <span>&times;</span></button>
                        </div>
                        <div class="modal-body">
                            <div class="form-group">
                                <label for="example-text-input"
                                       class="col-form-label">Config
                                    Name *</label>
                                <input class="form-control" required type="text"
                                       placeholder="name Here..."
                                       id="example-text-input"
                                       name="config_name"
                                       value="<?= $config->config_name ?>">
                            </div>
                            <input type="hidden" name="app_id"
                                   value="<?= $app->id ?>">
                            <input type="hidden" name="config_id"
                                   value="<?= $config->id ?>">
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary"
                                    data-dismiss="modal">Close
                            </button>
                            <button type="submit" class="btn btn-primary">Send
                            </button>
                        </div>

                    </div>
                </div>
            </div>
        </form>

        <div class="modal fade" id="delete_<?= $config->id ?>">
            <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Confirm deletion</h5>
                        <button type="button" class="close" data-dismiss="modal">
                            <span>&times;</span></button>
                    </div>
                    <div class="modal-body">
                        <p>Are you sure you want to delete <?= $config->config_name ?>?</p>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary"
                                data-dismiss="modal">Close
                        </button>
                        <form action="<?= route("deleteConfig") ?>" method="post">
                            <input type="hidden" name="config_id"
                                   value="<?= $config->id ?>">
                            <input type="hidden" name="app_id"
                                   value="<?= $app->id ?>">
                            <button type="submit" class="btn btn-danger">Delete
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    <?php endforeach; ?>
    <!-- main content area end -->
    <!-- footer area start-->
    <?php require viewPath("panel>layout>footer") ?>
    <!-- footer area end-->
</div>
<!-- page container area end -->
<!-- offset area start -->
<?php require viewPath("panel>layout>offset") ?>
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
<?php require viewPath("components>toastsJs") ?>
</body>

</html>

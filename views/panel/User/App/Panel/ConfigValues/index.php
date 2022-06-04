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
                            <li><a href="<?= route("appPanel", str_replace('.', '-', $config->app->packagename)) ?>">GamePanel</a>
                            </li>
                            <li><a href="<?= route("configApp", str_replace('.', '-', $config->app->packagename)) ?>">Configs</a>
                            </li>
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
                                <h4 class="header-title">Values For <?= $config->config_name ?></h4>
                                <button class="btn btn-info mb-3" data-toggle="modal" data-target="#create">Creat Value
                                </button>

                                <div class="modal fade bd-example-modal-lg" id="create">
                                    <div class="modal-dialog modal-lg">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title">Create Value</h5>
                                                <button type="button" class="close" data-dismiss="modal">
                                                    <span>&times;</span></button>
                                            </div>
                                            <form action="<?= route("addConfigValue") ?>" method="post">
                                                <div class="modal-body">
                                                    <div class="form-group">
                                                        <label for="example-text-input" class="col-form-label">
                                                            Name *</label>
                                                        <input class="form-control" required type="text"
                                                               placeholder="name Here..." id="example-text-input"
                                                               name="name">
                                                    </div>
                                                    <div class="form-group">
                                                        <label for="example-text-input" class="col-form-label">
                                                            Value *</label>
                                                        <textarea name="value" placeholder="Value Here..."
                                                                  class="form-control" required id="" cols="30"
                                                                  rows="10"></textarea>
                                                    </div>

                                                    <input type="hidden" name="config_id" value="<?= $config->id ?>">
                                                    <input type="hidden" name="app_id" value="<?= $config->app->id ?>">
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
                                            <th scope="col">Name</th>
                                            <th scope="col">Value</th>
                                            <th scope="col">Create Date</th>
                                            <th scope="col">action</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        <?php foreach ($config->values as $value): ?>
                                            <tr>
                                                <td><i class="fa fa-file-text-o"></i></td>
                                                <th scope="row"><?= $value->id ?></th>
                                                <td><?= $value->name ?></td>
                                                <td><?= $value->value ?></td>
                                                <td><?= $config->created_at ?></td>
                                                <td>
                                                    <ul class="d-flex justify-content-center">
                                                        <li class="mr-3"><a href="#" data-toggle="modal"
                                                                            data-target="#edit-<?= $value->id ?>"
                                                                            class="text-secondary"><i
                                                                        class="fa fa-edit"></i></a></li>
                                                        <li><a href="#" data-toggle="modal"
                                                               data-target="#delete-<?= $value->id ?>" class="text-danger"><i class="ti-trash"></i></a>
                                                        </li>
                                                    </ul>
                                                </td>
                                            </tr>
                                            <div class="modal fade" id="delete-<?= $value->id ?>">
                                                <div class="modal-dialog modal-dialog-centered" role="document">
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                            <h5 class="modal-title">Confirm deletion</h5>
                                                            <button type="button" class="close" data-dismiss="modal">
                                                                <span>&times;</span></button>
                                                        </div>
                                                        <div class="modal-body">
                                                            <p>Are you sure you want to delete <?= $value->name ?>?</p>
                                                        </div>
                                                        <div class="modal-footer">
                                                            <button type="button" class="btn btn-secondary"
                                                                    data-dismiss="modal">Close
                                                            </button>
                                                            <form action="<?= route("deleteConfigValue") ?>" method="post">
                                                                <input type="hidden" name="value_id"
                                                                       value="<?= $value->id ?>">
                                                                <button type="submit" class="btn btn-danger">Delete
                                                                </button>
                                                            </form>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="modal fade bd-example-modal-lg" id="edit-<?= $value->id ?>">
                                                <div class="modal-dialog modal-lg">
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                            <h5 class="modal-title">Create Value</h5>
                                                            <button type="button" class="close" data-dismiss="modal">
                                                                <span>&times;</span></button>
                                                        </div>
                                                        <form action="<?= route("editConfigValue") ?>" method="post">
                                                            <div class="modal-body">
                                                                <div class="form-group">
                                                                    <label for="example-text-input"
                                                                           class="col-form-label">
                                                                        Name *</label>
                                                                    <input class="form-control" required type="text"
                                                                           value="<?= $value->name ?>"
                                                                           placeholder="name Here..."
                                                                           id="example-text-input"
                                                                           name="name">
                                                                </div>
                                                                <div class="form-group">
                                                                    <label for="example-text-input"
                                                                           class="col-form-label">
                                                                        Value *</label>
                                                                    <textarea name="value" placeholder="Value Here..."
                                                                              class="form-control" required id=""
                                                                              cols="30"
                                                                              rows="10"><?= $value->value ?></textarea>
                                                                </div>

                                                                <input type="hidden" name="value_id"
                                                                       value="<?= $value->id ?>">
                                                            </div>
                                                            <div class="modal-footer">
                                                                <button type="button" class="btn btn-secondary"
                                                                        data-dismiss="modal">Close
                                                                </button>
                                                                <button type="submit" class="btn btn-primary">Send
                                                                </button>
                                                            </div>
                                                        </form>
                                                    </div>
                                                </div>
                                            </div>

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

<div class="sidebar-menu">
    <div class="sidebar-header">
        <div class="logo">
            <a href="<?= route("panel") ?>"><img src="/assets/images/icon/logo.png" alt="logo"></a>
        </div>
    </div>
    <div class="main-menu">
        <div class="menu-inner">
            <nav>
                <ul class="metismenu" id="menu">
                    <li>
                        <a href="javascript:void(0)" aria-expanded="true"><i
                                    class="ti-dashboard"></i><span>dashboard</span></a>
                        <ul class="collapse">
                            <li><a href="<?= route("panel") ?>">Dashboard</a></li>
                        </ul>
                    </li>
                    <li>
                        <a href="javascript:void(0)" aria-expanded="true"><i class="ti-app"></i><span>Apps</span></a>
                        <ul class="collapse">
                            <li><a href="<?= route("apps") ?>">apps Management</a></li>
                            <li><a href="<?= route("firstAppPanel") ?>">app Panel</a></li>
                        </ul>
                    </li>
                </ul>
            </nav>
        </div>
    </div>
</div>
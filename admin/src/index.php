<?php
$Admin = \FwAuthSystem\Main\UserObject::instance();

?>
<!DOCTYPE html>
<html lang="en" dir="rtl">
<?php
require_once 'layers/head.php';
?>
<body class="hold-transition sidebar-mini pace-primary">
<?=fw_preLoader();?>
<input type="hidden" id="index_avatar" value="avatar2.png">
<input type="hidden" id="index_name" value="<?= $Admin->getName() ?>">
<input type="hidden" id="index_username" value="<?= ($Admin->getUserName()) ?>">
<div class="wrapper">
    <nav class="main-header navbar navbar-expand bg-white navbar-light border-bottom">
        <ul class="navbar-nav">
            <li class="nav-item">
                <a class="nav-link" data-widget="pushmenu" href="#"><i class="fa fa-bars"></i></a>
            </li>
        </ul>
        <ul class="navbar-nav">
            <li class="nav-item">
                <h6 class="m-2 text-muted" ><?=jdate('Y/m/d',time())?> ساعت: <span id="txt"><?=en_to_fa(jdate('H:i:s',time()))?></span></h6>
            </li>
        </ul>
        <ul class="navbar-nav mr-auto">
            <?php
            require_once 'layers/user-menu.php';
            ?>
            <li class="nav-item">
                <a class="nav-link" data-widget="control-sidebar" data-slide="true" href="#"><i
                            class="fa fa-th-large"></i></a>
            </li>
        </ul>
    </nav>
    <aside class="main-sidebar sidebar-dark-primary elevation-4">
        <a href="index.php" style="background-color: #ffffff" class="brand-link">
            <img src="src/dist/images/CompanyLogo.png" alt="<?=FwConfig::PROJECT_NAME()?>" class="brand-image">
            <span style="color: #0c0c0c" class="brand-text font-weight-light">پنل مدیریت <?=FwConfig::PROJECT_NAME()?></span>
        </a>
        <div class="sidebar">
            <div>
                <div class="user-panel mt-3 pb-3 mb-3 d-flex">
                    <div class="info">
                        <a href="#" class="d-block"><?= $Admin->getName() ?></a>
                    </div>
                </div>
                <div class="user-panel mt-3 pb-3 mb-3 d-flex">
                    <div class="info">
                        <a href="index" class="d-block">داشبورد</a>
                    </div>
                </div>
                <nav class="mt-2">
                    <?php
                    require_once 'layers/SideBar.php';
                    ?>
                </nav>
            </div>
        </div>
    </aside>
    <div id="spinner" style="display: none"></div>
    <div class="content-wrapper" id="fw-content">
        <?php
        require_once 'layers/Dashboard.php';
        ?>
    </div>
    <aside class="control-sidebar control-sidebar-dark">
    </aside>
    <footer class="main-footer float-left">
        <strong>CopyRight &copy; 2019 <a target="_blank" href="https://parsa.best">Parsa.best</a></strong>
    </footer>
</div>
<?php
require_once 'layers/scripts.php';
?>
</body>
</html>

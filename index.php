<?php require_once 'header.php' ?>
<?php require_once 'navbar.php' ?>
<!-- LOGO HEADER END-->
<?php $title = DASHBOARD; ?>
<?php require_once 'menu.php' ?>
<!-- MENU SECTION END-->
<div class="content-wrapper">
    <div class="container">
<?php if (!empty($_SESSION['success'])) : ?>
    <div class="row">
        <div class="alert alert-success">
            <?php
                $message = $_SESSION['success'];
                $_SESSION['success'] = '';
                echo $message;
            ?>
        </div>
    </div>
<?php endif ?>
        <div class="row">
            <div class="col-md-12">
                <h4 class="page-head-line">Dashboard</h4>
            </div>
        </div>
        <div class="row">
            <div class="col-md-3 col-sm-3 col-xs-6">
                <div class="dashboard-div-wrapper bk-clr-one">
                    <i class="fa fa-venus dashboard-div-icon"></i>
                    <div class="progress progress-striped active">
                        <div class="progress-bar progress-bar-warning" role="progressbar" aria-valuenow="80"
                             aria-valuemin="0" aria-valuemax="100" style="width: 80%">
                        </div>
                    </div>
                    <h5>
                        <a href="<?php echo SITE ?>/multi.php">Multi table</a>
                    </h5>
                </div>
            </div>
            <div class="col-md-3 col-sm-3 col-xs-6">
                <div class="dashboard-div-wrapper bk-clr-two">
                    <i class="fa fa-edit dashboard-div-icon"></i>
                    <div class="progress progress-striped active">
                        <div class="progress-bar progress-bar-danger" role="progressbar" aria-valuenow="70"
                             aria-valuemin="0" aria-valuemax="100" style="width: 70%">
                        </div>

                    </div>
                    <h5>
                        <a href="<?php echo SITE ?>/calc.php">Calc</a>
                    </h5>
                </div>
            </div>
            <div class="col-md-3 col-sm-3 col-xs-6">
                <div class="dashboard-div-wrapper bk-clr-three">
                    <i class="fa fa-cogs dashboard-div-icon"></i>
                    <div class="progress progress-striped active">
                        <div class="progress-bar progress-bar-success" role="progressbar" aria-valuenow="40"
                             aria-valuemin="0" aria-valuemax="100" style="width: 40%">
                        </div>

                    </div>
                    <h5>
                        <a href="<?php echo SITE ?>/quiz.php">Quiz</a>
                    </h5>
                </div>
            </div>
            <div class="col-md-3 col-sm-3 col-xs-6">
                <div class="dashboard-div-wrapper bk-clr-four">
                    <i class="fa fa-bell-o dashboard-div-icon"></i>
                    <div class="progress progress-striped active">
                        <div class="progress-bar progress-bar-primary" role="progressbar" aria-valuenow="50"
                             aria-valuemin="0" aria-valuemax="100" style="width: 50%">
                        </div>

                    </div>
                    <h5>
                        <a href="<?php echo SITE ?>/users.php">Users</a>
                    </h5>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- CONTENT-WRAPPER SECTION END-->
<?php require_once 'footer.php' ?>

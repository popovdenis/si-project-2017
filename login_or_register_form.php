<?php require_once 'header.php' ?>
<?php require_once 'navbar.php' ?>
<!-- LOGO HEADER END-->
<?php $title = LOGIN ?>
<?php require_once 'menu.php' ?>
<!-- MENU SECTION END-->

<div class="content-wrapper">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <h4 class="page-head-line">Please Login Or Register To Enter </h4>
            </div>
        </div>
        <div class="row">
            <div class="col-md-6">
                <h4> Login </h4>
                <?php if (!empty($_SESSION['error_login'])) : ?>
                    <div class="alert alert-danger">
                        <?php
                        $message = $_SESSION['error_login'];
                        $_SESSION['error_login'] = '';
                        echo $message;
                        ?>
                    </div>
                <?php endif ?>
                <form action="users/login_handler.php" method="POST">
                    <label>Enter Email: </label>
                    <input type="text" name="email" value="" placeholder="enter email" class="form-control"/>
                    <label>Enter Password : </label>
                    <input type="password" name="password" value="" placeholder="enter password" class="form-control"/>
                    <hr/>
                    <input type="submit" value="&nbsp;Log Me In&nbsp;" class="btn btn-info" <span
                        class="glyphicon glyphicon-user"></span>
                </form>
            </div>
            
            <div class="col-md-6">
                <h4> Or Register </h4>
                <?php if (!empty($_SESSION['error_register'])) : ?>
                    <div class="alert alert-danger">
                        <?php
                            $message = $_SESSION['error_register'];
                            $_SESSION['error_register'] = '';
                            echo $message;
                        ?>
                    </div>
                <?php endif ?>
                <form action="users/register_handler.php" method="POST">
                    <label>Enter Username : </label>
                    <input type="text" name="username" value="" placeholder="enter your name" class="form-control"/>
                    <label>Enter Email: </label>
                    <input type="text" name="email" value="" placeholder="enter email" class="form-control"/>
                    <label>Enter Password : </label>
                    <input type="password" name="password" value="" placeholder="enter password" class="form-control"/>
                    <label>Enter Confitmation Password : </label>
                    <input type="password" name="confirmation" value="" placeholder="repeat password"
                           class="form-control"/>
                    <hr/>
                    <input type="submit" value="&nbsp;Register Me&nbsp;" class="btn btn-info" <span
                        class="glyphicon glyphicon-user"></span>
                </form>
            </div>
            
        </div>
    </div>
</div>
<!-- CONTENT-WRAPPER SECTION END-->
<?php require_once 'footer.php' ?>

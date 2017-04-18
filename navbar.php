<div class="navbar navbar-inverse set-radius-zero">
    <div class="container">
        <div class="navbar-header">
            <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
            <a class="navbar-brand" href="<?php echo SITE ?>">
                <span>SI Project</span>
            </a>
        </div>

        <div class="left-div">
            <div class="user-settings-wrapper">
                <ul class="nav">
                    <li class="dropdown">
                        <a class="dropdown-toggle" data-toggle="dropdown" href="#" aria-expanded="false">
                            <span class="glyphicon glyphicon-user" style="font-size: 25px;"></span>
                        </a>
                        <div class="dropdown-menu dropdown-settings">
                        <?php
                        if (isset($_SESSION['userdata'])) :
                            /**
                             * @var $user User
                             */
                            $user = unserialize($_SESSION['userdata']);
                        ?>
                            <div class="media">
                                <div class="media-body">
                                    <h4 class="media-heading"><?php echo $user->getUsername() ?> </h4>
                                    <h5><?php echo $user->getEmail() ?></h5>
                                </div>
                            </div>
                            <hr/>
<!--                            <a href="#" class="btn btn-info btn-sm">Full Profile</a>&nbsp;-->
                            <a href="users/logout.php" class="btn btn-danger btn-sm">Logout</a>
                        <?php endif; ?>
                    </li>
                </ul>
            </div>
        </div>
    </div>
</div>

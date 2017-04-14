<section class="menu-section">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="navbar-collapse collapse ">
                    <ul id="menu-top" class="nav navbar-nav navbar-right">
                        <li>
                            <a <?php if ($title == DASHBOARD) : ?> class="menu-top-active" <?php endif; ?>
                                href="<?php echo SITE ?>/">Dashboard</a>
                        </li>
                        <li>
                            <a <?php if ($title == MULTI) : ?> class="menu-top-active" <?php endif; ?>
                                href="<?php echo SITE ?>/multi.php">Multi table</a>
                        </li>
                        <li>
                            <a <?php if ($title == CALC) : ?> class="menu-top-active" <?php endif; ?>
                                href="<?php echo SITE ?>/calc.php">Calc</a>
                        </li>
                        <li>
                            <a <?php if ($title == QUIZ) : ?> class="menu-top-active" <?php endif; ?>
                                href="<?php echo SITE ?>/quiz.php">Quiz</a>
                        </li>
                        <li>
                            <a <?php if ($title == USERS) : ?> class="menu-top-active" <?php endif; ?>
                                href="<?php echo SITE ?>/users.php">Users</a>
                        </li>
                        <li>
                            <a <?php if ($title == LOGIN) : ?> class="menu-top-active" <?php endif; ?>
                                href="<?php echo SITE ?>/login_or_register_form.php">LOGIN OR REGISTER</a>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</section>

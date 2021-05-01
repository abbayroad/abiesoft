<?php

use AbieSoft\Sistem\Auth\AuthUser;
use AbieSoft\Sistem\Magic\Reader;

$auth = new AuthUser();
if ($auth->isLogin()) {
?>

    <aside class="bg-light lter b-r aside-md hidden-print" id="nav">
        <section class="vbox">
            <section class="w-f scrollable">
                <div class="slim-scroll" data-height="auto" data-disable-fade-out="true" data-distance="0" data-size="5px" data-color="#333333">
                    <nav class="nav-primary hidden-xs">
                        <ul class="nav">
                            <li <?php if (page == "") {
                                    echo "class='active'";
                                } ?>>
                                <a href="<?php echo weburl; ?>">
                                    <i class="fa fa-home icon"><b class="bg-danger"></b></i><span>Home</span>
                                </a>
                            </li>

                            <?php if (Reader::menu('grup') == "diijinkan") { ?>
                                <li <?php if (page == "grup") {
                                        echo "class='active'";
                                    } ?>>
                                    <a href="<?php echo weburl; ?>grup">
                                        <span class="pull-right">
                                            <i class="fa fa-angle-down text"></i>
                                            <i class="fa fa-angle-up text-active"></i>
                                        </span>
                                        <i class="fa fa-users icon"><b class="bg-warning"></b></i><span>Grup</span>
                                    </a>
                                    <ul class="nav lt">
                                        <li <?php if (subpage == "baru") {
                                                echo "class='active'";
                                            } ?>>
                                            <a href="<?php echo weburl; ?>grup/baru">
                                                <i class="fa fa-angle-right"></i>
                                                <span>Buat Grup</span>
                                            </a>
                                        </li>
                                        <li <?php if (subpage == "") {
                                                echo "class='active'";
                                            } ?>>
                                            <a href="<?php echo weburl; ?>grup">
                                                <i class="fa fa-angle-right"></i>
                                                <span>Semua Grup</span>
                                            </a>
                                        </li>
                                    </ul>
                                </li>
                            <?php } ?>




                            <?php if (Reader::menu('users') == "diijinkan") { ?>
                                <li <?php if (page == "users") {
                                        echo "class='active'";
                                    } ?>>
                                    <a href="<?php echo weburl; ?>users">
                                        <span class="pull-right">
                                            <i class="fa fa-angle-down text"></i>
                                            <i class="fa fa-angle-up text-active"></i>
                                        </span>
                                        <i class="fa fa-users icon"><b class="bg-success"></b></i><span>Users</span>
                                    </a>
                                    <ul class="nav lt">
                                        <li <?php if (subpage == "baru") {
                                                echo "class='active'";
                                            } ?>>
                                            <a href="<?php echo weburl; ?>users/baru">
                                                <i class="fa fa-angle-right"></i>
                                                <span>Buat Users</span>
                                            </a>
                                        </li>
                                        <li <?php if (subpage == "") {
                                                echo "class='active'";
                                            } ?>>
                                            <a href="<?php echo weburl; ?>users">
                                                <i class="fa fa-angle-right"></i>
                                                <span>Semua Users</span>
                                            </a>
                                        </li>
                                    </ul>
                                </li>
                            <?php } ?>


                        </ul>
                    </nav>
                </div>
            </section>
            <footer class="footer lt hidden-xs b-t b-light">
                <a href="#nav" data-toggle="class:nav-xs" class="pull-right btn btn-sm btn-default btn-icon">
                    <i class="fa fa-angle-left text"></i>
                    <i class="fa fa-angle-right text-active"></i>
                </a>
                <div class="btn-group hidden-nav-xs">
                    <button type="button" title="Profile" class="btn btn-icon btn-sm btn-default" onClick="window.location.href='<?php echo weburl; ?>profile?id=<?php echo getIdUser; ?>/detail'"><i class="fa fa-user"></i></button>
                    <button type="button" title="Logout" class="btn btn-icon btn-sm btn-default" onClick="window.location.href='<?php echo weburl; ?>logout'"><i class="fa fa-lock"></i></button>
                </div>
            </footer>
        </section>
    </aside>
<?php
}
?>
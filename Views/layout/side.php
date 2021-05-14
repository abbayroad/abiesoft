<?php

use AbieSoft\Sistem\Auth\AuthUser;
use AbieSoft\Sistem\Magic\Reader;

$auth = new AuthUser();
if ($auth->isLogin()) {
?>

    <div class="sidebar">
        <div class="sidebar-brand">
            <div class="brand-flex">
                <img src="<?php echo weburl; ?>asset/properti/logo.png" width="30px" alt="Logo AbieSoft">
                <div class="brand-icon">
                    <!-- <span class="las la-bell"></span> -->
                    <span>
                        <div class="dropdown">
                            <span onclick="showmenudropdown()" class="las la-user-circle" id="dropbtn"></span>
                            <div id="menudropdown" class="dropdown-content">
                                <a href="<?php echo weburl; ?>profile?id=<?php echo getIdUser; ?>/detail">Profile</a>
                                <a href="<?php echo weburl; ?>logout">Logout</a>
                            </div>
                        </div>
                    </span>
                </div>
            </div>
        </div>
        <div class="sidebar-main">
            <div class="sidebar-user">
                <img src="<?php echo weburl . getPhotoUser; ?>" alt="Photo User">
                <div>
                    <h3><?php echo getNamaUser; ?></h3>
                    <span><?php echo getEmailUser; ?></span>
                </div>
            </div>
            <div class="sidebar-menu">
                <div class="menu-block">
                    <div class="menu-head">
                        <span>Dashboard</span>
                    </div>
                    <ul>
                        <li>
                            <a href="/" <?php if (page == "") {
                                            echo "class='active'";
                                        } ?>>
                                <span class="las la-chart-pie"></span>
                                <div>Statistik</div>
                            </a>
                        </li>
                    </ul>
                </div>
                <!-- <div class="menu-block menu-scroll">
                    <div class="menu-head">
                        <span>Menu</span>
                    </div>
                    <ul>
                        <li>
                            <a href="" <?php if (page == "") {
                                            echo "class='active'";
                                        } ?>>
                                <span class="lab la-elementor"></span>
                                <div>Element</div>
                            </a>
                        </li>
                    </ul>
                </div> -->
                <div class=" menu-head">
                    <span>Seting</span>
                </div>
                <ul>
                    <?php if (Reader::menu('grup') == "diijinkan") { ?>
                        <li>
                            <a href="<?php echo weburl; ?>grup" <?php if (page == "grup") {
                                                                    echo "class='active'";
                                                                } ?>>
                                <span class="las la-check-circle"></span>
                                <div>Grup</div>
                            </a>
                        </li>
                    <?php } ?>

                    <?php if (Reader::menu('users') == "diijinkan") { ?>
                        <li>
                            <a href="<?php echo weburl; ?>users" <?php if (page == "users") {
                                                                        echo "class='active'";
                                                                    } ?>>
                                <span class="las la-users"></span>
                                <div>User</div>
                            </a>
                        </li>
                    <?php } ?>
                </ul>
            </div>
        </div>
    </div>

<?php
}
?>
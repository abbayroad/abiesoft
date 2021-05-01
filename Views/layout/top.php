<?php

use AbieSoft\Sistem\Utility\Config;
use AbieSoft\Sistem\Auth\AuthUser;

$auth = new AuthUser();
if ($auth->isLogin()) {
?>
    <header class="bg-dark dk header navbar navbar-fixed-top-xs">
        <div class="navbar-header aside-md">
            <a class="btn btn-link visible-xs" data-toggle="class:nav-off-screen,open" data-target="#nav,html">
                <i class="fa fa-bars"></i>
            </a>
            <a href="<?php echo weburl; ?>" class="navbar-brand" data-toggle="fullscreen"><img src="<?php echo weburl; ?>asset/images/logo.png" class="m-r-sm"><?php echo Config::envReader('WEB_TITEL'); ?></a>
            <a class="btn btn-link visible-xs" data-toggle="dropdown" data-target=".nav-user">
                <i class="fa fa-cog"></i>
            </a>
        </div>
        <ul class="nav navbar-nav hidden-xs">
            <!-- <li class="dropdown">
            <a href="#" class="dropdown-toggle dker" data-toggle="dropdown">
                <i class="fa fa-building-o"></i> 
                <span class="font-bold">Activity</span>
            </a>
            <section class="dropdown-menu aside-xl on animated fadeInLeft no-borders lt">
                <div class="wrapper lter m-t-n-xs">
                    <a href="#" class="thumb pull-left m-r">
                    <img src="<?php echo weburl; ?>images/avatar.jpg" class="img-circle">
                    </a>
                    <div class="clear">
                    <a href="#"><span class="text-white font-bold">@Mike Mcalidek</a></span>
                    <small class="block">Art Director</small>
                    <a href="#" class="btn btn-xs btn-success m-t-xs">Upgrade</a>
                    </div>
                </div>
                <div class="row m-l-none m-r-none m-b-n-xs text-center">
                    <div class="col-xs-4">
                    <div class="padder-v">
                        <span class="m-b-xs h4 block text-white">245</span>
                        <small class="text-muted">Followers</small>
                    </div>
                    </div>
                    <div class="col-xs-4 dk">
                    <div class="padder-v">
                        <span class="m-b-xs h4 block text-white">55</span>
                        <small class="text-muted">Likes</small>
                    </div>
                    </div>
                    <div class="col-xs-4">
                    <div class="padder-v">
                        <span class="m-b-xs h4 block text-white">2,035</span>
                        <small class="text-muted">Photos</small>
                    </div>
                    </div>
                </div>
            </section>
        </li> -->
        </ul>
        <ul class="nav navbar-nav navbar-right m-n hidden-xs nav-user">
            <!-- <li class="hidden-xs">
            <a href="#" class="dropdown-toggle dk" data-toggle="dropdown">
                <i class="fa fa-bell"></i>
                <span class="badge badge-sm up bg-danger m-l-n-sm count">2</span>
            </a>
            <section class="dropdown-menu aside-xl">
                <section class="panel bg-white">
                    <header class="panel-heading b-light bg-light">
                    <strong>You have <span class="count">2</span> notifications</strong>
                    </header>
                    <div class="list-group list-group-alt animated fadeInRight">
                    <a href="#" class="media list-group-item">
                        <span class="pull-left thumb-sm">
                        <img src="asset/images/avatar.jpg" alt="John said" class="img-circle">
                        </span>
                        <span class="media-body block m-b-none">
                        Use awesome animate.css<br>
                        <small class="text-muted">10 minutes ago</small>
                        </span>
                    </a>
                    <a href="#" class="media list-group-item">
                        <span class="media-body block m-b-none">
                        1.0 initial released<br>
                        <small class="text-muted">1 hour ago</small>
                        </span>
                    </a>
                    </div>
                    <footer class="panel-footer text-sm">
                    <a href="#" class="pull-right"><i class="fa fa-cog"></i></a>
                    <a href="#notes" data-toggle="class:show animated fadeInRight">See all the notifications</a>
                    </footer>
                </section>
            </section>
        </li> 
        <li class="dropdown hidden-xs">
            <a href="#" class="dropdown-toggle dker" data-toggle="dropdown"><i class="fa fa-fw fa-search"></i></a>
            <section class="dropdown-menu aside-xl animated fadeInUp">
                <section class="panel bg-white">
                    <form role="search">
                    <div class="form-group wrapper m-b-none">
                        <div class="input-group">
                        <input type="text" class="form-control" placeholder="Search">
                        <span class="input-group-btn">
                            <button type="submit" class="btn btn-info btn-icon"><i class="fa fa-search"></i></button>
                        </span>
                        </div>
                    </div>
                    </form>
                </section>
            </section>
        </li> -->
            <li class="dropdown">
                <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                    <span class="thumb-sm avatar pull-left" id='setphoto1'>
                        <img src="<?php echo weburl . getPhotoUser; ?>">
                    </span>
                    <span id='setnama1'><?php echo getNamaUser; ?></span> <b class="caret"></b>
                </a>
                <ul class="dropdown-menu animated fadeInRight">
                    <span class="arrow top"></span>
                    <li>
                        <a href="<?php echo weburl; ?>profile?id=<?php echo getIdUser; ?>/detail">Profile</a>
                    </li>
                    <li class="divider"></li>
                    <li>
                        <a href="<?php echo weburl; ?>logout">Logout</a>
                    </li>
                </ul>
            </li>
        </ul>
    </header>

<?php
}
?>
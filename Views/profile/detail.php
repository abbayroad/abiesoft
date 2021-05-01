<?php

use AbieSoft\Sistem\Magic\Form;
use AbieSoft\Sistem\Utility\Session;

?>
<section id="content">
    <section class="vbox">
        <header class="header bg-white b-b b-light">
            <p><span id='setnama2'>Profile <?php echo getNamaUser; ?></span></p>
        </header>
        <section class="scrollable">
            <section class="hbox stretch">
                <aside class="aside-lg bg-light lter b-r">
                    <section class="vbox">
                        <section class="scrollable">
                            <div class="wrapper">
                                <div class="clearfix m-b">
                                    <a href="#" class="pull-left thumb m-r">

                                        <span id='setphoto2'><img src="<?php echo getPhotoUser; ?>" class="img-circle"></span>
                                    </a>
                                    <div class="clear">
                                        <div class="h3 m-t-xs m-b-xs"><span id='setnama3'><?php echo getNamaUser; ?></span></div>
                                        <!-- <small class="text-muted"><i class="fa fa-users"></i> <?php echo getGrupIdUser; ?></small> -->
                                    </div>
                                </div>
                                <div>
                                    <small class="text-uc text-xs text-muted">Email</small>
                                    <p><span id='setemail'><?php echo getEmailUser; ?></span></p>
                                    <small class="text-uc text-xs text-muted">Nomor Hp.</small>
                                    <p>
                                        <span id='setphone'>
                                            <?php
                                            if (getPhoneUser != null) {
                                                echo getPhoneUser;
                                            } else {
                                                echo "-";
                                            }
                                            ?>
                                        </span>
                                    </p>
                                    <!-- <div class="line"></div> -->

                                </div>
                            </div>
                        </section>
                    </section>
                </aside>
                <aside class="bg-white">
                    <section class="vbox">
                        <header class="header bg-light bg-gradient">
                            <ul class="nav nav-tabs nav-white">
                                <li class="active"><a href="#editprofile" data-toggle="tab" onClick="loadprofileedit()" ;>Edit Profile</a></li>
                                <li class=""><a href="#aktifitas" data-toggle="tab">Aktifitas</a></li>
                            </ul>
                        </header>
                        <section class="scrollable">
                            <div class="tab-content">
                                <div class="tab-pane active" id="editprofile">
                                    <div class="wrapper">
                                        <?php
                                        if (Session::ada('logout')) {
                                            echo "<div class='bg-warning' style='padding: 20px; margin-bottom: 20px;'>" . Session::lihat('logout') . "</div>";
                                            Session::hapus('logout');
                                        }
                                        Form::update('profile', 'update', array(
                                            'Nama' => ['input', 'nama', 'Nama anda', 'setText', getNamaUser],
                                            'Email' => ['email', 'email', 'Email Anda', 'setEmail', getEmailUser],
                                            'No. Hp' => ['phone', 'phone', 'No Telepon', 'setNoHp', getPhoneUser],
                                            'Pertanyaan' => ['input', 'pertanyaan', 'pertanyaan', 'setText', getPertanyaanUser],
                                            'Jawaban' => ['password', 'jawaban', 'Jawaban', 'setClean', ''],
                                            'Password' => ['password', 'password', 'Password', 'setClean', ''],
                                            'Photo' => ['file', 'photo', 'Photo', 'setClean', ''],
                                            'Simpan' => ['submit', 'simpanuserupdate']
                                        ), getIdUser);
                                        ?>
                                    </div>
                                </div>
                                <div class="tab-pane" id="aktifitas">
                                    <ul class="list-group no-radius m-b-none m-t-n-xxs list-group-lg no-border">
                                        <?php
                                        foreach ($data['aktifitas'] as $aktifitas) {
                                        ?>
                                            <li class="list-group-item">
                                                <span class="clear">
                                                    <small class="pull-right"><?php echo $aktifitas->dibuat; ?></small>
                                                    <strong class="block"><?php echo $aktifitas->model; ?></strong>
                                                    <small>
                                                        <div>
                                                            <div style='float: left; position: absolute;'>IP</div>
                                                            <div style='float: left; margin-left: 100px;'><?php echo $aktifitas->ip; ?></div>
                                                            <div style='clear: both;'></div>
                                                        </div>
                                                        <div>
                                                            <div style='float: left; position: absolute;'>Perangkat</div>
                                                            <div style='float: left; margin-left: 100px;'><?php echo $aktifitas->perangkat; ?></div>
                                                            <div style='clear: both;'></div>
                                                        </div>
                                                        <div>
                                                            <div style='float: left; position: absolute;'>Catatan</div>
                                                            <div style='float: left; margin-left: 100px;'><?php echo $aktifitas->catatan; ?></div>
                                                            <div style='clear: both;'></div>
                                                        </div>
                                                    </small>
                                                </span>
                                            </li>
                                        <?php
                                        }
                                        ?>
                                    </ul>
                                </div>
                            </div>
                        </section>
                    </section>
                </aside>
                <aside class="col-lg-4 b-l">
                    <section class="vbox">
                        <section class="scrollable">
                            <div class="wrapper">
                                <!-- <section class="panel panel-default">
                                    <form>
                                        <textarea class="form-control no-border" rows="3" placeholder="What are you doing..."></textarea>
                                    </form>
                                    <footer class="panel-footer bg-light lter">
                                        <button class="btn btn-info pull-right btn-sm">POST</button>
                                        <ul class="nav nav-pills nav-sm">
                                            <li><a href="#"><i class="fa fa-camera text-muted"></i></a></li>
                                        </ul>
                                    </footer>
                                </section>
                                <section class="panel panel-default">
                                    <h4 class="font-thin padder">Rencana Kegiatan</h4>
                                    <ul class="list-group">
                                        <li class="list-group-item">
                                            <p>Wellcome <a href="#" class="text-info">@Drew Wllon</a> and play this web application template, have fun1 </p>
                                            <small class="block text-muted"><i class="fa fa-clock-o"></i> 2 minuts ago</small>
                                        </li>
                                    </ul>
                                </section> -->
                            </div>
                        </section>
                    </section>
                </aside>
            </section>
        </section>
    </section>
    <a href="#" class="hide nav-off-screen-block" data-toggle="class:nav-off-screen" data-target="#nav"></a>
</section>
<?php

use AbieSoft\Sistem\Utility\Config; ?>
<section id='content'>
    <section class='vbox'>
        <section class='scrollable padder'>
            <ul class='breadcrumb no-border no-radius b-b b-light pull-in'>
                <li><a href=''><i class='fa fa-home'></i> Home</a></li>
                <li><a href='<?php echo weburl; ?>users'>Users</a></li>
                <li class='active'>Detail</li>
            </ul>
            <div class='m-b-md'>
                <h3 class='m-b-none'>Detail Users</h3>
            </div>
            <div class="row">
                <div class="col-sm-6">
                    <section class="panel panel-default">
                        <div class="panel-body">
                            <?php
                            foreach ($data['users'] as $userdata) {
                            ?>
                                <div class="row">
                                    <div class="col-sm-4 text-center">
                                        <img src='<?php echo $userdata->photo; ?>' style='width: 100px;'>
                                    </div>
                                    <div class="col-sm-8">
                                        <div style='padding-top: 20px;'>
                                            <div class='floki' style='position: absolute;'>Nama </div>
                                            <div class='floki' style='margin-left: 100px; font-weight: bold;'><?php echo $userdata->nama; ?> </div>
                                            <div class='endflo'></div>
                                        </div>
                                        <div>
                                            <div class='floki' style='position: absolute;'>Email </div>
                                            <div class='floki' style='margin-left: 100px; font-weight: bold;'><?php echo $userdata->email; ?> </div>
                                            <div class='endflo'></div>
                                        </div>
                                        <div>
                                            <div class='floki' style='position: absolute;'>Telp. </div>
                                            <div class='floki' style='margin-left: 100px; font-weight: bold;'><?php echo $userdata->phone; ?> </div>
                                            <div class='endflo'></div>
                                        </div>
                                    </div>
                                </div>
                            <?php
                            }
                            ?>
                        </div>
                    </section>
                </div>
            </div>
        </section>
    </section>
    <a href='#' class='hide nav-off-screen-block' data-toggle='class:nav-off-screen' data-target='#nav'></a>
</section>
<?php

use AbieSoft\Sistem\Utility\Config;
use AbieSoft\Sistem\Mysql\DB;

?>
<section id='content'>
    <section class='vbox'>
        <section class='scrollable padder'>
            <ul class='breadcrumb no-border no-radius b-b b-light pull-in'>
                <li><a href=''><i class='fa fa-home'></i> Home</a></li>
                <li><a href='<?php echo weburl; ?>grup'>Grup</a></li>
                <li class='active'>Detail</li>
            </ul>
            <div class='m-b-md'>
                <h3 class='m-b-none'>Detail Grup</h3>
            </div>
            <section class="panel panel-default">
                <header class="panel-heading">
                    Tabel Grup
                </header>
                <div class="table-responsive">
                    <table class="table table-striped b-t b-light">
                        <thead>
                            <tr>
                                <th style='width: 50px;'>No</th>
                                <th style='width: 200px;'>Tabel</th>
                                <th>Akses Page</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $no = 1;
                            foreach ($data['grup'] as $grup) {
                            ?>
                                <tr>
                                    <td><?php echo $no; ?></td>
                                    <td><?php echo $grup->nama; ?></td>
                                    <td>
                                        <?php
                                        $act = "";
                                        foreach (explode(",", $grup->akses) as $akses) {
                                        ?>
                                            <div>
                                                <?php
                                                echo "<div>" . $akses;
                                                if ($akses != "logout" and $akses != "setprofilenama" and $akses != "setprofileemail" and $akses != "setprofilephone" and $akses != "setprofilephoto") {
                                                    echo "<div style='margin-left: 30px; border-bottom: 1px solid #eee;'>";
                                                    echo "<div class='floki'>Index</div>";
                                                    $status1 = "<div class='floka text-danger'>(Ditolak)</div>";
                                                    foreach (explode(",", $grup->act) as $act) {
                                                        if ($akses == explode("_", $act)[0] and explode("_", $act)[1] == "index") {
                                                            $status1 = "<div class='floka text-primary'>(diijinkan)</div>";
                                                        }
                                                    }
                                                    echo $status1;
                                                    echo "<div class='endflo'></div>";
                                                    echo "</div>";
                                                    echo "<div style='margin-left: 30px; border-bottom: 1px solid #eee;'>";
                                                    echo "<div class='floki'>Baru</div>";
                                                    $status2 = "<div class='floka text-danger'>(Ditolak)</div>";
                                                    foreach (explode(",", $grup->act) as $act) {
                                                        if ($akses == explode("_", $act)[0] and explode("_", $act)[1] == "baru") {
                                                            $status2 = "<div class='floka text-primary'>(diijinkan)</div>";
                                                        }
                                                    }
                                                    echo $status2;
                                                    echo "<div class='endflo'></div>";
                                                    echo "</div>";
                                                    echo "<div style='margin-left: 30px; border-bottom: 1px solid #eee;'>";
                                                    echo "<div class='floki'>Edit</div>";
                                                    $status3 = "<div class='floka text-danger'>(Ditolak)</div>";
                                                    foreach (explode(",", $grup->act) as $act) {
                                                        if ($akses == explode("_", $act)[0] and explode("_", $act)[1] == "edit") {
                                                            $status3 = "<div class='floka text-primary'>(diijinkan)</div>";
                                                        }
                                                    }
                                                    echo $status3;
                                                    echo "<div class='endflo'></div>";
                                                    echo "</div>";
                                                    echo "<div style='margin-left: 30px; border-bottom: 1px solid #eee;'>";
                                                    echo "<div class='floki'>Detail</div>";
                                                    $status4 = "<div class='floka text-danger'>(Ditolak)</div>";
                                                    foreach (explode(",", $grup->act) as $act) {
                                                        if ($akses == explode("_", $act)[0] and explode("_", $act)[1] == "detail") {
                                                            $status4 = "<div class='floka text-primary'>(diijinkan)</div>";
                                                        }
                                                    }
                                                    echo $status4;
                                                    echo "<div class='endflo'></div>";
                                                    echo "</div>";
                                                    echo "<div style='margin-left: 30px; border-bottom: 1px solid #eee;'>";
                                                    echo "<div class='floki'>Create</div>";
                                                    $status5 = "<div class='floka text-danger'>(Ditolak)</div>";
                                                    foreach (explode(",", $grup->act) as $act) {
                                                        if ($akses == explode("_", $act)[0] and explode("_", $act)[1] == "create") {
                                                            $status5 = "<div class='floka text-primary'>(diijinkan)</div>";
                                                        }
                                                    }
                                                    echo $status5;
                                                    echo "<div class='endflo'></div>";
                                                    echo "</div>";
                                                    echo "<div style='margin-left: 30px; border-bottom: 1px solid #eee;'>";
                                                    echo "<div class='floki'>Update</div>";
                                                    $status6 = "<div class='floka text-danger'>(Ditolak)</div>";
                                                    foreach (explode(",", $grup->act) as $act) {
                                                        if ($akses == explode("_", $act)[0] and explode("_", $act)[1] == "update") {
                                                            $status6 = "<div class='floka text-primary'>(diijinkan)</div>";
                                                        }
                                                    }
                                                    echo $status6;
                                                    echo "<div class='endflo'></div>";
                                                    echo "</div>";
                                                    echo "<div style='margin-left: 30px; border-bottom: 1px solid #eee;'>";
                                                    echo "<div class='floki'>Delete</div>";
                                                    $status7 = "<div class='floka text-danger'>(Ditolak)</div>";
                                                    foreach (explode(",", $grup->act) as $act) {
                                                        if ($akses == explode("_", $act)[0] and explode("_", $act)[1] == "delete") {
                                                            $status7 = "<div class='floka text-primary'>(diijinkan)</div>";
                                                        }
                                                    }
                                                    echo $status7;
                                                    echo "<div class='endflo'></div>";
                                                    echo "</div>";
                                                }
                                                echo "</div>";
                                                ?>
                                            </div>
                                        <?php
                                        }
                                        ?>
                                    </td>
                                </tr>
                            <?php
                                $no++;
                            }
                            ?>
                        </tbody>
                    </table>
                </div>
            </section>
        </section>
    </section>
    <a href='#' class='hide nav-off-screen-block' data-toggle='class:nav-off-screen' data-target='#nav'></a>
</section>
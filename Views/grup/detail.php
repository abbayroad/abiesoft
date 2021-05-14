<?php

use AbieSoft\Sistem\Utility\Config;
use AbieSoft\Sistem\Mysql\DB;

?>
<main>
    <div class="page-header">
        <h1>Grup</h1>
        <div class="header-opsi">
            <button onClick=window.location.href="<?php echo weburl; ?>grup">
                <span class="las la-bars"></span>
                <span class="label-opsi">List</span>
            </button>
        </div>
    </div>
    <section class="grid">
        <div class="row">
            <div class="col-12">
                <div class="card-tabel">
                    <table>
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
                                                echo "<div style='font-size: .9rem;'>" . $akses;
                                                if ($akses != "logout" and $akses != "setprofilenama" and $akses != "setprofileemail" and $akses != "setprofilephone" and $akses != "setprofilephoto") {
                                                    echo "<div style='font-size: .9rem; margin-left: 30px; border-bottom: 1px solid #eee;'>";
                                                    echo "<div class='floki' style='font-size: .9rem;'>Index</div>";
                                                    $status1 = "<div class='floka text-danger' style='font-size: .9rem;'>(Ditolak)</div>";
                                                    foreach (explode(",", $grup->act) as $act) {
                                                        if ($akses == explode("_", $act)[0] and explode("_", $act)[1] == "index") {
                                                            $status1 = "<div class='floka text-primary' style='font-size: .9rem;'>(diijinkan)</div>";
                                                        }
                                                    }
                                                    echo $status1;
                                                    echo "<div class='endflo'></div>";
                                                    echo "</div>";
                                                    echo "<div style='margin-left: 30px; border-bottom: 1px solid #eee;'>";
                                                    echo "<div class='floki' style='font-size: .9rem;'>Baru</div>";
                                                    $status2 = "<div class='floka text-danger' style='font-size: .9rem;'>(Ditolak)</div>";
                                                    foreach (explode(",", $grup->act) as $act) {
                                                        if ($akses == explode("_", $act)[0] and explode("_", $act)[1] == "baru") {
                                                            $status2 = "<div class='floka text-primary' style='font-size: .9rem;'>(diijinkan)</div>";
                                                        }
                                                    }
                                                    echo $status2;
                                                    echo "<div class='endflo'></div>";
                                                    echo "</div>";
                                                    echo "<div style='margin-left: 30px; border-bottom: 1px solid #eee;'>";
                                                    echo "<div class='floki' style='font-size: .9rem;'>Edit</div>";
                                                    $status3 = "<div class='floka text-danger' style='font-size: .9rem;'>(Ditolak)</div>";
                                                    foreach (explode(",", $grup->act) as $act) {
                                                        if ($akses == explode("_", $act)[0] and explode("_", $act)[1] == "edit") {
                                                            $status3 = "<div class='floka text-primary' style='font-size: .9rem;'>(diijinkan)</div>";
                                                        }
                                                    }
                                                    echo $status3;
                                                    echo "<div class='endflo'></div>";
                                                    echo "</div>";
                                                    echo "<div style='margin-left: 30px; border-bottom: 1px solid #eee;'>";
                                                    echo "<div class='floki' style='font-size: .9rem;'>Detail</div>";
                                                    $status4 = "<div class='floka text-danger' style='font-size: .9rem;'>(Ditolak)</div>";
                                                    foreach (explode(",", $grup->act) as $act) {
                                                        if ($akses == explode("_", $act)[0] and explode("_", $act)[1] == "detail") {
                                                            $status4 = "<div class='floka text-primary' style='font-size: .9rem;'>(diijinkan)</div>";
                                                        }
                                                    }
                                                    echo $status4;
                                                    echo "<div class='endflo'></div>";
                                                    echo "</div>";
                                                    echo "<div style='margin-left: 30px; border-bottom: 1px solid #eee;'>";
                                                    echo "<div class='floki' style='font-size: .9rem;'>Create</div>";
                                                    $status5 = "<div class='floka text-danger' style='font-size: .9rem;'>(Ditolak)</div>";
                                                    foreach (explode(",", $grup->act) as $act) {
                                                        if ($akses == explode("_", $act)[0] and explode("_", $act)[1] == "create") {
                                                            $status5 = "<div class='floka text-primary' style='font-size: .9rem;'>(diijinkan)</div>";
                                                        }
                                                    }
                                                    echo $status5;
                                                    echo "<div class='endflo'></div>";
                                                    echo "</div>";
                                                    echo "<div style='margin-left: 30px; border-bottom: 1px solid #eee;'>";
                                                    echo "<div class='floki' style='font-size: .9rem;'>Update</div>";
                                                    $status6 = "<div class='floka text-danger' style='font-size: .9rem;'>(Ditolak)</div>";
                                                    foreach (explode(",", $grup->act) as $act) {
                                                        if ($akses == explode("_", $act)[0] and explode("_", $act)[1] == "update") {
                                                            $status6 = "<div class='floka text-primary' style='font-size: .9rem;'>(diijinkan)</div>";
                                                        }
                                                    }
                                                    echo $status6;
                                                    echo "<div class='endflo'></div>";
                                                    echo "</div>";
                                                    echo "<div style='margin-left: 30px; border-bottom: 1px solid #eee;'>";
                                                    echo "<div class='floki' style='font-size: .9rem;'>Delete</div>";
                                                    $status7 = "<div class='floka text-danger' style='font-size: .9rem;'>(Ditolak)</div>";
                                                    foreach (explode(",", $grup->act) as $act) {
                                                        if ($akses == explode("_", $act)[0] and explode("_", $act)[1] == "delete") {
                                                            $status7 = "<div class='floka text-primary' style='font-size: .9rem;'>(diijinkan)</div>";
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
            </div>
        </div>
    </section>
</main>
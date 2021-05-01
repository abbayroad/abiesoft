<?php

use AbieSoft\Sistem\Utility\Config;
use AbieSoft\Sistem\Auth\AuthUser;

$auth = new AuthUser();
?>
<!DOCTYPE html>
<html lang="en" class="app">

<head>
    <meta charset="UTF-8">
    <meta name="description" content="app, web app, responsive, admin dashboard, admin, flat, flat ui, ui kit, off screen nav" />
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1" />
    <title><?php echo Config::envReader('WEB_TITEL'); ?></title>
    {{CSS}}
    <link rel="stylesheet" href="<?php echo weburl; ?>asset/css/abiesoft.css">
</head>

<body>
    <div id='loader'>
        <div class="textloader">
            Mohon Tunggu ..
        </div>
    </div>
    <section class="vbox">
        {{Top}}
        <section>
            <section class="hbox stretch">
                {{Side}}
                {{Konten}}
                <aside class="bg-light lter b-l aside-md hide" id="notes">
                    <div class="wrapper">Notifikasi</div>
                </aside>
            </section>
        </section>
    </section>

    {{JS}}

    <?php
    $page = page;
    if ($page != "") {
        $result = "";
        $dir = "asset/jsa/" . $page;
        if (file_exists($dir)) {
            $cdir = scandir($dir);
            foreach ($cdir as $key => $value) {
                if (!in_array($value, array(".", ".."))) {
                    echo "<script src='" . weburl . "asset/jsa/" . $page . "/" . $value . "'></script> \n";
                }
            }
        }
    }
    ?>
    <script src="<?php echo weburl; ?>asset/jsa/alert.js"></script>
    <script src="<?php echo weburl; ?>asset/jsa/validasi.js"></script>
    <script>
    {{JSA}}
    window.addEventListener("load", function(){
    const loader = document.querySelector('#loader');
    loader.className = "hidden";
    });
    </script>
</body>

</html>
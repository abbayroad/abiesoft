<?php

use AbieSoft\Sistem\Utility\Config;
use AbieSoft\Sistem\Auth\AuthUser;

$auth = new AuthUser();
?>
<!DOCTYPE html>
<html lang="en" class="app">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
    <title><?php echo Config::envReader('WEB_TITEL'); ?></title>
    {{CSS}}
    <link rel="stylesheet" href="https://maxst.icons8.com/vue-static/landings/line-awesome/line-awesome/1.3.0/css/line-awesome.min.css">
    <link rel="stylesheet" href="<?php echo weburl; ?>asset/css/abiesoft.css">
</head>

<body>
    <input type="checkbox" name="" id="sidebar-toggle">
    <?php if ($auth->isLogin()) { ?>
        {{Side}}
        <div class="main-content">
            {{Top}}
        <?php } ?>
        {{Konten}}
        <?php if ($auth->isLogin()) { ?>
        </div>
    <?php } ?>
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
    </script>
</body>

</html>
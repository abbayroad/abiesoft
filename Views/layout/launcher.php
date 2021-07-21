<?php

use AbieSoft\Sistem\Utility\Config; ?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="<?php echo weburl; ?>asset/fa/css/all.css">
    {{CSS}}
    <title>
        <?php if (page != "") {
            echo ucFirst(page);
        } else {
            echo Config::envReader('WEB_TITEL');
        } ?>
    </title>
</head>

<body>
    <div id='loading'>
        <img src="<?php echo weburl; ?>asset/properti/icon/logo_abiesoft.png">
        <div class="lds-ring">
            <div></div>
            <div></div>
            <div></div>
            <div></div>
        </div>
    </div>
    <div class='page'>
        {{Top}}
        {{Side}}
        {{Konten}}
        {{JS}}
        {{JSA}}
    </div>
</body>

</html>
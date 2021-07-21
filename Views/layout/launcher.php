<?php

use AbieSoft\Sistem\Utility\Config; ?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
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
<?php

$hotelId = "thisShouldBeReplacedWithValidHotelIdHash"; //replace this string with a hotel id sent to you by Mews

?>

<!doctype html>
<html class="no-js" lang="">
<head>
    <meta charset="utf-8">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <title></title>
    <meta name="description" content="">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Mews Distributor needs jQuery >= 1.9.0 -->
    <script src="//ajax.googleapis.com/ajax/libs/jquery/1.11.2/jquery.min.js"></script>
    <!-- Current Mews Distributor version -->
    <script src="https://www.mews.li/distributor/current/distributor.js"></script>
</head>
<body>

    <!--[if lt IE 8]>
    <p class="browserupgrade">
        You are using an <strong>outdated</strong> browser.
        Please <a href="http://browsehappy.com/">upgrade your browser</a> to improve your experience.
    </p>
    <![endif]-->

    <!-- Add your site or application content here -->
    <p>Hello world! This is Sample page integrating MEWS Distributor.</p>

    <!-- Distributor's element, insert anywhere in website -->
    <div id="mews-distributor"></div>

    <!-- Distributor's banner, you can have multiple of these -->
    <div class="mews-distributor-banner"></div>

    <script>
        new Mews.Distributor({
            hotelId: '<?php echo $hotelId; ?>'
        });
    </script>

</body>
</html>

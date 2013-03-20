<?php
// includes and namespace. You'd normally autoload this via Composer
include '../src/Assets.php';
include '../src/StaticAsset.php';
include '../src/Script.php';
include '../src/Style.php';

use Dmlogic\Assets\Assets as Assets;

// get our config - this will differ by environment
$collections = include 'config.php';

/**
 * Here we create our collections by picking assets from those available
 * Output order is order added
 */
$defaultAssets = Assets::createCollection( $collections['default'] );

// or do this
// $homeAssets = Assets::createCollection( $collections['home'], 'home' );

?>
<html>
<head>
    <title>Assets sample</title>

    <?php
    // output collection styles
    echo $defaultAssets->styles();
    ?>

</head>

<body>

    <h1>Assets test</h1>

    <p>View the source to see your asset code generated.</p>

    <?php
    // output collection scripts
    echo $defaultAssets->scripts();
    ?>

</body>
</html>
<?php
// includes and namespace. You'd normally autoload this via Composer
include '../Assets.php';
include '../StaticAsset.php';
include '../Script.php';
include '../Style.php';

use Dmlogic\Assets\Assets as Assets;

// get our config - this will differ by environment
$collections = include 'config.php';

/**
 * Here we create our collections by picking assets from those available
 * Output order is the order added
 */
$defaultAssets = Assets::createContainer( $collections['default'] );

// or do this
// $homeAssets = Assets::createContainer( $collections['home'], 'home' );

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
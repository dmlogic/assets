<?php
// includes and namespace. You'd normally autoload this via Composer
include '../Assets.php';
include '../StaticAsset.php';
include '../Script.php';
include '../Style.php';

use Dmlogic\Assets\Assets as Assets;

/**
 * Here we declare all our available Assets as objects.
 *
 * We'd likely do this if available assets are few and used in
 * multiple collections
 */
$available = array(

    'jquery_js'     => new Dmlogic\Assets\Script(array(
                                            'path' => '//ajax.googleapis.com/ajax/libs/jquery/1/jquery.min.js'
                                          )),

    'bootstrap_css' => new Dmlogic\Assets\Style(array(
                                            'path'  => '//twitter.github.com/bootstrap/assets/css/bootstrap.css',
                                            'media' => 'screen'
                                         )),

    'bootstrap_js'  => new Dmlogic\Assets\Script(array(
                                            'path' => '//laravel.dev/assets/bootstrap/js/bootstrap.js',
                                          )),
);

/**
 * Here we create our collections from those objects
 */

// send multiple objects
Assets::container('header')->add( array( $available['jquery_js'],$available['bootstrap_css'] ) );

// send a single object
Assets::container('footer')->add($available['bootstrap_js']);

// now some output
?>
<html>
<head>
    <title>Assets sample</title>

    <?php
    // output header collection styles
    echo Assets::container('header')->styles();
    ?>

    <?php
    // output header collection scripts
    echo Assets::container('header')->scripts();
    ?>
</head>

<body>

    <h1>Assets test</h1>

    <p>View the source to see your asset code generated.</p>

    <?php
    // Add a new Asset to the footer collection after it's initial creation
    Assets::container('footer')->add(new Dmlogic\Assets\Script([
                                            'inline' => 'console.log("An inline script");'
                                          ]));
    ?>

    <?php
    // output footer collection scripts
    echo Assets::container('footer')->scripts();
    ?>
</body>
</html>
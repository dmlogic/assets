Assets
======

ANOTHER static Asset manager package for PHP 5.3+

This one is designed to support the following workflow:

* Assets are defined as Containers of one or more stylesheets or scripts
* Collection contents can vary between environments
* Your app controllers or endpoints can render Containers ready for views via a very simple interface
* The package does NOT currently compile or combine assets - you would do that using your build/deploy process and reflect the differing Containers contents in your environments
* Very extensible. More StaticAssets could be added such as SASS, LESS or Coffeescript. Or maybe even an Image class that outputs the [Picture element](http://picture.responsiveimages.org/#example-of-usage). See comments in the Classes for more info

## Installation

Install via Composer (dmlogic/assets) or

    include '../src/Assets.php';
    include '../src/StaticAsset.php';
    include '../src/Script.php';
    include '../src/Style.php';

    use Dmlogic\Assets\Assets as Assets;

## Usage

The interface is a simplified form of the Laravel 3 Asset class. Create one or
more containers, add assets to them and then render within a view.

### Create new containers

This one will be called 'default'

    $myContainer = Assets::container();

This one will be called 'home'

    $homeContainer = Assets::container('home');

### Add an asset

    $myAsset = new Dmlogic\Assets\Style(array(
                                            'path'  => '/assets/css/bootstrap.css',
                                            'media' => 'screen'
                                         ))
    $myContainer->add($myAsset);

### Render the Container

    <?= $myContainer->styles() ?>

and

    <?= $myContainer->scripts() ?>


### Create named container and add multiple assets in one command

    $myAssets = array(

        new Dmlogic\Assets\Style(array(
                                    'path'  => '/assets/css/bootstrap.css',
                                    'media' => 'screen'
                                 )),

        new Dmlogic\Assets\Style(array(
                                    'path'  => '/assets/css/print.css',
                                    'media' => 'print'
                                 )),

        new Dmlogic\Assets\Script(array(
                                    'path' => '/assets/js/bootstrap.js',
                                  ))

        new Dmlogic\Assets\Script(array(
                                    'inline' => 'console.log("useful, huh?")'
                                  ))
    );

    Assets::container('home')->add($myAssets);

### Render assets from named Container

    echo Assets::container('home')->styles();

    echo Assets::container('home')->scripts();

### Generate Containers from text arrays

One of the most likely uses of this package is to define your containers in
config files that vary per environment. A method `createContainer()` is
available to make this a simple process. It accepts two parameters, a config
array in the format
[described here](https://github.com/dmlogic/assets/blob/master/samples/config.php)
and the name of the container.

    $containers = include '/config/packages/[your_environment]/assets.php';

    $defaultAssets = Assets::createContainer( $containers['default'] );

    $homeAssets = Assets::createContainer( $containers['home'], 'home' );

## Roadmap

* Unit tests
* Exception handling
* Add to Packagist
* Create wrapper package for use in Laravel 4
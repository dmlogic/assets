Assets
======

ANOTHER static Asset manager package for PHP 5.3+

This one is designed to support the following workflow:

* One or more Collections of assets are defined
* The Collection contents can vary between environments
* A Collection can consist of one or more JavaScript or CSS files (or Less, Sass, Coffee etc. if you code them)
* The package does NOT compile or combine assets
* Your app controllers or endpoints can render collections ready for views via a very simply interface

## Installation

Install via Composer or

    include '../src/Assets.php';
    include '../src/StaticAsset.php';
    include '../src/Script.php';
    include '../src/Style.php';

    use Dmlogic\Assets\Assets as Assets;

## Defining Collections

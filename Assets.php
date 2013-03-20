<?php namespace Dmlogic\Assets;
/**
 * For generating and managing collections of Assets
 *
 * Hat tip to Laravel 3 where the concept and indeed much of the code is
 * lifted from. http://laravel.com
 */
class Assets {

    /**
     * All of the instantiated asset containers.
     *
     * @var array
     */
    public static $containers = array();

    /**
     * Get an asset container instance.
     *
     * <code>
     *      // Get the default asset container
     *      $container = Asset::container();
     *
     *      // Get a named asset container
     *      $container = Asset::container('footer');
     * </code>
     *
     * @param  string            $container
     * @return Asset_Container
     */
    public static function container($container = 'default')
    {
        if ( ! isset(static::$containers[$container]))
        {
            static::$containers[$container] = new Asset_Container($container);
        }

        return static::$containers[$container];
    }

    //--------------------------------------------------------------------------

    /**
     * A helper function to do the heavy lifting of turning a text-based config
     * array into the series of objects needed to form a collection.
     *
     * @param  array  $config   see sample file provided
     * @return Asset_Container
     */
    public static function createContainer($config = array(), $name = 'default')
    {
        $container = self::container($name);

        foreach($config as $asset) {


            if(!isset($asset['type']) || !isset($asset['attributes'])) {
                throw new \Exception('Invalid Asset config');
            }

            // @todo. Make this easier to extend with more types
            switch($asset['type']) {

                case 'script':
                    $container->add(new Script($asset['attributes']));
                    break;

                case 'style':
                    $container->add(new Style($asset['attributes']));
                    break;
            }
        }

        return $container;
    }

    //--------------------------------------------------------------------------


    /**
     * Magic Method for calling methods on the default container.
     *
     * <code>
     *      // Call the "styles" method on the default container
     *      echo Asset::styles();
     *
     *      // Call the "add" method on the default container
     *      Asset::add('jquery', 'js/jquery.js');
     * </code>
     */
    public static function __callStatic($method, $parameters)
    {
        return call_user_func_array(array(static::container(), $method), $parameters);
    }

}

class Asset_Container {

    /**
     * The asset container name.
     *
     * @var string
     */
    public $name;

    /**
     * All of the registered assets.
     *
     * @var array
     */
    public $assets = array();

    //--------------------------------------------------------------------------

    /**
     * Create a new asset container instance.
     *
     * @param  string  $name
     * @return void
     */
    public function __construct($name)
    {
        $this->name = $name;
    }

    //--------------------------------------------------------------------------

    /**
     * Add an asset to a group
     *
     * @param mixed $assets     array or StaticAsset
     * @return void
     */
    public function add($assets)
    {
        if(!is_array($assets)) {
            $assets = [$assets];
        }

        foreach($assets as $asset) {

            if(empty($asset->group)) {
                throw new \Exception('Assets must declare a group variable');
            }

            $this->assets[$asset->group][] = $asset;
        }
    }

    //--------------------------------------------------------------------------

    /**
     * Get the links to all of the registered CSS assets.
     *
     * @return  string
     */
    public function styles()
    {
        return $this->group('styles');
    }

    //--------------------------------------------------------------------------

    /**
     * Get the links to all of the registered JavaScript assets.
     *
     * @return  string
     */
    public function scripts()
    {
        return $this->group('scripts');
    }

    //--------------------------------------------------------------------------

    /**
     * Create output for a given $group
     *
     * @param  string $group 'scripts|styles'
     * @return string
     */
    protected function group($group)
    {
        if ( ! isset($this->assets[$group]) or count($this->assets[$group]) == 0) return '';

        $out = '';

        // each $assset object has a render function. Use it
        foreach ($this->assets[$group] as $asset) {
            $out .= $asset->render();
        }

        return $out;
    }
}

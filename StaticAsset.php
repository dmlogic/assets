<?php namespace Dmlogic\Assets;

/**
 * StaticAsset class
 *
 * Includes some defaults and helper functions required by any assets type
 *
 * Would be straightforward to extend this to things like less, sass and
 * coffeescript. Just extend the render() function and do all the compilation
 * and caching that you need.
 */

class StaticAsset {

    /**
     * Used to group the output.
     * Things like less would be 'styles'
     * Things like coffeescript would be 'scripts'
     *
     * @var string  scripts|styles
     */
    public $group = 'scripts';

    /**
     * key => value pairs for all the attributes needed for the type of output
     * e.g. type => 'text/javascript'
     * Nothing is validated except the path ($pathKey) so keep it legal
     *
     * @var array
     */
    protected $attributes = array();

    /**
     * To keep the interface consistent, the source of the file may be
     * provided as a 'path' attribute. Here we specify what this sould be
     * converted to for the Asset in question
     * e.g. 'src' or 'href'
     *
     * @var string
     */
    protected $pathKey = 'src';

    /**
     * The HTML tag name to output for this asset type
     * @var string
     */
    protected $tag = 'script';

    /**
     * Whether or not the above tag <closes /> (true) or <closes></closes> (false)
     *
     * @var boolean
     */
    protected $selfClose = false;

    //--------------------------------------------------------------------------

    /**
     * Pass attributes directly to setter
     *
     * @param array $attributes
     */
    public function __construct($attributes)
    {
        $this->setAttributes($attributes);
    }

    //--------------------------------------------------------------------------

    /**
     * Merges the attributes supplied with those provided to the constructor
     * Also optionally validates process and validates 'path' key
     *
     * @param array  $arr       key/value pairs of attributes
     * @param boolean $checkKey whether to validate and process the 'path' key
     */
    protected function setAttributes($arr,$checkKey = true)
    {

        if($checkKey) {

            // allow a common array key for setting the path to the asset
            if(!empty($arr['path']) && empty($arr[$this->pathKey])) {
                $arr[$this->pathKey] = $arr['path'];
                unset($arr['path']);
            }

            // if we're checking, we're also validating
            if(empty($arr[$this->pathKey])) {
                throw new \Exception('Asset path not defined');
            }
        }

        $this->attributes = array_merge($this->attributes,$arr);
    }

    //--------------------------------------------------------------------------

    /**
     * Default method for rendering an Asset
     *
     * @return string
     */
    public function render()
    {
        $out = '<'.$this->tag;

        foreach ($this->attributes as $key => $value) {

            $out .= ' '.$key.'="'.$value.'"';

        }

        if($this->selfClose) {

            $out .= ' />';

        } else {

            $out .= '></'.$this->tag.'>';
        }

        return "{$out}\n";
    }
}

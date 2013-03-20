<?php namespace Dmlogic\Assets;

/**
 * A Stylesheet asset
 */

class Style extends StaticAsset {

    // Ensures we end up in the correct group
    public $group = 'styles';

    // The HTML tag for a stylesheet
    protected $tag = 'link';

    // Set that we <close />
    protected $selfClose = true;

    // The attribute for our path
    protected $pathKey = 'href';

    // Some default attributes that we'll always want
    protected $attributes = array(
        'rel'  => 'stylesheet',
        'type' => 'text/css'
    );

    //--------------------------------------------------------------------------

    /**
     * Simply pass attributes directly to the parent class
     *
     * @param array $attributes
     */
    public function __construct($attributes)
    {
        $this->setAttributes($attributes);
    }

}
<?php namespace Dmlogic\Assets;
/**
 * A JavaScript Asset
 *
 * Designed to accept two types via attributes. If an external script is
 * required (the default), simply supply path/src attribute. You can also
 * send in a custom type attribute for things like Backbone.
 *
 * If an inline script is required, supply the attributes as follows:
 *
 * array(
 *     'display' => 'inline',
 *     'content' => 'alert("Your code");'
 * )
 *
 *
 */
class Script extends StaticAsset {

    //--------------------------------------------------------------------------

    /**
     * Provides the attributes to the parent class with a little adjustment
     *
     * @param array $attributes
     */
    public function __construct($attributes)
    {
        // if we're inline, we don't want to validate the path attribute
        $checkKey = (isset($attributes['inline'])) ? false : true;

        $this->setAttributes($attributes,$checkKey);
    }

    //--------------------------------------------------------------------------

    /**
     * Hijack the default rendering for inline scripts
     *
     * @return string
     */
    public function render()
    {

        // handle inline differently
        if(isset($this->attributes['inline'])) {

            // we'll need some content if we're inline
            if(empty($this->attributes['inline'])) {

                throw new \Exception('No inline javascript content supplied');
            }

            return $this->renderInternal();
        }

        return parent::render();

    }

    //--------------------------------------------------------------------------

    /**
     * Alternate rendering function for inline scripts
     *
     * @return sting
     */
    private function renderInternal()
    {
        $out = "<script";

        if(!empty($this->attributes['type'])) {
            $out .= ' type="'.$this->attributes['type'].'"';
        }

        $out .= ">\n".$this->attributes['inline']."\n</script>\n";

        return $out;
    }

}
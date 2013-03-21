<?php

class StaticAssetsTest extends PHPUnit_Framework_TestCase
{
    public function testCanCreateAsset()
    {
        $asset = new Dmlogic\Assets\StaticAsset(['path' => 'file.js']);
    }

    //--------------------------------------------------------------------------

    public function testRenderDefaultTag()
    {
        $asset = new Dmlogic\Assets\StaticAsset(['path' => 'file.js']);

        $this->assertEquals(trim( $asset->render() ), '<script src="file.js"></script>');
    }

    //--------------------------------------------------------------------------

    public function testRenderWithAttributes()
    {
        $atts = [
            'type' => 'text/javascript',
            'path' => 'file.js',
        ];

        $asset = new Dmlogic\Assets\StaticAsset($atts);

        $this->assertEquals($asset->render(), "<script type=\"text/javascript\" src=\"file.js\"></script>\n");
    }

}
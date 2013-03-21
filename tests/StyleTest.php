<?php

class StyleTest extends PHPUnit_Framework_TestCase
{
    public function testCanCreateStyle()
    {
        $asset = new Dmlogic\Assets\Style(['path' => 'file.css']);#
    }

    //--------------------------------------------------------------------------

    public function testRender()
    {
        $asset = new Dmlogic\Assets\Style(['path' => 'file.css']);

        $this->assertEquals($asset->render(), "<link rel=\"stylesheet\" type=\"text/css\" href=\"file.css\" />\n");
    }


    public function testCreateWithHrefAttribute()
    {
        $asset = new Dmlogic\Assets\Style(['href' => 'file.css']);

        $this->assertEquals($asset->render(), "<link rel=\"stylesheet\" type=\"text/css\" href=\"file.css\" />\n");
    }

    //--------------------------------------------------------------------------

    public function testRenderWithAttributes()
    {
        $atts = [
            'path' => 'file.css',
            'media' => "screen and (min-width: 320px)",
        ];

        $asset = new Dmlogic\Assets\Style($atts);

        $this->assertEquals($asset->render(),
                            "<link rel=\"stylesheet\" type=\"text/css\" media=\"screen and (min-width: 320px)\" href=\"file.css\" />\n");
    }
}
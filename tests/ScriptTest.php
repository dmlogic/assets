<?php

class ScriptTest extends PHPUnit_Framework_TestCase
{
    public function testCanCreateScript()
    {
        $asset = new Dmlogic\Assets\Script(['path' => 'file.js']);
    }

    public function testCreateWithSrcAttribute()
    {
        $asset = new Dmlogic\Assets\Script(['src' => 'file.js']);

        $this->assertEquals( $asset->render(), "<script src=\"file.js\"></script>\n");
    }

    //--------------------------------------------------------------------------

    public function testRenderInlineTag()
    {
        $asset = new Dmlogic\Assets\Script(['inline' => 'alert("inline");']);

        $this->assertEquals($asset->render(), "<script>\nalert(\"inline\");\n</script>\n");
    }
    //--------------------------------------------------------------------------

    public function testRenderInlineTagWithAttributes()
    {
        $atts = [
            'type' => 'text/javascript',
            'inline' => 'alert("inline");',
        ];

        $asset = new Dmlogic\Assets\Script($atts);

        $this->assertEquals($asset->render(), "<script type=\"text/javascript\">\nalert(\"inline\");\n</script>\n");
    }
}
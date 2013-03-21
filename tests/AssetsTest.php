<?php
use Dmlogic\Assets\Assets as Assets;

class AssetsTest extends PHPUnit_Framework_TestCase
{
    public function testNewContainer()
    {
        $container = Assets::container();

        $this->assertInstanceOf('Dmlogic\Assets\Asset_Container', $container);
    }

    //--------------------------------------------------------------------------

    public function testNewNamedContainer()
    {
        $container = Assets::container('mine');

        $this->assertEquals('mine', $container->name);
    }

    //--------------------------------------------------------------------------

    public function testNewContainerAndAddScript()
    {
        $container = Assets::container('testNewContainerAndAddScript');

        $container->add( new Dmlogic\Assets\Script(['path' => 'file.js']) );

        $this->assertInstanceOf('Dmlogic\Assets\Script', $container->assets['scripts'][0]);
    }

    //--------------------------------------------------------------------------

    public function testNewContainerAndAddStyle()
    {
        $container = Assets::container('testNewContainerAndAddStyle');

        $container->add( new Dmlogic\Assets\Style(['href' => 'file.css']) );

        $this->assertInstanceOf('Dmlogic\Assets\Style', $container->assets['styles'][0]);
    }

    //--------------------------------------------------------------------------

    public function testNewContainerAndAddMany()
    {
        $container = $this->newSampleContainer('testNewContainerAndAddMany');

        $this->assertInstanceOf('Dmlogic\Assets\Script', $container->assets['scripts'][0]);
        $this->assertInstanceOf('Dmlogic\Assets\Style', $container->assets['styles'][0]);

    }

    //--------------------------------------------------------------------------

    public function testOutputScripts()
    {
        /* we've already tested the output from Assets types,
           so all we really want here is a successful string outcome */

        $container = $this->newSampleContainer('testOutputScripts');

        $this->assertTag(['tag' => 'script'],$container->scripts());

    }

    //--------------------------------------------------------------------------

    public function testOutputStyles()
    {
        // as above

        $container = $this->newSampleContainer('testOutputStyles');

        $this->assertTag(['tag' => 'link'],$container->styles());
    }

    //--------------------------------------------------------------------------

    public function testCreateContainerFunction()
    {
        // a config array in required format
        $config = array(

            array( 'type'       => 'script',
                   'attributes' =>  array(
                                    'path' => 'script1.js'
                                    )
                 ),

            array( 'type'       => 'script',
                   'attributes' =>  array(
                                    'path' => 'script2.js'
                                    )
                 ),

            array( 'type'       => 'script',
                   'attributes' =>  array(
                                    'inline' => 'alert("inline");'
                                    )
                 ),

            array( 'type'       => 'style',
                   'attributes' =>  array(
                                    'path' => 'style1.css'
                                    )
                ),
            array( 'type'       => 'style',
                   'attributes' =>  array(
                                    'path' => 'style2.css',
                                    'media' => 'screen'
                                    )
                )
        );

        // make the object
        $container = Assets::createContainer( $config, 'testCreateContainerFunction' );

        $output  = $container->scripts();
        $output .= $container->styles();

        // we're going to do a direct compare here as there's loads to check
        $expected = '<script src="script1.js"></script>
<script src="script2.js"></script>
<script>
alert("inline");
</script>
<link rel="stylesheet" type="text/css" href="style1.css" />
<link rel="stylesheet" type="text/css" media="screen" href="style2.css" />
';

        $this->assertEquals($output,$expected);
    }

    //--------------------------------------------------------------------------

    private function newSampleContainer($name = null) {

        $container = Assets::container($name);

        $container->add([
                        new Dmlogic\Assets\Script(['path' => 'file.js']),
                        new Dmlogic\Assets\Style(['href' => 'file.css'])
                        ]);

        return $container;
    }

}
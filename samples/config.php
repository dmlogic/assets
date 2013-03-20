<?php
/**
 * Here we define every available script and style, then group them into containers
 *
 * The idea is that this data would be stored in an environment config file
 * allowing for containers of the same name to vary in contents across
 * environments.
 *
 * This in turn allows for a dev site to have indivdual asset files
 * (great for troubleshooting) whilst production could use compiled, combined
 * files that may even be on a CDN.
 *
 * By storing the assets detail as plain text we save on instantiating objects
 * that may or may not be used within a given endpoint in our app.
 *
 * It makes for a mighty long config, but very neat code in controllers etc.
 *
 */
$allAssets = array(

    'jquery_js'      =>  array(

                             'type'       => 'script',
                             'attributes' =>  array(
                                                    'path' => '//ajax.googleapis.com/ajax/libs/jquery/1/jquery.min.js'
                                                   )
                           ),

    'bootstrap_js'   =>  array(
                             'type'       => 'script',
                             'attributes' =>  array(
                                                    'path' => '/assets/bootstrap/js/bootstrap.js'
                                                   )
                           ),

    'home_js'        =>  array(
                             'type'       => 'script',
                             'attributes' =>  array(
                                                    'path' => '/assets/js/home.js'
                                                   )
                           ),

    'reset_css'      =>  array(
                             'type'       => 'style',
                             'attributes' =>  array(
                                                    'path' => '/assets/css/reset.css'
                                                   )
                           ),

    'global_css'     =>  array(
                            'type'       => 'style',
                            'attributes' =>  array(
                                                'path' => '/assets/css/global.css'
                                                  )
                          ),

    'bootstrap_css'  =>  array(
                            'type'       => 'style',
                            'attributes' =>  array(
                                                'path'  => '/assets/bootstrap/css/bootstrap.css',
                                                'media' => 'screen'
                                                  )
                          ),

    'home_css'       =>  array(
                            'type'       => 'style',
                            'attributes' =>  array(
                                                'path' => '/assets/css/home.css',
                                                'media' => 'screen'
                                                  )
                          ),
);

// return our container names and the list of assets they use
return array(

    'default' => array(
                        $allAssets['reset_css'],
                        $allAssets['global_css'],
                        $allAssets['bootstrap_css'],

                        $allAssets['jquery_js'],
                        $allAssets['bootstrap_js'],
                      ),

    'home'    => array(
                        $allAssets['reset_css'],
                        $allAssets['global_css'],
                        $allAssets['bootstrap_css'],
                        $allAssets['home_css'],

                        $allAssets['jquery_js'],
                        $allAssets['bootstrap_js'],
                        $allAssets['home_js'],
                      ),

    // keep on going...
);
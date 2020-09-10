<?php
if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly



function master_elementor_init(){
    Elementor\Plugin::instance()->elements_manager->add_category(
        'master-elementor',
        [
            'title'  => 'GDM Custom Elements',
            'icon' => 'apps'
        ]
    );
}
add_action('elementor/init','master_elementor_init');

function add_new_widgets(){
  require_once plugin_dir_path(__FILE__).'team.php';
}
add_action('elementor/widgets/widgets_registered','add_new_widgets');
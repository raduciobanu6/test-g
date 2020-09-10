<?php

namespace Elementor;

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

class DTF_Title_Widget extends Widget_Base{

    public function get_name(){
        return 'dtf-title';
    }

    public function get_title(){
        return 'Big Title';
    }

    public function get_icon(){
        return 'fa fa-folder-o';
    }

    public function get_categories(){
        return ['lc-elementor'];
    }

    protected function _register_controls() {
        $this->start_controls_section(
            'subtitle_text',
			[
				'label' => 'Title',
			]
        );
        
        $this->add_control(
			'title',
			[
				'label' => 'Title',
				'type' => Controls_Manager::TEXT,
                'label_block' => true
			]
        );

        $this->end_controls_section();

        $this->start_controls_section(
            'style_section',
            [
                'label' => 'Style Section',
                'tab' => \Elementor\Controls_Manager::TAB_STYLE,
            ]
        );

        $this->end_controls_section();

    }

    protected function render() {
		$settings = $this->get_settings_for_display();
        
        ?>

            <?php if($settings['title']): ?>

                <h1 class="big-title"><?php echo $settings['title']; ?></h1>

            <?php endif ?>

        <?php
	}

}

Plugin::instance()->widgets_manager->register_widget_type( new DTF_Title_Widget() );

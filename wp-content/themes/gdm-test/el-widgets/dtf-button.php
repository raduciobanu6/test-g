<?php

namespace Elementor;

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

class DTF_Header_Widget extends Widget_Base{

    public function get_name(){
        return 'dtf-button';
    }

    public function get_title(){
        return 'Button';
    }

    public function get_icon(){
        return 'fa fa-folder-o';
    }

    public function get_categories(){
        return ['lc-elementor'];
    }

    protected function _register_controls() {

        $this->start_controls_section(
            'hero_button1',
			[
				'label' => 'Button',
			]
        );
        
        $this->add_control(
			'hero_cta1_text',
			[
				'label' => 'Button Text',
				'type' => Controls_Manager::TEXT,
                'label_block' => true
			]
        );

        $this->add_control(
			'hero_cta1_button',
			[
				'label' => 'Button Link',
				'type' => Controls_Manager::TEXT,
                'label_block' => true
			]
        );

        $this->add_control(
			'arrow_position',
			[
				'label' => 'Arrow Position',
				'type' => \Elementor\Controls_Manager::SELECT,
				'default' => 'right',
				'options' => [
                    'right' => 'Right',
					'left'  => 'Left',
				],
			]
        );
        
        $this->add_control(
			'arrow_direction',
			[
				'label' => 'Arrow Direction',
				'type' => \Elementor\Controls_Manager::SELECT,
				'default' => 'right',
				'options' => [
                    'left' => 'Left',
					'right'  => 'Right',
				],
			]
		);

        $this->end_controls_section();
    }

    protected function render() {
		$settings = $this->get_settings_for_display();
        
        ?>

        <div class="row">

            <div class="col-md-12 intro-content">

                <?php if($settings['arrow_position'] == 'right'): ?>

                    <?php if($settings['hero_cta1_text']): ?>

                        <a href="<?php echo $settings['hero_cta1_button']; ?>">
                            <span class="button-text"><?php echo $settings['hero_cta1_text']; ?></span>
                            <span class="arrow button-arrow right-arrow <?php if($settings['arrow_direction'] == 'left') : ?> <?php echo 'rotate-arrow'; ?> <?php endif ?>"><img src="/wp-content/themes/bakag/img/arrow.png" alt=""></span>
                        </a>

                    <?php endif ?>

                <?php else : ?>

                    <?php if($settings['hero_cta1_text']): ?>

                        <a href="<?php echo $settings['hero_cta1_button']; ?>">
                            <span class="arrow button-arrow left-arrow <?php if($settings['arrow_direction'] == 'left') : ?> <?php echo 'rotate-arrow'; ?> <?php endif ?>"><img src="/wp-content/themes/bakag/img/arrow.png" alt=""></span>
                            <span class="button-text"><?php echo $settings['hero_cta1_text']; ?></span>
                        </a>

                    <?php endif ?>
                
                <?php endif ?>

            </div>

        </div>

        <?php
	}

}

Plugin::instance()->widgets_manager->register_widget_type( new DTF_Header_Widget() );

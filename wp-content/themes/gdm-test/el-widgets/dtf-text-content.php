<?php
namespace Elementor;

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

class DTF_Text_Widget extends Widget_Base {

	public function get_name() {
		return 'dtf-text-content';
	}

	public function get_title() {
		return 'Text Content';
	}

	public function get_icon() {
		return 'fa fa-align-left';
	}

	public function get_categories() {
		return [ 'lc-elementor' ];
	}


	protected function _register_controls() {
		$this->start_controls_section(
			'tab_content',
			[
				'label' => 'Text Content',
			]
		);

		$this->add_control(
			'columns_number',
			[
				'label' => 'Columns',
				'type' => \Elementor\Controls_Manager::SELECT,
				'default' => '4 columns',
				'options' => [
                    '1 column' => '1 column',
					'2 columns'  => '2 columns',
					'3 columns' => '3 columns',
					'4 columns' => '4 columns',
				],
			]
		);

		$this->add_control(
			'title', 
			[
				'type' => Controls_Manager::TEXT,
				'label' => 'Title',
				'label_block' => true
			]
		);

		$repeater = new Repeater ();

		$repeater->add_control(
			'text_content', 
			[
				'type' => Controls_Manager::TEXTAREA,
				'label' => 'Content'
			]
		);

		$this->add_control(
			'text_repeater',
			[
				'type' => Controls_Manager::REPEATER,
				'label' => 'Text Content',
				'fields' => $repeater->get_controls(),
				'prevent_empty' => false
			]
		);

		$this->end_controls_section();
	}

	protected function render() {
		$settings = $this->get_settings_for_display();
		?>
			<?php if($settings['title']): ?>

				<h3 class="p-title"><?php echo $settings['title']; ?></h3>

			<?php endif ?>

            <div class="row">

                    <?php foreach($settings['text_repeater'] as $text) : ?>

				        <div class="<?php if($settings['columns_number'] === '2 columns'): ?>
                                        <?php echo 'col-md-6' ?>
                                    <?php elseif($settings['columns_number'] === '3 columns'): ?>
                                        <?php echo 'col-md-4' ?>
                                    <?php elseif($settings['columns_number'] === '4 columns'): ?>
                                        <?php echo 'col-md-3' ?>
                                    <?php elseif($settings['columns_number'] === '1 column'): ?>
                                        <?php echo 'col-md-12' ?>
                                    <?php endif ?> text-content">


                            <p><?php echo $text['text_content']; ?></p>
                            
                        </div>
					
					<?php endforeach ?>

			</div>
		<?php
	}	
}

Plugin::instance()->widgets_manager->register_widget_type( new DTF_Text_Widget() );
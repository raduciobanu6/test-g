<?php
namespace Elementor;

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

class DTF_Portfolio_Details extends Widget_Base {

	public function get_name() {
		return 'dtf-portfolio-details';
	}

	public function get_title() {
		return 'Portfolio Details';
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
				'label' => 'Text Content 1',
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

		$this->add_control(
			'columns_number',
			[
				'label' => 'Columns',
				'type' => \Elementor\Controls_Manager::SELECT,
				'default' => '3 columns',
				'options' => [
                    '1 column' => '1 column',
					'2 columns'  => '2 columns',
					'3 columns' => '3 columns',
					'4 columns' => '4 columns',
				],
			]
		);

		$repeater = new Repeater();

		$repeater->add_control(
			'detail_title', 
			[
				'type' => Controls_Manager::TEXT,
				'label' => 'Title',
				'label_block' => true
			]
		);

		$repeater->add_control(
			'detail_content', 
			[
				'type' => Controls_Manager::TEXT,
				'label' => 'Content',
				'label_block' => true
			]
		);

		$this->add_control(
			'detail_portfolio',
			[
				'type' => Controls_Manager::REPEATER,
				'label' => 'Portfolio details',
				'fields' => $repeater->get_controls(),
				'title_field' => '{{{ detail_title }}}',
				'prevent_empty' => false
			]
		);

		$this->end_controls_section();
	}

	protected function render() {
		$settings = $this->get_settings_for_display();
		?>
			<?php if($settings['title']): ?>

				<h3 class="p-title small-title ptf-details-title"><?php echo $settings['title']; ?></h3>

			<?php endif ?>
			
			<div class="row">
				<?php foreach ($settings['detail_portfolio'] as $detail_item): ?>
					<div class="<?php if($settings['columns_number'] === '2 columns'): ?>
											<?php echo 'col-md-6' ?>
										<?php elseif($settings['columns_number'] === '3 columns'): ?>
											<?php echo 'col-md-4' ?>
										<?php elseif($settings['columns_number'] === '4 columns'): ?>
											<?php echo 'col-md-3' ?>
										<?php elseif($settings['columns_number'] === '1 column'): ?>
											<?php echo 'col-md-12' ?>
										<?php endif ?>  sg-ptf-details">
						<ul>
							<li>
								<span class="detail-title"><?php echo $detail_item['detail_title']; ?></span>
								<span><?php echo $detail_item['detail_content']; ?></span>
							</li>
						</ul>
					</div>
				<?php endforeach ?>
			</div>

		<?php
	}	
}

Plugin::instance()->widgets_manager->register_widget_type( new DTF_Portfolio_Details() );
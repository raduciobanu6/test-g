<?php
namespace Elementor;

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

class DTF_Services extends Widget_Base {

	public function get_name() {
		return 'dtf-services';
	}

	public function get_title() {
		return 'Services';
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
				'label' => 'Services',
			]
		);

		$this->add_control(
			'columns_number',
			[
				'label' => 'Columns',
				'type' => \Elementor\Controls_Manager::SELECT,
				'default' => '4 columns',
				'options' => [
					'2 columns'  => '2 columns',
					'3 columns' => '3 columns',
					'4 columns' => '4 columns',
				],
			]
		);

		$repeater = new Repeater();

		$repeater->add_control(
			'icon',
			[
				'label' => 'Icon',
				'type' => \Elementor\Controls_Manager::ICONS,
				'default' => [
					'value' => 'fas fa-star',
					'library' => 'solid',
				],
				'description' => 'We highly recommend you to upload your own SVG icons.',
			]
		);

		$repeater->add_control(
			'services_title', 
			[
				'type' => Controls_Manager::TEXT,
				'label' => 'Service Category Title',
				'label_block' => true
			]
		);

		$repeater->add_control(
			'services_line_1', 
			[
				'type' => Controls_Manager::TEXT,
				'label' => 'Service 1',
				'label_block' => true
			]
		);

		$repeater->add_control(
			'services_line_2', 
			[
				'type' => Controls_Manager::TEXT,
				'label' => 'Service 2',
				'label_block' => true
			]
		);

		$repeater->add_control(
			'services_line_3', 
			[
				'type' => Controls_Manager::TEXT,
				'label' => 'Service 3',
				'label_block' => true
			]
		);

		$repeater->add_control(
			'services_line_4', 
			[
				'type' => Controls_Manager::TEXT,
				'label' => 'Service 4',
				'label_block' => true
			]
		);

		$repeater->add_control(
			'services_line_5', 
			[
				'type' => Controls_Manager::TEXT,
				'label' => 'Service 5',
				'label_block' => true
			]
		);

		$this->add_control(
			'services',
			[
				'type' => Controls_Manager::REPEATER,
				'label' => 'Services',
				'fields' => $repeater->get_controls(),
				'title_field' => '{{{ services_title }}}',
				'prevent_empty' => false
			]
		);

		$this->end_controls_section();
	}

	protected function render() {
		$settings = $this->get_settings_for_display();
		?>
			
			<div class="row">
				<?php foreach ($settings['services'] as $services_item): ?>
					<div class="<?php if($settings['columns_number'] === '2 columns'): ?>
									<?php echo 'col-md-6' ?>
								<?php elseif($settings['columns_number'] === '3 columns'): ?>
									<?php echo 'col-md-4' ?>
								<?php elseif($settings['columns_number'] === '4 columns'): ?>
									<?php echo 'col-md-3' ?>
								<?php endif ?> service">

						<?php \Elementor\Icons_Manager::render_icon( $services_item['icon'], [ 'aria-hidden' => 'true' ] ); ?>

						<h3 class="service-title"><?php echo $services_item['services_title']; ?></h3>

						<ul>
							<li>
								<?php if($services_item['services_line_1']) : ?>
									<?php echo $services_item['services_line_1']; ?>
								<?php endif ?>
							</li>
							<li>
								<?php if($services_item['services_line_2']) : ?>
									<?php echo $services_item['services_line_2']; ?>
								<?php endif ?>
							</li>
							<li>
								<?php if($services_item['services_line_3']) : ?>
									<?php echo $services_item['services_line_3']; ?>
								<?php endif ?>
							</li>
							<li>
								<?php if($services_item['services_line_4']) : ?>
									<?php echo $services_item['services_line_4']; ?>
								<?php endif ?>
							</li>
							<li>
								<?php if($services_item['services_line_5']) : ?>
									<?php echo $services_item['services_line_5']; ?>
								<?php endif ?>
							</li>
						</ul>
								
					</div>
				<?php endforeach ?>
			</div>

		<?php
	}	

}

Plugin::instance()->widgets_manager->register_widget_type( new DTF_Services() );
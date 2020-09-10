<?php
namespace Elementor;

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

class Widget_Team extends Widget_Base {

	public function get_name() {
		return 'team';
	}

	public function get_title() {
		return 'Team';
	}

	public function get_icon() {
		return 'fa fa-folder-o';
	}

	public function get_categories() {
		return [ 'master-elementor' ];
	}

	public function portfolio_taxonomy() {
		$terms = get_terms( array(
			'taxonomy' => 'team-category',
			'hide_empty' => false,
		) );
		foreach ($terms as $term) {
			$taxonomy[$term->slug] = $term->name;
		}
		
		return $taxonomy;
	}

	protected function _register_controls() {
		$this->start_controls_section(
			'tab_content',
			[
				'label' => 'Team',
			]
		);

		$this->end_controls_section();
	}

	protected function render() {
		$settings = $this->get_settings_for_display();
        $arg = array(
            'post_type'   =>  'team',
            'posts_per_page'  =>  -1,
        );
        if( $settings['order_by'] ){
            $arg['orderby'] = $settings['order_by'];
        }
        if( $settings['order_post'] ){
            $arg['order'] = $settings['order_post'];
        }
        if( $settings['category_name'] ){
            $arg['tax_query'] = array(
                'relation' => 'OR',
                array(
                    'taxonomy'   =>  'team-category',
                    'field' => 'slug', 
                    'terms' => $settings['category_name']
                )
            );
        }
        $portfolio = new \WP_Query( $arg );
		?>
            <div id="team">
				<div class="team-container row">
					<?php
					$row_no = 0; 
					while($portfolio->have_posts()) : $portfolio->the_post();
					$terms = get_the_terms(get_the_id(), 'team-category');
					$term_slug = array();
					$term_name = array();
					if ( !empty( $terms ) ) {
						foreach ($terms as $term) {
						$term_slug[] = $term->slug;
						$term_name[] = $term->name;
						}                
					}
					?>                              
					<div class="team-item <?php echo join( " ", $term_slug) ?> col-12 col-sm-6 col-md-4">
						<?php the_post_thumbnail(); ?>
						<div class="member-info">
							<a href="<?php the_permalink() ?>" data-src="<?php the_post_thumbnail_url( 'full' ) ?>">
								<h2><span class="team-title"><?php the_field('nume'); ?></span><span> <span><span><?php the_field('prenume'); ?></span></h2>
							</a>
							<h6>
								<?php the_field('functie') ?>
							</h6>
							<?php
								the_content();
							?>
						</div>
					</div>
					<?php endwhile; wp_reset_postdata(); ?>
				</div>
            </div>
		<?php
	}	
}

Plugin::instance()->widgets_manager->register_widget_type( new Widget_Team() );
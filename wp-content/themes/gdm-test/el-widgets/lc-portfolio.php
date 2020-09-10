<?php
namespace Elementor;

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

class Widget_Lc_Portfolio extends Widget_Base {

	public function get_name() {
		return 'lc-portfolio';
	}

	public function get_title() {
		return 'Portfolio';
	}

	public function get_icon() {
		return 'fa fa-folder-o';
	}

	public function get_categories() {
		return [ 'lc-elementor' ];
	}

	public function portfolio_taxonomy() {
		$terms = get_terms( array(
			'taxonomy' => 'portfolio-category',
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
				'label' => 'Portfolio',
			]
		);

		$this->end_controls_section();
	}

	protected function render() {
		$settings = $this->get_settings_for_display();
        $arg = array(
            'post_type'   =>  'portfolio',
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
                    'taxonomy'   =>  'portfolio-category',
                    'field' => 'slug', 
                    'terms' => $settings['category_name']
                )
            );
        }
        $portfolio = new \WP_Query( $arg );
		?>
            <div id="portfolio" class="wow">
				<div class="portfolio-container">
					<div class="portfolio-list">
						<?php
						$row_no = 0; 
						while($portfolio->have_posts()) : $portfolio->the_post();
						$terms = get_the_terms(get_the_id(), 'portfolio-category');
						$term_slug = array();
						$term_name = array();
						if ( !empty( $terms ) ) {
							foreach ($terms as $term) {
							$term_slug[] = $term->slug;
							$term_name[] = $term->name;
							}                
						}
						?>                              
						<div class="portfolio-item <?php echo join( " ", $term_slug) ?>">
							<a href="<?php the_permalink() ?>" data-src="<?php the_post_thumbnail_url( 'full' ) ?>">
								<span class="portfolio-title"><?php the_title(); ?></span><span class="arrow"><img src="/wp-content/themes/bakag/img/arrow.png" alt=""></span>
							</a>
							<div class="portfolio-hover">
								<?php the_post_thumbnail(); ?>
								<div class="portfolio-categories">
									<?php if(!empty( $terms )) : ?>
										<?php foreach ($terms as $term) : ?>
											<span><?php echo $term->name; ?></span>
										<?php endforeach; ?>
									<?php endif; ?>
								</div>  
							</div>
						</div>
						<?php endwhile; wp_reset_postdata(); ?>
					</div>
				</div>
            </div>
		<?php
	}	
}

Plugin::instance()->widgets_manager->register_widget_type( new Widget_Lc_Portfolio() );
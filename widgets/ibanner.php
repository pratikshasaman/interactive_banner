<?php 
namespace uael_ibanner\Widgets;

use Elementor\Widget_Base; 
use Elementor\Controls_Manager; 

if ( ! defined( 'ABSPATH' ) ) exit; 
wp_enqueue_style('ibanner_style');
class uael_ibanner_class extends Widget_Base {
	public function get_name() {
		return 'uael_ibanner';
	}
	public function get_title() {
		return __( 'Interactive Banner','uael_interactive_banner' );
	}
	public function get_icon() {
		return 'eicon-posts-ticker';
	}

	public function get_categories() {
		return [ 'basic' ];
	}
	protected function _register_controls() {
		$this->start_controls_section(
			'uael_ibanner_section',
			[
				'label' => __( 'General', 'uael_interactive_banner'),
			]
		);
		$this->add_control(
			'uael_ibanner_style',
			[
				'label' => __( 'Interactive Banner Style', 'uael_interactive_banner' ),
				'type' => Controls_Manager::SELECT,
				'options' => [
					'style1' => 'Style 1',
					'style2' => 'Style 2',
					'style3' => 'Style 3',
					'style4' => 'Style 4',
					'style5' => 'Style 5',
					'style6' => 'Style 6',
					'style7' => 'Style 7',
					'style8' => 'Style 8',
					'style9' => 'Style 9',
					'style10' => 'Style 10',
					'style11' => 'Style 11',
					'style12' => 'Style 12',
					'style13' => 'Style 13',
					'style14' => 'Style 14',
				],
				'default' => 'style1',
			]
		);
		$this->add_responsive_control(
			'uael_ibanner_height',
			[
				'label' => __( 'Banner Height', 'uael_interactive_banner' ),
				'type' => Controls_Manager::SLIDER,
				'range' => [
					'em' => [
						'min' => 50,
						'max' => 300,
						'step' => 1,
					],
					'px' => [
						'min' => 50,
						'max' => 300,
					],
				],
				'default' => [
					'unit' => 'em',
				],
				'tablet_default' => [
					'unit' => 'em',
				],
				'mobile_default' => [
					'unit' => 'em',
				],
				'size_units' => [ 'em', 'px' ],
				'selectors' => [
					'{{WRAPPER}} .uael-module-content.uael-ib2-outter.uael-new-ib ' => 'height: {{SIZE}}{{UNIT}};',
				],
			]
		);
		$this->add_control(
			'uael_ibanner_image',
			[
				'label' => __( 'Choose Banner Image', 'uael_interactive_banner' ),
				'type' => Controls_Manager::MEDIA,
				'default' => [
					'url' => \Elementor\Utils::get_placeholder_image_src(),
				],
			]
		);
		$this->add_control(
			'uael_ibanner_overlay',
			[
				'label' => __( 'Banner Overlay', 'uael_interactive_banner' ),
				'type' => Controls_Manager::SWITCHER,
				'default' => '',
				'conditions' => [
					'terms' => [
						[
							'name' => 'uael_ibanner_image[url]',
							'operator' => '!=',
							'value' => '',
						],
					],
				],
			]
		);	
		$this->add_control(
			'uael_ibanner_overlay_color',
			[
				'label' => __( 'Color', 'uael_interactive_banner' ),
				'type' => Controls_Manager::COLOR,
				'default' => 'rgba(0,0,0,0.5)',
				'conditions' => [
					'terms' => [
						[
							'name' => 'uael_ibanner_overlay',
							'value' => 'yes',
						],
					],
				],
				'selectors' => [
					'{{WRAPPER}} .uael-new-ib-img' => 'background-color: {{VALUE}}',
				],
			]
		);
		$this->add_control(
			'uael_ibanner_overlay_blend_mode',
			[
				'label' => __( 'Blend Mode', 'uael_interactive_banner' ),
				'type' => Controls_Manager::SELECT,
				'options' => [
					'' => __( 'Normal', 'uael_interactive_banner' ),
					'multiply' => 'Multiply',
					'screen' => 'Screen',
					'overlay' => 'Overlay',
					'darken' => 'Darken',
					'lighten' => 'Lighten',
					'color-dodge' => 'Color Dodge',
					'color-burn' => 'Color Burn',
					'hue' => 'Hue',
					'saturation' => 'Saturation',
					'color' => 'Color',
					'exclusion' => 'Exclusion',
					'luminosity' => 'Luminosity',
				],
				'conditions' => [
					'terms' => [
						[
							'name' => 'uael_ibanner_overlay',
							'value' => 'yes',
						],
					],
				],
				'selectors' => [
					'{{WRAPPER}} .uael-new-ib-img' => 'mix-blend-mode: {{VALUE}}',
				],
			]
		);


		//link

		// $this->add_control(
		// 	'uael_ibanner_link',
		// 	[
		// 		'label' => __( 'Interactive Banner Link', 'uael_interactive_banner' ),
		// 		'type' => Controls_Manager::SWITCHER,
		// 		'default' => '',
		// 	]
		// );
		// $this->add_control(
		// 	'uael_ibanner_link_url',
		// 	[
		// 		'label' => __( 'Link', 'uael_interactive_banner' ),
		// 		'type' => Controls_Manager::URL,
		// 		'placeholder' => __( 'https://your-link.com', 'uael_interactive_banner' ),
		// 		'conditions' => [
		// 			'terms' => [
		// 				[
		// 					'name' => 'uael_ibanner_link',
		// 					'value' => 'yes',
		// 				],
		// 			],
		// 		],
		// 	]
		// );


		$this->end_controls_section();	
		$this->start_controls_section(
			'uael_ibanner_content_section',
			[
				'label' => __( 'Banner Content', 'uael_interactive_banner'),
			]
		);
		// 	$this->add_control(
		// 	'uael_ibanner_title_heading',
		// 	[
		// 		'label' => __( 'Title', 'uael_interactive_banner' ),
		// 		'type' => Controls_Manager::HEADING,
		// 		'separator' => 'before',
		// 		'default' => 'Interactive Banner',
		// 	]
		// );
		$this->add_control(
			'uael_ibanner_title_text',
			[
				'label' => __('Title:','uael_interactive_banner'),
				'type' => Controls_Manager::TEXT,
				'placeholder' => __('Title','uael_interactive_banner'),

			],	
		);
		$this->add_control(
			'uael_ibanner_title_tags',
			[
				'label' => __( 'Title HTML Tag', 'uael_interactive_banner' ),
				'type' => Controls_Manager::SELECT,
				'options' => [
					'h1' => 'H1',
					'h2' => 'H2',
					'h3' => 'H3',
					'h4' => 'H4',
					'h5' => 'H5',
					'h6' => 'H6',
					'div' => 'div',
					'span' => 'span',
					'p' => 'p',
				],
				'default' => 'h3',
			]
		);
		// $this->add_control(
		// 	'uael_ibanner_title_size',
		// 	array(
		// 		'label'   => __( 'Size', 'uael_interactive_banner' ),
		// 		'type'    => Controls_Manager::SELECT,
		// 		'default' => 'default',
		// 		'options' => array(
		// 			'default' => __( 'Default', 'uael_interactive_banner' ),
		// 			'small'   => __( 'Small', 'uael_interactive_banner' ),
		// 			'medium'  => __( 'Medium', 'uael_interactive_banner' ),
		// 			'large'   => __( 'Large', 'uael_interactive_banner' ),
		// 			'xl'      => __( 'XL', 'uael_interactive_banner' ),
		// 			'xxl'     => __( 'XXL', 'uael_interactive_banner' ),
		// 		),
		// 	)
		// );

		// 		$this->add_control(
		// 	'uael_ibanner_description_heading',
		// 	[
		// 		'label' => __( 'Description', 'uael_interactive_banner' ),
		// 		'type' => Controls_Manager::HEADING,
		// 		'separator' => 'before',
		// 	]
		// );
		$this->add_control(
			'uael_ibanner_description_text',
			[
				'label' => __('Description:','uael_interactive_banner'),
				'type' => Controls_Manager::TEXTAREA,
				'placeholder' => __('Description','uael_interactive_banner'),
				'default' => 'Enter your Description...',
				'separator' => 'before',
			],
		);
		$this->add_control(
			'uael_ibanner_button_switcher',
			[
				'label' => __( 'Call to action', 'uael_interactive_banner' ),
				'type' => Controls_Manager::SWITCHER,
				'default' => 'no',
				'separator' => 'before',
				// 'conditions' => [
				// 	'terms' => [
				// 		[
				// 			// 'name' => 'uael_ibanner_image[url]',
				// 			'operator' => '!=',
				// 			'value' => '',
				// 		],
				// 	],
				// ],
			]
		);
		$this->add_control(
			'Button text',
			[
				'label' => __( 'Text', 'uael_interactive_banner' ),
				'type' => Controls_Manager::TEXT,
				'dynamic' => [
					'active' => true,
				],
				'default' => __( 'Click here', 'uael_interactive_banner' ),
				'placeholder' => __( 'Click here', 'uael_interactive_banner' ),
				'conditions' => [
					'terms' => [
						[
							'name' => 'uael_ibanner_button_switcher',
							'value' => 'yes',
						],
					],
				],
			]
		);
		$this->add_control(
			'uael_ibanner_button_url',
			[
				'label' => __( 'Link', 'uael_interactive_banner' ),
				'type' => Controls_Manager::URL,
				'placeholder' => __( 'https://your-link.com', 'uael_interactive_banner' ),
				'conditions' => [
					'terms' => [
						[
							'name' => 'uael_ibanner_button_switcher',
							'value' => 'yes',
						],
					],
				],
			]
		);
		$this->add_responsive_control(
			'uael_ibanner_button_align',
			[
				'label' => __( 'Alignment', 'uael_interactive_banner' ),
				'type' => Controls_Manager::CHOOSE,
				'options' => [
					'left'    => [
						'title' => __( 'Left', 'uael_interactive_banner' ),
						'icon' => 'eicon-text-align-left',
					],
					'center' => [
						'title' => __( 'Center', 'uael_interactive_banner' ),
						'icon' => 'eicon-text-align-center',
					],
					'right' => [
						'title' => __( 'Right', 'uael_interactive_banner' ),
						'icon' => 'eicon-text-align-right',
					],
				],
				'conditions' => [
					'terms' => [
						[
							'name' => 'uael_ibanner_button_switcher',
							'value' => 'yes',
						],
					],
				],
				// 'prefix_class' => 'elementor%s-align-',
				// 'default' => '',
			]
		);
		$this->add_control(
			'uael_ibanner_button_selected_icon',
			[
				'label' => __( 'Icon', 'uael_interactive_banner' ),
				'type' => Controls_Manager::ICONS,
				'label_block' => true,
				'fa4compatibility' => 'icon',
				'default' => [
					'value' => 'fas fa-star',
					'library' => 'solid',
				],
				'conditions' => [
					'terms' => [
						[
							'name' => 'uael_ibanner_button_switcher',
							'value' => 'yes',
						],
					],
				],
			]
		);
		$this->add_control(
			'uael_ibanner_button_icon_position',
			[
				'label' => __( 'Icon Position', 'uael_interactive_banner' ),
				'type' => Controls_Manager::SELECT,
				'options' => [
					'left' => __( 'Before', 'uael_interactive_banner' ),
					'right' => __( 'After', 'uael_interactive_banner' ),
				],
				'default' => 'left',
				'condition' => [
					'uael_ibanner_button_selected_icon[value]!' => '',
					'uael_ibanner_button_switcher' => 'yes',	
				],
			]
		);
		$this->end_controls_section();	
		$this->start_controls_section(
			'content',
			[
				'label' => __( 'Hover', 'uael_interactive_banner' ),
				'tab' => \Elementor\Controls_Manager::TAB_STYLE,
			]
		);
		$this->add_control(
			'uael_ibanner_hover_overlay',
			[
				'label' => __( 'Banner Hover Overlay', 'uael_interactive_banner' ),
				'type' => Controls_Manager::HEADING,
				'default' => '',
			]
		);	
		$this->add_control(
			'uael_ibanner_hover_overlay_color',
			[
				'label' => __( 'Color', 'uael_interactive_banner' ),
				'type' => Controls_Manager::COLOR,
				'default' => 'rgba(0,0,0,0.5)',
				// 'selectors' => [
				// 	'{{WRAPPER}} {{CURRENT_ITEM}} .elementor-background-overlay' => 'background-color: {{VALUE}}',
				// ],
			]
		);
		$this->add_control(
			'uael_ibanner_hover_overlay_blend_mode',
			[
				'label' => __( 'Blend Mode', 'uael_interactive_banner' ),
				'type' => Controls_Manager::SELECT,
				'options' => [
					'' => __( 'Normal', 'uael_interactive_banner' ),
					'multiply' => 'Multiply',
					'screen' => 'Screen',
					'overlay' => 'Overlay',
					'darken' => 'Darken',
					'lighten' => 'Lighten',
					'color-dodge' => 'Color Dodge',
					'color-burn' => 'Color Burn',
					'hue' => 'Hue',
					'saturation' => 'Saturation',
					'color' => 'Color',
					'exclusion' => 'Exclusion',
					'luminosity' => 'Luminosity',
				],
				// 'selectors' => [
				// 	'{{WRAPPER}} {{CURRENT_ITEM}} .elementor-background-overlay' => 'mix-blend-mode: {{VALUE}}',
				// ],
			]
		);
		$this->add_control(
			'uael_ibanner_title_heading',
			[
				'label' => __( 'Title', 'uael_interactive_banner' ),
				'type' => Controls_Manager::HEADING,
				'separator' => 'before',
			]
		);
		$this->add_control(
			'uael_ibanner_title_color',
			[
				'label' => __( 'Text Color', 'uael_interactive_banner' ),
				'type' => Controls_Manager::COLOR,
				'scheme' => [
					'type' => \Elementor\Scheme_Color::get_type(),
					'value' => \Elementor\Scheme_Color::COLOR_2,
				],
				// 'selectors' => [
				// 	'{{WRAPPER}} .pratiksha-heading' => 'color: {{VALUE}};',
				// ],
				'default' => '#6ec1e4',
				'alpha' => true,
			]
		);
		$this->add_group_control(
			\Elementor\Group_Control_Typography::get_type(),
			[
				'name' => 'uael_ibanner_title_typo',
				// 'selector' => '{{WRAPPER}} .pratiksha-heading',
			]
		);
		$this->add_control(
			'uael_ibanner_description_heading',
			[
				'label' => __( 'Description', 'uael_interactive_banner' ),
				'type' => Controls_Manager::HEADING,
				'separator' => 'before',
			]
		);
		$this->add_control(
			'uael_ibanner_description_color',
			[
				'label' => __( 'Text Color', 'uael_interactive_banner' ),
				'type' => Controls_Manager::COLOR,
				'scheme' => [
					'type' => \Elementor\Scheme_Color::get_type(),
					'value' => \Elementor\Scheme_Color::COLOR_1,
				],
				// 'selectors' => [
				// 	'{{WRAPPER}} .pratiksha-heading' => 'color: {{VALUE}};',
				// ],
				'default' => '#6ec1e4',
				'alpha' => true,
			]
		);
		$this->add_group_control(
			\Elementor\Group_Control_Typography::get_type(),
			[
				'name' => 'uael_ibanner_desp_typo',
				// 'selector' => '{{WRAPPER}} .pratiksha-heading',
			]
		);
		$this->end_controls_section();	

		$this->start_controls_section(
			'uael_ibanner_button_color',
			array(
				'label' => __( 'Button Color', 'uael_interactive_banner' ),
				'tab' => \Elementor\Controls_Manager::TAB_STYLE,
				'condition' => [
					'uael_ibanner_button_switcher' => 'yes',
				],
			)
		);
		$this->start_controls_tabs( 'uael_ibanner_button_tabs' );

		$this->start_controls_tab(
			'uael_ibanner_button_normal',
			[
				'label' => __( 'Normal', 'uael_interactive_banner' ),
			]
		);
		$this->add_control(
			'uael_ibanner_button_normal_txt',
			[
				'label' => __( 'Text Color', 'uael_interactive_banner' ),
				'type' => Controls_Manager::COLOR,
				'scheme' => [
					'type' => \Elementor\Scheme_Color::get_type(),
					'value' => \Elementor\Scheme_Color::COLOR_1,
				],
				// 'selectors' => [
				// 	'{{WRAPPER}} .pratiksha-heading' => 'color: {{VALUE}};',
				// ],
				'default' => '',
				'alpha' => true,
			]
		);
		$this->add_control(
			'uael_ibanner_button_normal_background',
			[
				'label' => __( 'Background Color', 'uael_interactive_banner' ),
				'type' => Controls_Manager::COLOR,
				'scheme' => [
					'type' => \Elementor\Scheme_Color::get_type(),
					'value' => \Elementor\Scheme_Color::COLOR_1,
				],
				// 'selectors' => [
				// 	'{{WRAPPER}} .pratiksha-heading' => 'color: {{VALUE}};',
				// ],
				'default' => '',
				'alpha' => true,
			]
		);
		$this->add_control(
			'uael_ibanner_normal_icon_color',
			[
				
				'label' => __( 'Icon Color', 'uael_interactive_banner' ),
				'type' => Controls_Manager::COLOR,
				'scheme' => [
					'type' => \Elementor\Scheme_Color::get_type(),
					'value' => \Elementor\Scheme_Color::COLOR_1,
				],
				// 'selectors' => [
				// 	'{{WRAPPER}} .pratiksha-heading' => 'color: {{VALUE}};',
				// ],
				'default' => '',
				'alpha' => true,
				'condition' => [
					'uael_ibanner_button_selected_icon[value]!' => '',
					'uael_ibanner_button_switcher' => 'yes',	
				],
			]
		);
		$this->end_controls_tab();
		$this->start_controls_tab(
			'uael_ibanner_button_hover',
			[
				'label' => __( 'Hover', 'uael_interactive_banner' ),
			]
		);
		$this->add_control(
			'uael_ibanner_button_hover_txt',
			[
				'label' => __( 'Text Color', 'uael_interactive_banner' ),
				'type' => Controls_Manager::COLOR,
				'scheme' => [
					'type' => \Elementor\Scheme_Color::get_type(),
					'value' => \Elementor\Scheme_Color::COLOR_1,
				],
				// 'selectors' => [
				// 	'{{WRAPPER}} .pratiksha-heading' => 'color: {{VALUE}};',
				// ],
				'default' => '',
				'alpha' => true,
			]
		);
		$this->add_control(
			'uael_ibanner_button_hover_background',
			[
				'label' => __( 'Background Color', 'uael_interactive_banner' ),
				'type' => Controls_Manager::COLOR,
				'scheme' => [
					'type' => \Elementor\Scheme_Color::get_type(),
					'value' => \Elementor\Scheme_Color::COLOR_1,
				],
				// 'selectors' => [
				// 	'{{WRAPPER}} .pratiksha-heading' => 'color: {{VALUE}};',
				// ],
				'default' => '',
				'alpha' => true,
			]
		);
		$this->add_control(
			'uael_ibanner_hover_icon_color',
			[
				
				'label' => __( 'Icon Color', 'uael_interactive_banner' ),
				'type' => Controls_Manager::COLOR,
				'scheme' => [
					'type' => \Elementor\Scheme_Color::get_type(),
					'value' => \Elementor\Scheme_Color::COLOR_1,
				],
				// 'selectors' => [
				// 	'{{WRAPPER}} .pratiksha-heading' => 'color: {{VALUE}};',
				// ],
				'default' => '',
				'alpha' => true,
				'condition' => [
					'uael_ibanner_button_selected_icon[value]!' => '',
					'uael_ibanner_button_switcher' => 'yes',	
				],
			]
		);
		$this->end_controls_tab();
		$this->end_controls_tabs();
		$this->end_controls_section();			
	}
	public static function get_link_rel( $target, $is_nofollow = 0, $echo = 0 ) {

		$attr = '';
		if ( '_blank' === $target ) {
			$attr .= 'noopener';
		}

		if ( 1 === $is_nofollow ) {
			$attr .= ' nofollow';
		}

		if ( '' === $attr ) {
			return;
		}

		$attr = trim( $attr );
		if ( ! $echo ) {
			return 'rel="' . $attr . '"';
		}
		echo 'rel="' . $attr . '"';
	}
	protected function render() {
		$settings = $this->get_settings_for_display();
		?>
		<div class="uael-module-content uael-ib2-outter uael-new-ib uael-ib-effect-<?php echo $settings['uael_ibanner_style']; ?>">
			
			<img class="uael-new-ib-img" src="<?php echo $settings['uael_ibanner_image']['url']; ?>">
			<div class="uael-new-ib-desc">
				<?php
				if ( '' != $settings['uael_ibanner_title_text'] ) {
					?>
					<<?php echo $settings['uael_ibanner_title_tags']; ?> class="elementor-inline-editing uael-new-ib-title uael-simplify">
					<?php echo $settings['uael_ibanner_title_text'] ?>
					</<?php echo $settings['uael_ibanner_title_tags']; ?>>
					<?php
				}
				?>
				<div class="uael-new-ib-content uael-text-editor uael-simplify"><?php echo $settings['uael_ibanner_description_text']; ?></div>
			</div>
		</div> 
		<?php
	}
	protected function _content_template() {
		?>
		<div class="uael-module-content uael-ib2-outter uael-new-ib uael-ib-effect-{{{settings.uael_ibanner_style}}}">
			<img class="uael-new-ib-img" src="{{{settings.uael_ibanner_image.url}}}">
			<div class="uael-new-ib-desc">
			
			<# if ( '' != settings.uael_ibanner_title_text ) { #>
			<{{{settings.uael_ibanner_title_tags}}} class="elementor-inline-editing uael-new-ib-title uael-simplify">
			{{{settings.uael_ibanner_title_text}}}
			</{{{settings.uael_ibanner_title_tags}}}>
			<# } #>

		<div class="uael-new-ib-content uael-text-editor uael-simplify">{{{settings.uael_ibanner_description_text}}}</div>
	</div>
</div>
<?php
}
}
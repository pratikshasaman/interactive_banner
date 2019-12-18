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
	/**
	 * Retrieve the list of scripts the widget depended on.
	 *
	 * Used to set scripts dependencies required to run the widget.
	 *
	 * @since 1.0.0
	 *
	 * @access public
	 *
	 * @return array Widget scripts dependencies.
	 */
	public function get_script_depends() {
		return [ 'ibanner_script' ];
	}
	protected function _register_controls() {
		$this->start_controls_section(
			'uael_ibanner_section',
			[
				'label' => __( 'General', 'uael_interactive_banner'),
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
		// 		$this->add_control(
		// 	'uael_ibanner_height',
		// 	[
		// 		'label' => __( 'Banner Height', 'uael_interactive_banner' ),
		// 		'type' => Controls_Manager::SLIDER,
		// 		'range' => [
		// 			'em' => [
		// 				'min' => 1,
		// 				'max' => 300,
		// 				'step' => 1,
		// 			],
		// 			'px' => [
		// 				'min' =>20,
		// 				'max' => 300,
		// 				'step' => 1,
		// 			],
		// 		],
		// 		'default' => [
		// 			'unit' => 'em',
		// 		],
		// 		'size_units' => [ 'em', 'px' ],
		// 		'selectors' => [
		// 			'{{WRAPPER}} .uael-main.uael-main-min-height ' => 'height: {{SIZE}}{{UNIT}};',
		// 		],
		// 	]
		// );
		$this->add_control(
			'uael_ibanner_title_text',
			[
				'label' => __('Title:','uael_interactive_banner'),
				'type' => Controls_Manager::TEXT,
				'default' => 'Interactive Banner',
			],	
		);
		$this->add_control(
			'uael_ibanner_description_text',
			[
				'label' => __('Description:','uael_interactive_banner'),
				'type' => Controls_Manager::TEXTAREA,
				'default' => 'Enter your Description...',
			],
		);
		$this->add_control(
			'uael_ibanner_style',
			[
				'label' => __( 'Select style', 'uael_interactive_banner' ),
				'type' => Controls_Manager::SELECT,
				'options' => [
					'style1' => 'Style 1',
					'style2' => 'Style 2'
				],
				'default' => 'style1',
			]
		);
		$this->add_control(
			'uael_ibanner_overlay',
			[
				'label' => __( 'Image Overlay', 'uael_interactive_banner' ),
				'type' => Controls_Manager::SWITCHER,
				'default' => '',
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
					'{{WRAPPER}} .uael-main .uael-ib-overlay' => 'background-color: {{VALUE}}',
				],
			]
		);
		$this->end_controls_section();
		$this->start_controls_section(
			'uael_ibanner_color',
			array(
				'label' => __( 'Title & Description', 'uael_interactive_banner' ),
				'tab' => \Elementor\Controls_Manager::TAB_STYLE,
			)
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
				'label' => __( 'Color', 'uael_interactive_banner' ),
				'type' => Controls_Manager::COLOR,
				'scheme' => [
					'type' => \Elementor\Scheme_Color::get_type(),
					'value' => \Elementor\Scheme_Color::COLOR_2,
				],
				'default' => '#6ec1e4',
				'alpha' => true,
				'selectors' => [
					'{{WRAPPER}} .uael-content .uael-content-title' => 'color: {{VALUE}}',
				],
			]
		);
		$this->add_group_control(
			\Elementor\Group_Control_Typography::get_type(),
			[
				'name' => 'uael_ibanner_title_typo',
				'selector' => '{{WRAPPER}}  .uael-content .uael-content-title',

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
				'label' => __( 'Color', 'uael_interactive_banner' ),
				'type' => Controls_Manager::COLOR,
				'scheme' => [
					'type' => \Elementor\Scheme_Color::get_type(),
					'value' => \Elementor\Scheme_Color::COLOR_1,
				],
				'default' => '#6ec1e4',
				'alpha' => true,
				'selectors' => [
					'{{WRAPPER}} .uael-content .uael-content-desp' => 'color: {{VALUE}}',
				],
			]
		);
		$this->add_group_control(
			\Elementor\Group_Control_Typography::get_type(),
			[
				'name' => 'uael_ibanner_desp_typo',
				'selector' => '{{WRAPPER}}  .uael-content .uael-content-desp p',
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
			'uael_ibanner_hover_overlay_color',
			[
				'label' => __( 'Image hover overlay', 'uael_interactive_banner' ),
				'type' => Controls_Manager::COLOR,
				'default' => 'rgba(0,0,0,0.5)',
				'selectors' => [
					'{{WRAPPER}} .uael-content:hover' => 'background-color: {{VALUE}}',
				],
			]
		);
		$this->end_controls_section();
	}
	protected function render() {
		$settings = $this->get_settings_for_display();
		$this->add_render_attribute( 'uael_ib_title', 'class', 'uael-content-title' );
		$this->add_render_attribute( 'uael_ib_description', 'class', 'uael-content-desp' );
		?>
		<div class="uael-main uael-main-new-ib uael-main-<?php echo $settings['uael_ibanner_style'];?> ">
			<img class="uael-main-img" src="<?php echo $settings['uael_ibanner_image']['url']?>">
			<div class="uael-ib-overlay"></div>
			<div class="uael-content">
				<h4 <?php echo $this->get_render_attribute_string( 'uael_ib_title' ); ?>><?php echo $settings['uael_ibanner_title_text']; ?></h4>
				<div <?php echo $this->get_render_attribute_string( 'uael_ib_description' ); ?>>
					<p><?php echo $settings['uael_ibanner_description_text']; ?></p>
				</div>
			</div>
		</div>
		<?php
	}
	protected function _content_template() {
		?>
		<#
		view.addInlineEditingAttributes( 'uael_ibanner_description_text');
		view.addInlineEditingAttributes( 'uael_ibanner_description_text');
		view.addRenderAttribute( 'uael_ib_title', 'class', [ 'uael-content-title' ] );
		view.addRenderAttribute( 'uael_ib_description', 'class', [ 'uael-content-desp' ] );
		#>
		<div class="uael-main uael-main-new-ib uael-main-{{{settings.uael_ibanner_style}}} ">
			<img class="uael-main-img" src="{{{settings.uael_ibanner_image.url}}}">
			<div class="uael-ib-overlay"></div>
			<div class="uael-content">
				<h4 {{{ view.getRenderAttributeString( 'uael_ib_title' ) }}}>{{{settings.uael_ibanner_title_text}}}</h4>
				<div {{{ view.getRenderAttributeString( 'uael_ib_description' ) }}}>
					<p>{{{settings.uael_ibanner_description_text}}}</p>
				</div>
			</div>
		</div>
		<?php
	}

}
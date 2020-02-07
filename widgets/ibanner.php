<?php 
namespace uael_ibanner\Widgets;
use Elementor\Widget_Base; 
use Elementor\Controls_Manager; 
use Elementor\Icons_Manager;
use Elementor\Utils;
use Elementor\Repeater;
use Elementor\Scheme_Color;
use Elementor\Scheme_Typography;
use Elementor\Group_Control_Border;
use Elementor\Group_Control_Typography;
use Elementor\Group_Control_Box_Shadow;
use Elementor\Group_Control_Text_Shadow;
use Elementor\Group_Control_Css_Filter;

if ( ! defined( 'ABSPATH' ) ) exit; 
class uael_ibanner_class extends Widget_Base {
	public function get_name() {
		return 'uael_ibanner';
	}
	public function get_title() {
		return __( 'Interactive Banner','uael' );
	}
	public function get_icon() {
		return 'eicon-posts-ticker';
	}

	public function get_categories() {
		return [ 'basic' ];
	}
	public function get_script_depends() {
		return [ 'ibanner_script' ];
	}
	protected function _register_controls() {
		$this->start_controls_section(
			'section_ibanner_content',
			array(
				'label' => __( 'Items', 'uael' ),
			)
		);
	$repeater = new Repeater();
		
	$repeater->start_controls_tabs( 'uael_ibanner_tabs' );
	// ---------------------------------------------------------------
	$repeater->start_controls_tab(
		'uael_ibanner_content_tab',
		[
			'label' => __( 'Content', 'uael' ),
		]
	);
	$repeater->add_control(
		'uael_ibanner_title',
		array(
			'label'   => __( 'Title', 'uael' ),
			'type'    => Controls_Manager::TEXT,
			'dynamic' => array(
				'active' => true,
			),
		)
	);
	$repeater->add_control('uael_ibanner_desp', 
		[
			'label'     => __( 'Description', 'uael' ),
			'type'      => Controls_Manager::TEXTAREA,
		]
	);
	// ---------------------------[Icon Tab]------------------------------------
	$repeater->add_control(
		'uael_ibanner_icon_switcher',
		[
			'label' => __( 'Icon', 'uael' ),
			'type' => Controls_Manager::SWITCHER,
			'default' => '',
		]
	);
	$repeater->add_control('uael_ibanner_icon',
		[
			'label'     => __( 'Choose Icon', 'uael' ),
			'type'              => Controls_Manager::ICONS,
			'fa4compatibility'  => 'icon',
			'label_block'=> true,
			'default' => [
				'value'     => 'fas fa-star',
				'library'   => 'fa-solid',
			],
			'condition'      => array(
				'uael_ibanner_icon_switcher' => 'yes',
			 ),
		]
	);

	$repeater->end_controls_tab();
	// ---------------------------------------------------------------
	$repeater->start_controls_tab(
		'uael_ibanner_image_tab',
		[
			'label' => __( 'Image', 'uael' ),
		]
	);
	$repeater->add_control(
		'uael_ibanner_image',
		[
			'label' => __( 'Choose Image', 'uael' ),
			'type' => Controls_Manager::MEDIA,
			'default' => [
				'url' => Utils::get_placeholder_image_src(),
			],
			'selectors'     => array(
				'{{WRAPPER}} {{CURRENT_ITEM}}::before, {{WRAPPER}} {{CURRENT_ITEM}} .ibanner-background' => 'background-image: url("{{url}}");',
			),
		]
	);
	$repeater->end_controls_tab();

	// ---------------------------[Icon Tab]------------------------------------^^^^


	$repeater->start_controls_tab( 'tab_link', [ 'label' => __( 'Link', 'uael' ) ] );

	$repeater->add_control(
	    'show_button',
	    [
	        'label'                 => __( 'Show Button', 'uael' ),
	        'type'                  => Controls_Manager::SWITCHER,
	        'default'               => '',
	        'label_on'              => __( 'Yes', 'uael' ),
	        'label_off'             => __( 'No', 'uael' ),
	        'return_value'          => 'yes',
	    ]
	);

	$repeater->add_control(
		'link',
		[
	        'label'                 => esc_html__( 'Link', 'uael' ),
	        'type'                  => Controls_Manager::URL,
	        'label_block'           => true,
	        'default'               => [
	            'url'           => '#',
	            'is_external'   => '',
	        ],
	        'show_external'         => true,
	        'condition'             => [
	            'show_button'   => 'yes',
	        ],
		]
	);

	$repeater->add_control(
	    'button_text',
	    [
	        'label'                 => __( 'Button Text', 'uael' ),
	        'type'                  => Controls_Manager::TEXT,
	        'dynamic'               => [
	            'active'   => true,
	        ],
	        'default'               => __( 'Get Started', 'uael' ),
	        'condition'             => [
	            'show_button'   => 'yes',
	        ],
	    ]
	);

	$repeater->add_control(
		'select_button_icon',
		[
			'label'					=> __( 'Button Icon', 'uael' ),
			'type'					=> Controls_Manager::ICONS,
			'fa4compatibility'		=> 'button_icon',
	        'condition'             => [
	            'show_button'   => 'yes',
	        ],
		]
	);

	$repeater->add_control(
	    'button_icon_position',
	    [
	        'label'                 => __( 'Icon Position', 'uael' ),
	        'type'                  => Controls_Manager::SELECT,
	        'default'               => 'after',
	        'options'               => [
	            'before'    => __( 'Before', 'uael' ),
	            'after'     => __( 'After', 'uael' ),
	        ],
	        'condition'             => [
	            'show_button'   => 'yes',
	            'select_button_icon[value]!'  => '',
	        ],
	    ]
	);

	$repeater->end_controls_tab();
	$repeater->end_controls_tabs();
	$this->add_control(
		'uael_ibanner_repeator_content',
		array(
			'label'       => __( 'Banner', 'uael' ),
			'type'        => Controls_Manager::REPEATER,
			'fields'      => $repeater->get_controls(),
			'default'     => array(
				array(
					'uael_ibanner_title' => 'Image #1',
				),
				array(
					'uael_ibanner_title' => 'Image #2',
				),
			),
			'title_field' => '{{{uael_ibanner_title}}}',
		)
	);

	$this->end_controls_section();
	$this->start_controls_section(
		'ibanner_layout',
		array(
			'label' => __( 'Layout', 'uael' ),
		)
	);
	$this->add_control(
		'uael_ibanner_orientation',
		array(
			'label'       => __( 'Orientation', 'uael' ),
			'type'        => Controls_Manager::SELECT,
			'label_block' => false,
			'options'     => array(
				'horizontal'      => 'Horizontal',
				'vertical'       => 'Vertical',
			),
			'default'     => 'horizontal',
			'render_type' => 'template',
		)
	);
	$this->add_control(
		'uael_ibanner_action',
		array(
			'label'       => __( 'Accordion Action', 'uael' ),
			'type'        => Controls_Manager::SELECT,
			'label_block' => false,
			'options'     => array(
				'onclick'      => 'On Click',
				'onhover'       => 'On Hover',
			),
			'default'     => 'onhover',
		)
	);
	$this->add_responsive_control('ib_content_align',
		[
			'label'         => __( 'Content Alignment', 'uael' ),
			'type'          => Controls_Manager::CHOOSE,
			'options'       => [
				'left'      => [
					'title'=> __( 'Left', 'uael' ),
					'icon' => 'fa fa-align-left',
				],
				'center'    => [
					'title'=> __( 'Center', 'uael' ),
					'icon' => 'fa fa-align-center',
				],
				'right'     => [
					'title'=> __( 'Right', 'uael' ),
					'icon' => 'fa fa-align-right',
				],
			],
			'selectors_dictionary'  => [
				'left'      => 'flex-start',
				'center'    => 'center',
				'right'     => 'flex-end',
			],
			'default'       => 'center',
			'toggle'        => false,
			'render_type'   => 'template',
			'selectors'     => [
				'{{WRAPPER}} .uael-ibanner-section .ibanner-content-wrap ' => 'justify-content: {{VALUE}};',
			],
		]
	);





// $this->add_responsive_control(
//             'accordion_height',
//             [
//                 'label'                 => esc_html__( 'Height', 'powerpack' ),
//                 'type'                  => Controls_Manager::SLIDER,
//                 'range'                 => [
//                     'px'        => [
//                         'min'   => 50,
//                         'max'   => 1000,
//                         'step'  => 1,
//                     ],
//                 ],
//                 'size_units'            => [ 'px' ],
// 				'default'               => [
// 					'size' => 400,
// 					'unit' => 'px',
// 				],
//                 'selectors'             => [
//                     '{{WRAPPER}} .uael-ibanner-section' => 'height: {{SIZE}}px',
//                 ],
//             ]
//         );

$this->add_responsive_control('height',
            [
                'label'         => __('Image Height', 'premium-addons-pro'),
                'type'          => Controls_Manager::SLIDER,
                'size_units'    => [ 'px', 'em', 'vh' ],
                'range'         => [
                    'px'    => [
                        'min'   => 0,
                        'max'   => 1000
                    ]
                ],
                'label_block'   => true,
                'selectors'     => [
                    '{{WRAPPER}} .uael-ibanner-section .ibanner-list-li ' => 'height: {{SIZE}}{{UNIT}}',
                    '{{WRAPPER}} .uael-ibanner-section .ibanner-orientation-vertical .ibanner-list-li ' => 'height: {{SIZE}}{{UNIT}}'
                ],
            ]
        );


	$this->end_controls_section();
	$this->start_controls_section(
		'ibanner_effect',
		array(
			'label' => __( 'Effect', 'uael' ),
		)
	);
	$this->add_control(
		'uael_ibanner_effect',
		array(
			'label'       => __( 'Effect', 'uael' ),
			'type'        => Controls_Manager::SELECT,
			'label_block' => false,
			'options'     => array(
				'default' => 'Default',
				'effect1' => 'Effect 1',
				'bubba' => 'Bubba',
				'layla' => 'Layla',
				'milo' => 'Milo',
			),
			'default'     => 'default',
		)
	);
	$this->end_controls_section();
	$this->start_controls_section('ibanner_image_overlay_setting',
		[
			'label'         => __('Images', 'uael'),
			'tab'           => Controls_Manager::TAB_STYLE,
		]
	);
	$this->add_control('ib_overlay',
		[
			'label'         => __('Overlay Color', 'uael'),
			'type'          => Controls_Manager::COLOR,
			'alpha' => true,
            'selectors'     => [
                '{{WRAPPER}} .ibanner-list-li .ibanner_overlay'  => 'background-color: {{VALUE}};'
            ],
		]
	);
	$this->add_control('ib_overlay_hover',
		[
			'label'         => __('Overlay Hover Color', 'uael'),
			'type'          => Controls_Manager::COLOR,
			'selectors'     => [
				'{{WRAPPER}} .ibanner-list-li:hover .ibanner_overlay'  => 'background-color: {{VALUE}};'
			],
		]
	);
	$this->end_controls_section();
	
	$this->start_controls_section('ibanner_style_settings',
		[
			'label'         => __('Content', 'uael'),
			'tab'           => Controls_Manager::TAB_STYLE,
		]
	);
	$this->start_controls_tabs('ibanner_content_style');

	$this->start_controls_tab('ib_icon_style_section',
		[
			'label'    => __('Icon', 'uael'),
		]
	);
	$this->add_control(
		'ibanner_icon_primary_color',
		[
			'label' => __('Color', 'uael'),
			'type' => \Elementor\Controls_Manager::COLOR,
			'selectors' =>[
				'{{WRAPPER}} .uael-ibanner-container i.uael-ibanner-icon' => 'color: {{VALUE}}',
			],
			'scheme' => [
				'type' => \Elementor\Scheme_Color::get_type(),
				'value' => \Elementor\Scheme_Color::COLOR_1,
			],
		]
	);
	$this->add_control(
		'ibanner_icon_hover',
		[
			'label' => __('Hover color', 'uael'),
			'type' => \Elementor\Controls_Manager::COLOR,
			'selectors' =>[
				'{{WRAPPER}} .uael-ibanner-container i.uael-ibanner-icon:hover' => 'color: {{VALUE}}',
			],
		]
	);
	$this->add_responsive_control(
		'ibanner_icon_size',
		[
			'label' => __( 'Icon size', 'uael' ),
			'type' => \Elementor\Controls_Manager::SLIDER,
			'range' => [
				'px' => [
					'min' => 6,
					'max' => 100,
				],
			],
			'default' => [
				'size' => 40,
				'unit' => 'px',
			],
			'selectors' => [
				'{{WRAPPER}} .uael-ibanner-container i.uael-ibanner-icon' => 'font-size: {{SIZE}}{{UNIT}};',
			],
		]
	);
	$this->end_controls_tab();
	$this->start_controls_tab('ib_title_style_section',
		[
			'label'    => __('Title', 'uael'),
		]
	);
	$this->add_control(
		'ibanner_title_color',
		[
			'label' => __( 'Color', 'uael' ),
			'type' => Controls_Manager::COLOR,
			'scheme' => [
				'type' => \Elementor\Scheme_Color::get_type(),
				'value' => \Elementor\Scheme_Color::COLOR_2,
			],
			'selectors' => [
				'{{WRAPPER}} .uael-ibanner-container .uael-ibanner-title' => 'color: {{VALUE}};',
			],
			'default' => '#6ec1e4',
			'alpha' => true,
		]
	);
	$this->add_group_control(
		\Elementor\Group_Control_Typography::get_type(),
		[
			'name' => 'ib_title_typography',
			'selector' => '{{WRAPPER}} .uael-ibanner-container .uael-ibanner-title',
		]
	);
	$this->end_controls_tab();
	$this->start_controls_tab('ib_description_style_section',
		[
			'label'    => __('Description', 'uael'),
		]
	);
	$this->add_control(
		'ib_description_color',
		[
			'label' => __( 'Color', 'uael' ),
			'type' => Controls_Manager::COLOR,
			'scheme' => [
				'type' => \Elementor\Scheme_Color::get_type(),
				'value' => \Elementor\Scheme_Color::COLOR_1,
			],
			'selectors' => [
				'{{WRAPPER}} .uael-ibanner-container .uael-ibanner-description ' => 'color: {{VALUE}};',
			],
			'default' => '#7a7a7a',
		]
	);
	$this->add_group_control(
		\Elementor\Group_Control_Typography::get_type(),
		[
			'name' => 'description_typography',
			'selector' => '{{WRAPPER}} .uael-ibanner-container .uael-ibanner-description ',
		]
	);
	$this->end_controls_tab();
	$this->end_controls_tabs();
	$this->end_controls_section();

	$this->start_controls_section('container_style',
        [
            'label'         => __('Container', 'uael'),
            'tab'           => Controls_Manager::TAB_STYLE,
        ]
    );

    $this->add_group_control(
        Group_Control_Border::get_type(), 
        [
            'name'          => 'container_border',
            'selector'      => '{{WRAPPER}} .uael-ibanner-section',
        ]
    );

    $this->add_control('container_border_radius',
        [
            'label'         => __('Border Radius', 'uael'),
            'type'          => Controls_Manager::SLIDER,
            'size_units'    => ['px', '%' ,'em'],
            'selectors'     => [
                '{{WRAPPER}} .uael-ibanner-section' => 'border-radius: {{SIZE}}{{UNIT}};'
            ]
        ]
    );

    $this->add_group_control(
        Group_Control_Box_Shadow::get_type(),
        [
            'name'          => 'container_shadow',
            'selector'      => '{{WRAPPER}} .uael-ibanner-section',
        ]
    );

    $this->add_responsive_control('container_margin',
        [
            'label'         => __('Margin', 'uael'),
            'type'          => Controls_Manager::DIMENSIONS,
            'size_units'    => [ 'px', 'em', '%' ],
            'selectors'     => [
                '{{WRAPPER}} .uael-ibanner-section' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}}',
            ]
        ]
    );

    $this->end_controls_section();
   /**
     * Style Tab: Button
     * -------------------------------------------------
     */
    $this->start_controls_section(
        'section_button_style',
        [
            'label'                 => __( 'Button', 'uael' ),
            'tab'                   => Controls_Manager::TAB_STYLE,
        ]
    );

	$this->add_control(
		'button_size',
		[
			'label'                 => __( 'Size', 'uael' ),
			'type'                  => Controls_Manager::SELECT,
			'default'               => 'md',
			'options'               => [
				'xs' => __( 'Extra Small', 'uael' ),
				'sm' => __( 'Small', 'uael' ),
				'md' => __( 'Medium', 'uael' ),
				'lg' => __( 'Large', 'uael' ),
				'xl' => __( 'Extra Large', 'uael' ),
			],
		]
	);
    
    $this->add_responsive_control(
        'button_spacing',
        [
            'label'                 => esc_html__( 'Button Spacing', 'uael' ),
            'type'                  => Controls_Manager::SLIDER,
            'range'                 => [
                'px'        => [
                    'min'   => 0,
                    'max'   => 50,
                    'step'  => 1,
                ],
            ],
            'size_units'            => [ 'px' ],
			'default'               => [
				'size' => 15,
				'unit' => 'px',
			],
            'selectors'             => [
                '{{WRAPPER}} .ibanner-button' => 'margin-top: {{SIZE}}px',
            ],
        ]
    );

    $this->start_controls_tabs( 'tabs_button_style' );

    $this->start_controls_tab(
        'tab_button_normal',
        [
            'label'                 => __( 'Normal', 'uael' ),
        ]
    );

    $this->add_control(
        'button_bg_color_normal',
        [
            'label'                 => __( 'Background Color', 'uael' ),
            'type'                  => Controls_Manager::COLOR,
            'default'               => '',
            'selectors'             => [
                '{{WRAPPER}} .ibanner-button' => 'background-color: {{VALUE}}',
            ],
        ]
    );

    $this->add_control(
        'button_text_color_normal',
        [
            'label'                 => __( 'Text Color', 'uael' ),
            'type'                  => Controls_Manager::COLOR,
            'default'               => '',
            'selectors'             => [
                '{{WRAPPER}} .ibanner-button' => 'color: {{VALUE}}',
                '{{WRAPPER}} .ibanner-button .ibanner-icon svg' => 'fill: {{VALUE}}',
            ],
        ]
    );

	$this->add_group_control(
		Group_Control_Border::get_type(),
		[
			'name'                  => 'button_border_normal',
			'label'                 => __( 'Border', 'uael' ),
			'placeholder'           => '1px',
			'default'               => '1px',
			'selector'              => '{{WRAPPER}} .ibanner-button',
		]
	);

	$this->add_control(
		'button_border_radius',
		[
			'label'                 => __( 'Border Radius', 'uael' ),
			'type'                  => Controls_Manager::DIMENSIONS,
			'size_units'            => [ 'px', '%' ],
			'selectors'             => [
				'{{WRAPPER}} .ibanner-button' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
			],
		]
	);
    
    $this->add_group_control(
        Group_Control_Typography::get_type(),
        [
            'name'                  => 'button_typography',
            'label'                 => __( 'Typography', 'uael' ),
            'scheme'                => Scheme_Typography::TYPOGRAPHY_4,
            'selector'              => '{{WRAPPER}} .ibanner-button',
        ]
    );

	$this->add_responsive_control(
		'button_padding',
		[
			'label'                 => __( 'Padding', 'uael' ),
			'type'                  => Controls_Manager::DIMENSIONS,
			'size_units'            => [ 'px', 'em', '%' ],
			'selectors'             => [
				'{{WRAPPER}} .ibanner-button' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
			],
		]
	);

	$this->add_group_control(
		Group_Control_Box_Shadow::get_type(),
		[
			'name'                  => 'button_box_shadow',
			'selector'              => '{{WRAPPER}} .ibanner-button',
		]
	);

    $this->end_controls_tab();

    $this->start_controls_tab(
        'tab_button_hover',
        [
            'label'                 => __( 'Hover', 'uael' ),
        ]
    );

    $this->add_control(
        'button_bg_color_hover',
        [
            'label'                 => __( 'Background Color', 'uael' ),
            'type'                  => Controls_Manager::COLOR,
            'default'               => '',
            'selectors'             => [
                '{{WRAPPER}} .ibanner-button:hover' => 'background-color: {{VALUE}}',
            ],
        ]
    );

    $this->add_control(
        'button_text_color_hover',
        [
            'label'                 => __( 'Text Color', 'uael' ),
            'type'                  => Controls_Manager::COLOR,
            'default'               => '',
            'selectors'             => [
                '{{WRAPPER}} .ibanner-button:hover' => 'color: {{VALUE}}',
                '{{WRAPPER}} .ibanner-button:hover .ibanner-icon svg' => 'fill: {{VALUE}}',
            ],
        ]
    );

    $this->add_control(
        'button_border_color_hover',
        [
            'label'                 => __( 'Border Color', 'uael' ),
            'type'                  => Controls_Manager::COLOR,
            'default'               => '',
            'selectors'             => [
                '{{WRAPPER}} .ibanner-button:hover' => 'border-color: {{VALUE}}',
            ],
        ]
    );

	$this->add_control(
		'button_hover_animation',
		[
			'label'                 => __( 'Animation', 'uael' ),
			'type'                  => Controls_Manager::HOVER_ANIMATION,
		]
	);

	$this->add_group_control(
		Group_Control_Box_Shadow::get_type(),
		[
			'name'                  => 'button_box_shadow_hover',
			'selector'              => '{{WRAPPER}} .ibanner-button:hover',
		]
	);

    $this->end_controls_tab();
    $this->end_controls_tabs();
    
    $this->add_control(
        'button_icon_heading',
        [
            'label'                 => __( 'Icon', 'uael' ),
            'type'                  => Controls_Manager::HEADING,
            'separator'             => 'before',
        ]
    );
        
    $this->add_responsive_control(
        'button_icon_spacing',
        [
            'label'                 => esc_html__( 'Icon Spacing', 'uael' ),
            'type'                  => Controls_Manager::SLIDER,
            'range'                 => [
                'px'        => [
                    'min'   => 0,
                    'max'   => 50,
                    'step'  => 1,
                ],
            ],
            'size_units'            => [ 'px' ],
			'default'               => [
				'size' => 2,
				'unit' => 'px',
			],
            'selectors'             => [
                '{{WRAPPER}} .ibanner-icon-before .ibanner-button-icon' => 'margin-right: {{SIZE}}px',
                '{{WRAPPER}} .ibanner-icon-after .ibanner-button-icon' => 'margin-left: {{SIZE}}px',
            ],
        ]
    );
    
    $this->end_controls_section();
	}
	protected function render_button_icon( $item ) {
        $settings = $this->get_settings_for_display();
		$migration_allowed = Icons_Manager::is_migration_allowed();
		// add old default
		if ( ! isset( $item['button_icon'] ) && ! $migration_allowed ) {
			$item['hotspot_icon'] = '';
		}
		$migrated = isset( $item['__fa4_migrated']['select_button_icon'] );
		$is_new = ! isset( $item['button_icon'] ) && $migration_allowed;
		if ( ! empty( $item['button_icon'] ) || ( ! empty( $item['select_button_icon']['value'] ) && $is_new ) ) {
			?>
			<span class="ibanner-button-icon ibanner-icon ibanner-no-trans">
				<?php if ( $is_new || $migrated ) {
					Icons_Manager::render_icon( $item['select_button_icon'], [ 'aria-hidden' => 'true' ] );
				} else { ?>
						<i class="<?php echo esc_attr( $item['button_icon'] ); ?>" aria-hidden="true"></i>
				<?php } ?>
			</span>
			<?php
		}
    }
	protected function render() {
		$settings = $this->get_settings_for_display();
		$id                 = $this->get_id();
		$this->add_render_attribute('ibanner_section', 'class', 'uael-ibanner-section');
		$orientation = 'ibanner-orientation-' . $settings['uael_ibanner_orientation'];
		$this->add_render_attribute('ibanner_wrap_orientation', 'class', [$orientation,'ib-orientation'] );
		$this->add_render_attribute('ibanner_wrap_orientation', 'data-orientation-type', $settings['uael_ibanner_orientation']);
		$this->add_render_attribute('ibanner_list', 'class','ibanner-ul-list' );

		$this->add_render_attribute('ibanner_list', 'data-ib-img-accordion-id', esc_attr($this->get_id()));
		$this->add_render_attribute('ibanner_list', 'data-accordion-type', $settings['uael_ibanner_action']);
		?>
		<div class="uael-ibanner-container">
			<div <?php echo $this->get_render_attribute_string('ibanner_section'); ?>>
				<div <?php echo $this->get_render_attribute_string('ibanner_wrap_orientation'); ?>>
					<ul <?php echo $this->get_render_attribute_string('ibanner_list') . 'id="ul-ibanner-img-id-' .$this->get_id().'"'?>> 
						<?php foreach ( $settings['uael_ibanner_repeator_content'] as $index => $item ) : 
							$title       = $this->get_repeater_setting_key('uael_ibanner_title','uael_ibanner_repeator_content', $index);
							$description = $this->get_repeater_setting_key('uael_ibanner_desp','uael_ibanner_repeator_content', $index);
						if ( $item['show_button'] == 'yes' && !empty( $item['link']['url'] ) ) {
                            $button_key = $this->get_repeater_setting_key( 'button', 'accordion_items', $index );
                            $this->add_render_attribute( $button_key, 'class', [
                                    'ibanner-button',
                                    'ibanner-icon-' . $item['button_icon_position'],
                                    'elementor-button',
                                    'elementor-size-' . $settings['button_size'],
                                ]
                            );
                            if ( $settings['button_hover_animation'] ) {
                                $this->add_render_attribute( $button_key, 'class', 'elementor-animation-' . $settings['button_hover_animation'] );
                            }
                            $this->add_render_attribute( $button_key, 'href', esc_url( $item['link']['url'] ) );
                            if ( $item['link']['is_external'] ) {
                                $this->add_render_attribute( $button_key, 'target', '_blank' );
                            }
                            if ( $item['link']['nofollow'] ) {
                                $this->add_render_attribute( $button_key, 'rel', 'nofollow' );
                            }
                        }
							$this->add_render_attribute($title, 'class', 'uael-ibanner-title');
							$this->add_inline_editing_attributes($title,'none');
							$this->add_render_attribute($description, 'class', 'uael-ibanner-description');
							$this->add_inline_editing_attributes( $description, 'basic' );
							$ibanner_list_item_key = 'img_index_'.$index;
							$this->add_render_attribute( $ibanner_list_item_key, 'class',
								[
									'ibanner-list-li',
									'elementor-repeater-item-' . $item['_id'],
									'ibanner-effect-'.$settings['uael_ibanner_effect'],
								]
							);
							$this->add_render_attribute( 'ibanner_content', 'class', [ 'ibanner-content', 'ibanner-content-' . $settings['ib_content_align'] ] );
							?>
							<li <?php echo $this->get_render_attribute_string( $ibanner_list_item_key ); ?>>
								<div class="ibanner-background"></div>
								<div class="ibanner_overlay"></div>
								<div class="ibanner-content-wrap">
									<div <?php echo $this->get_render_attribute_string('ibanner_content'); ?>>
										<!--  ------[Icon]-------- -->
										<?php if (($item['uael_ibanner_icon_switcher'] === 'yes') && ( $settings['uael_ibanner_effect'] != 'milo' ) ):
											$icon_migrated = isset( $item['__fa4_migrated']['uael_ibanner_icon'] );
											$icon_new = empty( $item['icon'] ) && Icons_Manager::is_migration_allowed();
											if ( $icon_new || $icon_migrated ) :
												Icons_Manager::render_icon( $item['uael_ibanner_icon'], [ 'class' => 'uael-ibanner-icon ib-icon-key-' . $item['_id'] ,'aria-hidden' => 'true'] );
												else: ?>
													<i class="<?php echo $item['icon']; ?>"></i>
											<?php endif; ?>
										<?php endif; ?> 
										<!-- --------------- -->
											<?php if(! empty($item['uael_ibanner_title'])) : ?>
												<h3 <?php echo $this->get_render_attribute_string( $title ); ?>><?php echo $item['uael_ibanner_title'] ?></h3>
											<?php endif ?>
											<?php if( ! empty( $item['uael_ibanner_desp'] ) ) : ?>
												<div <?php echo $this->get_render_attribute_string ( $description ); ?>><?php echo $item['uael_ibanner_desp']; ?></div>
											<?php endif ?>
											<!-- ------[Button]------ -->
											<?php if ( $item['show_button'] == 'yes' && $item['link']['url'] != '' && $settings['uael_ibanner_effect'] != 'milo') { ?>
                                				<div class="ibanner-button-wrap">
                                    			<a <?php echo $this->get_render_attribute_string( $button_key ); ?>>
                                        	<?php if ( $item['button_icon_position'] == 'before' ) {
													$this->render_button_icon($item);
												}
											?>
                                       		 <?php if ( ! empty( $item['button_text'] ) ) { ?>
                                            	<span class="ibanner-button-text"><?php echo esc_attr( $item['button_text'] ); ?></span>
                                        	<?php } ?>
                                        	<?php if ( $item['button_icon_position'] == 'after' ) {
													$this->render_button_icon($item);
												}
											?>
                                    			</a>
                                				</div>
                                			<?php } ?>
									</div>
								</div>
							</li>
						<?php endforeach; ?>	
					</ul>
				</div>
			</div>
		</div>
		<?php	
	}
}
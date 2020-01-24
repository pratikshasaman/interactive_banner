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
		// $repeater->add_control(
		// 	'ibanner_link',
		// 	[
		// 		'label' => __( 'Link Complete Box', 'uael' ),
		// 		'type' => Controls_Manager::SWITCHER,
		// 		'default' => '',
		// 	]
		// );
		// $repeater->add_control(
		// 	'ibanner_link_complete_box',
		// 	array(
		// 		'label'         => __( 'Link', 'uael' ),
		// 		'type'          => Controls_Manager::URL,
		// 		'default'       => array(
		// 			'url'         => '#',
		// 			'is_external' => '',
		// 		),
		// 		'dynamic'       => array(
		// 			'active' => true,
		// 		),
		// 		'show_external' => true, // Show the 'open in new tab' button.
		// 		'condition'     => array(
		// 			'ibanner_link' => 'yes',
		// 		),
		// 		// 'selector'      => '{{WRAPPER}} a.uael-infobox-cta-link',
		// 	)
		// );

        $repeater->add_control('ibanner_link_switcher',
            [
                'label'     => __('Link','uael'),
                'type'      => Controls_Manager::SWITCHER,
                'description'=> __('Add a custom link or select an existing page link','uael'),
            ]
        );
        $repeater->add_control('ibanner_link',
            [
                'label'         => __('Link', 'uael'),
                'type'          => Controls_Manager::URL,
                'placeholder'   => 'https://uaelementor.com/',
                'label_block'   => true,
                'condition'	=> array_merge( [
                    'ibanner_link_switcher' => 'yes',
                ])
            ]
        );
        $repeater->add_control('ibanner_link_whole',
            [
                'label'         => __( 'Whole Image Link', 'uael' ),
                'type'          => Controls_Manager::SWITCHER,
                'condition'	=> array_merge( [
                    'ibanner_link_switcher' => 'yes',
                ] ),
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
		// ---------------------------------------------------------------
		$repeater->start_controls_tab(
			'uael_ibanner_icon_tab',
			[
				'label' => __( 'Icon', 'uael' ),
				// 'condition'      => array(
				// 	'uael_ibanner_effect!'=>'milo',
				// ),
			],
		);
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
				// 	'uael_ibanner_effect'=>'milo',
				),
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
				'label'       => __( 'Action', 'uael' ),
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
					'{{WRAPPER}} {{CURRENT_ITEM}} .uael-ibanner-container i.uael-ibanner-icon' => 'color: {{VALUE}}',
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
					'{{WRAPPER}} {{CURRENT_ITEM}} .uael-ibanner-container i.uael-ibanner-icon:hover' => 'color: {{VALUE}}',
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
						'max' => 300,
					],
				],
				'default' => [
					'size' => 40,
					'unit' => 'px',
				],
				'selectors' => [
					'{{WRAPPER}} {{CURRENT_ITEM}} .uael-ibanner-container i.uael-ibanner-icon' => 'font-size: {{SIZE}}{{UNIT}};',
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
		$this->end_controls_section();
	}
	protected function render() {
		$settings = $this->get_settings_for_display();
		$id                 = $this->get_id();
		$this->add_render_attribute('ibanner_section', 'class', 'uael-ibanner-section');
		// $this->add_render_attribute('ibanner_list', 'data-accordion-type', $settings['uael_ibanner_action']);
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
							$item_link = 'link_' . $index;
							$link_url = $item['ibanner_link']['url'];
							 if ( $item['ibanner_link_switcher'] === 'yes' ) {
							 	$this->add_render_attribute( $item_link, 'class', 'ibanner-accordion-item-link' );
							 	if( ! empty( $item['ibanner_link']['is_external'] ) ) {
                                        $this->add_render_attribute( $item_link, 'target', "_blank" );
                                }
                                if( ! empty( $item['ibanner_link']['nofollow'] ) ) {
                                        $this->add_render_attribute( $item_link, 'rel',  "nofollow" );
                                }
                                if( ! empty( $item['ibanner_link']['url'] ) ) {
                                        $this->add_render_attribute( $item_link, 'href',  $link_url );
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
							<?php if ( $item['ibanner_link_switcher'] === 'yes') : ?>
                                <a <?php echo $this->get_render_attribute_string ( $item_link ); ?>></a>
                            <?php endif?>
								<div class="ibanner-content-wrap">
									<div <?php echo $this->get_render_attribute_string('ibanner_content'); ?>>
										<?php if ($item['uael_ibanner_icon_switcher'] === 'yes'):
											$icon_migrated = isset( $item['__fa4_migrated']['uael_ibanner_icon'] );
											$icon_new = empty( $item['icon'] ) && Icons_Manager::is_migration_allowed();
											if ( $icon_new || $icon_migrated ) :
												Icons_Manager::render_icon( $item['uael_ibanner_icon'], [ 'class' => 'uael-ibanner-icon ib-icon-key-' . $item['_id'] ,'aria-hidden' => 'true'] );
												else: ?>
													<i class="<?php echo $item['icon']; ?>"></i>
												<?php endif; ?>
											<?php endif; ?> 
											<?php if(! empty($item['uael_ibanner_title'])) : ?>
												<h3 <?php echo $this->get_render_attribute_string( $title ); ?>><?php echo $item['uael_ibanner_title'] ?></h3>
											<?php endif ?>
											<?php if( ! empty( $item['uael_ibanner_desp'] ) ) : ?>
												<div <?php echo $this->get_render_attribute_string ( $description ); ?>><?php echo $item['uael_ibanner_desp']; ?>
											</div>
										<?php endif ?>

										<!-- <?php //if ( $item['ibanner_link_switcher'] === 'yes') : ?>
                                                <a <?php// echo $this->get_render_attribute_string ( $item_link ); ?>>
                                                </a>
                                        <?php //endif;?> -->
									</div>
								</div>
							</li>
						<?php //} ?>
						<?php endforeach; ?>	
					</ul>
				</div>
			</div>
		</div>
		<?php	
	}
}
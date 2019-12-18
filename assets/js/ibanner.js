( function( $ ) {
	 var WidgetHelloWorldHandler = function( $scope, $) {
	 	if ( 'undefined' == typeof $scope )
	 		return;
	 	var scope_id = $scope.data( 'id' );
	 	jQuery(".elementor-widget-uael_ibanner .uael-main").hover(function () {
	 		jQuery(this).addClass("uael-main-hover");
	 	},
	 	function () {
	 		jQuery(this).removeClass("uael-main-hover");
	 	});
	 };
	$( window ).on( 'elementor/frontend/init', function() {
		elementorFrontend.hooks.addAction( 'frontend/element_ready/uael_ibanner.default', WidgetHelloWorldHandler );
	} );
} )( jQuery );
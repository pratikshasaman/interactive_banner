
var ibanner = function($scope, $) {
	var $ibanner = $scope.find(".ibanner-ul-list").eq(0);
	$id =$ibanner.data("ib-img-accordion-id") !== undefined? $ibanner.data("ib-img-accordion-id"): "";
  $type =$ibanner.data("accordion-type") !== undefined? $ibanner.data("accordion-type"): "";
  if( $type == 'onclick'){
    $("#ul-ibanner-img-id-" + $id + " li").off('click').on( 'click', function(e) {
    if( $(this).hasClass('on-click-class')){
      // $(this).removeClass("on-click-class");
      return;
    }
    else {
      $(this).siblings().removeClass("on-click-class");
      $(this).addClass('on-click-class');    
    } 
  });
 }
  // var $ibanner2 = $scope.find(".ib-orientation").eq(0);
  // $orientation = $ibanner2.data("orientation-type") !== undefined? $ibanner2.data("orientation-type"): "";
  // if( $orientation  == 'vertical'){
  //   var count = $(".ibanner-ul-list").children().length;
  //   if(count == 1) {
  //     $(".ibanner-list-li").css("height","400px");
  //   }
  // }
}
jQuery(window).on("elementor/frontend/init", function() {
  elementorFrontend.hooks.addAction(
   "frontend/element_ready/uael_ibanner.default",ibanner);
});


$(function() {
	$('.sidebar-nav li').removeClass('active');
   	$(".sidebar-nav li:eq(6)").addClass('active');
   	$(".sidebar-nav li:eq(6) a").click(function(event){
      		event.preventDefault();
      	});

   	$(document).on("click",".sidebar-toggle",function(event){
			event.preventDefault();
		    $(".wrapper").toggleClass("toggled");
		});
})
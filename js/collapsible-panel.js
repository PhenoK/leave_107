// 17/05/10�s�Wpanel�P�|�\��
$(function() {
	$(".panel-heading span.clickable").on('click', function(e) { togglePanel(this); });
});

function togglePanel(obj){
	var $this = $(obj);
	if (!$this.hasClass('panel-collapsed')) {
		$this.parents('.panel').find('.panel-body').slideUp();
		$this.addClass('panel-collapsed');
		$this.find('i').removeClass('glyphicon-chevron-up').addClass('glyphicon-chevron-down');
	} else {
		$this.parents('.panel').find('.panel-body').slideDown();
		$this.removeClass('panel-collapsed');
		$this.find('i').removeClass('glyphicon-chevron-down').addClass('glyphicon-chevron-up');
	}
}
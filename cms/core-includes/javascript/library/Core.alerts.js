var Alerts = {
	alerts: null,
	init: function()
	{
		this.alerts = $('.inline_alert');
		if(this.alerts.length == 1)
		{
			this.alerts.hide();
			this.alerts.slideDown();
			root = this;
			this.alerts.find('.close').click( function( event)
			{
				
				setTimeout( function(){ root.hide(); }, 400);
				event.preventDefault();
			});
		}
	},
	hide: function()
	{
		this.alerts.slideUp();
	}
};

(function( $ ) {
	$( function()
	{
		Alerts.init();
	})
})( jQuery );
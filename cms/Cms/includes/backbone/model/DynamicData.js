var DynamicData = Backbone.Model.extend({
	urlRoot : 'index.php?a=cms&r=dynamicData',
	url: function(){
		if(this.isNew())
		{
			var url = 'index.php?a=cms&r=dynamicData';
		}else{
			console.log(url);
			var url = 'index.php?a=cms&r=dynamicData&id=' + this.id;

		}
		return url;
	}
});

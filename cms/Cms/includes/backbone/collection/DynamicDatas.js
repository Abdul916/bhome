var DynamicDatas = Backbone.Collection.extend({
	model: DynamicData,
	urlRoot : 'index.php?a=cms&r=dynamicData',
	url: 'index.php?a=cms&r=dynamicData'
});
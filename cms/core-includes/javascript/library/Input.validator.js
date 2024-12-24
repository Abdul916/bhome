var validator = {};

validator.isEmpty = function( jq_field)
{
	if(jq_field.val() == '')
	{
		return true;
	}
	
	return false;
}
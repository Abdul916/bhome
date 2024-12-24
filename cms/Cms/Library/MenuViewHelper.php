<?php
/**
* 
*/
class Cms_Library_MenuViewHelper
{
	static $counter = 0;
	function __construct()
	{
		# code...
	}
	
	static function printUls( Cms_Model_MenuItem $menuItem , $menu)
	{
		if(Cms_Library_MenuViewHelper::$counter > 10)
			return;
		
		if($menuItem->count() > 0):
			echo '<ul>';
			foreach($menuItem as $item):
			 	echo '<li>';
				echo ' <h4>'. $item->get('title');
				echo ' <a href="';
				Core_Common_Route::linkController('menuItem:edit', array('id' => $item->get('id') , 'menu_id' => $menu->get('id') , 'site_id' => $_GET['site_id']));
				echo '">Editar</a>';
				echo '<span>' . $item->publishStatusToNoun( $item->get('publish_status')) . '</span>';
				echo '</h4>';
				Cms_Library_MenuViewHelper::$counter++;
				Cms_Library_MenuViewHelper::printUls( $menu->getChildsForMenuItem( $item) , $menu);
				
				echo '</li>';
			endforeach;
			echo '</ul>';
		endif;
		
		
		return;
	}
}

?>
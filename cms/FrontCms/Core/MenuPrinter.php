<?php
/**
* Abstract para impresión de de menus
*  - Incluye el loop para imprimir
*/
abstract class FrontCms_Core_MenuPrinter
{
	public $menu; // Cms_Model_Menu

	function __construct()
	{
		# code...
	}

	public function printli($item)
	{
		echo '<li><a href="index.php?seccid='.$item->get('id').'">'.$item->get('title').'</a>';

		if( $this->menu->getChildsForMenuItem($item)->isCollection())
		{
			$secmenu = $this->menu->getChildsForMenuItem($item);
			$aux = new self( $this->menu);
			$aux->loadFromMenuItem( $secmenu);
			$this->addChildMenu( $aux);
			echo "\n";
			echo '<ul>';
			$aux->printAsHtmlList();
			echo '</ul>';
		}
		echo "</li> \n";
	}
}

?>
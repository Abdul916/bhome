<?php
/**
*
*/
class Cms_Library_Menu implements Iterator
{
	protected $menuItemModel;
	protected $chids;
	protected $position;
	function __construct( Cms_Model_MenuItem $item)
	{
		if($item->count() == 0)
		{

			return null;
		}
		$this->chids = array();
		$this->menuItemModel = $item;
	}

	function addMenu( Cms_Library_Menu $menu)
	{
		$this->chids[] = $menu;
	}
	function hasChilds()
	{
		return (count($this->chids) > 0) ? true : false;
	}

	function rewind() {
        $this->position = 0;
    }
	function current() {
        return $this->chids[$this->position];
    }

    function key() {
        return $this->position;
    }

    function next() {
        ++$this->position;
    }

    function valid() {
        return isset($this->chids[$this->position]);
    }
}


?>
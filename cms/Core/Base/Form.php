<?php
/*
 * Helper para manejo de formas
 *
 * Descripci—n larga
 * Created on May 6, 2010
 *
 * @category    Core
 * @package    Core_Base
 * @author Hector Centeno <hector@blueadventures.me>
 * @version 1.0
 */

class Core_Base_Form  {


    static function getCheckbox($checkboxname, $req)
    {
    	$check = $req->post($checkboxname);
    	if(!$check)
    	{
    		return 0;
    	}
    	return 1;
    }
}


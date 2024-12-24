<?php
/*
 * Control de fechas para aplicaciones
 *
 * Descripci—n larga
 * Created on Jan 24, 2010
 *
 * @category    BlueFramework
 * @package    Core_Base
 * @author Hector Centeno <hector@blueadventures.me>
 * @version 1.0
 */

class Core_Base_Date {
    /**
     * A sample private variable, this can be hidden with the --parseprivate
     * option
     * @access private
     * @var integer|string
     */
    static $timeZoneSet= 0;
	static $mouths = array('', 'Enero', 'Febrero', 'Marzo', 'Abril', 'Mayo', 'Junio', 'Julio', 'Agosto', 'Septiembre', 'Octubre', 'Noviembre', 'Diciembre');
    function __construct()
    {
        # code...
    }
    static function setTimeZone()
    {
    	if(self::$timeZoneSet == 0)
    		return;
    	date_default_timezone_set('America/Mexico_City');
    	self::$timeZoneSet = 1;
    }
    static function getTimeUTC()
    {
    	date_default_timezone_set('UTC');
		return date('H:i:s');
    }
    static function getDate()
    {
    	self::setTimeZone();
    	return date("Y-m-d");
    }
    static function getDateTime($diff_time = null)
    {
    	if($diff_time)
    	{
    		return Core_Base_Date::getDateTimeByDiff($diff_time);
    	}
    	self::setTimeZone();
    	return date("Y-m-d H:i:s");
    }
    static function getDateTimeByDiff($diff_time)
    {
		$diff_hour = Core_Base_Date::getTimeDiff($diff_time);
    	return  date('Y-m-d H:i:s', strtotime($diff_hour." hour"));
    }
    static function getTime($diff_time = null, $format = "H:i:s")
    {
    	if($diff_time)
    	{
    		return Core_Base_Date::getTimeByDiff($diff_time, $format);
    	}
    	self::setTimeZone();
    	return date($format);
    }
    static function getTimeDiff( $diff_time)
    {
		if($diff_time < 0)
		{
			// la diferencia de horarios es hacia america
			$diff_hour = ($diff_time * 1) - (date('O') * 1);
		}
		$diff_hour = $diff_hour / 100;
		return $diff_hour;
    }
    static function getTimeByDiff( $diff_time, $format = "H:i:s")
    {
    	$diff_hour = Core_Base_Date::getTimeDiff($diff_time);
    	return  date($format, strtotime($diff_hour." hour"));
    }
	static function mouth($i)
	{
		return self::$mouths[$i];
	}
	static function DaysBetweenDates($a, $b)
	{
		$gd_a = getdate( $a );
		$gd_b = getdate( $b );

		// Now recreate these timestamps, based upon noon on each day
		// The specific time doesn't matter but it must be the same each day
		
		$a_new = mktime( 12, 0, 0, $gd_a['mon'], $gd_a['mday'], $gd_a['year'] );
		$b_new = mktime( 12, 0, 0, $gd_b['mon'], $gd_b['mday'], $gd_b['year'] );
		
		// Subtract these two numbers and divide by the number of seconds in a
		// day. Round the result since crossing over a daylight savings time
		// barrier will cause this time to be off by an hour or two.
		
		return round( abs( $a_new - $b_new ) / 86400 );
	}
	static function spanishDate($date,  $format = '%d %B %Y')
	{
	  $arr = explode("-", $date);
	  setlocale(LC_TIME, "es_ES");
	  return strftime( $format, mktime (0,0,0, $arr[1], $arr[2], $arr[0]));
	}
	static function stringDate( $strdate, $spanish = true)
	{
		$mounths = array('01', '02', '03', '04', '05', '06', '07', '08', '09', '10', '11', '12');
		$meses   = array('Ene', 'Feb', 'Mar', 'Abr', 'May', 'Jun', 'Jul', 'Ago', 'Sep', 'Oct', 'Nov', 'Dic');
		
		if(!$strdate) return '0000-00-00';
		
		if($spanish)
		{
			$strdate = str_replace($meses, $mounths, $strdate);
		}
		
		$strdate = str_replace(array(',', ' '), array('', '-'), trim($strdate));
		//echo $strdate; echo '<br />';
		$exp = explode('-', $strdate);
		//print_r($exp);
		$strdate = $exp[1].'/'.$exp[0].'/'.$exp[2];
		
		//$d = new DateTime($strdate);
		//$d->format('Y-m-d');
		return date( 'Y-m-d', strtotime($strdate));
	}
}


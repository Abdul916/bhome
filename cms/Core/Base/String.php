<?php
/*
 * Helper para control de cadenas de texto
 *
 * Descripci�n larga
 * Created on May 7, 2010
 *
 * @category    Atlas
 * @package    Atlas_Core
 * @author Hector Centeno <hector@blueadventures.me>
 * @version 1.0
 */

class Core_Base_String {
    /**
     * A sample private variable, this can be hidden with the --parseprivate
     * option
     * @access private
     * @var integer|string
     */

	static function assign_rand_value($num)
	{
		// accepts 1 - 36
		switch($num)
		{
			case "1":
				$rand_value = "a";
				break;
			case "2":
				$rand_value = "b";
				break;
			case "3":
				$rand_value = "c";
				break;
			case "4":
				$rand_value = "d";
				break;
			case "5":
				$rand_value = "e";
				break;
			case "6":
				$rand_value = "f";
				break;
			case "7":
				$rand_value = "g";
				break;
			case "8":
				$rand_value = "h";
				break;
			case "9":
				$rand_value = "i";
				break;
			case "10":
				$rand_value = "j";
				break;
			case "11":
				$rand_value = "k";
				break;
			case "12":
				$rand_value = "l";
				break;
			case "13":
				$rand_value = "m";
				break;
			case "14":
				$rand_value = "n";
				break;
			case "15":
				$rand_value = "o";
				break;
			case "16":
				$rand_value = "p";
				break;
			case "17":
				$rand_value = "q";
				break;
			case "18":
				$rand_value = "r";
				break;
			case "19":
				$rand_value = "s";
				break;
			case "20":
				$rand_value = "t";
				break;
			case "21":
				$rand_value = "u";
				break;
			case "22":
				$rand_value = "v";
				break;
			case "23":
				$rand_value = "w";
				break;
			case "24":
				$rand_value = "x";
				break;
			case "25":
				$rand_value = "y";
				break;
			case "26":
				$rand_value = "z";
				break;
			case "27":
				$rand_value = "0";
				break;
			case "28":
				$rand_value = "1";
				break;
			case "29":
				$rand_value = "2";
				break;
			case "30":
				$rand_value = "3";
				break;
			case "31":
				$rand_value = "4";
				break;
			case "32":
				$rand_value = "5";
				break;
			case "33":
				$rand_value = "6";
				break;
			case "34":
				$rand_value = "7";
				break;
			case "35":
				$rand_value = "8";
				break;
			case "36":
				$rand_value = "9";
				break;
		}
		return $rand_value;
	}
    static function randomString( $length = 8)
    {
		if($length>0)
		{
			$rand_id="";
			for($i=1; $i<=$length; $i++)
			{
				mt_srand((double)microtime() * 1000000);
				$num = mt_rand(1,26);
				$rand_id .= Core_Base_String::assign_rand_value($num);
			}
		}
		return $rand_id;
    }
    static function dateYearsDiff($birthday){
		list($year,$month,$day) = explode("-",$birthday);
		$year_diff  = date("Y") - $year;
		$month_diff = date("m") - $month;
		$day_diff   = date("d") - $day;
		if ($day_diff < 0 || $month_diff < 0)
			$year_diff--;
		return $year_diff;
	}

    static function moneyFormat($valor, $sign = '$')
	{
		$v = $sign."".number_format($valor , 2);
		return $v;
	}
	static function toggle($one='',$two='') {
		static $toggle = false;
		$toggle = empty($one) && empty($two) ? true : $toggle;
		$toggle = $toggle ? false : true;
		return $toggle ? $one : $two;
	}
	static public function normalize ($string) {
	    $table = array(
	        'Š'=>'S', 'š'=>'s', 'Đ'=>'Dj', 'đ'=>'dj', 'Ž'=>'Z', 'ž'=>'z', 'Č'=>'C', 'č'=>'c', 'Ć'=>'C', 'ć'=>'c',
	        'À'=>'A', 'Á'=>'A', 'Â'=>'A', 'Ã'=>'A', 'Ä'=>'A', 'Å'=>'A', 'Æ'=>'A', 'Ç'=>'C', 'È'=>'E', 'É'=>'E',
	        'Ê'=>'E', 'Ë'=>'E', 'Ì'=>'I', 'Í'=>'I', 'Î'=>'I', 'Ï'=>'I', 'Ñ'=>'N', 'Ò'=>'O', 'Ó'=>'O', 'Ô'=>'O',
	        'Õ'=>'O', 'Ö'=>'O', 'Ø'=>'O', 'Ù'=>'U', 'Ú'=>'U', 'Û'=>'U', 'Ü'=>'U', 'Ý'=>'Y', 'Þ'=>'B', 'ß'=>'Ss',
	        'à'=>'a', 'á'=>'a', 'â'=>'a', 'ã'=>'a', 'ä'=>'a', 'å'=>'a', 'æ'=>'a', 'ç'=>'c', 'è'=>'e', 'é'=>'e',
	        'ê'=>'e', 'ë'=>'e', 'ì'=>'i', 'í'=>'i', 'î'=>'i', 'ï'=>'i', 'ð'=>'o', 'ñ'=>'n', 'ò'=>'o', 'ó'=>'o',
	        'ô'=>'o', 'õ'=>'o', 'ö'=>'o', 'ø'=>'o', 'ù'=>'u', 'ú'=>'u', 'û'=>'u', 'ü'=>'u', 'ý'=>'y', 'ý'=>'y',
	        'þ'=>'b','ÿ'=>'y', 'Ŕ'=>'R', 'ŕ'=>'r', 'ª' => 'a'
	    );

	    return strtr($string, $table);
	}
    static public function plainString( $text)
    {
    	$text = Core_Base_String::normalize( $text);
    	$t = strtolower( strtr($text, " &", "--"));

    	$no=array('[', ']', '¿', '?','/','(',')',' ','–', '+', 'ª','´', "'", "\\", ':', '.', '“', '"', '”', ',', '’', '‘', '%');
    	$si=array('-', '', '', '','','','','-', '', '', 'a', '', '', '', '', '', '', '', '', '', '', '', '');

    	$t = str_replace($no, $si, $t);
    	$t = str_replace('--', '-', $t);
		return $t;
    }
	static function arrayImplode( $glue, $separator, $array, $user_key = true ) {
	    if ( ! is_array( $array ) ) return $array;
	    $string = array();
	    foreach ( $array as $key => $val ) {
	        if ( is_array( $val ) )
	            $val = implode( ',', $val );
			if($user_key)
	        $string[] = "{$key}{$glue}{$val}";
			else
			$string[] = "{$glue}{$val}{$glue}";
	    }
	    return implode( $separator, $string );

	}


    /**
    * Truncates text.
    *
    * Cuts a string to the length of $length and replaces the last characters
    * with the ending if the text is longer than length.
    *
    * @param string  $text String to truncate.
    * @param integer $length Length of returned string, including ellipsis.
    * @param string  $ending Ending to be appended to the trimmed string.
    * @param boolean $exact If false, $text will not be cut mid-word
    * @param boolean $considerHtml If true, HTML tags would be handled correctly
    * @return string Trimmed string.
    */
   static function truncate($text, $length = 100, $ending = '...', $exact = true, $considerHtml = false) {
        if ($considerHtml) {
            // if the plain text is shorter than the maximum length, return the whole text
            if (strlen(preg_replace('/<.*?>/', '', $text)) <= $length) {
                return $text;
            }
           
            // splits all html-tags to scanable lines
            preg_match_all('/(<.+?>)?([^<>]*)/s', $text, $lines, PREG_SET_ORDER);
   
            $total_length = strlen($ending);
            $open_tags = array();
            $truncate = '';
           
            foreach ($lines as $line_matchings) {
                // if there is any html-tag in this line, handle it and add it (uncounted) to the output
                if (!empty($line_matchings[1])) {
                    // if it's an "empty element" with or without xhtml-conform closing slash (f.e. <br/>)
                    if (preg_match('/^<(\s*.+?\/\s*|\s*(img|br|input|hr|area|base|basefont|col|frame|isindex|link|meta|param)(\s.+?)?)>$/is', $line_matchings[1])) {
                        // do nothing
                    // if tag is a closing tag (f.e. </b>)
                    } else if (preg_match('/^<\s*\/([^\s]+?)\s*>$/s', $line_matchings[1], $tag_matchings)) {
                        // delete tag from $open_tags list
                        $pos = array_search($tag_matchings[1], $open_tags);
                        if ($pos !== false) {
                            unset($open_tags[$pos]);
                        }
                    // if tag is an opening tag (f.e. <b>)
                    } else if (preg_match('/^<\s*([^\s>!]+).*?>$/s', $line_matchings[1], $tag_matchings)) {
                        // add tag to the beginning of $open_tags list
                        array_unshift($open_tags, strtolower($tag_matchings[1]));
                    }
                    // add html-tag to $truncate'd text
                    $truncate .= $line_matchings[1];
                }
               
                // calculate the length of the plain text part of the line; handle entities as one character
                $content_length = strlen(preg_replace('/&[0-9a-z]{2,8};|&#[0-9]{1,7};|&#x[0-9a-f]{1,6};/i', ' ', $line_matchings[2]));
                if ($total_length+$content_length> $length) {
                    // the number of characters which are left
                    $left = $length - $total_length;
                    $entities_length = 0;
                    // search for html entities
                    if (preg_match_all('/&[0-9a-z]{2,8};|&#[0-9]{1,7};|&#x[0-9a-f]{1,6};/i', $line_matchings[2], $entities, PREG_OFFSET_CAPTURE)) {
                        // calculate the real length of all entities in the legal range
                        foreach ($entities[0] as $entity) {
                            if ($entity[1]+1-$entities_length <= $left) {
                                $left--;
                                $entities_length += strlen($entity[0]);
                            } else {
                                // no more characters left
                                break;
                            }
                        }
                    }
                    $truncate .= substr($line_matchings[2], 0, $left+$entities_length);
                    // maximum lenght is reached, so get off the loop
                    break;
                } else {
                    $truncate .= $line_matchings[2];
                    $total_length += $content_length;
                }
               
                // if the maximum length is reached, get off the loop
                if($total_length>= $length) {
                    break;
                }
            }
        } else {
            if (strlen($text) <= $length) {
                return $text;
            } else {
                $truncate = substr($text, 0, $length - strlen($ending));
            }
        }
       
        // if the words shouldn't be cut in the middle...
        if (!$exact) {
            // ...search the last occurance of a space...
            $spacepos = strrpos($truncate, ' ');
            if (isset($spacepos)) {
                // ...and cut the text in this position
                $truncate = substr($truncate, 0, $spacepos);
            }
        }
       
        // add the defined ending to the text
        $truncate .= $ending;
       
        if($considerHtml) {
            // close all unclosed html-tags
            foreach ($open_tags as $tag) {
                $truncate .= '</' . $tag . '>';
            }
        }
       
        return $truncate;
       
    }


}


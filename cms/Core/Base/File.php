<?php
/*
 * Helper de manejo de archivos
 *
 * Implementa metodos para control de archivos, descarga, upload, seguridad, etc
 * Created on May 6, 2010
 *
 * @category    Atlas
 * @package    Atlas_Core
 * @author Hector Centeno <hector@blueadventures.me>
 * @version 1.0
 */

class Core_Base_File {
    /**
     * A sample private variable, this can be hidden with the --parseprivate
     * option
     * @access private
     * @var integer|string
     */
	static function getFilename($fname)
	{
		$t=Core_Base_File::correctSlashes($fname);
		$slash=strpos($t,"/");
		if($slash !== false ){
			$cv=explode("/",$t);
			$fname=$fname=substr($cv[count($cv)-1],0,-4);
			return $fname;
		}
		return $t;
	}
	static function getFileNameNoExtension( $fname)
	{
		$t=Core_Base_File::correctSlashes($fname);
		$slash=strrpos($t,".");
		if($slash !== false ){
			$cv=explode("/",$t);
			$fname=$fname=substr($t,0,$slash);
			return $fname;
		}
		return $t;
	}
	static function correctSlashes($stx){
		$stx=str_replace("\\","/",$stx);
		return $stx;
	}

	static function getFileExtension($url){
	  $ext = substr(strrchr($url, "."), 1);
	  return $ext;
	}

    static function upload($file_name, $savePath, $newname = false, $tolower = false)
    {
		if ( $_FILES[$file_name]['name'] != "")
		{
			$filename=Core_Base_File::getFilename($_FILES[$file_name]['name']);
			$ext=Core_Base_File::getFileExtension( $filename );
			if($newname != false)
				$newfile = $newname.".".$ext;
			else
				$newfile = $filename;

			if($tolower)
			{
				$newfile = strtolower($newfile);
			}
			
			if(move_uploaded_file($_FILES[$file_name]['tmp_name'], $savePath.$newfile ))
			{
				return true;
			}else{
				// echo "Error move upload";
			}
		}

		return false;
	}
	static function forceDownload($filepath, $filename)
	{
		$filename = basename($filename);
		
		if( is_file($filepath.$filename))
		{
			header('Content-disposition: attachment; filename='. $filename);
			header('Content-type: application/octet-stream');
			header("Content-Transfer-Encoding: binary");
			readfile($filepath.$filename);
			exit;
		}
		else{
			error_log('Error, la ruta no es valida o el archivo no existe: '. $filepath.$filename);
		}
	}
	static function humanFileSize($bytes, $precision = 2) { 
	    $units = array('B', 'KB', 'MB', 'GB', 'TB'); 

		    $bytes = max($bytes, 0); 
		    $pow = floor(($bytes ? log($bytes) : 0) / log(1024)); 
		    $pow = min($pow, count($units) - 1); 

		    $bytes /= pow(1024, $pow); 

		    return round($bytes, $precision) . ' ' . $units[$pow]; 
	}
}


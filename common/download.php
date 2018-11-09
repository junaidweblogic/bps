<?
// Determines platform (OS), browser and version of the user
// Based on a phpBuilder article:
//   see http://www.phpbuilder.net/columns/tim20000821.php
	if (!defined('PMA_USR_OS')) {
		// loic1 - 2001/25/11: use the new globals arrays defined with
		// php 4.1+
		if (!empty($_SERVER['HTTP_USER_AGENT'])) {
			$HTTP_USER_AGENT = $_SERVER['HTTP_USER_AGENT'];
		} else if (!empty($HTTP_SERVER_VARS['HTTP_USER_AGENT'])) {
			$HTTP_USER_AGENT = $HTTP_SERVER_VARS['HTTP_USER_AGENT'];
		}
		// 1. Platform
		if (strstr($HTTP_USER_AGENT, 'Win')) {
			define('PMA_USR_OS', 'Win');
		} else if (strstr($HTTP_USER_AGENT, 'Mac')) {
			define('PMA_USR_OS', 'Mac');
		} else if (strstr($HTTP_USER_AGENT, 'Linux')) {
			define('PMA_USR_OS', 'Linux');
		} else if (strstr($HTTP_USER_AGENT, 'Unix')) {
			define('PMA_USR_OS', 'Unix');
		} else if (strstr($HTTP_USER_AGENT, 'OS/2')) {
			define('PMA_USR_OS', 'OS/2');
		} else {
			define('PMA_USR_OS', 'Other');
		}
		// 2. browser and version
		if (ereg('MSIE ([0-9].[0-9]{1,2})', $HTTP_USER_AGENT, $log_version)) {
			define('PMA_USR_BROWSER_VER', $log_version[1]);
			define('PMA_USR_BROWSER_AGENT', 'IE');
		} else if (ereg('Opera(/| )([0-9].[0-9]{1,2})', $HTTP_USER_AGENT, $log_version)) {
			define('PMA_USR_BROWSER_VER', $log_version[2]);
			define('PMA_USR_BROWSER_AGENT', 'OPERA');
		} else if (ereg('OmniWeb/([0-9].[0-9]{1,2})', $HTTP_USER_AGENT, $log_version)) {
			define('PMA_USR_BROWSER_VER', $log_version[1]);
			define('PMA_USR_BROWSER_AGENT', 'OMNIWEB');
		} else if (ereg('Mozilla/([0-9].[0-9]{1,2})', $HTTP_USER_AGENT, $log_version)) {
			define('PMA_USR_BROWSER_VER', $log_version[1]);
			define('PMA_USR_BROWSER_AGENT', 'MOZILLA');
		} else if (ereg('Konqueror/([0-9].[0-9]{1,2})', $HTTP_USER_AGENT, $log_version)) {
			define('PMA_USR_BROWSER_VER', $log_version[1]);
			define('PMA_USR_BROWSER_AGENT', 'KONQUEROR');
		} else {
			define('PMA_USR_BROWSER_VER', 0);
			define('PMA_USR_BROWSER_AGENT', 'OTHER');
		}
	} // $__PMA_DEFINES_LIB__


/**
 * Defines the <CR><LF> value depending on the user OS.
 *
 * @return  string   the <CR><LF> value to use
 *
 * @access  public
 */

        $the_crlf = "\n";

        // The 'PMA_USR_OS' constant is defined in "./libraries/defines.lib.php"
        // Win case
        if (PMA_USR_OS == 'Win') {
            $the_crlf = "\r\n";
        }
        // Mac case
        else if (PMA_USR_OS == 'Mac') {
            $the_crlf = "\r";
        }
        // Others
        else {
            $the_crlf = "\n";
        }

/*
	 end of defining the <CR><LF>
*/


//START/////DOWNLOAD FILE///////////////////
	$crlf = $the_crlf;

	$mime_type = (PMA_USR_BROWSER_AGENT == 'IE' || PMA_USR_BROWSER_AGENT == 'OPERA')
			   ? 'application/octetstream'
			   : 'application/octet-stream';

    // Send headers
    header('Content-Type: ' . $mime_type);
    // lem9 & loic1: IE need specific headers
    if (PMA_USR_BROWSER_AGENT == 'IE') {
        header('Content-Disposition: attachment; filename="' . $filename . '.' . $ext . '"');
        header('Expires: 0');
        header('Cache-Control: must-revalidate, post-check=0, pre-check=0');
        header('Pragma: public');
    } else {
        header('Content-Disposition: attachment; filename="' . $filename . '.' . $ext . '"');
        header('Expires: 0');
        header('Pragma: no-cache');
    }

//END/////DOWNLOAD FILE///////////////////

?>
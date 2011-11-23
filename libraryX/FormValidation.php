<?php
/**
 * class FormValidation
 *
 * @author Pontus <bopontuskarlsson@hotmail.com>
 * @version 1.0
 * @category projectX
 * @package ProjectX
 */
/**
 * Custom validation for projectX
 *
 * <p>This class is used for form validation in ProjectX</p>
 * @author Pontus
 * @version 1.0
 * @category projectX
 * @package ProjectX
 */
class FormValidation {
	/**
     * <p>Check that a string do not exceed maxlenght</p>
     *
     * @access public
     * @param string str
     * @param string maxlenght	 
     * @return bool
     */
	public function valMaxLenght($str, $maxlenght) {
		if(strlen($str) < $maxlenght ? true : false);
	}
    /**
     * <p>Validate url</p>
     * <p>with or without http:// and https://</p>
     *
     * @access public
     * @param string tags
     * @return bool true or false
     */
    public function valUrl($value) {
        $value = trim($value);
        $validhost = true;
        if (strpos($value, 'http://') === false && strpos($value, 'https://') === false) {
            $value = 'http://' . $value;
        }
        //first check with php's FILTER_VALIDATE_URL
        if (filter_var($value, FILTER_VALIDATE_URL, FILTER_FLAG_HOST_REQUIRED) === false) {
            $validhost = false;
        } else {
            //not all invalid URLs are caught by FILTER_VALIDATE_URL
            //use our own mechanism
            $host = parse_url($value, PHP_URL_HOST);
            $dotcount = substr_count($host, '.');
            //the host should contain at least one dot
            if ($dotcount > 0) {
                //if the host contains one dot
                if ($dotcount == 1) {
                    //and it start with www.
                    if (strpos($host, 'www.') === 0) {
                        //there is no top level domain, so it is invalid
                        $validhost = false;
                    }
                } else {
                    //the host contains multiple dots
                    if (strpos($host, '..') !== false) {
                        //dots can't be next to each other, so it is invalid
                        $validhost = false;
                    }
                }
            } else {
                //no dots, so it is invalid
                $validhost = false;
            }
        }
        //return false if host is invalid
        //otherwise return true
        return $validhost;
    }
    /**
     * Word Censoring Function
     *
     * <p>Supply a string and an array of disallowed words and any</p>
     * <p>matched words will be converted to #### or to the replacement</p>
     * </p>word you've submitted.</p>
     *
     * @access	public
     * @param	string	the text string
     * @param	string	the array of censoered words
     * @param	string	the optional replacement value
     * @return	string
     */
    function word_censor($str, $censored, $replacement = '') {
        if (!is_array($censored)) {
            return $str;
        }
        $str = ' ' . $str . ' ';
        $delim = '[-_\'\"`(){}<>\[\]|!?@#%&,.:;^~*+=\/ 0-9\n\r\t]';
        foreach ($censored as $badword) {
            if ($replacement != '') {
                $str = preg_replace("/({$delim})(" . str_replace('\*', '\w*?', preg_quote($badword, '/')) . ")({$delim})/i", "\\1{$replacement}\\3", $str);
            } else {
                $str = preg_replace("/({$delim})(" . str_replace('\*', '\w*?', preg_quote($badword, '/')) . ")({$delim})/ie", "'\\1'.str_repeat('#', strlen('\\2')).'\\3'", $str);
            }
        }
        return trim($str);
    }
    /**
     * Validate an email
     *
     * <p>This function verifies that the email address complies with the following
     * standards:</p>
     * <p>RFC 822, RFC 1035, RFC 2821, RFC 2822</p>
     * <p>It also ensures that the domain actually resolves.</p>
     *
     * @access public
     * @param string email
     * @return bool true or false
     */
    //Todo: Can I trust you?
    public function valEmail($email) {
        // get position of the final @ symbol
        $index = strrpos($email, "@");
        if (is_bool($index) && !$index) return false;
        // split up the email address into domain and local parts
        $domain = substr($email, $index + 1);
        $local = substr($email, 0, $index);
        // determine string length
        $l_len = strlen($local);
        $d_len = strlen($domain);
        // verify strings aren't too short or too long
        if ($l_len < 1 || $l_len > 64) return false;
        if ($d_len < 1 || $d_len > 255) return false;
        // verify that we don't start or end with a .
        if ($local[0] == '.' || $local[$l_len - 1] == '.') return false;
        if ($domain[0] == '.' || $domain[$d_len - 1] == '.') return false;
        // verify we don't have two .'s in succession
        if (preg_match('/\\.\\./', $local)) return false;
        if (preg_match('/\\.\\./', $domain)) return false;
        // check for disallowed characters
        if (!preg_match('/^[A-Za-z0-9\\-\\.]+$/', $domain)) return false;
        if (!preg_match('/^(\\\\.|[A-Za-z0-9!#%&`_=\\/$\'*+?^{}|~.-])+$/', str_replace("\\\\", "", $local))) {
            // check for invalid escape sequences in the local part
            if (!preg_match('/^"(\\\\"|[^"])+"$/', str_replace("\\\\", "", $local))) return false;
            // check for valid DNS records
            if (!(checkdnsrr($domain, "MX") || checkdnsrr($domain, "A") || checkndsrr("AAAA"))) return false;
        }
        // return true, the email is valid.
        return true;
    }
}
?>
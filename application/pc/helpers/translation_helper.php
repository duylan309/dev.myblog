<?php
	require_once APPPATH. 'third_party/translation.php';
	
    function __($key, $domain = 'core') {
        $gt = Translation::newInstance()->_get($domain);
        
        if(!$gt) {
            return $key;
        }
        return $gt->translate($key);
    }

    /**
     * Translate strings (echo them)
     *
     * @param string $key
     * @param string $domain
     * @return string
     */
    function _e($key, $domain = 'core') {
        $gt = Translation::newInstance()->_get($domain);

        if(!$gt) {
            echo $key;
            return '';
        }
        echo $gt->translate($key);
        return '';
    }

    /**
     * Translate string (flash messages)
     *
     * @param string $key
     * @return string
     */
    function _m($key) {
        return __($key, 'messages');
    }

?>
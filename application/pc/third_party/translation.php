<?php 
    require_once APPPATH .'third_party/php-gettext/streams.php';
    require_once APPPATH .'third_party/php-gettext/gettext.php';

    class Translation {
        private $messages;
        private static $instance;

        public static function newInstance() {
            if(!self::$instance instanceof self) {
                self::$instance = new self ;
            }
            return self::$instance ;
        }

        function __construct() {
            // get user/admin locale
            $locale = 'vi_VN';
            if(isset($_SESSION['site_locale'])){
            	$locale = $_SESSION['site_locale'];
            }

            // load core
            $core_file = APPPATH .'language/' . $locale . '/core.mo';            
            $this->_load($core_file, 'core');

            // load messages
            $messages_file = APPPATH .'language/' . $locale . '/messages.mo';
           
            $this->_load($messages_file, 'messages');
        }

        function _get($domain) {
            if(!isset($this->messages[$domain])) {
                return false;
            }

            return $this->messages[$domain];
        }

        function _set($domain, $reader) {
            if(isset($messages[$domain])) {
               false;
            }

            $this->messages[$domain] = $reader;
            return true;
        }

        function _load($file, $domain) {
            if(!file_exists($file)) {
                return false;
            }

            $streamer = new FileReader($file);
            $reader = new gettext_reader($streamer);
            return $this->_set($domain, $reader);
        }
    }

?>
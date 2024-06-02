<?php
    ini_set('display_errors', 1);
    error_reporting(E_ERROR | E_WARNING | E_PARSE | E_NOTICE);
    

    // define el separador de directorio
    define('DS', DIRECTORY_SEPARATOR);

    //define la ruta base
    define('ROOT',realpath(dirname(__FILE__)).DS);
    
    //define la ruta del core
    define('CORE_PATH',ROOT . 'src' . DS. 'class'. DS);

    //define la ruta de las librerias externas
    define('LIB_PATH',ROOT . 'src' . DS. 'lib'. DS);

    //define la ruta de configuracion
    define('CONF_PATH',ROOT . 'src' . DS. 'config'. DS);

    //define la ruta de aplicacion
    define('APP_PATH',ROOT . 'applications' . DS);

    //define la ruta de los log
    define('LOG_PATH',ROOT . 'log' . DS);

    try{   

        require_once CORE_PATH . 'config.php' ;	  		
        require_once CORE_PATH . 'autoload.php' ;
        require_once CORE_PATH . 'hash.php';
            
        
        $registry = registry::getInstancia();
        $registry ->_request = new request();
        $registry ->_db = new db();
        // die("prueba");
        bootstrap ::start($registry->_request);
      
    } catch (Exception $e) 
            {
                echo $e->getMessage();
            }
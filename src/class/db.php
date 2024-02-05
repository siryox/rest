<?php
// clase padre para conexion a base de datos Mysql extendiendo de pdo 
class db extends PDO
{
              
          public function __construct() {
                
                        parent::__construct(
                        'mysql:host=' . DB_HOST .
                        ';dbname=' . DB_NAME,
                        DB_USER, 
                        DB_PASS, 
                        array(
                            PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES ' . DB_CHAR
                            ));
                
           }
           
           
   
	public function getInsertedId(){
		return self::lastInsertId();
	}

	public function getError(){
		return self::errorInfo();
	} 
           
    // Method that starts transaction in MYSQL  
    public function start()
    {
        self::beginTransaction(); 
    }
    
    
    // Method that confirms transaction in MYSQL 
    public function confirm()
    {
        self::commit();
    }
    
    // Method that cancels transaction in MYSQL 
    public function cancel()
    {
        self::rollBack();
        $error =$this->getError();
        logger::errorLog($error['2'],'DB');
    }   

    
           
}

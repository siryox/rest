<?php
    final class securityModel extends model
    {


        public function __construct()
        {
            parent::__construct('Usuarios');
            
        }


        public function login($datos)
        {
            $user = $datos['user'];
           // $password = $datos['psw'];
            $tocken = $datos['tocken'];

            $sql = "select count(*) as total from Usuarios where email_usuario = '$user' and tocken_usuario = '$tocken'";
            $res = $this->_db->query($sql);
            if($res){
                $res->setFetchMode(PDO::FETCH_ASSOC);
                $total =  $res->fetch();
                if($total['total']>0)
                {
                    return true;
                }else
                    return false;
            }else
                {
                    $error =$this->_db->getError();
                    logger::errorLog($error['2'],'DB');           
                    return array();	
                }
            

        }

    }
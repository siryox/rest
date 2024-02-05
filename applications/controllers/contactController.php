<?php
    final class contactController extends controller
    {

        private $_contact;
        private $_security;

        public function __construct()
        {
            parent::__construct();

            //model para gestion de clientes
            $this->_contact = $this->loadModel('contact');
           
            ///model para gestionar seguridad en la conexion
            $this->_security = $this->loadModel('security');
           
            $this->getLibrary('logger');
            $this->getLibrary('validate');
        }

        public function index()
        {

            $user =  validate::getPostParam('user');
            $tocken = validate::getPostParam('tocken');
            $valores = array();
            $datos = ['user'=>$user,'tocken'=>$tocken];
            
            if($this->_security->login($datos))
            {
                
                $method = validate::getPostParam('method');
                
                $nameMethod = $method['name'];
                $fields = (isset($method['fields']))?$method['fields']:null;
                $search = (isset($method['search']))?$method['search']:null;
                $index = (isset($method['index']))?$method['index']:null;

                $parameters = ['fields'=>$fields,'search'=>$search,"index"=>$index];
                if($nameMethod=='list')
                {
                    $valores = $this->_contact->list($parameters);
                }

                if(is_array($valores) && count($valores))
                {
                    echo json_encode(['date'=>date("F j, Y, g:i a"),'url'=>BASE_URL,'values'=>$valores],true);
                }else
                    echo json_encode(['date'=>date("F j, Y, g:i a"),'url'=>BASE_URL,'values'=>"Not Resul"],true);


            }else
                {
                    echo "no conecto......".json_encode($datos);

                }

        }


        public function create()
        {

            $user =  validate::getPostParam('user');
            $tocken = validate::getPostParam('tocken');
            $valores = array();
            $datos = ['user'=>$user,'tocken'=>$tocken];
            if($this->_security->login($datos))
            {
                $method = validate::getPostParam('method');
                
                $nameMethod = $method['name'];
                $fields = (isset($method['fields']))?$method['fields']:null;

                $parameters = ['fields'=>$fields];

                if($nameMethod =='create')
                {
                    if($this->_contact->create($parameters))
                    {
                        echo json_encode(['date'=>date("F j, Y, g:i a"),'url'=>BASE_URL,'values'=>"Method Success"],true);
                    }else
                        echo json_encode(['date'=>date("F j, Y, g:i a"),'url'=>BASE_URL,'values'=>"Method Faild"],true);

                }


            }else
                echo json_encode(['date'=>date("F j, Y, g:i a"),'url'=>BASE_URL,'values'=>"Login Faild"],true);


        }


        public function update()
        {
            $user =  validate::getPostParam('user');
            $tocken = validate::getPostParam('tocken');
            $valores = array();
            $datos = ['user'=>$user,'tocken'=>$tocken];
            
            if($this->_security->login($datos))
            {
                $method = validate::getPostParam('method');
                
                $nameMethod = $method['name'];
                $fields = (isset($method['fields']))?$method['fields']:null;
                $search = (isset($method['search']))?$method['search']:null;
                $parameters = ['fields'=>$fields,'search'=>$search];
                if($nameMethod=='update')
                {
                    if($valores = $this->_contact->update($parameters))
                    {
                        echo json_encode(['date'=>date("F j, Y, g:i a"),'url'=>BASE_URL,'values'=>"Method Success"],true);
                    }else
                        echo json_encode(['date'=>date("F j, Y, g:i a"),'url'=>BASE_URL,'values'=>"Method Faild"],true);
                    }
                }           
                
            
            }    

        
            public function delete()
            {
                $user =  validate::getPostParam('user');
                $tocken = validate::getPostParam('tocken');
                $valores = array();
                $datos = ['user'=>$user,'tocken'=>$tocken];
                
                if($this->_security->login($datos))
                {
                    $method = validate::getPostParam('method');
                    
                    $nameMethod = $method['name'];
                    //$fields = (isset($method['fields']))?$method['fields']:null;
                    $search = (isset($method['search']))?$method['search']:null;
                    $parameters = ['search'=>$search];
                    if($nameMethod=='delete')
                    {
                        if($valores = $this->_contact->delete($parameters))
                        {
                            echo json_encode(['date'=>date("F j, Y, g:i a"),'url'=>BASE_URL,'values'=>"Method Success"],true);
                        }else
                            echo json_encode(['date'=>date("F j, Y, g:i a"),'url'=>BASE_URL,'values'=>"Method Faild"],true);
                        }
                    }           
                    
                
                }    




    }
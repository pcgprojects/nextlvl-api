<?php
namespace spa\V1\Rest\Models;

use Zend\Db\Sql\Select;
use Zend\Db\Adapter\Adapter;
use Zend\Db\Adapter\AdapterInterface;
use Zend\Paginator\Adapter\DbSelect;
use Zend\Db\Sql\Sql;
use Zend\Db\Sql\Update;
use Zend\Db\Adapter\Driver\DriverInterface;

class UserMapper
{

    protected $adapter;
    protected $table_name;

    public function __construct(AdapterInterface $adapter)
    {
        $this->adapter = $adapter;
    }

    public function newUserSP($datos){
        
        try {

            $sql = 'call newUser(:nro_doc,:names,:ape_pat,:ape_mat,:email,:cell,:id_referido,:role_id,:pass)';
            
            $driver = $this->adapter->getDriver();
            $stmt = $driver->createStatement($sql);
            $stmt->prepare();
            $result = $stmt->execute($datos);
            $current = $result->current();
            $result->getResource()->closeCursor();
            return $current;
        } catch (\Exception $e) {
            return array('id' => -1, 'msg' => $e->getMessage());
        }
    
    }

    public function getUserById($id)
    {

        $data = array();

        try {
            $sql = new Sql($this->adapter);
            $select = new Select('tb_cliente');
            $select->columns(array(
                        'id_cliente',
                        'num_documento',
                        'nombres',
                        'ape_pat',
                        'ape_mat',
                        'email',
                        'num_celular',
                        'acumulado' => new \Zend\Db\Sql\Expression("fn_acumulado(".$id.")")
                    ))->where(array('num_estado' => 1,'id_cliente' => $id));
                    //->order('num_orden asc');
            $statement = $sql->prepareStatementForSqlObject($select);
            $results = $statement->execute();
            foreach ($results as $dat) {
                $data[] = [
                    'id' => utf8_encode($dat['id_cliente']), 
                    'num_documento' => utf8_encode($dat['num_documento']),
                    'nombres' => utf8_encode($dat['nombres']),
                    'ape_pat' => utf8_encode($dat['ape_pat']),
                    'ape_mat' => utf8_encode($dat['ape_mat']),
                    'email' => utf8_encode($dat['email']),
                    'num_celular' => utf8_encode($dat['num_celular']),
                    'acumulado' => utf8_encode($dat['acumulado'])
                ];
            }
            if ($results->count() === 1) {
                return $data[0];
            }
            return $data;
        } catch (\Exception $ex) {
            return array(
                'estado' => -100,
                'mensaje' => 'Error: ' . $ex->getMessage()
            );
        }
        if (!$data) {
            return false;
        }
        return $data;
    }

    public function getAllUsers()
    {

        $data = array();

        try {
            $sql = new Sql($this->adapter);
            $select = new Select('tb_cliente');
             $select->columns(array(
                        'id_cliente',
                        'num_documento',
                        'nombres',
                        'ape_pat',
                        'ape_mat',
                        'email',
                        'num_celular'
                    ))->where(array('num_estado' => 1));
                    //->order('num_orden asc');
            $statement = $sql->prepareStatementForSqlObject($select);
            $results = $statement->execute();
            foreach ($results as $dat) {
                $data[] = [
                    'id' => utf8_encode($dat['id_cliente']), 
                    'num_documento' => utf8_encode($dat['num_documento']),
                    'nombres' => utf8_encode($dat['nombres']),
                    'ape_pat' => utf8_encode($dat['ape_pat']),
                    'ape_mat' => utf8_encode($dat['ape_mat']),
                    'email' => utf8_encode($dat['email']),
                    'num_celular' => utf8_encode($dat['num_celular'])
                ];
            }
            if ($results->count() === 1) {
                return $data[0];
            }
            return $data;
        } catch (\Exception $ex) {
            return array(
                'estado' => -100,
                'mensaje' => 'Error: ' . $ex->getMessage()
            );
        }
        if (!$data) {
            return false;
        }
        return $data;
    }

}

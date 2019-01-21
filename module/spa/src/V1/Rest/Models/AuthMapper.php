<?php
namespace spa\V1\Rest\Models;

use Zend\Db\Sql\Select;
use Zend\Db\Adapter\Adapter;
use Zend\Db\Adapter\AdapterInterface;
use Zend\Paginator\Adapter\DbSelect;
use Zend\Db\Sql\Sql;
use Zend\Db\Sql\Update;
use Zend\Db\Adapter\Driver\DriverInterface;
use Zend\Crypt\Password\Bcrypt;

class AuthMapper
{

    protected $adapter;
    protected $table_name;

    public function __construct(AdapterInterface $adapter)
    {
        $this->adapter = $adapter;
    }

    public function validatePass($passOrigin,$passServer){
        $passIsValid = true;

        if (!password_verify($passOrigin, $passServer)) {
            $passIsValid = false;
        }
        return $passIsValid;
    }
    public function getUserByUsername($username)
    {

        $data = array();

        try {
            $sql = new Sql($this->adapter);
            $select = new Select('tb_cliente');
            $select->columns(array(
                        'id_cliente',
                        'auth_pass',
                        'id_role',
                        'nombres',
                        'ape_pat',
                        'ape_mat'
                    ))->where(array('num_estado' => 1,'num_documento' => $username));
            $statement = $sql->prepareStatementForSqlObject($select);
            $results = $statement->execute();
            foreach ($results as $dat) {
                $data[] = [
                    'id' => utf8_encode($dat['id_cliente']), 
                    'auth_pass' => utf8_encode($dat['auth_pass']),
                    'id_role' => utf8_encode($dat['id_role']),
                    'userSigned' => utf8_encode($dat['nombres'].' '.$dat['ape_pat'].' '.$dat['ape_mat'])
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
    
        return $data;
    }

}

<?php
namespace spa\V1\Rest\Auth;

use ZF\ApiProblem\ApiProblem;
use ZF\Rest\AbstractResourceListener;
use Zend\Crypt\Password\Bcrypt;

class AuthResource extends AbstractResourceListener
{

    protected $services;
    protected $mapper;
    protected $config;
    protected $cache;

    public function __construct($services) {
        $this->services = $services;
        $this->mapper = $services->get('spa\V1\Rest\Models\AuthMapper');
        $this->config = $services->get('config');
    }


    /**
     * Create a resource
     *
     * @param  mixed $data
     * @return ApiProblem|mixed
     */
    public function create($data)
    {
        $bcrypt = new Bcrypt();
       /* $passOrigin = $bcrypt->create(mb_strtoupper($data->pass));
        return array(
                    'estado' => 200,
                    'mensaje' => $passOrigin
                );
        */
        $passOrigin =mb_strtoupper($data->pass);
        /*Valida Usuario*/
        $user = $this->mapper->getUserByUsername($data->username);

        if(count($user) > 0){
            $isValid = $this->mapper->validatePass($passOrigin,$user['auth_pass']);
            if($isValid){
                $roleID = intval(intval($user['id_role']));
                if($roleID === 1){
                    $roleDesc = 'Administrador';
                }else if($roleID === 2){
                    $roleDesc = 'Cliente';
                }else{
                    $roleDesc = 'Estilista';
                }
                return array(
                    'estado' => 200,
                    'mensaje' => 'Success',
                    'userIdSigned' => intval($user['id']),
                    'role' => intval($user['id_role']),
                    'roleDesc' => $roleDesc,
                    'userSigned' => $user['userSigned']

                );
            }else{
                return array(
                    'estado' => -100,
                    'mensaje' => 'Username or password invalid.'
                );
            }    
        }else{
            return new ApiProblem(500, 'Internal server error.');
        }
        return new ApiProblem(405, 'The POST method has not been defined');
    }

    /**
     * Delete a resource
     *
     * @param  mixed $id
     * @return ApiProblem|mixed
     */
    public function delete($id)
    {
        return new ApiProblem(405, 'The DELETE method has not been defined for individual resources');
    }

    /**
     * Delete a collection, or members of a collection
     *
     * @param  mixed $data
     * @return ApiProblem|mixed
     */
    public function deleteList($data)
    {
        return new ApiProblem(405, 'The DELETE method has not been defined for collections');
    }

    /**
     * Fetch a resource
     *
     * @param  mixed $id
     * @return ApiProblem|mixed
     */
    public function fetch($id)
    {
        return new ApiProblem(405, 'The GET method has not been defined for individual resources');
    }

    /**
     * Fetch all or a subset of resources
     *
     * @param  array $params
     * @return ApiProblem|mixed
     */
    public function fetchAll($params = [])
    {
        return new ApiProblem(405, 'The GET method has not been defined for collections');
    }

    /**
     * Patch (partial in-place update) a resource
     *
     * @param  mixed $id
     * @param  mixed $data
     * @return ApiProblem|mixed
     */
    public function patch($id, $data)
    {
        return new ApiProblem(405, 'The PATCH method has not been defined for individual resources');
    }

    /**
     * Patch (partial in-place update) a collection or members of a collection
     *
     * @param  mixed $data
     * @return ApiProblem|mixed
     */
    public function patchList($data)
    {
        return new ApiProblem(405, 'The PATCH method has not been defined for collections');
    }

    /**
     * Replace a collection or members of a collection
     *
     * @param  mixed $data
     * @return ApiProblem|mixed
     */
    public function replaceList($data)
    {
        return new ApiProblem(405, 'The PUT method has not been defined for collections');
    }

    /**
     * Update a resource
     *
     * @param  mixed $id
     * @param  mixed $data
     * @return ApiProblem|mixed
     */
    public function update($id, $data)
    {
        return new ApiProblem(405, 'The PUT method has not been defined for individual resources');
    }
}

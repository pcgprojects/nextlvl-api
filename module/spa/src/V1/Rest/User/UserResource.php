<?php
namespace spa\V1\Rest\User;

use ZF\ApiProblem\ApiProblem;
use ZF\Rest\AbstractResourceListener;
use Zend\Crypt\Password\Bcrypt;

class UserResource extends AbstractResourceListener
{
    protected $services;
    protected $mapper;
    protected $emailMapper;
    protected $config;
    protected $cache;

    public function __construct($services) {
        $this->services = $services;
        $this->mapper = $services->get('spa\V1\Rest\Models\UserMapper');
        $this->emailMapper = $services->get('spa\V1\Rest\Models\EmailMapper');
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
        
        
        $randomPass = '';
        $caracteres = [
            'A','B','C','D','E','F','G','H','J','K','M','N',
            '1','2','3','4','5','6','7','8','9'
        ];
        for($i=0;$i <10;$i++){
            $random = rand(2, 10);
            $randomPass.=$caracteres[$random];
        }
        /*Dni*/
        //$pass_bcrypt = $bcrypt->create($data->nro_doc);
        /*Clave random*/
        $pass_bcrypt = $bcrypt->create($randomPass);

        $datos = [
            'nro_doc' => $data->nro_doc,
            'names' => $data->names,
            'ape_pat' => $data->ape_pat,
            'ape_mat' => $data->ape_mat,
            'email' => $data->email,
            'cell' => $data->cell,
            'role_id' => $data->role_id,
            'id_referido' => $data->id_referido,
            'pass' => $pass_bcrypt
        ];
       
        $resultado = $this->mapper->newUserSP($datos);
        $datos['password'] = $randomPass;
        $config = $this->config;

        if(intval($resultado['id']) > 0){
            $this->emailMapper->sendEmailService($datos,$config);
        }
    
        return $resultado;       
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
        $datos = $this->mapper->getUserById($id);
        return $datos;
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
        $datos = $this->mapper->getAllUsers();
        return $datos;
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

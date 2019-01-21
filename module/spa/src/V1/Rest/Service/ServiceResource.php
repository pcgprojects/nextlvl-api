<?php
namespace spa\V1\Rest\Service;

use ZF\ApiProblem\ApiProblem;
use ZF\Rest\AbstractResourceListener;

class ServiceResource extends AbstractResourceListener
{
    protected $services;
    protected $mapper;
    protected $config;
    protected $cache;

    public function __construct($services) {
        $this->services = $services;
        $this->mapper = $services->get('spa\V1\Rest\Models\ServiceMapper');
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
       
        $datos = [
            "nro_doc_estilista" => $data->nro_doc_estilista,
            "nro_doc_cliente" => $data->nro_doc_cliente,
            "desc_servicio" => $data->desc_servicio,
            "precio_servicio"=> $data->precio_servicio,
            "chk_acumula_dscto" => $data->chk_acumula_dscto,
            "chk_usa_dscto" => $data->chk_usa_dscto,
            "monto_dscto" => $data->monto_dscto
        ];

        $resultado = $this->mapper->newServiceSP($datos);
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
        $datos = $this->mapper->getAcumulado($id);
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

<?php
namespace spa\V1\Rest\Auth;

class AuthResourceFactory
{
    public function __invoke($services)
    {
        return new AuthResource($services);
    }
}

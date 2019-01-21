<?php
namespace spa\V1\Rest\User;

class UserResourceFactory
{
    public function __invoke($services)
    {
        return new UserResource($services);
    }
}

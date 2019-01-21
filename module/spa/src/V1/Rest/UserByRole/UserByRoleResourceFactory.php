<?php
namespace spa\V1\Rest\UserByRole;

class UserByRoleResourceFactory
{
    public function __invoke($services)
    {
        return new UserByRoleResource($services);
    }
}

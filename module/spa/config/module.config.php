<?php
return [
    'service_manager' => [
        'factories' => [
            \spa\V1\Rest\Auth\AuthResource::class => \spa\V1\Rest\Auth\AuthResourceFactory::class,
            \spa\V1\Rest\User\UserResource::class => \spa\V1\Rest\User\UserResourceFactory::class,
            \spa\V1\Rest\UserByRole\UserByRoleResource::class => \spa\V1\Rest\UserByRole\UserByRoleResourceFactory::class,
            \spa\V1\Rest\Service\ServiceResource::class => \spa\V1\Rest\Service\ServiceResourceFactory::class,
        ],
    ],
    'router' => [
        'routes' => [
            'spa.rest.auth' => [
                'type' => 'Segment',
                'options' => [
                    'route' => '/auth[/:auth_id]',
                    'defaults' => [
                        'controller' => 'spa\\V1\\Rest\\Auth\\Controller',
                    ],
                ],
            ],
            'spa.rest.user' => [
                'type' => 'Segment',
                'options' => [
                    'route' => '/user[/:user_id]',
                    'defaults' => [
                        'controller' => 'spa\\V1\\Rest\\User\\Controller',
                    ],
                ],
            ],
            'spa.rest.user-by-role' => [
                'type' => 'Segment',
                'options' => [
                    'route' => '/user-by-role[/:user_by_role_id]',
                    'defaults' => [
                        'controller' => 'spa\\V1\\Rest\\UserByRole\\Controller',
                    ],
                ],
            ],
            'spa.rest.service' => [
                'type' => 'Segment',
                'options' => [
                    'route' => '/service[/:service_id]',
                    'defaults' => [
                        'controller' => 'spa\\V1\\Rest\\Service\\Controller',
                    ],
                ],
            ],
        ],
    ],
    'zf-versioning' => [
        'uri' => [
            0 => 'spa.rest.auth',
            1 => 'spa.rest.user',
            2 => 'spa.rest.user-by-role',
            3 => 'spa.rest.service',
        ],
    ],
    'zf-rest' => [
        'spa\\V1\\Rest\\Auth\\Controller' => [
            'listener' => \spa\V1\Rest\Auth\AuthResource::class,
            'route_name' => 'spa.rest.auth',
            'route_identifier_name' => 'auth_id',
            'collection_name' => 'auth',
            'entity_http_methods' => [
                0 => 'GET',
                1 => 'PATCH',
                2 => 'PUT',
                3 => 'DELETE',
            ],
            'collection_http_methods' => [
                0 => 'GET',
                1 => 'POST',
            ],
            'collection_query_whitelist' => [],
            'page_size' => 25,
            'page_size_param' => null,
            'entity_class' => \spa\V1\Rest\Auth\AuthEntity::class,
            'collection_class' => \spa\V1\Rest\Auth\AuthCollection::class,
            'service_name' => 'auth',
        ],
        'spa\\V1\\Rest\\User\\Controller' => [
            'listener' => \spa\V1\Rest\User\UserResource::class,
            'route_name' => 'spa.rest.user',
            'route_identifier_name' => 'user_id',
            'collection_name' => 'user',
            'entity_http_methods' => [
                0 => 'GET',
                1 => 'PATCH',
                2 => 'PUT',
                3 => 'DELETE',
            ],
            'collection_http_methods' => [
                0 => 'GET',
                1 => 'POST',
            ],
            'collection_query_whitelist' => [],
            'page_size' => 25,
            'page_size_param' => null,
            'entity_class' => \spa\V1\Rest\User\UserEntity::class,
            'collection_class' => \spa\V1\Rest\User\UserCollection::class,
            'service_name' => 'user',
        ],
        'spa\\V1\\Rest\\UserByRole\\Controller' => [
            'listener' => \spa\V1\Rest\UserByRole\UserByRoleResource::class,
            'route_name' => 'spa.rest.user-by-role',
            'route_identifier_name' => 'user_by_role_id',
            'collection_name' => 'user_by_role',
            'entity_http_methods' => [
                0 => 'GET',
                1 => 'PATCH',
                2 => 'PUT',
                3 => 'DELETE',
            ],
            'collection_http_methods' => [
                0 => 'GET',
                1 => 'POST',
            ],
            'collection_query_whitelist' => [],
            'page_size' => 25,
            'page_size_param' => null,
            'entity_class' => \spa\V1\Rest\UserByRole\UserByRoleEntity::class,
            'collection_class' => \spa\V1\Rest\UserByRole\UserByRoleCollection::class,
            'service_name' => 'userByRole',
        ],
        'spa\\V1\\Rest\\Service\\Controller' => [
            'listener' => \spa\V1\Rest\Service\ServiceResource::class,
            'route_name' => 'spa.rest.service',
            'route_identifier_name' => 'service_id',
            'collection_name' => 'service',
            'entity_http_methods' => [
                0 => 'GET',
                1 => 'PATCH',
                2 => 'PUT',
                3 => 'DELETE',
            ],
            'collection_http_methods' => [
                0 => 'GET',
                1 => 'POST',
            ],
            'collection_query_whitelist' => [],
            'page_size' => 25,
            'page_size_param' => null,
            'entity_class' => \spa\V1\Rest\Service\ServiceEntity::class,
            'collection_class' => \spa\V1\Rest\Service\ServiceCollection::class,
            'service_name' => 'service',
        ],
    ],
    'zf-content-negotiation' => [
        'controllers' => [
            'spa\\V1\\Rest\\Auth\\Controller' => 'Json',
            'spa\\V1\\Rest\\User\\Controller' => 'Json',
            'spa\\V1\\Rest\\UserByRole\\Controller' => 'Json',
            'spa\\V1\\Rest\\Service\\Controller' => 'Json',
        ],
        'accept_whitelist' => [
            'spa\\V1\\Rest\\Auth\\Controller' => [
                0 => 'application/vnd.spa.v1+json',
                1 => 'application/hal+json',
                2 => 'application/json',
            ],
            'spa\\V1\\Rest\\User\\Controller' => [
                0 => 'application/vnd.spa.v1+json',
                1 => 'application/hal+json',
                2 => 'application/json',
            ],
            'spa\\V1\\Rest\\UserByRole\\Controller' => [
                0 => 'application/vnd.spa.v1+json',
                1 => 'application/hal+json',
                2 => 'application/json',
            ],
            'spa\\V1\\Rest\\Service\\Controller' => [
                0 => 'application/vnd.spa.v1+json',
                1 => 'application/hal+json',
                2 => 'application/json',
            ],
        ],
        'content_type_whitelist' => [
            'spa\\V1\\Rest\\Auth\\Controller' => [
                0 => 'application/vnd.spa.v1+json',
                1 => 'application/json',
            ],
            'spa\\V1\\Rest\\User\\Controller' => [
                0 => 'application/vnd.spa.v1+json',
                1 => 'application/json',
            ],
            'spa\\V1\\Rest\\UserByRole\\Controller' => [
                0 => 'application/vnd.spa.v1+json',
                1 => 'application/json',
            ],
            'spa\\V1\\Rest\\Service\\Controller' => [
                0 => 'application/vnd.spa.v1+json',
                1 => 'application/json',
            ],
        ],
    ],
    'zf-hal' => [
        'metadata_map' => [
            \spa\V1\Rest\Auth\AuthEntity::class => [
                'entity_identifier_name' => 'id',
                'route_name' => 'spa.rest.auth',
                'route_identifier_name' => 'auth_id',
                'hydrator' => \Zend\Hydrator\ArraySerializable::class,
            ],
            \spa\V1\Rest\Auth\AuthCollection::class => [
                'entity_identifier_name' => 'id',
                'route_name' => 'spa.rest.auth',
                'route_identifier_name' => 'auth_id',
                'is_collection' => true,
            ],
            \spa\V1\Rest\User\UserEntity::class => [
                'entity_identifier_name' => 'id',
                'route_name' => 'spa.rest.user',
                'route_identifier_name' => 'user_id',
                'hydrator' => \Zend\Hydrator\ArraySerializable::class,
            ],
            \spa\V1\Rest\User\UserCollection::class => [
                'entity_identifier_name' => 'id',
                'route_name' => 'spa.rest.user',
                'route_identifier_name' => 'user_id',
                'is_collection' => true,
            ],
            \spa\V1\Rest\UserByRole\UserByRoleEntity::class => [
                'entity_identifier_name' => 'id',
                'route_name' => 'spa.rest.user-by-role',
                'route_identifier_name' => 'user_by_role_id',
                'hydrator' => \Zend\Hydrator\ArraySerializable::class,
            ],
            \spa\V1\Rest\UserByRole\UserByRoleCollection::class => [
                'entity_identifier_name' => 'id',
                'route_name' => 'spa.rest.user-by-role',
                'route_identifier_name' => 'user_by_role_id',
                'is_collection' => true,
            ],
            \spa\V1\Rest\Service\ServiceEntity::class => [
                'entity_identifier_name' => 'id',
                'route_name' => 'spa.rest.service',
                'route_identifier_name' => 'service_id',
                'hydrator' => \Zend\Hydrator\ArraySerializable::class,
            ],
            \spa\V1\Rest\Service\ServiceCollection::class => [
                'entity_identifier_name' => 'id',
                'route_name' => 'spa.rest.service',
                'route_identifier_name' => 'service_id',
                'is_collection' => true,
            ],
        ],
    ],
];

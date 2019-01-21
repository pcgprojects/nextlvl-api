<?php
namespace spa;

use ZF\Apigility\Provider\ApigilityProviderInterface;

class Module implements ApigilityProviderInterface
{
    public function getConfig()
    {
        return include __DIR__ . '/config/module.config.php';
    }

    public function getAutoloaderConfig()
    {
        return [
            'ZF\Apigility\Autoloader' => [
                'namespaces' => [
                    __NAMESPACE__ => __DIR__ . '/src',
                ],
            ],
        ];
    }

      public function getServiceConfig() {
        return array(
            'factories' => array(
                'spa\V1\Rest\Models\UserMapper' => function ($sm) {
                    $adapter = $sm->get('spa');
                    return new \spa\V1\Rest\Models\UserMapper($adapter);
                },
                'spa\V1\Rest\Models\AuthMapper' => function ($sm) {
                    $adapter = $sm->get('spa');
                    return new \spa\V1\Rest\Models\AuthMapper($adapter);
                },
                'spa\V1\Rest\Models\UserByRoleMapper' => function ($sm) {
                    $adapter = $sm->get('spa');
                    return new \spa\V1\Rest\Models\UserByRoleMapper($adapter);
                },
                'spa\V1\Rest\Models\ServiceMapper' => function ($sm) {
                    $adapter = $sm->get('spa');
                    return new \spa\V1\Rest\Models\ServiceMapper($adapter);
                },
                'spa\V1\Rest\Models\EmailMapper' => function ($sm) {
                    $adapter = $sm->get('spa');
                    return new \spa\V1\Rest\Models\EmailMapper($adapter);
                }
            ),
        );
    }
}

<?php

namespace RayzorAnalytics\Controller\Service;

use Zend\ServiceManager\FactoryInterface;
use Zend\ServiceManager\ServiceLocatorInterface;
use RayzorAnalytics\Controller\SendController;

class SendControllerFactory implements FactoryInterface
{
    public function createService(ServiceLocatorInterface $serviceLocator)
    {
        $serviceLocator = $serviceLocator->getServiceLocator();
        $controller = new SendController();
        $config = $serviceLocator->get('Config');
        $service = $serviceLocator->get('RayzorAnalytics\Service\AnalyticsService');

        /**
         * TODO: Throw exception when there is no user-agent or no tId
         */
        $service->setUserAgent($config['analytics']['user-agent']);
        $service->setTId($config['analytics']['tId']);
        $controller->setAnalyticsService($service);

        return $controller;
    }
}

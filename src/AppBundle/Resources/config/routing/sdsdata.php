<?php

use Symfony\Component\Routing\RouteCollection;
use Symfony\Component\Routing\Route;

$collection = new RouteCollection();

$collection->add('sdsmount_index', new Route(
    '/',
    array('_controller' => 'AppBundle:SdsData:index'),
    array(),
    array(),
    '',
    array(),
    array('GET')
));

$collection->add('sdsmount_show', new Route(
    '/{idSds}/show',
    array('_controller' => 'AppBundle:SdsData:show'),
    array(),
    array(),
    '',
    array(),
    array('GET')
));

$collection->add('sdsmount_new', new Route(
    '/new',
    array('_controller' => 'AppBundle:SdsData:new'),
    array(),
    array(),
    '',
    array(),
    array('GET', 'POST')
));

$collection->add('sdsmount_edit', new Route(
    '/{idSds}/edit',
    array('_controller' => 'AppBundle:SdsData:edit'),
    array(),
    array(),
    '',
    array(),
    array('GET', 'POST')
));

$collection->add('sdsmount_download', new Route(
    '/{idSds}/download',
    array('_controller' => 'AppBundle:SdsData:download'),
    array(),
    array(),
    '',
    array(),
    array('GET', 'POST')
));

$collection->add('sdsmount_delete', new Route(
    '/{idSds}/delete',
    array('_controller' => 'AppBundle:SdsData:delete'),
    array(),
    array(),
    '',
    array(),
    array('DELETE')
));

return $collection;

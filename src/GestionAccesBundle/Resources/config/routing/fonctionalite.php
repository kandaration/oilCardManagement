<?php

use Symfony\Component\Routing\RouteCollection;
use Symfony\Component\Routing\Route;

$collection = new RouteCollection();

$collection->add('fonctionalite_index', new Route(
    '/',
    array('_controller' => 'GestionAccesBundle:Fonctionalite:index'),
    array(),
    array(),
    '',
    array(),
    array('GET')
));

$collection->add('fonctionalite_show', new Route(
    '/{id}/show',
    array('_controller' => 'GestionAccesBundle:Fonctionalite:show'),
    array(),
    array(),
    '',
    array(),
    array('GET')
));

$collection->add('fonctionalite_new', new Route(
    '/new',
    array('_controller' => 'GestionAccesBundle:Fonctionalite:new'),
    array(),
    array(),
    '',
    array(),
    array('GET', 'POST')
));

$collection->add('fonctionalite_edit', new Route(
    '/{id}/edit',
    array('_controller' => 'GestionAccesBundle:Fonctionalite:edit'),
    array(),
    array(),
    '',
    array(),
    array('GET', 'POST')
));

$collection->add('fonctionalite_delete', new Route(
    '/{id}/delete',
    array('_controller' => 'GestionAccesBundle:Fonctionalite:delete'),
    array(),
    array(),
    '',
    array(),
    array('DELETE')
));

return $collection;

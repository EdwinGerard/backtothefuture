<?php
/**
 * This file hold all routes definitions.
 *
 * PHP version 7
 *
 * @author   WCS <contact@wildcodeschool.fr>
 *
 * @link     https://github.com/WildCodeSchool/simple-mvc
 */

$routes = [
    'TimeTravel' => [
        ['index', '/', ['GET', 'POST']],
        ['step', '/step', 'POST'],
    ],

];

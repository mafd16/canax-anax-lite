<?php
/**
 * Internal routes.
 */


$app->router->addInternal("404", function () use ($app) {
    $app->view->add("take1/header", ["title" => "404"]);
    //$app->view->add("navbar1/navbar");
    $app->view->add("navbar2/navbar2");
    $app->view->add("default/404");

    $app->response->setBody([$app->view, "render"])
                  ->send(404);
});

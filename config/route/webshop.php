<?php
/**
 * Login routes.
 */


// Admin webshop page
$app->router->add("webshop", function () use ($app) {
    $app->view->add("take1/header", ["title" => "Admin webshop"]);
    //$app->view->add("navbar1/navbar");
    $app->view->add("navbar2/navbar2");
    //$app->view->add("login/admin_nav");
    $app->view->add("webshop/admin_webshop");
    $app->view->add("take1/footer");
    $app->response->setBody([$app->view, "render"])
            ->send();
});

// Admin webshop edit prod page
$app->router->add("webshop_edit_prod", function () use ($app) {
    $app->view->add("take1/header", ["title" => "Admin webshop edit prod"]);
    //$app->view->add("navbar1/navbar");
    $app->view->add("navbar2/navbar2");
    //$app->view->add("login/admin_nav");
    $app->view->add("webshop/webshop_edit_prod");
    $app->view->add("take1/footer");
    $app->response->setBody([$app->view, "render"])
            ->send();
});

// Admin webshop del prod page
$app->router->add("webshop_del_prod", function () use ($app) {
    $app->view->add("take1/header", ["title" => "Admin webshop del prod"]);
    //$app->view->add("navbar1/navbar");
    $app->view->add("navbar2/navbar2");
    //$app->view->add("login/admin_nav");
    $app->view->add("webshop/webshop_del_prod");
    $app->view->add("take1/footer");
    $app->response->setBody([$app->view, "render"])
            ->send();
});

// Admin webshop edit inv page
$app->router->add("webshop_edit_inv", function () use ($app) {
    $app->view->add("take1/header", ["title" => "Admin webshop edit inv"]);
    //$app->view->add("navbar1/navbar");
    $app->view->add("navbar2/navbar2");
    //$app->view->add("login/admin_nav");
    $app->view->add("webshop/webshop_edit_inv");
    $app->view->add("take1/footer");
    $app->response->setBody([$app->view, "render"])
            ->send();
});

// Admin webshop del inv page
$app->router->add("webshop_del_inv", function () use ($app) {
    $app->view->add("take1/header", ["title" => "Admin webshop del inv"]);
    //$app->view->add("navbar1/navbar");
    $app->view->add("navbar2/navbar2");
    //$app->view->add("login/admin_nav");
    $app->view->add("webshop/webshop_del_inv");
    $app->view->add("take1/footer");
    $app->response->setBody([$app->view, "render"])
            ->send();
});

// Admin webshop add prod page
$app->router->add("webshop_add_prod", function () use ($app) {
    $app->view->add("take1/header", ["title" => "Admin webshop add prod"]);
    //$app->view->add("navbar1/navbar");
    $app->view->add("navbar2/navbar2");
    //$app->view->add("login/admin_nav");
    $app->view->add("webshop/webshop_add_prod");
    $app->view->add("take1/footer");
    $app->response->setBody([$app->view, "render"])
            ->send();
});

// Admin webshop add inv page
$app->router->add("webshop_add_inv", function () use ($app) {
    $app->view->add("take1/header", ["title" => "Admin webshop add inv"]);
    //$app->view->add("navbar1/navbar");
    $app->view->add("navbar2/navbar2");
    //$app->view->add("login/admin_nav");
    $app->view->add("webshop/webshop_add_inv");
    $app->view->add("take1/footer");
    $app->response->setBody([$app->view, "render"])
            ->send();
});

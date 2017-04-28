<?php
/**
 * Login routes.
 */

// Login
$app->router->add("login", function () use ($app) {
    $app->view->add("take1/header", ["title" => "Logga in"]);
    //$app->view->add("navbar1/navbar");
    $app->view->add("navbar2/navbar2");
    $app->view->add("login/login");
    $app->view->add("take1/footer");

    $app->response->setBody([$app->view, "render"])
                  ->send();
});

// Logout
$app->router->add("logout", function () use ($app) {
    $app->view->add("take1/header", ["title" => "Logga ut"]);
    //$app->view->add("navbar1/navbar");
    $app->view->add("navbar2/navbar2");
    $app->view->add("login/logout");
    $app->view->add("take1/footer");

    $app->response->setBody([$app->view, "render"])
                  ->send();
});

// Create
$app->router->add("create", function () use ($app) {
    $app->view->add("take1/header", ["title" => "Skapa profil"]);
    //$app->view->add("navbar1/navbar");
    $app->view->add("navbar2/navbar2");
    $app->view->add("login/create");
    $app->view->add("take1/footer");

    $app->response->setBody([$app->view, "render"])
                  ->send();
});

// Read
$app->router->add("profile", function () use ($app) {
    $app->view->add("take1/header", ["title" => "Profil"]);
    //$app->view->add("navbar1/navbar");
    $app->view->add("navbar2/navbar2");
    $app->view->add("login/profile");
    $app->view->add("take1/footer");

    $app->response->setBody([$app->view, "render"])
                  ->send();
});

// Update
$app->router->add("update", function () use ($app) {
    $app->view->add("take1/header", ["title" => "Uppdatera profil"]);
    //$app->view->add("navbar1/navbar");
    $app->view->add("navbar2/navbar2");
    $app->view->add("login/update");
    $app->view->add("take1/footer");

    $app->response->setBody([$app->view, "render"])
                  ->send();
});

// Delete

// Validate
$app->router->add("validate", function () use ($app) {
    $app->view->add("take1/header", ["title" => "Validering"]);
    //$app->view->add("navbar1/navbar");
    $app->view->add("navbar2/navbar2");
    $app->view->add("login/validate");
    $app->view->add("take1/footer");

    $app->response->setBody([$app->view, "render"])
                  ->send();
});

// handle new user
$app->router->add("handle_new_user", function () use ($app) {
    $app->view->add("take1/header", ["title" => "Validering"]);
    //$app->view->add("navbar1/navbar");
    $app->view->add("navbar2/navbar2");
    $app->view->add("login/handle_new_user");
    $app->view->add("take1/footer");

    $app->response->setBody([$app->view, "render"])
                  ->send();
});

// Change password
$app->router->add("change_password", function () use ($app) {
    $app->view->add("take1/header", ["title" => "Byt lösenord"]);
    //$app->view->add("navbar1/navbar");
    $app->view->add("navbar2/navbar2");
    $app->view->add("login/change_password");
    $app->view->add("take1/footer");

    $app->response->setBody([$app->view, "render"])
                  ->send();
});

// Admin page
$app->router->add("admin", function () use ($app) {
    $app->view->add("take1/header", ["title" => "Admin"]);
    //$app->view->add("navbar1/navbar");
    $app->view->add("navbar2/navbar2");
    $app->view->add("login/admin_nav");
    $app->view->add("login/admin");
    $app->view->add("take1/footer");

    $app->response->setBody([$app->view, "render"])
                  ->send();
});

// Admin show all page
$app->router->add("admin_show", function () use ($app) {
    $app->view->add("take1/header", ["title" => "Admin"]);
    //$app->view->add("navbar1/navbar");
    $app->view->add("navbar2/navbar2");
    $app->view->add("login/admin_nav");
    $app->view->add("login/admin_show");
    $app->view->add("take1/footer");

    $app->response->setBody([$app->view, "render"])
                  ->send();
});

// Admin search page
$app->router->add("admin_search", function () use ($app) {
    $app->view->add("take1/header", ["title" => "Admin"]);
    //$app->view->add("navbar1/navbar");
    $app->view->add("navbar2/navbar2");
    $app->view->add("login/admin_nav");
    $app->view->add("login/admin_search");
    $app->view->add("take1/footer");

    $app->response->setBody([$app->view, "render"])
                  ->send();
});

// Admin add page
$app->router->add("admin_add", function () use ($app) {
    $app->view->add("take1/header", ["title" => "Admin"]);
    //$app->view->add("navbar1/navbar");
    $app->view->add("navbar2/navbar2");
    $app->view->add("login/admin_nav");
    $app->view->add("login/admin_add");
    $app->view->add("take1/footer");

    $app->response->setBody([$app->view, "render"])
                  ->send();
});

// Admin edit page
$app->router->add("admin_edit", function () use ($app) {
    $app->view->add("take1/header", ["title" => "Admin"]);
    //$app->view->add("navbar1/navbar");
    $app->view->add("navbar2/navbar2");
    $app->view->add("login/admin_nav");
    $app->view->add("login/admin_edit");
    $app->view->add("take1/footer");

    $app->response->setBody([$app->view, "render"])
                  ->send();
});

// Admin delete page
$app->router->add("admin_delete", function () use ($app) {
    $app->view->add("take1/header", ["title" => "Admin"]);
    //$app->view->add("navbar1/navbar");
    $app->view->add("navbar2/navbar2");
    $app->view->add("login/admin_nav");
    $app->view->add("login/admin_delete");
    $app->view->add("take1/footer");

    $app->response->setBody([$app->view, "render"])
                  ->send();
});

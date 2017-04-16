<?php
/**
 * session routes.
 */

$app->router->add("session", function () use ($app) {
    $app->view->add("take1/header", ["title" => "Session"]);
    //$app->view->add("navbar1/navbar");
    $app->view->add("navbar2/navbar2");
    $app->view->add("take1/session");
    $app->view->add("take1/footer");

    $app->response->setBody([$app->view, "render"])
                  ->send();
});

$app->router->add("session/increment", function () use ($app) {
    // Increment the count in session:
    $app->session->start();
    $app->session->set('count', $app->session->get('count') + 1);
    // Redirect
    $app->response->redirect($app->url->create("session"));
});

$app->router->add("session/decrement", function () use ($app) {
    // Decrement the count in session:
    $app->session->start();
    $app->session->set('count', $app->session->get('count') - 1);
    // Redirect
    $app->response->redirect($app->url->create("session"));
});

$app->router->add("session/status", function () use ($app) {
    $app->session->start();
    $data = [
        "Cache expire" => session_cache_expire(),
        "Cache limiter" => session_cache_limiter(),
        "Encode" => session_encode(),
        "Get cookie params" => session_get_cookie_params(),
        "Id" => session_id(),
        "Module name" => session_module_name(),
        "Name" => session_name(),
        "Save path" => session_save_path(),
        "Status" => session_status(),
        ];
    $app->response->sendJson($data);
});

$app->router->add("session/dump", function () use ($app) {
    $app->session->start();
    $app->session->set('dump', true);
    // Redirect
    $app->response->redirect($app->url->create("session"));
});

$app->router->add("session/destroy", function () use ($app) {
    $app->session->start();
    $app->session->destroy();
    // Redirect
    $app->response->redirect($app->url->create("session/dump"));
});

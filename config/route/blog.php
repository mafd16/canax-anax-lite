<?php
/**
 * blog routes.
 */

$app->router->add("format", function () use ($app) {
    $app->view->add("take1/header", ["title" => "Format text"]);
    //$app->view->add("navbar1/navbar");
    $app->view->add("navbar2/navbar2");
    $app->view->add("blog/format");
    $app->view->add("take1/footer");

    $app->response->setBody([$app->view, "render"])
                  ->send();
});

$app->router->add("content", function () use ($app) {
    $app->view->add("take1/header", ["title" => "Handle content"]);
    //$app->view->add("navbar1/navbar");
    $app->view->add("navbar2/navbar2");
    $app->view->add("blog/content");
    $app->view->add("take1/footer");

    $app->response->setBody([$app->view, "render"])
                  ->send();
});

$app->router->add("edit", function () use ($app) {
    $app->view->add("take1/header", ["title" => "Edit content"]);
    //$app->view->add("navbar1/navbar");
    $app->view->add("navbar2/navbar2");
    $app->view->add("blog/edit");
    $app->view->add("take1/footer");

    $app->response->setBody([$app->view, "render"])
                  ->send();
});

$app->router->add("create_content", function () use ($app) {
    $app->view->add("take1/header", ["title" => "Create content"]);
    //$app->view->add("navbar1/navbar");
    $app->view->add("navbar2/navbar2");
    $app->view->add("blog/create_content");
    $app->view->add("take1/footer");

    $app->response->setBody([$app->view, "render"])
                  ->send();
});

$app->router->add("delete_content", function () use ($app) {
    $app->view->add("take1/header", ["title" => "Delete content"]);
    //$app->view->add("navbar1/navbar");
    $app->view->add("navbar2/navbar2");
    $app->view->add("blog/delete_content");
    $app->view->add("take1/footer");

    $app->response->setBody([$app->view, "render"])
                  ->send();
});

$app->router->add("pages", function () use ($app) {
    $app->view->add("take1/header", ["title" => "Show pages"]);
    //$app->view->add("navbar1/navbar");
    $app->view->add("navbar2/navbar2");
    $app->view->add("blog/pages");
    $app->view->add("take1/footer");

    $app->response->setBody([$app->view, "render"])
                  ->send();
});

$app->router->add("page", function () use ($app) {
    $app->view->add("take1/header", ["title" => "Page"]);
    //$app->view->add("navbar1/navbar");
    $app->view->add("navbar2/navbar2");
    $app->view->add("blog/page");
    $app->view->add("take1/footer");

    $app->response->setBody([$app->view, "render"])
                  ->send();
});

$app->router->add("blog", function () use ($app) {
    $app->view->add("take1/header", ["title" => "Blog"]);
    //$app->view->add("navbar1/navbar");
    $app->view->add("navbar2/navbar2");
    $app->view->add("blog/blog");
    $app->view->add("take1/footer");

    $app->response->setBody([$app->view, "render"])
                  ->send();
});

$app->router->add("blogentry", function () use ($app) {
    $app->view->add("take1/header", ["title" => "Blogentry"]);
    //$app->view->add("navbar1/navbar");
    $app->view->add("navbar2/navbar2");
    $app->view->add("blog/blogentry");
    $app->view->add("take1/footer");

    $app->response->setBody([$app->view, "render"])
                  ->send();
});

$app->router->add("block", function () use ($app) {
    $app->view->add("take1/header", ["title" => "Block"]);
    //$app->view->add("navbar1/navbar");
    $app->view->add("navbar2/navbar2");
    $app->view->add("blog/block");
    $app->view->add("take1/footer");

    $app->response->setBody([$app->view, "render"])
                  ->send();
});

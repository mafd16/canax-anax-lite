<?php //echo "I wanna be a frontcontroller!";

require "../src/Database/Database.php";
require "../src/Database/function.php";


/**
 * Bootstrap the framework.
 */
// Where are all the files? Booth are needed by Anax.
define("ANAX_INSTALL_PATH", realpath(__DIR__ . "/.."));
define("ANAX_APP_PATH", ANAX_INSTALL_PATH);

// Include essentials
require ANAX_INSTALL_PATH . "/config/error_reporting.php";

// Get the autoloader by using composers version.
require ANAX_INSTALL_PATH . "/vendor/autoload.php";

// Add all resources to $app
$app = new \Marton\App\App();
$app->database = new Database();
$app->navbar   = new \Marton\Navbar\Navbar();
$app->session  = new \Marton\Session\Session('martintestsession');
$app->request  = new \Anax\Request\Request();
$app->response = new \Anax\Response\Response();
$app->url      = new \Anax\Url\Url();
$app->router   = new \Anax\Route\RouterInjectable();
$app->view     = new \Anax\View\ViewContainer();

// Create db-connection
//$db = new Database();
//$db->connect($databaseConfig);

// Update navbar configuration with values from config file.
$app->navbar->configure("navbar.php");

// Let navbar get current route
//$app->navbar->setCurrentRoute($app->request->getRoute());

// Let navbar be able to create links
//$app->navbar->setUrlCreator([$app->url, "create"]);

// Inject $app into the navbar for use.
$app->navbar->setApp($app);

// Inject $app into the view container for use in view files.
$app->view->setApp($app);

// Update view configuration with values from config file.
$app->view->configure("view.php");

// Init the object of the request class.
$app->request->init();

// Init the url-object with default values from the request object.
$app->url->setSiteUrl($app->request->getSiteUrl());
$app->url->setBaseUrl($app->request->getBaseUrl());
$app->url->setStaticSiteUrl($app->request->getSiteUrl());
$app->url->setStaticBaseUrl($app->request->getBaseUrl());
$app->url->setScriptName($app->request->getScriptName());

// Update url configuration with values from config file.
$app->url->configure("url.php");
$app->url->setDefaultsFromConfiguration();

// Load the routes
require ANAX_INSTALL_PATH . "/config/route.php";

// Leave to router to match incoming request to routes
$app->router->handle($app->request->getRoute());

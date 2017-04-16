<?php

// ----- Start creating the Navbar from array -----
$navbar = [
    "config" => [
        "navbar-class" => "navbar"
    ],
    "items" => [
        "hem" => [
            "text" => "Hem",
            "route" => ""
        ],
        "om" => [
            "text" => "Om",
            "route" => "about"
        ],
        "redovisning" => [
            "text" => "Redovisning",
            "route" => "report"
        ],
        "session" => [
            "text" => "Session",
            "route" => "session"
        ]
    ]
];

$htmlnav = "<navbar class='";
$htmlnav .= $navbar['config']['navbar-class'];
$htmlnav .= "'><ul>";
foreach ($navbar["items"] as $key => $value) {
    $navlink = $app->url->create($value["route"]);
    if ($app->request->getRoute() == $value["route"]) {
        $htmlnav .= "<li class='current'><a href='" . $navlink;
        $htmlnav .= "'>" . $value["text"] . "</a></li>";
    } else {
        $htmlnav .= "<li><a href='" . $navlink;
        $htmlnav .= "'>" . $value["text"] . "</a></li>";
    }
}
$htmlnav .= "</ul></navbar>";
// ----- Stopp creating the Navbar from array -----


echo $htmlnav;

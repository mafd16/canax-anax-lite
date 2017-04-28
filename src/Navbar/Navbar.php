<?php

namespace Marton\Navbar;

/**
 * Navbar to generate HTML för a navbar from a configuration array.
 */
class Navbar implements
    \Anax\Common\ConfigureInterface,
    \Anax\Common\AppInjectableInterface
{
    use \Anax\Common\ConfigureTrait,
        \Anax\Common\AppInjectableTrait;

    /**
     * Get HTML for the navbar.
     *
     * @return string as HTML with the navbar.
     */
    public function getHTML()
    {
        $navbar = '<navbar class="';
        $navbar .= $this->config['config']['navbar-class'] . '"><ul>';
        foreach ($this->config['items'] as $value) {
            if ($this->app->request->getRoute() == $value['route']) {
                $navbar .= '<li class="current"><a href="';
            } else {
                $navbar .= '<li><a href="';
            }
            //$route = $value['route'];
            $navbar .= $this->app->url->create($value['route']);
            $navbar .= '">' . $value['text'] . '</a></li>';
        }
        //$navbar .= '</ul></navbar></div>';
        $navbar .= '</ul>';
        $navbar .= '</navbar></div>';

        return $navbar;
    }


    /**
     * Set the app object.
     *
     * @param object $app with framework resources.
     *
     * @return $this
     */
    public function setApp($app)
    {
        $this->app = $app;
        return $this;
    }
}

<?php


namespace Weekend\Controller;

use Symfony\Component\HttpFoundation\Response;
use Weekend\Service\ConfigService;


class BasicPageController
{

    protected $config;
    protected $twig;

    /**
     * BasicPageController constructor.
     * @param \Twig_Environment $twig
     * @param ConfigService $config
     */
    public function __construct(\Twig_Environment $twig, ConfigService $config)
    {
        $this->twig = $twig;
        $this->config = $config;
    }

    /**
     * @param $path
     * @return Response|static
     * @throws \Twig_Error_Loader
     * @throws \Twig_Error_Runtime
     * @throws \Twig_Error_Syntax
     */
    public function get($path) {
        $page = ($path == '/') ? 'index' : substr($path, 1);
        $menu = $this->config->getConfig();
        if(isset($menu[$page])) {

            $content = $this->twig->render('index.html', $menu[$page]);
            return new Response($content);
        }
        return Response::create('page not found', 404);
    }

}
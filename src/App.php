<?php


namespace Weekend;

use Symfony\Component\Config\FileLocator;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\DependencyInjection\Loader\YamlFileLoader;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;


class App
{
    protected $filesystem;
    protected $twig;
    protected $container;

    public  function __construct()
    {
        $this->container = new ContainerBuilder();
        $loader = new YamlFileLoader($this->container, new FileLocator(__DIR__));
        $loader->load('services.yaml');
        $this->twig = $this->container->get('twig');
        $this->filesystem = $this->container->get('filesystem');
    }

    public function run(Request $request)
    {
        $routes = [
            '/' => 'basic_page_controller',
            '/index' => 'basic_page_controller',
            '/about' => 'basic_page_controller',
            '/contact' => 'contact_controller'
        ];
        $path = $request->getPathInfo();
        $method = strtolower($request->getMethod()); // method type get,post

        if(isset($routes[$path])) {
            $controller = $this->container->get($routes[$path]);
            if(is_callable([$controller, $method])) {
                return call_user_func_array(array($controller, $method), array($path, $request));
            }
        }
        return Response::create("Page not found App.php", 404);
    }
}
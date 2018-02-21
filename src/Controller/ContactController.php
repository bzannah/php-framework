<?php


namespace Weekend\Controller;


use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class ContactController
{
    protected $twig;

    /**
     * ContactController constructor.
     * @param \Twig_Environment $twig
     */
    public function __construct(\Twig_Environment $twig)
    {
        $this->twig = $twig;
    }

    /**
     * @return Response
     * @throws \Twig_Error_Loader
     * @throws \Twig_Error_Runtime
     * @throws \Twig_Error_Syntax
     */
    public function get()
    {
        $form = $this->twig->render('forms/contact.html');
        $content = $this->twig->render('index.html', [
            'title' => 'Contact',
            'content' => $form
        ]);
        return new Response($content);

    }

    /**
     * @return Response
     * @throws \Twig_Error_Loader
     * @throws \Twig_Error_Runtime
     * @throws \Twig_Error_Syntax
     */
    public function post()
    {
        // TODO: validate input
        $content = $this->twig->render('index.html', [
            'title' => 'Contact',
            'content' => 'Thank you for you message.'
        ]);
        return new Response($content);

    }
}
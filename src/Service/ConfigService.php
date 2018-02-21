<?php


namespace Weekend\Service;


use League\Flysystem\FilesystemInterface;

class ConfigService
{
    protected $config;

    /**
     * ConfigService constructor.
     * @param FilesystemInterface $filesystem
     * @throws \League\Flysystem\FileNotFoundException
     */
    public function __construct(FilesystemInterface $filesystem)
    {
        $this->config = json_decode($filesystem->read('menu.json'), true);
    }

    /**
     * @return mixed
     */
    public function getConfig()
    {
        return $this->config;
    }

}
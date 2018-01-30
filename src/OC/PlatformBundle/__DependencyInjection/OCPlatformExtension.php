<?php
/**
 * Created by PhpStorm.
 * User: AMIN
 * Date: 1/26/2018
 * Time: 5:07 PM
 */

namespace OC\PlatformBundle\__DependencyInjection;

use Symfony\Component\Config\FileLocator;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\DependencyInjection\Loader;
use Symfony\Component\DependencyInjection\Extension\Extension;

class OCPlatformExtension extends Extension
{
    public function load(array $configs, ContainerBuilder $container)
    {
        $configuration = new Configuration();
        $config = $this->processConfiguration($configuration, $configs);
        $loader = new Loader\YamlFileLoader(
            $container,
            new FileLocator(__DIR__."../../Resources/config")
        );
        $loader->load("services.yml");
    }

}
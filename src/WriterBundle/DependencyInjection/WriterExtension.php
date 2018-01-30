<?php
/**
 * Created by PhpStorm.
 * User: AMIN
 * Date: 1/23/2018
 * Time: 3:53 PM
 */

namespace WriterBundle\DependencyInjection;

use Symfony\Component\HttpKernel\DependencyInjection\Extension;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\DependencyInjection\Loader\YamlFileLoader;
use Symfony\Component\Config\FileLocator;
use Symfony\Component\Yaml\Yaml;

class WriterExtension extends Extension
{
    public function load(array $configs, ContainerBuilder $container){
        $file = __DIR__.'/../Resources/config/writeConfig.yml';
        $configs = array_merge($configs, Yaml::parse(file_get_contents($file)));
        $configuration = new Configuration();
        $config = $this->processConfiguration($configuration, $configs);
        $container->setParameter('writer',$config);
    }
}
<?php

namespace ContainerLOhWdVC;

use Symfony\Component\DependencyInjection\Argument\RewindableGenerator;
use Symfony\Component\DependencyInjection\Exception\RuntimeException;

/**
 * @internal This class has been auto-generated by the Symfony Dependency Injection Component.
 */
class getGenerateRandomPostCommand_LazyService extends App_KernelDevDebugContainer
{
    /**
     * Gets the private '.App\Command\GenerateRandomPostCommand.lazy' shared service.
     *
     * @return \Symfony\Component\Console\Command\LazyCommand
     */
    public static function do($container, $lazyLoad = true)
    {
        include_once \dirname(__DIR__, 4).'/vendor/symfony/console/Command/Command.php';
        include_once \dirname(__DIR__, 4).'/vendor/symfony/console/Command/LazyCommand.php';

        return $container->privates['.App\\Command\\GenerateRandomPostCommand.lazy'] = new \Symfony\Component\Console\Command\LazyCommand('app:generate-random-post', [], 'Run app:generate-random-post', false, function () use ($container): \App\Command\GenerateRandomPostCommand {
            return ($container->privates['App\\Command\\GenerateRandomPostCommand'] ?? $container->load('getGenerateRandomPostCommandService'));
        });
    }
}

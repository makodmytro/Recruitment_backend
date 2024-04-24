<?php

namespace ContainerLOhWdVC;

use Symfony\Component\DependencyInjection\Argument\RewindableGenerator;
use Symfony\Component\DependencyInjection\Exception\RuntimeException;

/**
 * @internal This class has been auto-generated by the Symfony Dependency Injection Component.
 */
class getAddPostCommandService extends App_KernelDevDebugContainer
{
    /**
     * Gets the private 'App\Command\AddPostCommand' shared autowired service.
     *
     * @return \App\Command\AddPostCommand
     */
    public static function do($container, $lazyLoad = true)
    {
        include_once \dirname(__DIR__, 4).'/vendor/symfony/console/Command/Command.php';
        include_once \dirname(__DIR__, 4).'/src/App/Command/AddPostCommand.php';
        include_once \dirname(__DIR__, 4).'/src/Domain/Post/PostManager.php';

        $container->privates['App\\Command\\AddPostCommand'] = $instance = new \App\Command\AddPostCommand(new \Domain\Post\PostManager(($container->services['doctrine.orm.default_entity_manager'] ?? $container->getDoctrine_Orm_DefaultEntityManagerService())));

        $instance->setName('app:add-post');
        $instance->setDescription('Run app:add-post');

        return $instance;
    }
}
<?php

namespace App\Providers;

use Doctrine\MongoDB\Connection as MongoConnection;
use Illuminate\Database\Connection;
use Illuminate\Support\ServiceProvider;
use Doctrine\ODM\MongoDB\Configuration;
use Doctrine\ODM\MongoDB\DocumentManager;
use Doctrine\ODM\MongoDB\Mapping\Driver\AnnotationDriver;
use Doctrine\Common\Annotations\AnnotationRegistry;
use Doctrine\Common\EventManager;
use Doctrine\ODM\MongoDB\Types\Type;
use Gedmo\Tree\TreeListener;
use Gedmo\Timestampable\TimestampableListener;
use Gedmo\Sluggable\SluggableListener;
use Gedmo\Loggable\LoggableListener;
use Gedmo\Sortable\SortableListener;
use Gedmo\Translatable\TranslatableListener;

/**
 * TODO: Configure Doctrine ODM here.
 */
class DoctrineServiceProvider extends ServiceProvider
{
    private $subscribers = [
        TreeListener::class,
        TimestampableListener::class,
    ];

    /**
     * Bootstrap.
     *
     * @return void
     */
    public function boot()
    {
    }

    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        $this->registerDoctrine();
    }

    /**
     * @throws \Doctrine\ODM\MongoDB\Mapping\MappingException
     */
    public function registerDoctrine()
    {
        $config = new Configuration();
        $config->setProxyDir(app_path('Doctrine/DoctrineProxies'));
        $config->setHydratorDir(app_path('Doctrine/DoctrineHydrators'));
        $config->setProxyNamespace('App\Doctrine\DoctrineProxies');
        $config->setHydratorNamespace('App\Doctrine\DoctrineHydrators');

        $config->setDefaultDB(config('database.connections.mongodb.database'));
        $config->setMetadataDriverImpl(AnnotationDriver::create(config('app.entityPaths')));
        AnnotationDriver::registerAnnotationClasses();
        $gedmoPath = app_path('/../vendor/gedmo/doctrine-extensions/lib');
        AnnotationRegistry::registerAutoloadNamespaces([
            'Gedmo' => $gedmoPath,
        ]);

        $evm = $this->getDoctrineEventManager();
        $connection = new MongoConnection(
            'mongodb://'
            .config('database.connections.mongodb.host')
            .':'
            .config('database.connections.mongodb.port')
        );
        $this->app->singleton(DocumentManager::class, function ($app) use ($connection, $config, $evm) {
            return DocumentManager::create($connection, $config, $evm);
        });

        if (!Type::hasType('translatableString')) {
            Type::addType('translatableString', TranslatableString::class);
        }
    }

    /**
     * Configure doctrine event manager and return an instance.
     * @return EventManager [description]
     */
    private function getDoctrineEventManager() : EventManager
    {
        $evm = new EventManager();
        foreach ($this->subscribers as $subscriber) {
            $evm->addEventSubscriber(new $subscriber);
        }

        return $evm;
    }
}

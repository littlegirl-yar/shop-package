<?php

namespace Yaromir\ShopPackage\Tests;

use Yaromir\ShopPackage\ShopPackageServiceProvider;

class TestCase extends \Orchestra\Testbench\TestCase
{
    public function setUp(): void
    {
        parent::setUp();
    }

    public function getEnvironmentSetUp($app)
    {
        $app['config']->set('database.default', 'testbench');
        $app['config']->set('database.connections.testbench', [
            'driver'   => 'sqlite',
            'database' => ':memory:',
            'prefix'   => '',
        ]);

        include_once __DIR__ . '/../database/migrations/create_posts_table.php.stub';
        include_once __DIR__ . '/../database/migrations/create_clients_table.php';

        // run the migration's up() method
        (new \CreatePostsTable)->up();
        (new \CreateUsersTable)->up();
    }

    protected function getPackageProviders($app)
    {
        return [
            ShopPackageServiceProvider::class,
        ];
    }
}

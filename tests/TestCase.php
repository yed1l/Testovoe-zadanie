<?php

namespace Tests;

use Illuminate\Foundation\Application;
use Illuminate\Foundation\Testing\TestCase as BaseTestCase;

abstract class TestCase extends BaseTestCase
{
    use CreatesApplication;

    /**
     * Creates the application.
     *
     * @return Application
     */
    public function createApplication() {
        $app = require __DIR__ . '/../bootstrap/app.php';

        $app->make(\Illuminate\Contracts\Console\Kernel::class)->bootstrap();

        $this->clearCache();

        $app->make(\Illuminate\Foundation\Bootstrap\LoadEnvironmentVariables::class)->bootstrap($app);
        $app->make(\Illuminate\Foundation\Bootstrap\LoadConfiguration::class)->bootstrap($app);

        return $app;
    }

    /**
     * Clears Laravel Cache.
     */
    protected function clearCache() {
        $commands = ['clear-compiled', 'cache:clear', 'view:clear', 'config:clear', 'route:clear'];
        foreach ($commands as $command) {
            \Illuminate\Support\Facades\Artisan::call($command);
        }
    }
}

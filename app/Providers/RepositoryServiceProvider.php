<?php

namespace Quill\Providers;

use Illuminate\Support\ServiceProvider;

class RepositoryServiceProvider extends ServiceProvider
{
    /**
     * Specify the repository driver to use. This will typically
     * the name of the directory in the Repositories directory.
     * 
     * @var string
     */
    protected $driver = 'Eloquent';

    /**
     * An array of repositories to register.
     * 
     * @var array
     */
    protected $repositories = ['User', 'Post'];

    /**
     * Register the repositories for the app.
     *
     * @return void
     */
    public function register()
    {
        foreach ($this->repositories as $repository) {
            $this->registerRepository($repository);
        }
    }

    /**
     * Registers the repository with the given name.
     * 
     * @param  string $repositoryName
     * @return void
     */
    protected function registerRepository($repositoryName)
    {
        $this->app->bind(
            "Quill\Contracts\Repositories\\{$repositoryName}RepositoryContract",
            "Quill\Repositories\\{$this->driver}\\{$repositoryName}Repository"
        );
    }
}

<?php

namespace Faisal50x\QueryFilter\Console\Commands;

use Illuminate\Support\Str;
use Illuminate\Console\GeneratorCommand;
use Symfony\Component\Console\Input\InputArgument;

/**
 * Artisan command to generate query filters.
 *
 */

class MakeQueryFilterCommand extends GeneratorCommand
{
    /**
     * The console command name.
     *
     * @var string
     */
    protected $name = 'make:query-filter';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Create a new query filter class';

    /**
     * The type of class being generated.
     *
     * @var string
     */
    protected $type = 'Query filter';

    /**
     * Get the stub file for the generator.
     *
     * @return string
     */
    protected function getStub()
    {
        return __DIR__ . '/../../../stubs/queryFilter.stub';
    }

    /**
     * Get the default namespace for the class.
     *
     * @param  string  $rootNamespace
     * @return string
     */
    protected function getDefaultNamespace($rootNamespace)
    {
        // get query filters path from configuration
        $path = $this->laravel['config']['query-filter.path'];
        // ensure the path always starts with "app/"
        $path = Str::start(ltrim($path, '/'), 'app/');
        // remove "app/" from the beginning of the path
        $path = preg_replace('#^app\/#', '', $path);
        // convert the path into namespace
        $namespace = implode('\\', array_map('ucfirst', explode('/', $path)));
        // prepend the root namespace
        return $rootNamespace . '\\' . $namespace;
    }

    /**
     * Build the class with the given name.
     *
     * @param  string  $name
     * @return string
     */
    protected function buildClass($name)
    {
        $stub = parent::buildClass($name);

        return $this->replaceFilters($stub);
    }

    /**
     * Replace filters for the given stub
     *
     * @param string $stub
     * @return string
     */
    protected function replaceFilters($stub)
    {
        parse_str($this->argument('filters'), $rawFilters);

        if (empty($rawFilters)) {
            return str_replace('DummyFilters', PHP_EOL . '    //' . PHP_EOL, $stub);
        }

        $filters = '';
        $filterStub = file_get_contents(__DIR__ . '/../../../stubs/filter.stub');

        foreach ($rawFilters as $queryParameter => $parameterName) {
            $filterName = Str::camel($queryParameter);
            $parameterVariable = $parameterName === '' ? '' : '$' . $parameterName;
            $search = ['dummyQueryParameter', 'dummyFilter', 'dummyParameter'];
            $replace = [$queryParameter, $filterName, $parameterVariable];
            $filters .= str_replace($search, $replace, $filterStub);
        }

        return str_replace('DummyFilters', $filters, $stub);
    }

    /**
     * Get the console command arguments.
     *
     * @return array
     */
    protected function getArguments()
    {
        return [
            ['name', InputArgument::REQUIRED, 'The name of the class'],
            ['filters', InputArgument::OPTIONAL, 'The name of the filters e.g. published=0&published_at=2020-01-10'],
        ];
    }
}

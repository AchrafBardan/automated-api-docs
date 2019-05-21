<?php

namespace OwowAgency\AutomatedApiDocs\Parsers;

abstract class Parser
{
    /**
     * The docs generator config.
     *
     * @var array
     */
    protected $config;

    /**
     * Parser constructor.
     *
     * @param  array  $config
     * @return void
     */
    public function __construct($config)
    {
        $this->config = $config;
    }

    /**
     * Save the API Blueprint content generated by the parser.
     *
     * @return void
     */
    protected function saveContent($content)
    {
        $file = sprintf(
            '%s/output.%s',
            rtrim($this->getConfigValue('output_path'), '/'),
            $this->getExtension()
        );

        if (! file_exists($file)) {
            touch($file);
        }

        file_put_contents($file, $content);
    }

    /**
     * Get the config value by it's given key. If the key is not found we return
     * null.
     *
     * @param  string  $key
     * @return mixed
     */
    protected function getConfigValue($key)
    {
        return data_get($this->config, $key);
    }

    /**
     * Execute the parser and transform to correct format.
     *
     * @param  array  $collections
     * @return void
     */
    public abstract function handle($collections);

    /**
     * Get the file extension of the docs format.
     *
     * @return string
     */
    public abstract function getExtension();
}

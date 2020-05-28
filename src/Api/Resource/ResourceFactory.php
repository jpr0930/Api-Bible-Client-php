<?php

namespace ApiBibleClient\Api\Resource;

use ApiBibleClient\Api\RestClient;

/**
 * Class ResourceFactory
 *
 * Factory implementation to load API resource classes at runtime
 *
 * @package ApiBibleClient\Api\Resource
 */
class ResourceFactory {
    /** @var array */
    private $services = [];
    /** @var RestClient */
    private $client;

    /** @var string[] */
    private static $classMap = [
        'bible'  => BibleResource::class,
        'bibles' => BiblesResource::class,
    ];

    /**
     * ResourceFactory constructor.
     * @param RestClient $client
     */
    public function __construct(RestClient $client) {
        $this->client = $client;
    }

    /**
     * Fetch resource class if defined in class map; instantiate if not done yet
     *
     * @param string $name
     * @return mixed
     * @throws \InvalidArgumentException
     */
    public function getResourceClass(string $name) {
        $resourceClass = self::$classMap[$name] ?? null;

        if ($resourceClass !== null) {
            if (array_key_exists($name, $this->services) === false) {
                $this->services[$name] = new $resourceClass($this->client);
            }

            return $this->services[$name];
        }

        throw new \InvalidArgumentException('Undefined resource: ' . $name);
    }

}
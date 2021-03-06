<?php

declare(strict_types=1);

namespace Grocelivery\Utils\Resources;

use Grocelivery\Utils\Interfaces\JsonResourceInterface;
use Illuminate\Contracts\Support\Arrayable;
use Illuminate\Support\Collection;

/**
 * Class JsonResource
 * @package Grocelivery\Utils\Http
 */
abstract class JsonResource implements JsonResourceInterface
{
    /** @var Arrayable */
    protected $resource;

    /**
     * Resource constructor.
     * @param Arrayable $resource
     */
    public function __construct(Arrayable $resource)
    {
        $this->resource = $resource;
    }

    /**
     * @param array $resource
     * @return static
     */
    public static function fromArray(array $resource): self
    {
        $class = get_called_class();
        return new $class(new ResourceArray($resource));
    }

    /**
     * @return array
     */
    public function map(): array
    {
        $data = [];

        if ($this->resource instanceof Collection) {
            foreach ($this->resource as $resource) {
                $this->resource = $resource;
                $data[] = $this->toArray();
            }
        } else {
            $data = $this->toArray();
        }

        return $data;
    }
}
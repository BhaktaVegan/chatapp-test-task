<?php

declare(strict_types=1);

namespace App\Dto;

use App\Dto\Exceptions\DtoValidationException;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;

/**
 * Data object abstract class.
 */
abstract class Dto
{
    /**
     * DTO attributes array.
     *
     * @var array
     */
    protected $initialized = [];

    /**
     * Initialization.
     *
     * @throws DtoValidationException
     */
    public function __construct(array $data)
    {
        $this->validate($data);
        $this->setProperties($data);
    }

    /**
     * Validation rules.
     */
    abstract public function rules(): array;

    /**
     * Parameters validation.
     *
     * @throws DtoValidationException
     */
    public function validate(array $data): void
    {
        $validator = Validator::make($data, static::rules());

        if ($validator->fails()) {
            Log::error('DTO validation error', [
                'class' => get_class($this),
                'errors' => $validator->getMessageBag()->toArray(),
            ]);
            throw new DtoValidationException();
        }
    }

    /**
     * Representation as array.
     */
    public function toArray(): array
    {
        return $this->getProperties()
            ->filter(function ($value, $key): bool {
                return in_array($key, $this->initialized);
            })
            ->mapWithKeys(static function ($value, $key): array {
                return [
                    Str::snake($key) => $value,
                ];
            })
            ->toArray();
    }

    /**
     * Get object attributes.
     */
    private function getProperties(): Collection
    {
        return collect(get_object_vars($this))->forget('initialized');
    }

    /**
     * Initialization of object attributes.
     */
    private function setProperties(array $data): void
    {
        foreach ($data as $key => $value) {
            if (property_exists($this, $propertyCamel = Str::camel($key))) {
                $this->{$propertyCamel} = $value;
                $this->initialized[] = $propertyCamel;
            }
        }
    }
}

<?php

declare(strict_types=1);

namespace App\Services\Validators;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Arr;

abstract class BaseJsonApiValidation extends FormRequest
{
    public const string ATTRIBUTE_KEY = 'data.attributes.';

    public function rules(): array
    {
        return [...$this->mapFromJsonApiAttributes()];
    }

    public function attributes(): array
    {
        return [...$this->mapToCustomAttributes()];
    }

    public function messages(): array
    {
        return [...$this->mapToCustomErrorMessages()];
    }

    protected function mapFromJsonApiAttributes(): array
    {
        return Arr::prependKeysWith($this->jsonApiAttributeRules(), self::ATTRIBUTE_KEY);
    }

    protected function mapToCustomAttributes(): array
    {
        return Arr::prependKeysWith($this->jsonApiCustomAttributes(), self::ATTRIBUTE_KEY);
    }

    protected function mapToCustomErrorMessages(): array
    {
        if (! $this->jsonApiCustomErrorMessages()) {
            return [];
        }

        return Arr::prependKeysWith($this->jsonApiCustomErrorMessages(), self::ATTRIBUTE_KEY);
    }

    public function __get($key)
    {
        return $this->data(self::ATTRIBUTE_KEY.$key);
    }

    /**
     * return [
     *      'field' => 'rule';
     * ];
     */
    abstract public function jsonApiAttributeRules(): array;

    abstract public function jsonApiCustomAttributes(): array;

    public function jsonApiCustomErrorMessages(): array
    {
        return [];
    }
}
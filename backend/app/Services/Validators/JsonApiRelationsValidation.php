<?php

declare(strict_types=1);

namespace App\Services\Validators;

use Illuminate\Support\Collection;

/**
 * @method Collection relation(string $key)
 */
abstract class JsonApiRelationsValidation extends BaseJsonApiValidation
{
    public const string RELATION_KEY = 'data.relationships.';

    public function rules(): array
    {
        return [...$this->mapFromJsonApiAttributes(), ...$this->mapFromJsonApiRelationshipsRules()];
    }

    public function attributes(): array
    {
        return [...$this->mapToCustomAttributes(), ...$this->mapToCustomRelationshipsAttributes()];
    }

    public function messages(): array
    {
        return [...$this->mapToCustomErrorMessages(), ...$this->mapToCustomRelationshipsMessages()];
    }

    protected function mapFromJsonApiRelationshipsRules(): array
    {
        return $this->relationshipsMapperToJsonApiFields($this->jsonApiRelationshipsRules());
    }

    protected function mapToCustomRelationshipsAttributes(): array
    {
        return $this->relationshipsMapperToJsonApiFields($this->jsonApiRelationshipsCustomAttributes());
    }

    protected function mapToCustomRelationshipsMessages(): array
    {
        return $this->relationshipsMapperToJsonApiFields($this->jsonApiRelationshipsCustomErrorsMessages());
    }

    private function relationshipsMapperToJsonApiFields(array $data): array
    {
        if ($data === []) {
            return [];
        }

        return collect($data)
            ->flatMap(fn($item, $relationship) => collect($item)
                ->mapWithKeys(function ($value, $field) use ($relationship) {
                    if (str_contains($relationship, '.*')) {
                        $relationshipKey = str_replace('.*', '', $relationship);
                        return [self::RELATION_KEY."{$relationshipKey}.data.*.{$field}" => $value];
                    }

                    return [self::RELATION_KEY."{$relationship}.data.{$field}" => $value];
                }))
            ->toArray();
    }

    public function __call($method, $parameters)
    {
        if ($method === 'relation') {
            if (! $parameters) {
                return collect($this->data('data.relationships'))
                    ->mapWithKeys(fn($item, $key) => $item);
            }

            return collect($this->data(self::RELATION_KEY.$parameters[0])['data']);
        }

        throw new \RuntimeException('Undefined method in json api validation');
    }

    /**
     * return [
     *       'relation' => [
     *           'key.rule' => 'message';
     *       ],
     *  ]
     */
    public function jsonApiRelationshipsCustomErrorsMessages(): array
    {
        return [];
    }

    /**
     * return [
     *      'relation' => [
     *          'field' => 'rule';
     *      ],
     * ];
     */
    abstract public function jsonApiRelationshipsRules(): array;

    /**
     * return [
     *      'relation' => [
     *          'key' => 'new attribute';
     *      ],
     * ]
     */
    abstract public function jsonApiRelationshipsCustomAttributes(): ?array;
}
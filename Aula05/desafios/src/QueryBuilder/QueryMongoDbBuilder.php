<?php

namespace DifferDev\QueryBuilder;

class QueryMongoDbBuilder
{
    /**
     * @var array<int, string>
     */
    protected array $queryPieces = [];

    public function find(string $collectionName): self
    {
        $this->queryPieces['collectionName'] = $collectionName;
        return $this;
    }

    public function getQueryAsArray(): array
    {
        return $this->queryPieces;
    }

    public function projection(array $projections): self
    {
        foreach ($projections as $projection) {
            if (!isset($this->queryPieces['options'])) {
                $this->queryPieces['options'] = [];
            }
            if (!isset($this->queryPieces['options']['projection'])) {
                $this->queryPieces['options']['projection'] = [];
            }
            $this->queryPieces['options']['projection'][$projection] = 1;
        }

        return $this;
    }

    public function filter(string $field, string $operator, string $value): self
    {
        if (!isset($this->queryPieces['filter'])) {
            $this->queryPieces['filter'] = [];
        }

        $parsedOperator = $this->parserOperator($operator);
        $this->queryPieces['filter'][$field][$parsedOperator] = $value;

        return $this;
    }

    private function parserOperator(string $operator): string
    {
        return match ($operator) {
            ">" => '$gt',
            ">=" => '$gte',
            "<" => '$lt',
            "<=" => '$lte',
            "=" => '$eq',
        };
    }
}

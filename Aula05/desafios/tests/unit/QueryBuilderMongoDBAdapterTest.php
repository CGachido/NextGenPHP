<?php

namespace unit;

use DifferDev\Interfaces\QueryBuilderAdapter;
use DifferDev\QueryBuilder\QueryMongoDbBuilder;
use DifferDev\Adapter\QueryMongoDbBuilderAdapter;
use PHPUnit\Framework\Attributes\CoversClass;
use PHPUnit\Framework\TestCase;

#[CoversClass(QueryMongoDbBuilderAdapter::class)]
#[CoversClass(QueryMongoDbBuilder::class)]
class QueryBuilderMongoDBAdapterTest extends TestCase
{
    public function testQueryBuilderShouldCreateASelectQuery(): void
    {
        $queryBuilderAdapter = new QueryMongoDbBuilderAdapter(
            new QueryMongoDbBuilder
        );
        $queryBuilderAdapter->select(['name', 'email'])
            ->from('users')
            ->where('created_at', '>=', '2022-01-01 00:00:00');

        $this->assertEquals(
            [
                'collectionName' => 'users',
                'filter' => [
                    'created_at' => [
                        '$gte' => '2022-01-01 00:00:00'
                    ]
                ],
                'options' => [
                    'projection' => [
                        'name' => 1,
                        'email' => 1
                    ]
                ]
            ],
            $queryBuilderAdapter->getQueryAsArray()
        );
    }

    public function testQueryBuilderShouldHandleGreaterThanOperator(): void
    {
        $queryBuilderAdapter = new QueryMongoDbBuilderAdapter(new QueryMongoDbBuilder);
        $queryBuilderAdapter->select(['name', 'email'])
            ->from('users')
            ->where('age', '>', '18');

        $this->assertEquals(
            [
                'collectionName' => 'users',
                'filter' => [
                    'age' => [
                        '$gt' => '18'
                    ]
                ],
                'options' => [
                    'projection' => [
                        'name' => 1,
                        'email' => 1
                    ]
                ]
            ],
            $queryBuilderAdapter->getQueryAsArray()
        );
    }

    public function testQueryBuilderShouldHandleLessThanOperator(): void
    {
        $queryBuilderAdapter = new QueryMongoDbBuilderAdapter(new QueryMongoDbBuilder);
        $queryBuilderAdapter->select(['name', 'email'])
            ->from('users')
            ->where('age', '<', '65');

        $this->assertEquals(
            [
                'collectionName' => 'users',
                'filter' => [
                    'age' => [
                        '$lt' => '65'
                    ]
                ],
                'options' => [
                    'projection' => [
                        'name' => 1,
                        'email' => 1
                    ]
                ]
            ],
            $queryBuilderAdapter->getQueryAsArray()
        );
    }

    public function testQueryBuilderShouldHandleEqualsOperator(): void
    {
        $queryBuilderAdapter = new QueryMongoDbBuilderAdapter(new QueryMongoDbBuilder);
        $queryBuilderAdapter->select(['name', 'email'])
            ->from('users')
            ->where('status', '=', 'active');

        $this->assertEquals(
            [
                'collectionName' => 'users',
                'filter' => [
                    'status' => [
                        '$eq' => 'active'
                    ]
                ],
                'options' => [
                    'projection' => [
                        'name' => 1,
                        'email' => 1
                    ]
                ]
            ],
            $queryBuilderAdapter->getQueryAsArray()
        );
    }

    public function testQueryBuilderShouldHandleGreaterThanOrEqualOperator(): void
    {
        $queryBuilderAdapter = new QueryMongoDbBuilderAdapter(new QueryMongoDbBuilder);
        $queryBuilderAdapter->select(['name', 'email'])
            ->from('users')
            ->where('created_at', '>=', '2022-01-01 00:00:00');

        $this->assertEquals(
            [
                'collectionName' => 'users',
                'filter' => [
                    'created_at' => [
                        '$gte' => '2022-01-01 00:00:00'
                    ]
                ],
                'options' => [
                    'projection' => [
                        'name' => 1,
                        'email' => 1
                    ]
                ]
            ],
            $queryBuilderAdapter->getQueryAsArray()
        );
    }

    public function testQueryBuilderShouldHandleLessThanOrEqualOperator(): void
    {
        $queryBuilderAdapter = new QueryMongoDbBuilderAdapter(new QueryMongoDbBuilder);
        $queryBuilderAdapter->select(['name', 'email'])
            ->from('users')
            ->where('created_at', '<=', '2023-12-31 23:59:59');

        $this->assertEquals(
            [
                'collectionName' => 'users',
                'filter' => [
                    'created_at' => [
                        '$lte' => '2023-12-31 23:59:59'
                    ]
                ],
                'options' => [
                    'projection' => [
                        'name' => 1,
                        'email' => 1
                    ]
                ]
            ],
            $queryBuilderAdapter->getQueryAsArray()
        );
    }
}

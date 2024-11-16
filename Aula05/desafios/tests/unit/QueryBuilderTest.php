<?php

namespace unit;

use DifferDev\QueryBuilder\QueryBuilder;
use PHPUnit\Framework\Attributes\CoversClass;
use PHPUnit\Framework\TestCase;

#[CoversClass(QueryBuilder::class)]
class QueryBuilderTest extends TestCase
{
    public function testQueryBuilderShouldCreateASelectQuery(): void
    {
        $queryBuilder = new QueryBuilder();
        $queryBuilder->select(['name', 'email'])
            ->from('users')
            ->where('created_at', '>=', '2022-01-01 00:00:00');

        $this->assertEquals(
            [
                'SELECT' => 'name, email',
                'FROM' => 'users',
                'WHERE' => "created_at >= '2022-01-01 00:00:00'"
            ],
            $queryBuilder->getQueryAsArray()
        );
    }
}

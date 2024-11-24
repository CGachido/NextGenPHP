<?php

namespace Architecture\Infraestructure;

use Architecture\Domain\Entities\StoredBook;

interface StoredBookRepositoryInterface
{
    /**     
     * @return StoredBook
     */
    public function findById(int $storedBook): ?StoredBook;
}

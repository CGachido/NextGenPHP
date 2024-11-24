<?php

namespace Architecture\Infraestructure\Repository\Eloquent;

use App\Models\StoredBook as EloquentStoredBook;
use Architecture\Domain\Entities\StoredBook;
use Architecture\Infraestructure\StoredBookRepositoryInterface;
use Illuminate\Database\Eloquent\Model;

class EloquentStoredBookRepository implements StoredBookRepositoryInterface
{
    protected ?Model $model;
    public function __construct()
    {
        $this->model = new EloquentStoredBook();
    }

    public function findById(int $storedBookId): ?StoredBook
    {
        $storedBookData = $this->model::find($storedBookId);
        if (!$storedBookData) {
            return null;
        }
        return StoredBook::fromArray($storedBookData->toArray());
    }
}

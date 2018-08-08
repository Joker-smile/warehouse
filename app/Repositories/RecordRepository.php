<?php

namespace App\Repositories;

use App\Contracts\Repositories\AbstractRepository;
use App\Repositories\Contracts\RecordRepositoryInterface;
use App\Record;

class RecordRepository extends AbstractRepository implements RecordRepositoryInterface
{
    public function model()
    {
        return Record::class;
    }
}

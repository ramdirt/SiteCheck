<?php

namespace App\Queries;

use App\Models\Page;
use Illuminate\Contracts\Database\Eloquent\Builder;

class QueryBuilderPages implements QueryBuilder
{
    public function getBuilder(): Builder
    {
        return Page::query();
    }

    public function getPageById(int $id)
    {
        return Page::select(['id', 'name', 'url', 'status', 'last_check'])->findOrFail($id);
    }

    public function deletePage(int $id) {
        return Page::query()->whereKey($id)->delete();
    }
}

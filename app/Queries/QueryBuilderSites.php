<?php

namespace App\Queries;

use App\Models\Site;
use App\Models\User;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Contracts\Database\Eloquent\Builder;

class QueryBuilderSites implements QueryBuilder
{
    public function getBuilder(): Builder
    {
        return Site::query();
    }

    public function getSites(): Collection
    {
        return Site::select(['id', 'name', 'url', 'status', 'last_check'])->get();
    }

    public function getSiteById(int $id)
    {
        return Site::select(['id', 'name', 'url', 'status', 'last_check'])->findOrFail($id);
    }

    public function getSitesUserById(int $id)
    {
        return User::find($id)->sites()->get();
    }

    public function deleteSite($id)
    {
        return Site::find($id)->delete();
    }
}
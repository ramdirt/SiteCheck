<?php

namespace App\Http\Controllers;

use App\Models\User;
use Inertia\Inertia;
use Illuminate\Http\Request;
use App\Queries\QueryBuilderSites;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\StoreSiteRequest;

class SiteController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Inertia\Response
     */
    public function index(QueryBuilderSites $sites)
    {
        $user_id = Auth::user()->id;

        return Inertia::render(
            'TheSites',
            [
                'sites' => $sites->getSitesUserById($user_id),
            ]
        );
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(StoreSiteRequest $request)
    {
        $validated = $request->validated();

        User::find(Auth::id())->sites()->create([
            'name' => $validated['name'],
            'url' => $validated['url'],
            'status' => false
        ]);

        return back();
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Inertia\Response
     */
    public function show()
    {
        return 'pages';
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(QueryBuilderSites $sites, $id)
    {
        $sites->deleteSite($id);
    }
}
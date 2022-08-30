<?php

namespace App\Http\Controllers;

use App\Models\Page;
use App\Models\Site;
use App\Queries\QueryBuilderPages;
use Illuminate\Http\Request;
use Inertia\Inertia;

class PageController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Inertia\Response
     */
    public function index(QueryBuilderPages $pages, $id)
    {
        return Inertia::render(
            'PageLayout',
            [
                'page' => $pages->getPageById($id)
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
    public function store(Request $request)
    {
        $request->validate([
            'site_id' => 'required',
            'name' => 'required',
            'url' => 'required',
        ]);

        $site_id = $request->get('site_id');

        $page = Site::find($site_id)->pages()->create([
            'name' => $request->name,
            'url' => $request->url,
            'site_id' => $site_id,
        ]);

        if (Page::where('url', '=', $request->url)) {
            return redirect()->route('pages.index')->with('success', 'Запись успешно добавлена');
        }

        return back()->with('error', 'Ошибка добавления');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Inertia\Response
     */
    public function show(QueryBuilderPages $sites, $id)
    {
       //
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
    public function destroy(QueryBuilderPages $pages,$id)
    {
        $pages->deletePage($id);
    }
}

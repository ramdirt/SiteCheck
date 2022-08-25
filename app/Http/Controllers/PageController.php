<?php

namespace App\Http\Controllers;

use App\Models\Page;
use App\Models\Site;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class PageController extends Controller
{
    /**
     * Get all pages for specific site
     *
     * @param Request $request
     * @return JsonResponse
     */
    public function index(Request $request): JsonResponse
    {
        if ($request->has('site_id')) {
            $siteId = $request->get('site_id');
            return new JsonResponse([
                'status' => true,
                'sites' => Page::query()
                    ->where('site_id', '=', $siteId)
                    ->get()
            ]);
        } else {
            return new JsonResponse([
                'status' => true,
                'sites' => Site::all()
            ]);
        }
    }

    /**
     * Save new page or update existing
     *
     * @param Request $request
     * @return JsonResponse
     */
    public function update(Request $request): JsonResponse
    {
        $page = $request->get('page');

        Page::query()->updateOrCreate([
            'id' => $page['id']
        ], [
            $page
        ]);

        return new JsonResponse(['status' => true]);
    }

    /**
     * Delete page
     *
     * @param Request $request
     * @return JsonResponse
     */
    public function delete(Request $request): JsonResponse
    {
        $id = $request->get('id');
        Page::query()->whereKey($id)->delete();

        return new JsonResponse(['status' => true]);
    }
}

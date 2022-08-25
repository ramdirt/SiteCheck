<?php

namespace App\Http\Controllers;

use App\Models\Check;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class CheckController extends Controller
{
    /**
     * Get all checks for specific page
     *
     * @param Request $request
     * @return JsonResponse
     */
    public function index(Request $request): JsonResponse
    {
        $pageId = $request->get('page_id');
        return new JsonResponse([
            'status' => true,
            'pages' => Check::query()
                ->where('page_id', '=', $pageId)
                ->get()
        ]);
    }

    /**
     * Create new check or update existing
     *
     * @param Request $request
     * @return JsonResponse
     */
    public function update(Request $request): JsonResponse
    {
        $page = $request->get('page');

        Check::query()->updateOrCreate([
            'id' => $page['id']
        ], [
            $page
        ]);

        return new JsonResponse(['status' => true]);
    }

    /**
     * Delete check
     *
     * @param Request $request
     * @return JsonResponse
     */
    public function delete(Request $request): JsonResponse
    {
        $id = $request->get('id');
        Check::query()->whereKey($id)->delete();

        return new JsonResponse(['status' => true]);
    }
}

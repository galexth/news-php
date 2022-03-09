<?php

namespace App\Http\Controllers;

use App\Http\Resources\ArticlesCollection;
use App\Repositories\ArticleRepositoryInterface;
use Illuminate\Http\Request;

class ArticleController extends Controller
{
    public function index(Request $request, ArticleRepositoryInterface $repo)
    {
        $this->validate($request, [
            'date' => 'date|before_or_equal:today',
            'page' => 'numeric|min:1',
            'per_page' => 'numeric|min:1',
        ]);

        $page = $request->input('page') ?: 1;
        $perPage = $request->input('per_page') ?: 20;

        $criteria = array_filter($request->only(['date', 'source', 'title']));

        $paginator = $repo->getAll($criteria, ['source'], $page, $perPage);

        return response()->json(new ArticlesCollection($paginator));
    }
}

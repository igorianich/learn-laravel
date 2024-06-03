<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateArticleRequest;
use App\Http\Requests\UpdateArticleRequest;
use App\Http\Resources\ArticleResource;
use App\Models\Article;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;

class ArticleController extends Controller
{
    public function index(Request $request): AnonymousResourceCollection
    {
        $request->validate([
            'per_page' => 'integer|min:1|max:100',
        ]);

        return ArticleResource::collection(Article::with('user')
            ->where('status','published')
            ->paginate($request->input('per_page',10)));
    }

    public function show(Article $article): ArticleResource
    {
        $this->authorize('view', $article);

        return new ArticleResource($article);
    }
}

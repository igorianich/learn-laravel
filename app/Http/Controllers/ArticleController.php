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
        $validated = $request->validate([
            'per_page' => 'integer|min:1|max:100',
        ]);
        $perPage = $validated['per_page'] ?? 10;

        return ArticleResource::collection(Article::with('user')->paginate($perPage));
    }

    public function show(Article $article): ArticleResource
    {
        return new ArticleResource($article);

    }

    public function store(CreateArticleRequest $request): JsonResponse
    {
        $article = $request->user()->articles()->create($request->validated());

        return (new ArticleResource($article->fresh()))->response()->setStatusCode(201);
    }

    public function update(UpdateArticleRequest $request, Article $article): ArticleResource
    {
        $article->update($request->validated());

        return new ArticleResource($article);
    }
}

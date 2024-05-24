<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateArticleRequest;
use App\Http\Requests\UpdateArticleRequest;
use App\Http\Resources\ArticleResource;
use App\Models\Article;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;

class ArticleController extends Controller
{
    public function index(): AnonymousResourceCollection
    {
        $articles = Article::with('user')->paginate(10);
        return ArticleResource::collection($articles);
    }

    public function show(Article $article): ArticleResource
    {
        return new ArticleResource($article);

    }

    public function store(CreateArticleRequest $request): JsonResponse
    {
        $validated = $request->validated();
        $article = $request->user()->articles()->create($validated);

        return (new ArticleResource($article->fresh()))->response()->setStatusCode(201);
    }

    public function update(UpdateArticleRequest $request, Article $article): ArticleResource
    {
        $validated = $request->validated();

        $article->update($validated);
//        dd($article->fresh());
        return new ArticleResource($article->fresh());
    }
}

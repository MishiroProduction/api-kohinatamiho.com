<?php

declare(strict_types=1);

namespace App\Services\Interfaces;

use App\Models\News;
use App\Http\Requests\Request;
use Illuminate\Pagination\LengthAwarePaginator;

interface NewsServiceInterface
{ 
    public function getNewsList(): LengthAwarePaginator;
    public function createNews(Request $request): News;
    public function updateNews(News $news, Request $request);
    public function deleteNews(News $news);
}

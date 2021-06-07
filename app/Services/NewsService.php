<?php

declare(strict_types=1);

namespace App\Services;

use App\Models\News;
use App\Services\Service as BaseService;
use App\Services\Interfaces\NewsServiceInterface;
use App\Http\Requests\Request;
use Illuminate\Pagination\LengthAwarePaginator;

class NewsService extends BaseService implements NewsServiceInterface
{

    /**
     * Get all news.
     *
     * @return LengthAwarePaginator
     */
    public function getNewsList(): LengthAwarePaginator {

        return News::paginate(15);

    }

    /**
     * Create news.
     *
     * @param Request $request
     * @return News
     */
    public function createNews(Request $request): News {

        $result = News::create([
            'title' => $request->input('title'),
            'content' => $request->input('content'),
            'status' => $request->input('status'),
        ]);
        if (empty($result)) {
            throw new \Exception('Failed to create');
        }
        return $result;

    }

    /**
     * Update the news.
     *
     * @param News $news
     * @param Request $request
     */
    public function updateNews(News $news, Request $request) {

        $data = [
            'title' => $request->get('title'),
            'content' => $request->get('content'),
            'status' => $request->get('status'),
        ];
        if (!$news->update($data)) {
            throw new \Exception('Failed to update');
        }

    }

    /**
     * Delete the news.
     *
     * @param News $news
     */
    public function deleteNews(News $news) {

        if (!$news->delete()) {
            throw new \Exception('Failed to delete');
        }

    }
    
}

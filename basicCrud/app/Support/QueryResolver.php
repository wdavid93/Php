<?php

declare(strict_types=1);

namespace App\Support;

use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Route;

class QueryResolver
{
    /**
     * @var Collection<string, mixed>
     */
    private Collection $query;

    public function __construct()
    {
        if (request()->routeIs('*.index')) {
            session()->put(Route::currentRouteName().'.previous.query', request()->query());
        }
        $this->query = request()->collect()->forget(['page']);
    }

    /**
     * @return array<string, mixed>
     */
    public static function getPreviousQuery(string $routeName): array
    {
        $query = session()->get($routeName.'.previous.query');

        return is_array($query) ? $query : [];
    }

    /**
     * @return array<int, mixed>
     */
    public function sortQuery(string $key): array
    {
        $query = $this->query->toArray();
        unset($query['sortBy'], $query['direction']);

        return [
            ...$query,
            ...match ($this->query->get('sortBy')) {
                $key => $this->query->get('direction') === 'asc' ? ['sortBy' => $key, 'direction' => 'desc'] : [],
                default => ['sortBy' => $key, 'direction' => 'asc'],
            },
        ];
    }

    public function sortArrow(string $key): string
    {
        return $this->query->get('sortBy') === $key
        ? ($this->query->get('direction') === 'asc' ? '&uarr;' : '&darr;')
        : '&uarr;&darr;';
    }

    /**
     * @return array<int, mixed>
     */
    public function publishedQuery(): array
    {
        $query = $this->query->toArray();
        unset($query['published']);

        return [
            ...$query,
            'published' => $this->query->get('published') ? null : true,
        ];
    }

    public function publishedLabel(): string
    {
        return $this->query->get('published') ? __('posts.index.All Posts') : __('posts.index.Published Posts');
    }

    /**
     * @return array<int, mixed>
     */
    public function searchQuery(): array
    {
        $query = $this->query->toArray();
        unset($query['search']);

        return $query;
    }

    public function searchValue(): mixed
    {
        return $this->query->get('search');
    }
}

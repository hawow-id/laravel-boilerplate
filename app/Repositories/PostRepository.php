<?php


namespace App\Repositories;


use App\Models\Post;
use JetBrains\PhpStorm\ArrayShape;

class PostRepository extends BaseRepository
{

    #[ArrayShape([
        'title' => "string|array",
        'sub_title' => "string|array",
        'author_id' => "string|array",
        'content' => "string|array",
    ])]
    public function getRules(): array
    {
        return [
            'title' => 'required',
            'sub_title' => 'required',
            'author_id' => 'required',
            'content' => 'required',
        ];
    }

    public function getModel()
    {
        return new Post();
    }

    public function getRouteName(): string
    {
        return 'posts';
    }

    #[ArrayShape([
        'title' => 'string',
    ])]
    public function getViewAttributes(): array
    {
        return [
            'title' => 'Post',
        ];
    }
}

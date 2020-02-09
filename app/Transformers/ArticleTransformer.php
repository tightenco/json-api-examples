<?php

namespace App\Transformers;

use App\Article;
use League\Fractal\TransformerAbstract;

class ArticleTransformer extends TransformerAbstract
{
    /**
     * List of resources to automatically include
     *
     * @var array
     */
    protected $defaultIncludes = [
        //
    ];

    /**
     * List of resources possible to include
     *
     * @var array
     */
    protected $availableIncludes = [
        'author',
        'comments',
    ];

    /**
     * A Fractal transformer.
     *
     * @return array
     */
    public function transform(Article $article)
    {
        return [
            'id' => (int) $article->id,
            'title' => $article->title,
        ];
    }

    public function includeAuthor(Article $article)
    {
        return $this->item($article->author, new AuthorTransformer);
    }

    public function includeComments(Article $article)
    {
        return $this->collection($article->comments, new CommentTransformer);
    }
}

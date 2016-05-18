<?php

namespace Quill\Repositories\Eloquent;

use Quill\Contracts\Repositories\PostRepositoryContract;

class PostRepository extends AbstractRepository implements PostRepositoryContract
{
    /**
     * The name of the model to build the repository for.
     * 
     * @var string
     */
    protected $model = 'Quill\Post';

    /**
     * Returns all the threads in the database, paginated.
     * 
     * @param  integer $perPage The number of records to show per page.
     * @param  array   $with    Relationships to eager-load.
     * @return object
     */
    public function threadsPaginated($perPage = 10, $with = [])
    {
        return $this->getModel()
            ->whereNull('parent_id')
            ->with($with)
            ->paginate($perPage); 
    }

    /**
     * Returns the posts for the given thread, paginated.
     * 
     * @param  integer $threadId
     * @param  integer $postsPerPage
     * @param  array   $with
     * @return \Illuminate\Http\Response
     */
    public function postsInThreadPaginated($threadId, $postsPerPage = 10, $with = [])
    {
        $thread = $this->getModel()->find($threadId);

        return $thread->posts()->with($with)->paginate($postsPerPage);
    }
}
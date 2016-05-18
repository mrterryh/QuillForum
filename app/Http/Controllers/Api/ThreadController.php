<?php

namespace Quill\Http\Controllers\Api;

use Quill\Contracts\Repositories\PostRepositoryContract as PostRepo;

use Illuminate\Http\Request;

class ThreadController extends ApiController
{
    /**
     * @var PostRepo
     */
    protected $posts;

    /**
     * Class constructor.
     * 
     * @param PostRepo $posts
     */
    public function __construct(PostRepo $posts)
    {
        $this->posts = $posts;
    }

    /**
     * Returns recent threads in the database.
     * 
     * @return \ILluminate\Http\Response
     */
    public function getRecent()
    {
        return $this->posts->threadsPaginated(10, ['poster']);
    }

    /**
     * Returns the posts for the given thread, paginated.
     * 
     * @param  integer $threadId
     * @return \Illuminate\Http\Response
     */
    public function getPosts($threadId)
    {
        return $this->posts->postsInThreadPaginated($threadId, 10, ['poster']);
    }

    /**
     * Creates a post on the given thread.
     * 
     * @param  Request $request
     * @return \Illuminate\Http\Response
     */
    public function postReply(Request $request)
    {
        $post = $this->posts->create([
            'body' => $request->body,
            'parent_id' => $request->threadId,
            'poster_id' => auth()->user()->id
        ]);

        // I know this looks kinda weird, but it's for Vue.
        // I'm sure there's a better work around.
        $post->poster = $post->poster;

        return $post;
    }
}
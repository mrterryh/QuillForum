<?php

namespace Quill\Http\Controllers;

use Quill\Contracts\Repositories\PostRepositoryContract as PostRepo;

class ThreadController extends Controller
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
     * Displays a single thread.
     * 
     * @param  integer $threadId
     * @return \Illuminate\Http\Response
     */
    public function getThread($threadId)
    {
        // @TODO What happens when the user enters the ID of a post
        // and not a thread? It won't error, but we need to account for it.
        $thread = $this->posts->find($threadId, ['poster']);

        return view('thread.thread')->withThread($thread);
    }
}
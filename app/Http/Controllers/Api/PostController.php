<?php

namespace Quill\Http\Controllers\Api;

use Quill\Contracts\Repositories\PostRepositoryContract as PostRepo;

use Illuminate\Http\Request;

class PostController extends ApiController
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
     * Deletes a post from the database.
     * 
     * @param  Request $request
     * @return \Illuminate\Http\Response
     */
    public function postDelete(Request $request)
    {
        $this->posts->delete($request->postId);

        // @TODO Make this "dynamic"? What does the above return?
        return ['success' => true];
    }

    /**
     * Updates the body of the given post.
     * 
     * @param  Request $request
     * @return \Illuminate\Http\Response
     */
    public function postEdit(Request $request)
    {
        $this->posts->update($request->postId, ['body' => $request->body]);
    }
}
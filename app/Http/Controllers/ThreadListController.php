<?php

namespace Quill\Http\Controllers;

class ThreadListController extends Controller
{
    /**
     * Displays a list of recent forum threads.
     * 
     * @return \Illuminate\Http\Response
     */
    public function getRecent()
    {
        return view('threadlist.recent');
    }
}
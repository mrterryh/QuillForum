@extends('layouts.main')

@section('title', 'Recent Threads')

@section('content')
    <div class="row">
        <div class="col-md-3">
            <div class="card recent-threads">
                <div class="card-header">Recent Threads</div>

                <ul class="list-group list-group-flush">
                    <li class="list-group-item"><a href="#">Integer posuere erat a ante venenatis dapibus posuere.</a></li>
                    <li class="list-group-item"><a href="#">Aenean lacinia bibendum nulla sed consectetur.</a></li>
                    <li class="list-group-item"><a href="#">Etiam porta sem malesuada magna mollis euismod.</a></li>
                    <li class="list-group-item"><a href="#">Cras mattis consectetur purus sit amet fermentum.</a></li>
                </ul>
            </div>
        </div>
        
        <div class="col-md-9">
            <quill-threadlist inline-template source="/api/threads/recent" page="{{ Request::get('page') }}">
                <quill-spinner v-if="threadsLoading"></quill-spinner>

                <quill-threadlist-item inline-template v-for="thread in threads" :thread="thread">
                    <div class="row thread-row">
                        <div class="col-md-1">
                            <a href="#"><img class="avatar" :src="thread.poster.avatar" alt="Profile picture"></a>
                        </div>

                        <div class="col-md-6">
                            <h3><a href="/thread/@{{ thread.id }}-@{{ thread.slug }}">@{{ thread.title }}</a></h3>

                            <p class="text-muted meta">
                                Posted by <a href="#">@{{ thread.poster.username }}</a>,
                                @{{ date }}
                            </p>
                        </div>

                        <div class="reply-count col-md-2">
                            <h5>{{ mt_rand(100, 1000) }}</h5>
                            <span>Replies</span>
                        </div>

                        <div class="last-updated col-md-3">
                            <p class="text-muted">Last updated by <a href="#">[username]</a></p>
                            <p class="text-muted">[timestamp]</p>
                        </div>
                    </div>
                </quill-threadlist-item>

                <div class="row">
                    <quill-pagination v-if="!threadsLoading" :paginator="paginator"></quill-pagination>
                </div>
            </quill-threadlist>
        </div>
    </div>
@stop
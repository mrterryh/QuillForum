@extends('layouts.main')

@section('title', $thread->title)

@section('content')
    <quill-thread :thread='{!! $thread !!}' page="{{ Request::get('page') }}"></quill-thread>
@stop
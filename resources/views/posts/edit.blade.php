@extends('layouts.app')
@section('content')
<div class="card-body">
    <form method="post" action="{{ route('posts.update', $post ) }}">
        @method('PUT')
        @csrf
        <input type="text" class="form-control" name="title" placeholder="Write title post" required autocomplete="title" autofocus value="{{ $post->title }}"/><br>
        <input type="textarea" class="form-control" name="description" placeholder="Write text" required  autocomplete="description" autofocus value="{{ $post->description }}"/><br>
        Mark post category/ies<br>
        @foreach ( $categories as $singleCategory )
            <input type="checkbox" class="form-control" name="categories[]" value="{{ $singleCategory->id }}"
            @if (in_array( $singleCategory->id, $postCategories) )
                checked="checked"
            @endif
            />{{ $singleCategory->title }}<br>
        @endforeach
        <button type="submit" class="btn btn-primary">Save post</button>
    </form>
@endsection

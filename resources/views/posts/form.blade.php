@extends('layouts.app')
@section('content')
<div class="card-body">
    <form method="POST" action="{{ route('posts.store') }}">
        @csrf
        <input type="text" class="form-control" name="title" placeholder="Write title post" required autocomplete="title" autofocus value="{{ old('title') }}"/><br>
        <input type="textarea" class="form-control" name="description" placeholder="Write text" required  autocomplete="description" autofocus value="{{ old('description') }}"/><br>
        Mark post category/ies<br>
        @foreach ( $categories as $singleCategory )
            <input type="checkbox" class="form-control" name="categories[]" value="{{ $singleCategory->id }}"/>{{ $singleCategory->title }}<br>
        @endforeach
        <button type="submit" class="btn btn-primary">Save post</button>
    </form>
@endsection

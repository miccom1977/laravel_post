@extends('layouts.app')
@section('content')
<div class="card-body">
    <form method="POST" action="{{ route('categories.store') }}">
        @csrf
        <input type="text" class="form-control" name="title" placeholder="Write title category" required autocomplete="title" autofocus value="{{ old('title') }}"/><br>
        <button type="submit"  class="btn btn-primary">Save category</button>
    </form>
@endsection

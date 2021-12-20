@extends('layouts.app')
@section('content')
<div class="card-body">
            <table class="table">
                <thead>
                <tr>
                    <th scope="col">Post Title</th>
                    <th scope="col">Categories</th>
                    <th scope="col">Description</th>
                </tr>
                </thead>
                <tbody>
                    @foreach($posts as $singlePost)
                    <tr>
                        <td>{{ $singlePost->title }}</td>
                        <td>
                            @foreach( $singlePost->categories as $singleCategory )
                            {{ $singleCategory->title }}
                            @endforeach
                        </td>
                        <td>{{ $singlePost->description }}</td>
                    </tr>
                @endforeach
                </tbody>
            </table>

        </div>

        <div class="card-footer">
            {{ $posts->links() }}
        </div>
    </div>
@endsection

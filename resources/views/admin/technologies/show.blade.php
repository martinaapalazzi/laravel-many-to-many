@extends('layouts.app')

@section('page-title', $type->title)

@section('main-content')
    <div class="row">
        <div class="col">
            <div class="card">
                <div class="card-body">

                    <div class="mb-4">
                        <a href="{{ route('admin.technologies.index') }}" class="btn btn-primary">
                            Go back to Technologies Page
                        </a>
                    </div>
                    
                    <h1 class="text-center text-success">
                        {{ $technology->title }}
                    </h1>
                    
                    <ul>
                        @foreach ($technology->posts as $post)
                            <li>
                                <a href="{{ route('admin.posts.show', ['post' => $post->id]) }}">
                                    {{ $post->title }}
                                </a>
                            </li>
                        @endforeach
                    </ul>

                </div>
            </div>
        </div>
    </div>
@endsection
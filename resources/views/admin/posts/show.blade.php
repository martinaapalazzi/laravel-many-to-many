@extends('layouts.app')

@section('page-title', $post->title)

@section('main-content')
    <div class="row">
        <div class="col">
            <div class="card">
                <div class="card-body">
                    <h1 class="text-center text-success">
                        {{ $post->title }}
                    </h1>
                    
                    <div>
                        <h3>
                            {{ $post->slug }}
                        </h3>
                        <p>
                            {{ $post->content }}
                        </p>
                    </div>

                    <div>
                        <p>
                            Type:
                            {{ $post->type->title }}
                        </p>
                    </div>

                    <div>
                        <p>
                            Tech:
                            @forelse ($post->technologies as $technology)
                                <a href="{{ route('admin.technologies.show', ['technology' => $technology->id]) }}" class="badge rounded-pill text-bg-primary">
                                    {{ $technology->title }}
                                </a>
                            @empty
                                -
                            @endforelse
                        </p>
                    </div>

                    @if ($post->cover_img != null)
                        <div class="my-3">
                            <img src="{{ asset('storage/'.$post->cover_img) }}" style="max-width: 400px;">
                        </div>
                    @endif

                </div>
            </div>
        </div>
    </div>
@endsection
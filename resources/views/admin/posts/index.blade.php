@extends('layouts.app')

@section('page-title', 'Posts:')

@section('main-content')
    <div class="row">
        <div class="col">
            <div class="card">
                <div class="card-body">
                    <h1 class="text-center text-success">
                        All the posts
                    </h1>

                    <div class="m-4">
                        <a href="{{ route('admin.posts.create') }}" class="btn btn-xs btn-primary">
                            add new post
                        </a>
                    </div>
                    
                    <div>
                        <table class="table">
                            <thead>
                                <tr>
                                    <th scope="col">#</th>
                                    <th scope="col">Title</th>
                                    <th scope="col">Slug</th>
                                    <th scope="col">Type</th>
                                    <th scope="col">Created at</th>
                                    <th scope="col">Show post</th>
                                    <th scope="col">edit post</th>
                                    <th scope="col">Delete post</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($posts as $post)
                                    <tr>
                                        <th scope="row">{{ $post->id }}</th>
                                        <td>{{ $post->title }}</td>
                                        <td>{{ $post->slug }}</td>
                                        <td>
                                            @if ($post->type != null)
                                                <a href="{{ route('admin.types.show', ['type' => $post->type->id]) }}">
                                                    {{ $post->type->title }}
                                                </a>
                                            @else
                                                -
                                            @endif
                                        </td>
                                        <td>{{ $post->created_at->format('H:i d/m/Y') }}</td>
                                        <td>
                                            <a href="{{ route('admin.posts.show', ['post' => $post->slug]) }}" class="btn btn-xs btn-primary">
                                                Show
                                            </a>
                                        </td>
                                        <td>
                                            <a href="{{ route('admin.posts.edit', ['post' => $post->slug]) }}" class="btn btn-warning">
                                                Edit
                                            </a>
                                        </td>
                                        <td>
                                            <form 
                                            onsubmit="return confirm('Are you sure you want to delete this post?');"
                                            class="d-inline-block" action="{{ route('admin.posts.destroy', ['post' => $post->id]) }}"  method="POST">
                                                @csrf
                                                @method('DELETE')
                                                <button  type="submit" class="btn btn-danger">Delete</button>
                                            </form>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>

                </div>
            </div>
        </div>
    </div>
@endsection

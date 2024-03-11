@extends('layouts.app')

@section('page-title', 'Posts:')

@section('main-content')
    <div class="row">
        <div class="col">
            <div class="card">
                <div class="card-body">
                    <h1 class="text-center text-success">
                        All the Technologies
                    </h1>

                    <div class="m-4">
                        <a href="{{ route('admin.technologies.create') }}" class="btn btn-xs btn-primary">
                            add new technologies
                        </a>
                    </div>
                    
                    <div>
                        <table class="table">
                            <thead>
                                <tr>
                                    <th scope="col">#</th>
                                    <th scope="col">Title</th>
                                    <th scope="col">Created at</th>
                                    <th scope="col">Show post</th>
                                    <th scope="col">Edit post</th>
                                    <th scope="col">Delete post</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($technologies as $technology)
                                    <tr>
                                        <th scope="row">{{ $technology->id }}</th>
                                        <td>{{ $technology->title }}</td>
                                        <td>{{ $technology->created_at->format('H:i d/m/Y') }}</td>
                                        <td>
                                            <a href="{{ route('admin.technologies.show', ['technology' => $technology->slug]) }}" class="btn btn-xs btn-primary">
                                                Show
                                            </a>
                                        </td>
                                        <td>
                                            <a href="{{ route('admin.technologies.edit', ['technology' => $technology->slug]) }}" class="btn btn-xs btn-warning">
                                                Edit
                                            </a>
                                        </td>
                                        <td>
                                            <form class="d-inline-block" action="{{ route('admin.technologies.destroy', ['technology' => $technology->id]) }}" method="post" onsubmit="return confirm('Are you sure you want to delete this technology?');">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-danger">
                                                    Delete
                                                </button>
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

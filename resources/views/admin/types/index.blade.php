@extends('layouts.app')

@section('page-title', 'Posts:')

@section('main-content')
    <div class="row">
        <div class="col">
            <div class="card">
                <div class="card-body">
                    <h1 class="text-center text-success">
                        All the types
                    </h1>

                    <div class="m-4">
                        <a href="{{ route('admin.types.create') }}" class="btn btn-xs btn-primary">
                            add new type
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
                                @foreach ($types as $type)
                                    <tr>
                                        <th scope="row">{{ $type->id }}</th>
                                        <td>{{ $type->title }}</td>
                                        <td>{{ $type->created_at->format('H:i d/m/Y') }}</td>
                                        <td>
                                            <a href="{{ route('admin.types.show', ['type' => $type->slug]) }}" class="btn btn-xs btn-primary">
                                                Show
                                            </a>
                                        </td>
                                        <td>
                                            <a href="{{ route('admin.types.edit', ['type' => $type->slug]) }}" class="btn btn-xs btn-warning">
                                                Edit
                                            </a>
                                        </td>
                                        <td>
                                            <form class="d-inline-block" action="{{ route('admin.types.destroy', ['type' => $type->slug]) }}" method="post" onsubmit="return confirm('Are you sure you want to delete this type');">
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

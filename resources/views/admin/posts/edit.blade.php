@extends('layouts.app')

@section('page-title', 'Edit your post:')

@section('main-content')
    <div class="row">
        <div class="col">
            <div class="card">
                <div class="card-body">
                    <h1 class="text-center text-success">
                        Edit your post
                    </h1>
                    
                    <div class="mb-4">
                        <a href="{{ route('admin.posts.index') }}" class="btn btn-primary">
                            Go back to Posts Page
                        </a>
                    </div>
        
                    @if($errors->any())
                    <div class="alert alert-danger">
                        <ul class="mb-0">
                            @foreach ( $errors->all() as $error )
                            <li>{{ $error}}</li>
                            @endforeach
                        </ul>
                    </div>
                    @endif

                    <form action="{{ route('admin.posts.update', ['post'=> $post->slug]) }}" method="POST">
                        @csrf

                        @method('PUT')
        
                        <div class="mb-3">
                            <label for="title" class="form-label"> Title <span class="text-danger">*</span></label>
                            <input type="text" class="form-control" id="title" name="title" placeholder="enter the title..." maxlength="64" required value="{{ old ('title', $post->title)}}">
                        </div>

                        <div class="mb-3">
                            <label for="type_id" class="form-label">Categoria</label>
                            <select name="type_id" id="type_id" class="form-select">
                                <option
                                    value="{{ old('type_id') == null ? 'selected' : '' }}">
                                    Seleziona una categoria...
                                </option>
                                @foreach ($types as $type)
                                    <option
                                        value="{{ $type->id }}"
                                        {{ old('type_id') == $type->id ? 'selected' : '' }}>
                                        {{ $type->title }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
        
                        <div class="mb-3">
                            <label for="slug" class="form-label">slug</label>
                            <textarea class="form-control" id="slug" name="slug" rows="3" placeholder="enter the slug..."></textarea value="{{ old ('slug', $post->slug)}}">
                        </div>
        
                        <div class="mb-3">
                            <label for="content" class="form-label">content</label>
                            <textarea class="form-control" id="content" name="content" rows="3" placeholder="enter the content..."></textarea value="{{ old ('content', $post->content)}}">
                        </div>
        
                        <div>
                            <button type="submit" class="btn btn-success w-100">
                                Update the post
                            </button>
                        </div>
                    </form>

                </div>
            </div>
        </div>
    </div>
@endsection

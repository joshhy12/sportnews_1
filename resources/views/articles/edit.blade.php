@extends('layouts.home')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Edit Article') }}</div>

                <div class="card-body">
                    <form method="POST" action="{{ route('articles.update', $article->id) }}">
                        @csrf
                        @method('PUT')

                        <div class="form-group">
                            <label for="title">{{ __('Title') }}</label>
                            <input id="title" type="text" class="form-control @error('title') is-invalid @enderror" name="title" value="{{ $article->title }}" required autofocus>

                            @error('title')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label for="content">{{ __('Content') }}</label>
                            <textarea id="content" class="form-control @error('content') is-invalid @enderror" name="content" rows="5" required>{{ $article->content }}</textarea>

                            @error('content')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label for="category_id">{{ __('Category') }}</label>
                            <select id="category_id" class="form-control @error('category_id') is-invalid @enderror" name="category_id" required>
                                @foreach($categories as $category)
                                <option value="{{ $category->id }}" {{ $category->id == $article->category_id ? 'selected' : '' }}>{{ $category->name }}</option>
                                @endforeach
                            </select>

                            @error('category_id')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="image">{{ __('Image') }}</label>
                            <input id="image" type="file" class="form-control @error('image') is-invalid @enderror" name="image">

                            @error('image')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>


                        <div class="form-group">
                            <label for="published_at">{{ __('Published At') }}</label>
                            <input id="published_at" type="text" class="form-control @error('published_at') is-invalid @enderror" name="published_at" value="{{ $article->published_at }}">

                            @error('published_at')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>

                        <div class="form-group">
                            <button type="submit" class="btn btn-primary">
                                {{ __('Update') }}
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@extends('layouts.app')

@section('content')
    <h1>Dashboard</h1>
    <div class="row">
        <div class="col-md-6">
            <div class="card">
                <div class="card-header">
                    <h3>Articles</h3>
                </div>
                <div class="card-body">
                    <p>Total articles: {{ $articlesCount }}</p>
                    <p>Published articles: {{ $publishedCount }}</p>
                    <p>Draft articles: {{ $draftCount }}</p>
                </div>
            </div>
        </div>
        <div class="col-md-6">
            <div class="card">
                <div class="card-header">
                    <h3>Categories</h3>
                </div>
                <div class="card-body">
                    <p>Total categories: {{ $categoriesCount }}</p>
                </div>
            </div>
        </div>
    </div>
@endsection

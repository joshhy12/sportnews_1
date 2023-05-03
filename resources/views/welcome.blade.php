@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-8">
                <h2>Latest News Articles</h2>
                <hr>
                @include('articles.index')
            </div>
            <div class="col-md-4">
                <h2>Upcoming Game Schedules</h2>
                <hr>

                <br>
                <div class="card">


                </div>
            </div>
        </div>
    </div>
@endsection

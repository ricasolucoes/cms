@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">

            <div class="col-md-12">
                <div class="card card-default">
                    <div class="card-header">
                        <h2>
                            {{ $post->title }} <small>by {{ $post->user->name }}</small>

                            <a href="{{ url('admin/posts') }}" class="btn btn-default pull-right">Go Back</a>
                        </h2>
                    </div>

                    <div class="box-body panel-body card-body">
                        <p>{{ $post->body }}</p>

                        <p><strong>Category: </strong>{{ $post->category->name }}</p>
                        <p><strong>Tags: </strong>{{ $post->tags->implode('name', ', ') }}</p>
                    </div>
                </div>
            </div>

        </div>
    </div>
@endsection

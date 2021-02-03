@extends('layouts.app')

@section('content')
    <section class="content-header">
        <h1>
            {!! trans('words.clients') !!}
        </h1>
    </section>
    <div class="content">

        <div class="box card box-primary card-primary">

            <div class="box-body card-body">
                <div class="row">
                    {!! Form::open(['route' => 'clients.store']) !!}

                        @include('dashboard.clients.fields')

                    {!! Form::close() !!}
                </div>
            </div>
        </div>
    </div>
@endsection

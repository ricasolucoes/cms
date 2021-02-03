@extends('layouts.app')

@section('content')
    <section class="content-header">
        <h1>
            Service
        </h1>
    </section>
    <div class="content">

        <div class="box card box-primary card-primary">

            <div class="box-body card-body">
                <div class="row">
                    {!! Form::open(['route' => 'services.store']) !!}

                        @include('admin.services.fields')

                    {!! Form::close() !!}
                </div>
            </div>
        </div>
    </div>
@endsection

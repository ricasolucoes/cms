@extends('layouts.app')

@section('content')
    <section class="content-header">
        <h1>
            Contact
        </h1>
    </section>
    <div class="content">

        <div class="box card box-primary card-primary">

            <div class="box-body card-body">
                <div class="row">
                    {!! Form::open(['route' => 'contacts.store']) !!}

                        @include('dashboard.contacts.fields')

                    {!! Form::close() !!}
                </div>
            </div>
        </div>
    </div>
@endsection

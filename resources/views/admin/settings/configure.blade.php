@extends('layouts.app')

@section('content')
    <section class="content-header">
        <h1>
            New Configuration
        </h1>
    </section>
    <div class="content">

        <div class="box card box-primary card-primary">

            <div class="box-body card-body">
                <div class="row">

                    <form method="post" action="{{ route('rica.facilitador.facilitador.settings.store', ['codeSetting' => $codeSetting]) }}">
                        {!! csrf_field() !!}
                        @include('cms::admin.settings.fields')
                    </form>

                </div>
            </div>
        </div>
    </div>
@endsection

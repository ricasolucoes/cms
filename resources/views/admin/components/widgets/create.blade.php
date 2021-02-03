@extends('layouts.dashboard')

@section('pageTitle') Widgets @stop

@section('content')

    <div class="col-md-12 mt-2">
        @include('cms::admin.components.widgets.breadcrumbs', ['location' => ['create']])
    </div>

    <div class="col-md-12">
        {!! Form::open(['route' => 'admin.widgets.store', 'class' => 'add']) !!}

            {!! FormMaker::fromTable('widgets', config('cms.forms.widget')) !!}

            <div class="form-group text-right">
                <a href="{!! cms()->url('widgets') !!}" class="btn btn-secondary raw-left">{{ __('pedreiro::generic.cancel') }}</a>
                {!! Form::submit('Save', ['class' => 'btn btn-primary']) !!}
            </div>

        {!! Form::close() !!}
    </div>

@endsection

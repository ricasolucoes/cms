@extends('layouts.dashboard')

@section('pageTitle') Events @stop

@section('content')

    <div class="col-md-12 mt-2">
        @include('cms::admin.features.calendar.events.breadcrumbs', ['location' => ['create']])
    </div>

    <div class="col-md-12">
        {!! Form::open(['route' => 'admin.events.store', 'class' => 'add']) !!}

            {!! FormMaker::setColumns(3)->fromTable('events', config('cms.forms.event.identity')) !!}
            {!! FormMaker::setColumns(1)->fromTable('events', config('cms.forms.event.content')) !!}
            {!! FormMaker::setColumns(2)->fromTable('events', config('cms.forms.event.seo')) !!}
            {!! FormMaker::setColumns(2)->fromTable('events', config('cms.forms.event.publish')) !!}

            <div class="form-group text-right">
                <a href="{!! url('admin/'.'events') !!}" class="btn btn-secondary float-left">{{ __('pedreiro::generic.cancel') }}</a>
                {!! Form::submit('Save', ['class' => 'btn btn-primary']) !!}
            </div>

        {!! Form::close() !!}
    </div>

@endsection

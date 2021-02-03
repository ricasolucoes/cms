@extends('layouts.dashboard')

@section('pageTitle') Faqs @stop

@section('content')

    <div class="col-md-12 mt-2">
        @include('cms::admin.features.writelabel.faqs.breadcrumbs', ['location' => ['create']])
    </div>

    <div class="col-md-12">
        {!! Form::open(['route' => 'admin.faqs.store', 'class' => 'add']) !!}

            {!! FormMaker::fromTable('faqs', config('cms.forms.faqs')) !!}

            <div class="form-group text-right">
                <a href="{!! url('admin/'.'faqs') !!}" class="btn btn-secondary float-left">{{ __('pedreiro::generic.cancel') }}</a>
                {!! Form::submit('Save', ['class' => 'btn btn-primary']) !!}
            </div>

        {!! Form::close() !!}
    </div>

@endsection

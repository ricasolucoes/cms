@extends('layouts.dashboard')

@section('pageTitle') Faqs @stop

@section('content')

    <div class="col-md-12">
        <div class="row">
            <div class="col-md-6 mt-2">
                @include('cms::admin.features.writelabel.faqs.breadcrumbs', ['location' => ['edit']])
            </div>
            <div class="col-md-6">
                <div class="btn-toolbar float-right mt-2">
                    @if (! cms()->isDefaultLanguage() && $faq->translationData(request('lang')))
                        @if (isset($faq->translationData(request('lang'))->is_published))
                            <a class="btn btn-success pull-right ml-1" href="{!! url('faqs') !!}">Live</a>
                        @endif
                        <a class="btn btn-warning pull-right ml-1" href="{!! Cms::rollbackUrl($faq->translation(request('lang')))!!}">Rollback</a>
                    @else
                        @if ($faq->is_published)
                            <a class="btn btn-success pull-right ml-1" href="{!! url('faqs') !!}">Live</a>
                        @endif
                        <a class="btn btn-warning pull-right ml-1" href="{!! Cms::rollbackUrl($faq) !!}">Rollback</a>
                    @endif
                </div>
            </div>
        </div>
    </div>

    <div class="col-md-12">
        <div class="row mb-4">
            <div class="col-md-12">
                <ul class="nav nav-tabs">
                    @include('layouts.tabs', [ 'module' => 'faqs', 'item' => $faq ])
                </ul>
            </div>
        </div>

        <div class="row">
            <div class="col-md-12">
                {!! Form::model($faq, ['route' => ['admin.faqs.update', $faq->id], 'method' => 'patch', 'class' => 'edit']) !!}

                    <input type="hidden" name="lang" value="{{ request('lang') }}">

                    {!! FormMaker::fromObject($faq->asObject(), config('cms.forms.faqs')) !!}

                    <div class="form-group text-right">
                        <a href="{!! url('admin/'.'faqs') !!}" class="btn btn-secondary float-left">{{ __('pedreiro::generic.cancel') }}</a>
                        {!! Form::submit('Save', ['class' => 'btn btn-primary']) !!}
                    </div>

                {!! Form::close() !!}
            </div>
        </div>
    </div>

@endsection

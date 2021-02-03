@extends('layouts.dashboard')

@section('pageTitle') Menus @stop

@section('content')

    <div class="col-md-12 mt-2">
        @include('cms::admin.features.writelabel.menus.breadcrumbs', ['location' => ['edit']])
    </div>

    <div class="col-md-12">
        {!! Form::model($menu, ['route' => ['admin.menus.update', $menu->id], 'method' => 'patch', 'class' => 'edit']) !!}

            {!! FormMaker::fromObject($menu, config('cms.forms.menu')) !!}

            <div class="form-group text-right">
                <a href="{!! url('admin/'.'menus') !!}" class="btn btn-secondary float-left">{{ __('pedreiro::generic.cancel') }}</a>
                {!! Form::submit('Save', ['class' => 'btn btn-primary']) !!}
            </div>

        {!! Form::close() !!}
    </div>

    <div class="col-md-12">
        <hr class="mt-4 mb-4">
    </div>

    <div class="col-md-12">
        <a class="btn btn-outline-primary float-right" href="{!! url('admin/'.'links/create?m='.$menu->id) !!}">Add Link</a>
        <h5 class="pt-2">Links <small>(Drag and drop to sort)</small></h5>
        @include('cms::admin.features.writelabel.links.index')
    </div>

@endsection

@section('pre_javascript')

    @parent
    var _linkOrder = @if (!is_null($menu->order)) {!! $menu->order !!} @else [] @endif;
    var _id = {{ $menu->id }};
    var _cmsUrl = _url + "/{{ config('cms.backend-route-prefix') }}";

@stop

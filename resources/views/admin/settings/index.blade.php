@extends('layouts.app')

@section('content')
    <section class="content-header">
        <h1 class="pull-left">{!! Business::getBusiness()->name !!}</h1>
        <ol class="breadcrumb">
            <li><a href="#"><i class="fa fa-dashboard"></i> {!! trans('words.home') !!}</a></li>
            <li class="active">{!! Business::getBusiness()->name !!}</li>
        </ol>
    </section>
    <div class="content">
        <div class="clearfix"></div>

        @include(\Pedreiro::loadRelativeView('layouts.partials.message'))

        <div class="clearfix"></div>

        <div class="box card box-primary card-primary">
            <div class="box-body card-body">
                    @include('cms::admin.settings.table')
            </div>
        </div>
        <div class="box card box-primary card-primary">
            <div class="box-body card-body">
                    @include('cms::admin.settings.table-others')
            </div>
        </div>
    </div>
@endsection


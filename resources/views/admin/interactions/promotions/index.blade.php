@extends('layouts.app')

@section('pageTitle') Promotions @stop

@section('content')

    <div class="modal fade" id="deleteModal" tabindex="-3" role="dialog" aria-labelledby="deleteModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title" id="deleteModalLabel">Delete Event</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                </div>
                <div class="modal-body">
                    <p>Are you sure want to delete this promotion?</p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <a id="deleteBtn" class="btn btn-danger" href="#">Confirm Delete</a>
                </div>
            </div>
        </div>
    </div>

    @include('pedreiro::layouts.module-header', [ 'module' => 'promotions' ])

    <div class="col-md-12">
        <div class="row">
            <div class="col-md-12">
                @if ($promotions->count() === 0)
                    @include('pedreiro::layouts.module-search', [ 'module' => 'promotions' ])
                @else
                    <table class="table table-striped">
                        <thead>
                            <th>{!! sortable('Slug', 'slug') !!}</th>
                            <th class="m-hidden">{!! sortable('Publushed At', 'published_at') !!}</th>
                            <th class="m-hidden">{!! sortable('Finished At', 'finished_at') !!}</th>
                            <th class="m-hidden">Currenlty Visible</th>
                            <th width="170px" class="text-right">Actions</th>
                        </thead>
                        <tbody>

                        @foreach($promotions as $promotion)
                            <tr>
                                <td><a href="{!! route('admin.promotions.edit', [$promotion->id]) !!}">{!! $promotion->slug !!}</a></td>
                                <td class="m-hidden">{!! date('M jS, Y', strtotime($promotion->published_at)) !!}</td>
                                <td class="m-hidden">{!! date('M jS, Y', strtotime($promotion->finished_at)) !!}</td>
                                <td class="m-hidden">
                                    @if ($promotion->is_published)
                                        <span class="fa fa-check"></span>
                                    @else
                                        <span class="fa fa-times"></span>
                                    @endif
                                </td>
                                <td class="text-right">
                                    <div class="btn-toolbar justify-content-between">
                                        <a class="btn btn-sm btn-outline-primary mr-2" href="{!! route('admin.promotions.edit', [$promotion->id]) !!}"><i class="fa fa-edit"></i> Edit</a>
                                        <form method="post" action="{!! url('admin/'.'promotions/'.$promotion->id) !!}">
                                            {!! csrf_field() !!}
                                            {!! method_field('DELETE') !!}
                                            <button class="delete-btn btn btn-sm btn-danger" type="submit"><i class="fa fa-trash"></i> Delete</button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            @endif
        </div>
    </div>
    <div class="text-center">
        {!! $pagination !!}
    </div>

@endsection

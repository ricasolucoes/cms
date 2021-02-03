<table class="table table-striped" id="settings-table">
    <thead>
        <th>{!! trans('words.name') !!}</th>
        <th>{!! trans('words.description') !!}</th>
        <th>{!! trans('words.value') !!}</th>
        <th colspan="3">{!! trans('words.action') !!}</th>
    </thead>
    <tbody>
        @if (!empty($otherOptions))
            @foreach($otherOptions as $slug => $otherOption)
                <tr>
                    <td>{!! $otherOption['name'] !!}</td>
                    <td>{!! $otherOption['description'] !!}</td>
                    <td>{!! $otherOption['defaultValue'] !!}</td>
                    <td>
                        <div class='btn-group'>
                            <a href="{!! route('admin.facilitador.settings.configure', [$slug]) !!}" class='btn btn-default btn-xs'><i class="fa fa-edit"></i> Edit</a>
                        </div>
                    </td>
                </tr>
            @endforeach
        @endif
    </tbody>
</table>
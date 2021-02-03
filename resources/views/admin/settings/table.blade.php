<table class="table table-striped" id="settings-table">
    <thead>
        <th>{!! trans('words.name') !!}</th>
        <th>{!! trans('words.description') !!}</th>
        <th>{!! trans('words.value') !!}</th>
        <th colspan="3">{!! trans('words.action') !!}</th>
    </thead>
    <tbody>
        @if (!empty($settings))
            @foreach($settings as $setting)
                <tr>
                    <td>{!! $setting->getAppAtribute('name') !!}</td>
                    <td>{!! $setting->getAppAtribute('description') !!}</td>
                    <td>{!! $setting->value !!}</td>
                    <td>
                        {!! Form::open(['route' => ['admin.facilitador.settings.destroy', $setting->setting_key], 'method' => 'delete']) !!}
                        <div class='btn-group'>
                            <a href="{!! route('admin.facilitador.settings.configure', ['codeSetting' => $setting->setting_key]) !!}" class='btn btn-default btn-xs'><i class="fa fa-edit"></i> Edit</a>
                            {!! Form::button('<i class="fa fa-trash"></i> Delete', ['type' => 'submit', 'class' => 'btn btn-danger btn-xs', 'onclick' => "return confirm('".trans('phrases.areYouSure')."')"]) !!}
                        </div>
                        {!! Form::close() !!}
                    </td>
                </tr>
            @endforeach
        @endif
    </tbody>
</table>
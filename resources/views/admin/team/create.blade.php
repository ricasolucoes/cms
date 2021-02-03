@include('layouts.partials.message')

<div class="container">

    <form method="post" action="{{ route('admin.teams.store') }}">
        {!! csrf_field() !!}

        @form_maker_table("teams", ['name' => 'string'])

        <a href="{{ URL::previous() }}">{{ __('pedreiro::generic.cancel') }}</a>
        <button type="submit">Create</button>

    </form>

</div>
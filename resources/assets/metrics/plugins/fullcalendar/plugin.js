require.\Illuminate\Support\Facades\Config::get(
    {
        shim: {
            'fullcalendar': ['moment', 'jquery'],
        },
        paths: {
            'fullcalendar': 'assets/plugins/fullcalendar/js/fullcalendar.min',
            'moment': 'assets/plugins/fullcalendar/js/moment.min',
        }
    }
);
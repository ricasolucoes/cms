<?php

namespace Cms\Http\Controllers\Calendar;

use Cms\Services\EventService;
use Cms\Repositories\EventRepository;
use Cms\Http\Controllers\Controller as BaseController;
use Illuminate\Http\Request;

class EventsController extends BaseController
{
    private $eventsRepository;

    public function __construct(EventRepository $eventsRepo, EventService $eventService)
    {
        $this->eventsRepository = $eventsRepo;
        $this->eventService = $eventService;

        if (!\Features::isActive('events')) {
            return redirect('/')->send();
        }
    }

    /**
     * Calendar.
     *
     * @param string $date
     *
     * @return Response
     */
    public function calendar($date = null)
    {
        if (is_null($date)) {
            $date = date('Y-m-d');
        }

        $events = $this->eventService->calendar($date);
        $calendar = $this->eventService->generate($date);

        if (empty($calendar)) {
            abort(404);
        }

        return view('features.calendar.events.calendar')
            ->with('events', $events)
            ->with('calendar', $calendar);
    }

    /**
     * Display page list.
     *
     * @return Response
     */
    public function date($date)
    {
        $events = $this->eventsRepository->findEventsByDate($date);

        if (empty($events)) {
            abort(404);
        }

        return view('features.events.date')->with('events', $events);
    }

    /**
     * Display page list.
     *
     * @return Response
     */
    public function all()
    {
        $events = $this->eventsRepository->published();

        if (empty($events)) {
            abort(404);
        }

        return view('features.events.all')->with('events', $events);
    }

    /**
     * Display the specified Page.
     *
     * @param string $date
     *
     * @return Response
     */
    public function show(Request $request, $id)
    {
        $event = $this->eventsRepository->findEventById($id);

        if (empty($event)) {
            abort(404);
        }

        return view('features.events.'.$event->template)->with('event', $event);
    }
}

<?php

namespace Cms\Services;

use Cms\Models\Hotel;
use Cms\Models\Room;
use hotelbeds\hotel_api_sdk\HotelApiClient;
use hotelbeds\hotel_api_sdk\model\Destination;
use hotelbeds\hotel_api_sdk\model\Occupancy;
use hotelbeds\hotel_api_sdk\model\Pax;
use hotelbeds\hotel_api_sdk\model\Stay;
use hotelbeds\hotel_api_sdk\types\ApiVersion;
use hotelbeds\hotel_api_sdk\types\ApiVersions;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Log;

class HotelBeds
{
    protected $apiClient;
    protected $rqData;
    protected $rqBookingConfirm;
    protected $rqCheckRate;
    public function __construct()
    {
        $this->apiClient = new HotelApiClient(
            env('HOTELBEDS_URLDEFAULT', 'https://api.hotelbeds.com'),
            env('HOTELBEDS_APIKEY', 'xb7kap4fnpemrhjsahb4ncxh'),
            env('HOTELBEDS_SHAREDSECRET', 'GmFcJGnjTY'),
            new ApiVersion(ApiVersions::V1_0),
            env('HOTELBEDS_TIMEOUT', 120),
            null,
            env('HOTELBEDS_URLSECURE', 'https://api-secure.hotelbeds.com')
        );
    }

    public function recheck($rateKey)
    {
        //$rateKey = "20171115|20171120|W|1|1075|TPL.VM|CG-TODOS BB|BB||1~2~1|8|N@5897F2A3FEF5401B8A86C4A57DD34DD91542";
        //$paxes = [ new Pax(Pax::AD, 30, "Miquel", "Fiol",1), new Pax(Pax::AD, 27, "Margalida", "Soberats",1), new Pax(Pax::CH, 8, "Josep", "Fiol",1) ];
        $paxes = [ new Pax(Pax::AD, 30, "Mike", "Doe", 1), new Pax(Pax::AD, 27, "Jane", "Doe", 1), new Pax(Pax::CH, 8, "Mack", "Doe", 1) ];
        //$paxes = [ new Pax(Pax::AD, 30, "Mike", "Doe", 1) ];
        $this->rqBookingConfirm = new \hotelbeds\hotel_api_sdk\helpers\Booking();
        $this->rqBookingConfirm->holder = new \hotelbeds\hotel_api_sdk\model\Holder("Hotelbeds", "PHP_IS_FUN");
        $this->rqBookingConfirm->language="ENG";
        $bookingRoom = new \hotelbeds\hotel_api_sdk\model\BookingRoom($rateKey);
        $bookingRoom->paxes = $paxes;
        $bookRooms[] = $bookingRoom;
        $this->rqBookingConfirm->rooms = $bookRooms;
        $this->rqBookingConfirm->clientReference = "PHP_DEMO";

        $confirmRS = $this->apiClient->BookingConfirm($this->rqBookingConfirm);

        return $confirmRS;
    }

    public function getRqBookingConfirm()
    {
        return $this->rqBookingConfirm->toArray();
    }

    public function getRqCheckRate()
    {
        return $this->rqCheckRate->toArray();
    }

    public function getRqData()
    {
        return $this->rqData->toArray();
    }



    public function booking($rateKey)
    {
        $this->rqCheckRate = new \hotelbeds\hotel_api_sdk\helpers\CheckRate();
        $this->rqCheckRate->rooms = [ [ "rateKey" => $rateKey ] ];

        $CheckRateRS = $this->apiClient->CheckRate($this->rqCheckRate);


        return $CheckRateRS;
    }

    /**
     * Get a module's asset.
     *
     * @param string $module      Module name
     * @param string $path        Path to module asset
     * @param string $contentType Asset type
     *
     * @return string
     */
    public function includeDateInterval($init = "2018-02-01", $end = "2018-02-10")
    {
        $this->rqData = new \hotelbeds\hotel_api_sdk\helpers\Availability();
        //        $this->rqData->stay = new Stay(
        //            \DateTime::createFromFormat("Y-m-d", $init),
        //            \DateTime::createFromFormat("Y-m-d", $end));

        $this->rqData->stay = new Stay(
            \DateTime::createFromFormat("Y-m-d", "2018-12-15"),
            \DateTime::createFromFormat("Y-m-d", "2018-12-20")
        );
    }

    /**
     * Generates a notification for the app.
     *
     * @param string $string Notification string
     * @param string $type   Notification type
     */
    public function includeDestine($destine = "PMI")
    {
        //        $this->rqData->destination = new Destination($destine);
    }

    /**
     * Creates a breadcrumb trail.
     *
     * @param array $locations Locations array
     *
     * @return string
     */
    public function includePeoples($adults = 2, $children = 1, $rooms = 1)
    {
        $occupancy = new Occupancy();
        $occupancy->adults = $adults;
        $occupancy->children = $children;
        $occupancy->rooms = $rooms;

        $occupancy->paxes = [
            new Pax(Pax::AD, 30, "Mike", "Doe"),
            new Pax(Pax::AD, 27, "Jane", "Doe"),
            new Pax(Pax::CH, 8, "Mack", "Doe")
        ];
        $this->rqData->occupancies = [ $occupancy ];
    }

    /**
     * Get Module Config.
     *
     * @param string $key Config key
     *
     * @return mixed
     */
    public function returnAvaliables()
    {
        try {
            $this->availRS = $this->apiClient->Availability($this->rqData);
        } catch (\hotelbeds\hotel_api_sdk\types\HotelSDKException $e) {
            Log::emergency('Api HotelBeds Deu Ruim: '.$e->getMessage());
            //            $auditData = $e->getAuditData();
            return false;
        } catch (Exception $e) {
            Log::emergency('Api HotelBeds Deu Ruim: '.$e->getMessage());
            return false;
        }

        if ($this->availRS->isEmpty()) {
            dd('aquiassssssssssss');
            return [];
        }

        return $this->captureHotelsAndRooms($this->availRS);
    }

    /**
     * @param  $availRS
     * @return array
     */
    public function captureHotelsAndRooms($availRS)
    {
        dd('dddddddddddd', $availRS);
        $dataToReturn = [];
        foreach ($availRS->hotels->iterator() as $hotelCode => $hotelData) {
            $hotel = Hotel::firstOrNew(['code' => $hotelData->code]);
            if ($hotel->name !== $hotelData->name) {
                $hotel->name = $hotelData->name;
                $hotel->save();
            }
            $dataToReturnRooms = [];
            foreach ($hotelData->iterator() as $roomCode => $roomData) {
                $room = Room::firstOrNew(['code' => $roomCode]);
                if ($room->name !== $roomData->name) {
                    $room->name = $roomData->name;
                    $room->save();
                }
                $dataToReturnRates = [];
                foreach ($roomData->rateIterator() as $rateKey => $rateData) {
                    $dataToReturnRates[] = [
                        'net' => $rateData->net,
                        'rateType' => $rateData->rateType
                    ];
                }

                $dataToReturnRooms[] = [
                    'name' => $roomData->name,
                    'code' => $roomCode,
                    'rates' => $dataToReturnRates
                ];
            }
            $dataToReturn[] = [
                'name' => $hotelData->name,
                'code' => $hotelData->code,
                'rooms' => $dataToReturnRooms
            ];
        }
        return $dataToReturn;
    }

    /**
     * Assign a value to the path.
     *
     * @param array  &$arr Original Array of values
     * @param string $path Array as path string
     *
     * @return mixed
     */
    public function assignArrayByPath(&$arr, $path)
    {
        $keys = explode('.', $path);

        while ($key = array_shift($keys)) {
            $arr = &$arr[$key];
        }

        return $arr;
    }

    /**
     * Convert a string to a URL.
     *
     * @param string $string
     *
     * @return string
     */
    public function convertToURL($string)
    {
        return preg_replace('/[^A-Za-z0-9\-]/', '', str_replace(' ', '-', strtolower($string)));
    }

    /**
     * Add these views to the packages.
     *
     * @param string $dir
     */
    public function addToPackages($dir)
    {
        $files = glob($dir.'/*');

        $packageViews = Config::get('sitec.package-menus');

        if (is_null($packageViews)) {
            $packageViews = [];
        }

        foreach ($files as $view) {
            array_push($packageViews, $view);
        }

        return Config::set('sitec.package-menus', $packageViews);
    }

    /**
     * Edit button.
     *
     * @param string $type
     * @param int    $id
     *
     * @return string
     */
    public function editBtn($type = null, $id = null)
    {
        if (Gate::allows('sitec', Auth::user())) {
            if (!is_null($id)) {
                return '<a href="'.url('sitec/'.$type.'/'.$id.'/edit').'" class="btn btn-xs btn-secondary float-right"><span class="fa fa-pencil"></span> Edit</a>';
            } else {
                return '<a href="'.url('sitec/'.$type).'" class="btn btn-xs btn-secondary float-right"><span class="fa fa-pencil"></span> Edit</a>';
            }
        }

        return '';
    }

    /**
     * Rollback URL.
     *
     * @param obj $object
     *
     * @return string
     */
    public function rollbackUrl($object)
    {
        $class = str_replace('\\', '_', get_class($object));

        return url('sitec/rollback/'.$class.'/'.$object->id);
    }

    /**
     * Get version from the changelog.
     *
     * @return string
     */
    public function version()
    {
        $changelog = @file_get_contents(__DIR__.'/../../changelog.md');

        if (!$changelog) {
            return 'unknown version';
        }

        $matches = strstr($changelog, '## [');
        $until = strpos($matches, '-');

        return str_replace(']', '', substr($matches, 5, $until - 5));
    }
}

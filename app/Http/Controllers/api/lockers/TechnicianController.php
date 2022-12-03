<?php

namespace App\Http\Controllers\api\lockers;

use App\Http\Controllers\Controller;
use App\Models\Locker;
use App\Models\TechnicianAccess;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Carbon;

class TechnicianController extends Controller
{
    private int $changeDayIntValue;

    public function __construct() {
        $this->changeDayIntValue = intval(env('GLOBAL_TEC_CH_DAY', '01'));
    }

    private function getLastChangeDay()
    {
        $lastChangeDay = Carbon::today()->subDays($this->changeDayIntValue - 1);
        $lastChangeDay->day = $this->changeDayIntValue;
        return $lastChangeDay;
    }

    private function getGlobalTechnitian()
    {
        $lastChangeDay = $this->getLastChangeDay();

        return ['id' => 0,
            'usuario' => env('GLOBAL_TEC_USER', ''),
            'senha' => env('GLOBAL_TEC_KEY_PREFIX', '') .
                sprintf("%02d%02d%02d", $this->changeDayIntValue, $lastChangeDay->month, $lastChangeDay->year % 100),
            'deleted_at' => null,
        ];
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function allTechnician(Request $request, string $codigo_armario)
    {
        /** @var Locker $locker */
        $locker = $request->get("lockerModel");
        $includeTrashed = $request->query->get("deleted_registers", "false");
        $lastSyncAt = $request->query->get("last_sync_at");
        $globalTechnicians = [];

        $techniciansQuery = TechnicianAccess::query();

        if (strcasecmp($includeTrashed, "true") === 0) {
            $techniciansQuery->withTrashed();
        }

        if ($lastSyncAt != null) {
            $this->validate($request, ['last_sync_at' => 'required|date']);
            $lastSyncAtUtc = Carbon::parse($lastSyncAt);
            $lastSyncAtServerTz = $lastSyncAtUtc->setTimezone(Carbon::now()->getTimezone())
                ->toDateTimeString();
            $techniciansQuery->where('technician_accesses.updated_at',
                                     '>=',
                                     $lastSyncAtServerTz);

            $lastChangeDay = $this->getLastChangeDay();
            if ($lastChangeDay->greaterThan($lastSyncAtUtc)) {
                $globalTechnicians[] = $this->getGlobalTechnitian();
            }
        } else {
            $globalTechnicians[] = $this->getGlobalTechnitian();
        }

        $selectArgs = ['technician_accesses.id as id',
            'technician_accesses.login as usuario',
            'technician_accesses.password as senha',
            'technician_accesses.updated_at',
            'technician_accesses.deleted_at',
        ];

        $technicians = $techniciansQuery->get($selectArgs)->toArray();
        return new Response(array_merge($globalTechnicians, $technicians), 200);
    }
}

<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\MaintenanceRequest;
use App\Http\Resources\Admin\Maintenance\indexResource;
use App\Http\Resources\Admin\Maintenance\MaintenanceResource;
use App\Models\Maintenance;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class MaintenanceController extends Controller
{
    public function index()
    {
        $Maintenance_cards = Maintenance::latest()->get();
        return response()->json(indexResource::collection($Maintenance_cards));
    }
    public function update(MaintenanceRequest $request, maintenance $maintenance)
    {
        // $Maintenance_card= Maintenance::where('status','pending');
        try {
            DB::beginTransaction();
            if ($maintenance->status != 'pending')
                abort(404);
            $data = $request->validated();
            $maintenance->appointment_dates()->create($data);
            $maintenance->status = 'waiting';
            $maintenance->save();
            DB::commit();
            return success('updated successfully');
        } catch (\Exception $ex) {
            DB::rollBack();
            return failure('some things went wrongs', 450);
        }
    }

    public function addPrice(maintenance $maintenance, Request $request)
    {
        $request->validate([
            'price' => 'required|numeric'
        ]);

        if ($maintenance->status != 'under proccessing')
            abort('404');

        $maintenance->price = $request->price;
        $maintenance->save();
        return success('added price successfully');
    }
}

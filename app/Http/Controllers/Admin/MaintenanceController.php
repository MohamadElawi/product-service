<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\MaintenanceRequest;
use App\Http\Resources\Admin\Maintenance\indexResource;
use App\Http\Resources\Admin\Maintenance\MaintenanceResource;
use App\Models\Maintenance;
use App\Models\MaintenanceTime;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class MaintenanceController extends Controller
{
    public function index()
    {
        $Maintenance_cards = Maintenance::latest()->get();
        return response()->json(indexResource::collection($Maintenance_cards));
    }



    public function show(Maintenance $maintenance){
        return response()->json(MaintenanceResource::make($maintenance));
    }


    public function update(MaintenanceRequest $request, maintenance $maintenance)
    {
        // $Maintenance_card= Maintenance::where('status','pending');
        try {
            DB::beginTransaction();
            if ($maintenance->status != 'pending')
                abort(404);
            $data = $request->validated();
            foreach($data as $value){
                MaintenanceTime::create([
                    'maintenance_id'=>$maintenance->id ,
                    'date' => $value
                ]);
            }

            $maintenance->status = 'waiting';
            $maintenance->save();
            DB::commit();
            return success('updated successfully');
        } catch (\Exception $ex) {
            DB::rollBack();
            // return failure('some things went wrongs', 450);
            return $ex->getMessage();
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

    public function destroy(Maintenance $maintenance){
        if (! $maintenance->status == 'pending' || !$maintenance->status == 'waiting')
            abort('404');
        $maintenance->status = 'rejected' ;
        $maintenance->save();
        return success('rejected successfully');
    }
}

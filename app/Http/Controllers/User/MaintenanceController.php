<?php

namespace App\Http\Controllers\User;
// use App\Http\Controllers\User\MaintenanceRequest;
use App\Http\Controllers\Controller;
use App\Http\Requests\User\MaintenanceRequest;
use App\Http\Resources\User\MaintenanceResource;
use App\Models\Maintenance;
use App\Models\MaintenanceTime;
use Illuminate\Contracts\Foundation\MaintenanceMode;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class MaintenanceController extends Controller
{
    public function createCard($service , MaintenanceRequest $request){
            $user =auth()->user();
           $maintenance_card = Maintenance::create([
            'user_id' =>$user->id,
            'service_id' => $service,
            'description' => $request->description,
            'location' => $request->location,
            'street'=> $request->street,
            'area'=> $request->area,
        ]);
        return success('created successfully');
    }
    public function update(MaintenanceRequest $request, maintenance $maintenance)
    {
        $user = auth()->user();
        $maintenance_card = Maintenance::where('id',$maintenance->id)->where('user_id',$user->id)->where('status','pending')->firstOrFail();
        $data =$request->validated();

        // $maintenance->update( [
        //     'description' => $request->description,
        //     'location' => $request->location,
        //     'street'=> $request->street,
        //     'area'=> $request->area,
        //     ]
        // );

        $maintenance_card->update($data);
        return success('updated successfully');
    }


    public function index(){
        $user= auth()->user();
        $maintenance_cards= Maintenance::where("user_id",$user->id)->latest()->get();
        return response()->json(MaintenanceResource::collection($maintenance_cards));
    }
    public function delete (maintenance $maintenance){
        $user= auth()->user();
        $maintenance_card = Maintenance::where('id',$maintenance->id)->where('user_id',$user->id)->where('status','pending')->firstOrFail();
        $maintenance_card->delete();
        return success('deleted successfully');
    }

    public function chooseDate(Maintenance $maintenance ,MaintenanceTime $maintenanceTime ){
        if($maintenance->status != 'waiting')
            abort(404);

        if($maintenanceTime->maintenance_id == $maintenance->id)
            abort(404);

        $maintenance->appointment_at = $maintenanceTime->date ;
        $maintenance->status = 'under proccessing';
        $maintenance->save();
        DB::table('maintenance_times')->where('maintenance_id' ,$maintenance->id)->delete();
        return success('done');
    }

}

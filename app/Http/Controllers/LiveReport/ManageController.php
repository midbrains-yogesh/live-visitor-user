<?php

namespace App\Http\Controllers\LiveReport;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use DB;

class ManageController extends Controller
{
    public function livestore(Request $request)
    {
        try{
            date_default_timezone_set("Asia/Calcutta");
            $check_user = (!empty($request['user_id']))? DB::table('users')->where('id',$request['user_id'])->count():0;

            $check_visitor = DB::table('manages')->where(
                function ($query) use ($request){
                    $query->where('user_ip',request()->ip())
                            ->orWhere('user_id',$request['user_id']);
                        })->count();
            if($check_visitor>0){
                $data = [
                    'user_ip'       => request()->ip(),
                    'is_active'     => '1',
                    'is_register'   => ($check_user>0)?'1':'0',
                    'user_id'       => $request['user_id'],
                    'updated_at'    => now()->format("Y-m-d H:i:s"),
                ];
                DB::table('manages')->where(
                    function ($query) use ($request){
                        $query->where('user_ip',request()->ip())
                                ->orWhere('user_id',$request['user_id']);
                            })->update($data);
            }else{
                $data = [
                    'user_ip'       => request()->ip(),
                    'is_active'     => '1',
                    'is_register'   => ($check_user>0)?'1':'0',
                    'user_id'       => $request['user_id'],
                    'created_at'    => now()->format("Y-m-d H:i:s"),
                    'updated_at'    => now()->format("Y-m-d H:i:s"),
                ];
                DB::table('manages')->insert($data);
            }
            return response()->json(['status'=>true],200);
        } catch (\Exception $e) {
            return response()->json(['status'=>false],200);
        }
    }
    public function getusers()
    {
        $res['visitor_live']    = DB::table('manages')->where('is_active','1')->where('is_register','!=','1')->count();
        $res['user_live']       = DB::table('manages')->where('is_active','1')->where('is_register','1')->count();

        return $res;
    }
}

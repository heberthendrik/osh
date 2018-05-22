<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Notification;
use App\Models\User;

use Illuminate\Support\Facades\Auth;

class NotificationController extends Controller
{
    public function postStatus($id)
    {
        $notif = Notification::find($id);
        $data['read'] = 1;

        if ($notif->update($data)) {
            return redirect($notif->link);
        }
    }

    public static function postNotification($id_master, $roles, $data2)
    {
        $getReceiver = User::where('roles', $roles)->get();

        foreach($getReceiver as $gr){
            $lastResult = Notification::distinct()->where('id','LIKE', $id_master.'%')->count();
            $data3['id'] = $id_master .'-'. ($lastResult+1);
            $data3['sender'] = Auth::user()->id;
            $data3['sender_name'] = Auth::user()->name;
            $data3['receiver'] = $gr->id;
            $data3['receiver_name'] = $gr->name;
            $data3['read'] = '0';
            $data3['link'] = 'result/summary/'.$id_master;

            $data = array_merge($data3, $data2);

            $result = new Notification($data);
            $result->save();
        }

        return redirect()->back();
    }
}

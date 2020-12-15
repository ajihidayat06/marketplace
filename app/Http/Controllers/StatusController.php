<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Status;

class StatusController extends Controller
{
    //
    public function index(){
        $status = Status::all();
        return view('admin.status', [
            'status' => $status
        ]);
    }

    public function tambah_status(Request $request){
        $this->validate($request,[
            'status_value' => 'required|string',
        ]);

        $status = new Status;
        $status->status_value = $request->status_value;
        $status->save();
        return redirect()->back();
    }

    public function edit_status(Request $request){
        $this->validate($request,[
            'edit_status_value' => 'required|string',
        ]);

        $status = Status::where('id', $request->id_status)->firstOrFail();
        $status->status_value = $request->edit_status_value;
        $status->save();
        return redirect()->back();
    }

    public function hapus_status(Request $request){
        return $request;
    }
}

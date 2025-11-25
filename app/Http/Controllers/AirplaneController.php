<?php

namespace App\Http\Controllers;

use App\Models\AirPlane;
use Illuminate\Http\Request;

class AirplaneController extends Controller
{
    //

    public function index()
    {
        $batas = 5;
        $datas = AirPlane::paginate($batas, ['*'], 'halaman');
        return view('admin.airplane')->with('datas', $datas);
    }

    public function form(Request $request)
    {
        if ($request->has('id')) {
            $datas = AirPlane::find($request->id);
            return view('admin.airplane_form')->with('datas', $datas);
        }
        return view('admin.airplane_form');
    }

    public function storeUpdate(Request $request)
    {
        $request->validate([
            'air_plane_name' => 'required',
        ]);


        switch ($request->submit) {
            case 'Create':
                $AirPlane = new AirPlane;
                $AirPlane->air_plane_name = $request->air_plane_name;
                $AirPlane->save();
                break;
            case 'Update':
                $AirPlane = AirPlane::find($request->air_plane_id);
                $AirPlane->air_plane_name = $request->air_plane_name;
                $AirPlane->save();
                break;
            default:
                # code...
                break;
        }

        $request->session()->flash('success', 'Form submitted successfully!');

        // Redirect to another URL
        return redirect()->route('AirplaneList');

        return redirect()->back()->withInput();
    }

    public function delete(Request $request)
    {

        $request->validate([
            'id' => 'required',
        ]);
        $id = $request->id;

        try {
            $airplanesWithoutSch = AirPlane::where('air_plane_id', $id)->doesntHave('sch')->first();
            if (!empty($airplanesWithoutSch)) {
                $AirPlane = AirPlane::find($id);
                $AirPlane->delete();
                $request->session()->flash('success', 'Delete successfully!');
                // Redirect to another URL
                return redirect()->route('AirplaneList');
            }

            return redirect()->back()->withErrors(['error' => 'Airplane has been used to schedule']);
        } catch (\Throwable $th) {
            //throw $th;
        }


        return redirect()->back()->withErrors(['error' => 'Delete Failed']);
    }
}

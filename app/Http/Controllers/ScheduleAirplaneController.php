<?php

namespace App\Http\Controllers;

use App\Models\AirPlane;
use App\Models\SchAirPlane;
use Illuminate\Http\Request;
use stdClass;

class ScheduleAirplaneController extends Controller
{
    public function index()
    {
        $batas = 5;
        $datas = SchAirPlane::with('air_plane')->paginate($batas, ['*'], 'halaman');
        return view('admin.schairplane')->with('datas', $datas);
    }


    public function form(Request $request)
    {
        $datas = new stdClass();
        if ($request->has('id')) {
            $datas = SchAirPlane::find($request->id);
        }
        $datas->airPlaneData = AirPlane::all();
        return view('admin.schairplane_form')->with('datas', $datas);
    }

    public function storeUpdate(Request $request)
    {
        $request->validate([
            'air_plane_id' => 'required',
            'schedule' => 'required',
            'sch_price' => 'required',
        ]);


        switch ($request->submit) {
            case 'Create':
                $SchAirPlane = new SchAirPlane;
                $SchAirPlane->air_plane_id = $request->air_plane_id;
                $SchAirPlane->schedule = $request->schedule;
                $SchAirPlane->sch_price = $request->sch_price;
                $SchAirPlane->save();
                break;
            case 'Update':
                $SchAirPlane = SchAirPlane::find($request->sch_air_plane_id);
                $SchAirPlane->air_plane_id = $request->air_plane_id;
                $SchAirPlane->schedule = $request->schedule;
                $SchAirPlane->sch_price = $request->sch_price;
                $SchAirPlane->save();
                break;
            default:
                # code...
                break;
        }

        $request->session()->flash('success', 'Form submitted successfully!');

        // Redirect to another URL
        return redirect()->route('SchplaneList');

        return redirect()->back()->withInput();
    }

    public function delete(Request $request)
    {

        $request->validate([
            'id' => 'required',
        ]);
        $id = $request->id;

        $SchAirPlane = SchAirPlane::find($id);
        $SchAirPlane->delete();
        $request->session()->flash('success', 'Delete successfully!');
        // Redirect to another URL
        return redirect()->route('SchplaneList');


        return redirect()->back()->withErrors(['error' => 'Delete Failed']);
    }
}

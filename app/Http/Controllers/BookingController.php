<?php

namespace App\Http\Controllers;

use App\Models\Booking;
use App\Models\Payment;
use App\Models\SchAirPlane;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class BookingController extends Controller
{

    public function index()
    {
        $batas = 5;
        $datas = Booking::with(['sch_air_plane.air_plane', 'payment', 'user_registered'])->whereHas('sch_air_plane.air_plane', function ($query) {
            $query->whereNull('deleted_at');
        })->whereHas('user_registered', function ($query) {
            $query->whereNull('deleted_at');
        })->paginate($batas, ['*'], 'halaman');
        return view('admin.booking')->with('datas', $datas);
    }

    public function booking_customer_form(Request $request)
    {
        if ($request->has('id')) {
            $id = $request->id;
            $datas = SchAirPlane::where('sch_air_plane_id', $id)->with('air_plane')->first();
            if (!empty($datas)) {
                return view('booking_customer_form')->with('datas', $datas);
            }
            return redirect()->route('home.php');
        }

        return redirect()->route('home.php');
    }

    public function processBooking(Request $request)
    {
        $request->validate([
            'sch_airplane_id' => 'required',
            'id_card' => 'required',
            'name' => 'required',
            'id_card_upload' => 'required|file|mimes:jpeg,png,pdf|max:2048',
            'upload_proof' => 'required|file|mimes:jpeg,png,pdf|max:2048',
        ]);

        $id_card_upload = null;
        $upload_proof = null;
        if ($request->file('id_card_upload')) {

            $id_card_upload =  $request->file('id_card_upload')->store('', 'public');
        }

        if ($request->file('upload_proof')) {

            $upload_proof =  $request->file('upload_proof')->store('', 'public');
        }

        DB::beginTransaction();
        try {
            $Booking = new Booking();
            $Booking->sch_airplane_id = $request->sch_airplane_id;
            $Booking->id_card = $request->id_card;
            $Booking->name = $request->name;
            $Booking->id_card_upload = $id_card_upload;
            $Booking->user_id = Auth::id();
            $Booking->save();

            $Payment = new Payment();
            $Payment->booking_id = $Booking->booking_id;
            $Payment->user_id = 0;
            $Payment->upload_proof = $upload_proof;
            $Payment->status = 'Booking';
            $Payment->save();

            DB::commit();
            $request->session()->flash('success', 'Form submitted successfully!');

            // Redirect to another URL
            return redirect()->route('home.php');
        } catch (\Throwable $th) {
            DB::rollBack();
        }



        return redirect()->back()->withInput();
    }

    public function processCancel(Request $request)
    {

        $request->validate([
            'id' => 'required'
        ]);

        $Payment =  Payment::where('booking_id', $request->id)->first();

        if (!empty($Payment)) {

            try {
                $PaymentUpdate = Payment::find($Payment->payment_id);
                $PaymentUpdate->status = 'Cancel';
                $PaymentUpdate->user_id = Auth::id();
                $PaymentUpdate->save();


                // Redirect to another URL
                if (Auth::user()->type == 'admin') {
                    $request->session()->flash('success', 'Payment Cancel successfully!');
                    return redirect()->route('BookingList');
                } else {
                    $request->session()->flash('success', 'Booking Cancel successfully!');
                    return redirect()->route('home.php');
                }
            } catch (\Throwable $th) {
            }
        }

        return redirect()->back()->withErrors(['error' => 'Payment Cancel failed']);
    }

    public function processAccept(Request $request)
    {
        $request->validate([
            'id' => 'required'
        ]);

        $Payment =  Payment::where('booking_id', $request->id)->first();
        if (!empty($Payment)) {
            try {
                $PaymentUpdate = Payment::find($Payment->payment_id);
                $PaymentUpdate->status = 'Payment Accepted';
                $PaymentUpdate->user_id = Auth::id();
                $PaymentUpdate->save();

                $request->session()->flash('success', 'Payment Accepted successfully!');

                // Redirect to another URL
                return redirect()->route('BookingList');
            } catch (\Throwable $th) {
                //throw $th;
            }
        }

        return redirect()->back()->withErrors(['error' => 'Accept failed']);
    }

    public function processReject(Request $request)
    {
        $request->validate([
            'id' => 'required'
        ]);

        $Payment =  Payment::where('booking_id', $request->id)->first();
        if (!empty($Payment)) {
            try {
                $PaymentUpdate = Payment::find($Payment->payment_id);
                $PaymentUpdate->status = 'Payment Rejected';
                $PaymentUpdate->user_id = Auth::id();
                $PaymentUpdate->save();

                $request->session()->flash('success', 'Payment Rejected successfully!');

                // Redirect to another URL
                return redirect()->route('BookingList');
            } catch (\Throwable $th) {
                //throw $th;
            }
        }

        return redirect()->back()->withErrors(['error' => 'Reject failed']);
    }

    public function historyCustomer()
    {
        $batas = 5;
        $datas = Booking::where('user_id', Auth::id())->whereHas('sch_air_plane.air_plane', function ($query) {
            $query->whereNull('deleted_at');
        })->whereHas('user_registered', function ($query) {
            $query->whereNull('deleted_at');
        })->with(['sch_air_plane.air_plane', 'payment', 'user_registered'])->paginate($batas, ['*'], 'halaman');
        return view('historyCustomer')->with('datas', $datas);
    }
}

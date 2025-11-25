<?php

namespace App\Http\Controllers;

use stdClass;
use Carbon\Carbon;
use App\Models\User;
use App\Models\SchAirPlane;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{

    public function index(Request $request)
    {
        if (Auth::user() && Auth::user()->type == 'admin') {
            return redirect('/booking.php');
        }
        $batas = 5;
        $datas = SchAirPlane::with('air_plane')->where('schedule', '>=', Carbon::now()->addHours(3));
        if ($request->has('airline')  && !empty($request->airline)) {
            $datas = $datas->whereHas('air_plane', function ($q)  use ($request) {
                $q->where('air_plane_name', $request->airline);
            });
        }

        if ($request->has('schedule')  && !empty($request->schedule)) {
            $datas = $datas->where('schedule', '>=', $request->schedule . ' 00:00:00');
        }

        $datas = $datas->paginate($batas, ['*'], 'halaman');
        return view('home')->with('datas', $datas);
    }

    public function register(Request $request)
    {
        $redirect = $request->redirect;
        $datas = ['redirect' => $redirect];
        return view('register')->with('datas', $datas);
    }

    public function admin()
    {
        if (Auth::user() && (Auth::user()->type == 'admin' || Auth::user()->type == 'customer')) {
            return redirect('/booking.php');
        }
        return view('admin');
    }

    public function adminLogin(Request $request)
    {
        $request->validate([
            'username' => 'required|string|max:255',
            'password' => 'required|string|min:6',
        ]);

        $d = User::where('username', $request->username)->first();

        if (!empty($d)) {
            $pwd = md5($request->password);

            if ($pwd == $d->user_password) {
                Auth::login($d);
                if ($d->type == 'admin') {
                    return redirect('/booking.php')->with('success', 'Form submitted successfully!');
                }
                return redirect('/')->with('success', 'Form submitted successfully!');
            }
        }

        return redirect()->back()->withErrors(['password' => 'Incorrect password']);
    }

    public function logout(Request $request)
    {
        $x = Auth::user();
        Auth::logout();

        // Invalidate the session
        $request->session()->invalidate();
        if ($x && $x->type == 'admin') {
            return redirect('/admin.php');
        }
        return redirect('/');
    }

    public function store(Request $request)
    {
        $redirect = $request->redirect;
        $request->validate([
            'user_email' => 'required',
            'user_mobile' => 'required',
            'name' => 'required|string|min:5',
            'username' => ['required', 'string', 'min:5', 'regex:/^[^\s]+$/', 'unique:user,username'],
            'user_password' => 'required|string|min:5|max:255',
        ]);

        $User = new User();
        $User->user_email = $request->user_email;
        $User->user_mobile = $request->user_mobile;
        $User->name = $request->name;
        $User->username = $request->username;
        $User->user_password = md5($request->user_password);
        $User->type = 'customer';
        $User->save();
        $request->session()->flash('success', 'User Created');

        $d = User::where('username', $request->username)->first();
        if (!empty($d)) {
            $pwd = md5($request->user_password);

            if ($pwd == $d->user_password) {
                Auth::login($d);
            }
        }

        if (!empty($redirect)) {
            return redirect($redirect);
        }

        return redirect('/');
    }

    public function changePassword()
    {
        return view('changePassword');
    }

    public function UpdatePassword(Request $request)
    {
        $request->validate([
            'current_password' => 'required|string|min:5|max:255',
            'new_password' => 'required|string|min:5|confirmed|max:255',
        ]);

        $User = Auth::user();
        if ($User->user_password == md5($request->current_password)) {
            $UserData = User::find(Auth::id());
            $UserData->user_password = md5($request->new_password);
            $UserData->save();
            $request->session()->flash('success', 'Password updated successfully!');

            // Redirect to another URL
            return redirect()->route('home.php');
        } else {
            return redirect()->back()->withErrors(['password' => 'Incorrect password']);
        }

        return redirect()->back()->withInput();
    }

    public function userView()
    {
        $batas = 5;
        $datas = User::paginate($batas, ['*'], 'halaman');
        return view('admin.user')->with('datas', $datas);
    }

    public function form(Request $request)
    {
        $datas = new stdClass();
        if ($request->has('id')) {
            $datas = User::find($request->id);
        }
        $datas->typeUser = ['admin', 'customer'];

        return view('admin.user_form')->with('datas', $datas);
    }

    public function storeUpdate(Request $request)
    {

        switch ($request->submit) {
            case 'Create':
                $request->validate([
                    'user_email' => 'required|email',
                    'name' => 'required|string|min:5',
                    'username' => ['required', 'string', 'min:5', 'regex:/^[^\s]+$/', 'unique:user,username'],
                    'user_mobile' => 'required',
                    'user_password' => 'required|string|min:5|max:255',
                    'type' => 'required',
                ]);

                $dataModel = new User();
                $dataModel->user_email = $request->user_email;
                $dataModel->name = $request->name;
                $dataModel->username = $request->username;
                $dataModel->user_mobile = $request->user_mobile;
                $dataModel->user_password = $request->user_password;
                $dataModel->type = $request->type;
                $dataModel->save();
                break;
            case 'Update':
                $request->validate([
                    'user_email' => 'required|email',
                    'name' => 'required|string|min:5',
                    'username' => ['required', 'string', 'min:5', 'regex:/^[^\s]+$/', 'unique:user,username,' . $request->user_id . ',user_id'],
                    'user_mobile' => 'required',
                    'user_password' => 'nullable|string|min:5|max:255',
                    'type' => 'required',
                ]);

                $dataModel = User::find($request->user_id);
                $dataModel->user_email = $request->user_email;
                $dataModel->name = $request->name;
                $dataModel->username = $request->username;
                $dataModel->user_mobile = $request->user_mobile;
                if ($request->has('user_password') && !empty($request->user_password)) {
                    $dataModel->user_password = $request->user_password;
                }
                $dataModel->type = $request->type;
                $dataModel->save();
                break;
            default:
                # code...
                break;
        }

        $request->session()->flash('success', 'Form submitted successfully!');

        // Redirect to another URL
        return redirect()->route('UserList');

        return redirect()->back()->withInput();
    }

    public function delete(Request $request)
    {

        $request->validate([
            'id' => 'required',
        ]);
        $id = $request->id;

        $SchAirPlane = User::find($id);
        $SchAirPlane->delete();
        $request->session()->flash('success', 'Delete successfully!');
        // Redirect to another URL
        return redirect()->route('UserList');


        return redirect()->back()->withErrors(['error' => 'Delete Failed']);
    }
}

<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\UserDetail;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AdminController extends Controller
{
    function index() {
        $user = User::where('id',Auth::user()->id)->with('UserDetail')->first();
        return view('admin.pages.dashboard',compact('user'));
    }
    function profile() {
        $user = User::where('id',Auth::user()->id)->with('UserDetail')->first();
        return view('admin.pages.profile',compact('user'));
    }

    function editProfile(Request $request) {
        try {
            $user = User::where('id',Auth::user()->id)->first();
            $user->name = $request->name;
            $user->email = $request->email;
            $user->save();

            $userDetail = UserDetail::where('user_id',Auth::user()->id)->first();
            $userDetail->phone = $request->phone;
            $userDetail->address = $request->address;
            if($request->hasFile('file')){
                $userDetail ->profile_photo = 'innerjoy'.time().'.'.$request->file->extension();
                $request->file->move(public_path('profile'), 'innerjoy'.time().'.'.$request->file->extension());
            }
            $userDetail->save();
            
            return response()->json(['status' => 'Berhasil Ubah Profil']);
        } catch (\Throwable $th) {
            return response()->json(['status' => $th->getMessage()]);
        }
    }

    function indexAdmin() {
        $data = User::all();
        $user = User::where('id',Auth::user()->id)->with('UserDetail')->first();
        return view('admin.pages.admin',compact('data','user'));
    }

    function getAdmin() {
        $loggedInUserId = Auth::id();
        $data = User::where('role', 'admin')->where('id', '!=', $loggedInUserId)->get();
        return response()->json(['data' => $data]);
    }

    function storeAdmin(Request $request) {
        try {
            $user = User::where('email', $request->email)->first();
            if ($user) {
                return "Email sudah terdaftar";
            }
            $user = User::create([
                'name' => $request->name,
                'email' => $request->email,
                'password' => Hash::make($request->password),
                'remember_token' => Str::random(10),
                'role' => 'admin',
                'active' =>  $request->active,
            ]);

            $user->UserDetail()->create();

            return response()->json(['status'=>'Data Berhasil Disimpan']);
        } catch (\Throwable $th) {
            return response()->json(['status'=>'Fail cause '.$th->getMessage()]);
        }
    }

    function showAdmin(string $id) {
        $user = User::find($id);
        if (!$user) {
            return response()->json(['error' => 'Data not found'], 404);
        }
        return response()->json(['data' => $user]);
    }

    function updateAdmin(Request $request, string $id) {
        try {
            $user = User::findOrFail($id);

            $user->update([
                'name' => $request->name,
                'email' => $request->email,
                'active' =>  $request->active,
            ]);

            $data = User::where('id', $user->id)->get();

            return response()->json(['status'=>'Data Berhasil Diupdate']);
        } catch (\Throwable $th) {
            return response()->json(['status'=>'Fail cause '.$th->getMessage()]);
        }
    }

    function destroyAdmin(string $id) {
        try {
            $user = User::findOrFail($id);
            $data = $user->UserDetail()->delete();
            $data = $user->delete();
            return response()->json(['status'=>'Berhasil Dihapus']);
        } catch (\Throwable $th) {
            return response()->json(['status'=>'Fail cause '.$th->getMessage()]);
        }
    }
}

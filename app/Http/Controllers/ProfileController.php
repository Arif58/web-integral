<?php

namespace App\Http\Controllers;

use App\Models\City;
use App\Models\Cluster;
use App\Models\Major;
use App\Models\Province;
use App\Models\University;
use App\Models\User;
use Illuminate\Http\Request;

class ProfileController extends Controller
{
    public function index()
    {
        $profile = auth()->user();
        return view('web.sections.dashboard.profile', compact('profile'));
    }

    public function edit($id)
    {
        $profile = User::findOrFail($id);
        $province = Province::pluck('name', 'id');
        $level = User::$level;
        $cluster = Cluster::pluck('name', 'id');
        return view('web.sections.dashboard.edit-profile', compact('profile', 'province', 'level', 'cluster'));
    }

    public function getCity($id)
    {
        $city = City::where('province_id', $id)->get();
        return response()->json($city);
    }

    public function update(Request $request, $id)
    {
        try {
            $request->validate([
                'fullname' => 'required',
                'username' => 'unique:users,username,' . $id,
                'phone' => 'required',
                'level' => 'required',
                'institution' => 'required',
                'province' => 'required',
                'city' => 'required',
                'interest' => 'required',
            ]);
    
            $profile = User::findOrFail($id);
    
            $profile->update([
                'fullname' => $request->fullname,
                'username' => $request->username,
                // 'email' => $request->email,
                'phone' => $request->phone,
                'level' => $request->level,
                'institution' => $request->institution,
                'city_id' => $request->city,
                'interest' => $request->interest,
            
            ]);
            return redirect('/profil-saya')->with(['status'=>'success', 'message' => 'Profil berhasil diperbarui.']);
        } catch (\Illuminate\Validation\ValidationException $e) {
            return redirect()->back()->withErrors($e->validator)->withInput();
        } catch (\Exception $e) {
            return redirect()->back()->with(['status' => 'error', 'message' => 'Terjadi kesalahan: ' . $e->getMessage()])->withInput();
        }
    }

    public function editMajor($id)
    {
        $profile = User::findOrFail($id);
        $university = University::pluck('name', 'id');
        return view('web.sections.dashboard.edit-major', compact('profile', 'university'));
    }

    public function getMajor($id)
    {
        $major = Major::where('university_id', $id)->orderBy('name', 'asc')->get();
        return response()->json($major);
    }

    public function updateMajor(Request $request, $id)
    {
        try {
            $request->validate([
                'first_university' => 'required',
                'second_university' => 'required',
                'first_major' => 'required',
                'second_major' => 'required',
            ]);
            $profile = User::findOrFail($id);
    
            $profile->update([
                'first_major' => $request->first_major,
                'second_major' => $request->second_major,
            ]);
    
            return redirect('/profil-saya')->with(['status' => 'success', 'message' => 'Program Studi berhasil diperbarui.']);
        } catch (\Illuminate\Validation\ValidationException $e) {
            return redirect()->back()->withErrors($e->validator)->withInput();
        } catch (\Exception $e) {
            return redirect()->back()->with(['status' => 'error', 'message' => 'Terjadi kesalahan: ' . $e->getMessage()])->withInput();
        }
    }

    public function getCompleteProfile()
    {
        $profile = auth()->user();
        if ($profile->is_completed) {
            return redirect('/dashboard')->with(['status' => 'error', 'message' => 'Profil Anda sudah lengkap.']);
        }
        $province = Province::pluck('name', 'id');
        $level = User::$level;
        $cluster = Cluster::pluck('name', 'id');
        $university = University::pluck('name', 'id');
        return view('web.sections.dashboard.complete-profile', compact('profile', 'province', 'level', 'cluster', 'university'));
    }

    public function completeProfile(Request $request, $id)
    {
        try {
            $request->validate([
                'fullname' => 'required',
                'phone' => 'required|min:12',
                'level' => 'required',
                'institution' => 'required',
                'province' => 'required',
                'city' => 'required',
                'interest' => 'required',
                'first_university' => 'required',
                'first_major' => 'required',
                'second_university' => 'required',
                'second_major' => 'required',
            ]);
    
            $profile = User::findOrFail($id);
    
            $profile->update([
                'fullname' => $request->fullname,
                'phone' => $request->phone,
                'level' => $request->level,
                'institution' => $request->institution,
                'city_id' => $request->city,
                'interest' => $request->interest,
                'first_major' => $request->first_major,
                'second_major' => $request->second_major,
                'is_completed' => true,
            ]);
    
            return redirect('/dashboard')->with(['status' => 'success', 'message' => 'Profil berhasil diperbarui.']);
        } catch (\Illuminate\Validation\ValidationException $e) {
            return redirect()->back()->withErrors($e->validator)->withInput();
        } catch (\Exception $e) {
            return redirect()->back()->with(['status' => 'error', 'message' => 'Terjadi kesalahan: ' . $e->getMessage()])->withInput();
        }

    }

}

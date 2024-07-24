<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;

class UserManagementController extends Controller
{
    public function index()
    {
        return view('web.sections.dashboard.admin.user-management');
    }

    public function getUsers()
    {
        $query = User::query();

        return DataTables::of($query)
            ->addIndexColumn()
            ->addColumn('city.name', function ($user) {
                if ($user->city == null) {
                    return '-';
                }
                return $user->city->name;
            })
            ->addColumn('action', function ($user) {
                return '
                <button class="btn btn-primary btn-lg me-2 detail-user" data-id="' . $user->id . '"><i class="fas fa-eye"></i></button>
                <button class="btn btn-lg btn-danger delete-user" data-id="' . $user->id . '"><i class="fas fa-trash"></i></button>';
            })
            ->rawColumns(['action'])
            ->make(true);
    }

    public function destroy($id)
    {
        try {
            $user = User::findOrFail($id);
            $user->delete();
            return response()->json(['status' => 'success','message' => 'User berhasil dihapus.']);
        } catch (\Exception $e) {
            return response()->json(['status' => 'error','message' => 'Terjadi kesalahan: ' . $e->getMessage()]);
        }
    }

    public function show($id)
    {
        $user = User::findOrFail($id);

        return view('web.sections.dashboard.admin.detail-user', compact('user'));
    }
}

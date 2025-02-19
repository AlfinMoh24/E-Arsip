<?php

namespace App\Http\Controllers;

use App\Models\Peminjaman;
use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{

    public function index()
    {
        $user = User::where('level', 'user')->get();
        return view('admin.users.index', [
            'users' => $user,
            'title' => 'User Peminjam'
        ]);
    }

    public function create() {}

    public function store(Request $request)
    {
        try {
            $validated = $request->validate([
                'nip' => 'required|unique:users|max:225',
                'name' => 'required|max:225',
                'jabatan' => 'required|max:225'
            ]);

            User::create($validated);

            return redirect(route('user-peminjam.index'))->with('success', 'Data Peminjam Berhasil ditambahkan!');
        } catch (\Exception $e) {
            return redirect()->back()->withInput()->withErrors($e->getMessage())->with('add_error', true);;
        }
    }

    public function show($nip)
    {
            $user = User::where('nip', $nip)->firstOrFail();
            $user_id = $user->id;
            $peminjaman = Peminjaman::where('user_id', $user_id)->get();
            // dd($peminjaman);
            return view('admin.users.show', [
                'user' => $user,
                'peminjamans' => $peminjaman
            ]);
    }


    public function update(Request $request, $id)
    {


        try {
            $user = User::findOrFail($id);
            $rules = [
                'name' => 'required|max:225',
                'jabatan' => 'required',
            ];

            if ($request->nip != $user->nip) {
                $rules['nip'] = 'required|unique:users';
            }

            $validated = $request->validate($rules);

            User::where('id', $id)->update($validated);

            return redirect('/admin/user-peminjam')->with('success', 'update berhasil!');
        } catch (\Exception $e) {
            return redirect()->back()
                ->withInput()
                ->withErrors(['user' => $e->getMessage()])
                ->with('edit_error', true)
                ->with('edit_id', $id); // Kirim ID modal yang error
        }
    }


    public function destroy($id)
    {
        User::findOrFail($id);
        User::where('id', $id)->delete();

        return redirect('/admin/user-peminjam')->with('success', 'Hapus Berhasil!');
    }
}

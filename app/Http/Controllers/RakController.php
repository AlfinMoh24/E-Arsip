<?php

namespace App\Http\Controllers;

use App\Models\rak;
use Illuminate\Http\Request;

class RakController extends Controller
{
    public function index()
    {
        return view('admin.master.rak', [
            'title' => 'Rak',
            'raks' => rak::all()
        ]);
    }


    public function store(Request $request)
    {

        try {
            $validated = $request->validate([
                'rak' => 'required|unique:raks|max:225'
            ]);

            rak::create($validated);

            return redirect('/admin/rak')->with('success', 'Tambah rak berhasil!');
        } catch (\Exception $e) {
            return redirect()->back()->withInput()->withErrors($e->getMessage())->with('add_error', true);;
        }
    }


    public function update(Request $request, string $id)
    {
        try {
            $rak = rak::findOrFail($id);
            $rule = [
                'rak' => 'required'
            ];

            if ($request->rak != $rak->rak) {
                $rule['rak'] =  'required|unique:raks';
            }

            $validated = $request->validate($rule);

            rak::where('id', $id)->update($validated);

            return redirect('/admin/rak')->with('success', 'Edit rak berhasil!');
        } catch (\Exception $e) {
            return redirect()->back()
                ->withInput()
                ->withErrors($e->getMessage())
                ->with('edit_error', true)
                ->with('edit_id', $id); // Kirim ID modal yang error
        }
    }


    public function destroy(string $id)
    {
        rak::findOrFail($id);
        rak::where('id', $id)->delete();

        return redirect('/admin/rak')->with('success', 'Hapus Berhasil!');
    }
}

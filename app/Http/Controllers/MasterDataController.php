<?php
namespace App\Http\Controllers;

use App\Models\Ruang;
use App\Models\Box;
use App\Models\Map;
use App\Models\Urut;
use App\Models\Rak;
use Illuminate\Http\Request;

class MasterDataController extends Controller
{
    public function index($type)
    {
        $models = [
            'rak' => Rak::class,
            'ruang' => Ruang::class,
            'box' => Box::class,
            'map' => Map::class,
            'urut' => Urut::class,
        ];

        if (!isset($models[$type])) {
            abort(404); // Jika tipe tidak ditemukan
        }

        $model = $models[$type];

        return view('admin.master.index', [
            'title' => ucfirst($type),
            'items' => $model::all(),
            'type' => $type,
        ]);
    }

    public function store(Request $request, $type)
    {
        $models = [
            'rak' => Rak::class,
            'ruang' => Ruang::class,
            'box' => Box::class,
            'map' => Map::class,
            'urut' => Urut::class,
        ];

        if (!isset($models[$type])) {
            abort(404); // Jika tipe tidak ditemukan
        }

        $model = $models[$type];

        try {
            $validated = $request->validate([
                $type => 'required|unique:' . $type . 's|max:225',
            ]);

            $model::create($validated);

            return redirect()->route('master.index', ['type' => $type])
                ->with('success', 'Tambah ' . ucfirst($type) . ' berhasil!');
        } catch (\Exception $e) {
            return redirect()->back()->withInput()->withErrors($e->getMessage())->with('add_error', true);
        }
    }

    public function update(Request $request, $type, $id)
    {
        $models = [
            'rak' => Rak::class,
            'ruang' => Ruang::class,
            'box' => Box::class,
            'map' => Map::class,
            'urut' => Urut::class,
        ];

        if (!isset($models[$type])) {
            abort(404); // Jika tipe tidak ditemukan
        }

        $model = $models[$type];
        try {
            $item = $model::findOrFail($id);
            $rules = [
                $type => 'required',
            ];

            if ($request->$type != $item->$type) {
                $rules[$type] = 'required|unique:' . $type . 's';
            }

            $validated = $request->validate($rules);

            $model::where('id', $id)->update($validated);

            return redirect()->route('master.index', ['type' => $type])
                ->with('success', 'Edit ' . ucfirst($type) . ' berhasil!');
        } catch (\Exception $e) {
            return redirect()->back()
                ->withInput()
                ->withErrors($e->getMessage())
                ->with('edit_error', true)
                ->with('edit_id', $id);
        }
    }

    public function destroy($type, $id)
    {
        $models = [
            'rak' => Rak::class,
            'ruang' => Ruang::class,
            'box' => Box::class,
            'map' => Map::class,
            'urut' => Urut::class,
        ];

        if (!isset($models[$type])) {
            abort(404); // Jika tipe tidak ditemukan
        }

        $model = $models[$type];
        try {
            $model::findOrFail($id);
            $model::where('id', $id)->delete();

            return redirect()->route('master.index', ['type' => $type])
                ->with('success', 'Hapus ' . ucfirst($type) . ' berhasil!');
        } catch (\Exception $e) {
            return redirect()->back()->withErrors($e->getMessage());
        }
    }
}

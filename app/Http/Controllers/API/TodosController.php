<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Todo;
use Exception;
use Illuminate\Http\Request;

class TodosController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        //
        try {
           return response()->json(
            Todo::when($request->filter, function($q, $filter){
                switch ($filter) {
                    case "belum selesai":
                        $q->where('status', '0');
                        break;
                    case "selesai":
                        $q->where('status', '1');
                        break;
                }
            })
            ->where('created_by', auth()->user()->id)
            ->where('is_deleted', 0)
            ->paginate(8));
        } catch (\Exception $e) {
            return response()->json(['success'=> false]);
        }
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //


        try {
            Todo::create([
                'task' => $request->task,
                'status' => $request->status,
                'created_at' => date('Y-m-d H:i:s'),
                'created_by' => auth()->user()->id,
            ]);
            return response()->json([
                'success' => true,
                'message' => 'Todo berhasil disimpan',
                'id' => auth()->user()->id
            ]);
        } catch (Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Todo gagal disimpan',
                'e' => $e->getMessage()
            ]);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
        return Todo::findOrFail($id);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
        return Todo::findOrFail($id);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
        try {
            Todo::find($id)->update([
                'task' => $request->task,
                'status' => $request->status,
                'updated_at' => date('Y-m-d H:i:s')
            ]);
            return response()->json([
                'success' => true,
                'message' => 'Todo berhasil diupdate',
                'r' => [$request->all(), $id]
            ]);
        } catch (Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Todo gagal disimpan',
                'e' => $e->getMessage()
            ]);
        } 
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
        $exists = Todo::where(['id' => $id, 'created_by' => auth()->user()->id])->exists();
        if ($exists) {
            try {
                Todo::find($id)->update([
                    'is_deleted' => 1,
                    'deleted_at' => date('Y-m-d H:i:s'),
                    'deleted_by' => auth()->user()->id]);

                    return response()->json([
                        'success' => true,
                        'message' => 'Todo berhasil dihapus',
                    ]);
                } catch (Exception $e) {
                    return response()->json([
                        'success' => false,
                        'message' => 'Todo gagal dihapus',
                    ]);
                }
        }
    }
}

<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Task;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class TaskController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $datas = Task::with('category')->get();

        return view('dashboard.tasks.index', compact('datas'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {

        $categories = Category::all();
        return view('dashboard.tasks.create', compact('categories'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'description' => 'required',
            'category_id' => 'required',
            'photo' => 'required|mimes:jpg,png,jpeg'
        ]);

        $data = $request->all();

        $data['photo'] = Storage::disk('public')->put('task_photos', $request->file('photo'));

        Task::query()->create($data);

        return to_route('tasks.index')->with('success', 'Berhasil tambah tasks');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $task = Task::query()->findOrFail($id);
        $categories = Category::all();
        return view('dashboard.tasks.edit', compact('task', 'categories'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $task = Task::query()->findOrFail($id);

        $data = $request->all();
        $data['photo'] = $task->photo;

        if ($request->hasFile('photo')) {
            Storage::disk('public')->delete($task->photo);
            $data['photo'] = Storage::disk('public')->put('task_photos', $request->file('photo'));
        }

        $task->update($data);

        return to_route('tasks.index')->with('success', 'Berhasil update tasks');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $task = Task::query()->findOrFail($id);
        Storage::disk('public')->delete($task->photo);
        $task->delete();

        return to_route('tasks.index')->with('success', 'Berhasil menghapus tasks');
    }
}

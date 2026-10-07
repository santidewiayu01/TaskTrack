<?php

namespace App\Http\Controllers;

use App\Models\Task;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class TaskController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        // base query limited to the authenticated user
        $query = Task::where('user_id', Auth::id());

        if ($request->status) {
            if ($request->status === 'terlambat') {
                $query->where('status', 'belum')
                      ->where('deadline', '<', now()->toDateString());
            } elseif ($request->status === 'favorit') {
                $query->where('favorite', true);
            } else {
                $query->where('status', $request->status);
            }
        }

        $tasks = $query->orderBy('deadline')->get();

        $total = Task::where('user_id', Auth::id())->count();
        $selesai = Task::where('user_id', Auth::id())
                        ->where('status', 'selesai')->count();
        $belum = $total - $selesai;
        $terlambat = Task::where('user_id', Auth::id())
                         ->where('status', 'belum')
                         ->where('deadline', '<', now()->toDateString())
                         ->count();
        $favoriteCount = Task::where('user_id', Auth::id())
                             ->where('favorite', true)
                             ->count();
        $newThisWeek = Task::where('user_id', Auth::id())
                           ->where('created_at', '>=', now()->startOfWeek())
                           ->count();

        return view('tasks.dashboard', compact('tasks','total','selesai','belum','terlambat','newThisWeek','favoriteCount'));
    }

    public function toggleFavorite(Task $task)
    {
        abort_if($task->user_id !== Auth::id(), 403);

        $task->update(['favorite' => ! $task->favorite]);

        return back();
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('tasks.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $data = $request->validate([
            'judul' => 'required|string|max:255',
            'deskripsi' => 'nullable|string',
            'deadline' => 'required|date',
        ]);

        $data['user_id'] = Auth::id();
        $data['status'] = 'belum';

        Task::create($data);

        return redirect()->route('tasks.index')->with('success', 'Tugas berhasil ditambahkan.');
    }
    /**
     * Display the specified resource.
     */
    public function show(Task $task)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Task $task)
    {
        // ensure the user owns the task
        abort_if($task->user_id !== Auth::id(), 403);

        return view('tasks.edit', compact('task'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Task $task)
    {
        abort_if($task->user_id !== Auth::id(), 403);

        // validation should permit updating only the status when that's
        // all the user changes. the previous implementation required all
        // fields to be present which meant the status-change form – which
        // only POSTed `status` – would always fail validation and silently
        // redirect back with no visible error.
        $data = $request->validate([
            'judul' => 'sometimes|required|string|max:255',
            'deskripsi' => 'sometimes|nullable|string',
            'deadline' => 'sometimes|required|date',
            'status' => 'required|in:belum,selesai',
        ]);

        $task->update($data);

        return redirect()->route('tasks.index')->with('success', 'Tugas berhasil diperbarui.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Task $task)
{
    $task->delete();
    return redirect()->route('tasks.index');
}
}

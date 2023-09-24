<?php

namespace App\Http\Controllers;

use App\Models\InertiaTest;
use Illuminate\Http\Request;
use Inertia\Inertia;

class InertiaTestController extends Controller
{
    public function index()
    {
        return Inertia::render('inertia/Index', [
            'blogs' => InertiaTest::all()
        ]);
    }

    public function show($id)
    {
        return Inertia::render('inertia/Show', [
            'id' => $id,
            'blog' => InertiaTest::findOrFail($id)
        ]);
    }

    public function create()
    {
        return Inertia::render('inertia/Create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => ['required', 'max:20'],
            'content' => ['required'],
        ]);

        $inertiaTest = new InertiaTest;
        $inertiaTest->title = $request->title;
        $inertiaTest->content = $request->content;
        $inertiaTest->save();

        return to_route('inertia.index')
        ->with([
            'message' => '登録しました。'
        ]);
    }

    public function delete($id)
    {
        $data = InertiaTest::findOrFail($id);
        $data->delete();

        return to_route('inertia.index')
        ->with([
            'message' => '削除しました。'
        ]);
    }
}

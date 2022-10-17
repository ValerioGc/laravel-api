<?php

namespace App\Http\Controllers\Admin;

use App\Category;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $categories = Category::all();
        return view('admin.categories.index', compact('categories'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.categories.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate(
            [
                'title' => 'required|max:200|min:3',
            ],
            [
                'title.required' => 'Il Titolo del post è richiesto',
                'title.max' => 'Inserisci deve essere massimo 200 caratteri',
                'title.min' => 'Il titolo deve essere di almeno 3 caratteri',
            ]
        );

        $data = $request->all();
        $categories = Category::all();

        if (!$categories->contains('title', $data['title'])) {
            $newCategory = new Category();
            $newCategory->slug = Str::slug($data['title'], '-');
            $newCategory->fill($data);
            $newCategory->save();
            return redirect()->route('admin.categories.index')->with('status', 'Categoria creata correttamente!');
        } else {
            return redirect()->route('admin.categories.index')->with('status', 'Categoria già esistente!');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Category $category)
    {
        return view('admin.categories.show', compact('category'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Category $category)
    {
        return view('admin.categories.edit', compact('category'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Category $category)
    {
        $request->validate(
            [
                'title' => 'required|max:200|min:3',
            ],
            [
                'title.required' => 'Il Titolo del post è richiesto',
                'title.max' => 'Inserisci deve essere massimo 200 caratteri',
                'title.min' => 'Il titolo deve essere di almeno 3 caratteri',
            ]
        );

        $data = $request->all();

        if ($category->title !== $data['title']) {
            $data['slug'] = Str::slug($data['title'], '-');
        }

        $category->update($data);

        return redirect()->route('admin.categories.index')->with('status', 'Categoria creata correttamente!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Category $category)
    {
        $category->delete();
        return redirect()->route('admin.categories.index')->with('status', 'Categoria cancellata');
    }
}

<?php

namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use App\Tag;

class TagController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $tags = Tag::all();
        return view('admin.tags.index', compact('tags'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $tags = Tag::all();
        return view('admin.tags.index', compact('tags'));
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
                'name' => 'required|max:20|min:2',
            ],
            [
                'name.required' => 'Il Nome del tag è richiesto',
                'name.max' => 'Inserisci deve essere massimo 20 caratteri',
                'name.min' => 'Il titolo deve essere di almeno 2 caratteri',
            ]
        );
        $data = $request->all();
        $tags = Tag::all();

        if (!$tags->contains('name', $data['name'])) {
            $newTag = new Tag();
            $newTag->slug = Str::slug($data['name'], '-');
            $newTag->fill($data);
            $newTag->save();
            return redirect()->route('admin.tags.index')->with('status', 'Tag creato correttamente!');
        } else {
            return redirect()->route('admin.tags.index')->with('status', 'Tag già esistente!');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Tag $tag)
    {
        return view('admin.tags.show', compact('tag'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Tag $tag)
    {
        return view('admin.tags.edit', compact('tag'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Tag $tag)
    {
        $request->validate(
            [
                'name' => 'required|max:20|min:2',
            ],
            [
                'title.required' => 'Il Titolo del tag è richiesto',
                'title.max' => 'Inserisci deve essere massimo 200 caratteri',
                'title.min' => 'Il titolo deve essere di almeno 2 caratteri',
            ]
        );

        $data = $request->all();

        if ($tag->name !== $data['name']) {
            $data['slug'] = Str::slug($data['name'], '-');
        }

        $tag->update($data);

        return redirect()->route('admin.tags.index')->with('status', 'Tag creato correttamente!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Tag $tag)
    {
        $tag->posts()->sync([]);
        $tag->delete();
        return redirect()->route('admin.tags.index')->with('status', 'Tag cancellato');
    }
}

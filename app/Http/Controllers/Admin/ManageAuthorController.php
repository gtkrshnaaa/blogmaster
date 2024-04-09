<?php

// app/Http/Controllers/Admin/ManageAuthorController.php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Models\Author;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rule;
use Illuminate\Routing\Controller;

class ManageAuthorController extends Controller
{
    public function index()
    {
        $authors = Author::all();
        return view('admin.authors.index', compact('authors'));
    }

    public function create()
    {
        return view('admin.authors.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:authors,email',
            'password' => 'required|string|min:6',
        ]);

        $author = new Author();
        $author->name = $request->name;
        $author->email = $request->email;
        $author->password = Hash::make($request->password);
        $author->save();

        return redirect()->route('admin.authors.index')->with('success', 'Author created successfully.');
    }

    public function edit($id)
    {
        $author = Author::findOrFail($id);
        return view('admin.authors.edit', compact('author'));
    }


    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => ['required', 'email', Rule::unique('authors')->ignore($id)],
            'password' => 'nullable|string|min:6',
        ]);

        $author = Author::findOrFail($id);
        $author->name = $request->name;
        $author->email = $request->email;

        if ($request->filled('password')) {
            $author->password = Hash::make($request->password);
        }

        $author->save();

        return redirect()->route('admin.authors.index')->with('success', 'Author updated successfully.');
    }

    public function destroy($id)
    {
        $author = Author::findOrFail($id);
        $author->delete();

        return redirect()->route('admin.authors.index')->with('success', 'Author deleted successfully.');
    }

}
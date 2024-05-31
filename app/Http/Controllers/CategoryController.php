<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use RealRashid\SweetAlert\Facades\Alert;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // select * from categories where role='category' order by name
        $categories = Category::with('user')->orderby('name')->get();
        $data = [
            "title" => "Categories",
            "categories" => $categories,
        ];

        return view('category.index', $data);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $data = [
            "title" => "Add Category",
        ];

        return view('category.form', $data);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $messages = [
            'name.required' => 'Tolong isi nama dengan benar.',
            'description.required' => 'Tolong isi description dengan benar.',
            // Define more custom messages here
        ];

        $data = $request->validate([
                'name' => 'required',
                'description' => 'required',
            ], $messages);
        try {
            $data['user_id'] = auth()->user()->id;
            Category::create($data);
            Alert::success('Sukses', 'Add data success.');
            return redirect('category');
        } catch (\Throwable $th) {
            Alert::error('Error', $th->getMessage());
            return redirect('user');
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        // select * from categories where id='$id'
        $category = Category::find($id);
        $data = [
            "title" => "Category Detail",
            "category" => $category,
        ];

        return view('category.detail', $data);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $category = Category::find($id);
        if (!$category) {
            return redirect('category')->with("errorMessage", "Data tidak ditemukan");
        }
        $data = [
            "title" => "Edit Category",
            "category" => $category,
        ];

        return view('category.form', $data);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $messages = [
            'name.required' => 'Tolong isi nama dengan benar.',
            'description.required' => 'Tolong isi description dengan benar.',
            // Define more custom messages here
        ];

        $data = $request->validate([
                'name' => 'required',
                'description' => 'required|unique:categories,description,' . $id,
            ], $messages);
        try {
                $category = Category::find($id);
                $data['user_id'] = auth()->user()->id;
                $category->update($data);
                Alert::success('Sukses', 'Update data success.');
                return redirect('category');
        } catch (\Throwable $th) {
            Alert::error('Error', $th->getMessage());
            return redirect('category');
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        try {
            $category = Category::find($id);
            $category->delete();
            Alert::success('Sukses', 'Delete data success.');
            return redirect('category');
        } catch (\Throwable $th){
            Alert::error('Error', $th->getMessage());
            return redirect('category');
        }
    }
}
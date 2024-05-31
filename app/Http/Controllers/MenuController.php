<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Menu;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use RealRashid\SweetAlert\Facades\Alert;

class MenuController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // select * from menus where role='menu' order by name
        $menus = Menu::with('user', 'category')->orderby('name')->get();
        $data = [
            "title" => "Menus",
            "menus" => $menus,
        ];

        return view('menu.index', $data);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $categories = Category::orderby('name')->get();
        $data = [
            "title" => "Add Menu",
            "categories" => $categories,
        ];

        return view('menu.form', $data);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $data = $request->validate([
                'name' => 'required',
                'description' => 'required',
                'price' => 'required|integer',
                'category_id' => 'required',
                'image' => 'required|image|mimes:jpeg,png,jpg,gif|max:1024',
        ]);

        try {
            $data['user_id'] = auth()->user()->id;
            if($request->hasFile('image')) {
                $data['image'] = $request->file('image')->store('images', 'public');
            }else{
                $data['image'] = null;
            }

            Menu::create($data);

            Alert::success('Sukses', 'Add data sukses');
            
        } catch (\Throwable $th) {
            Alert::error('Error', $th->getMessage());

        } finally{
            return redirect('menu');
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        // select * from menus where id='$id'
        $menu = Menu::find($id);
        $data = [
            "title" => "Menu Detail",
            "menu" => $menu,
        ];

        return view('menu.detail', $data);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $menu = Menu::find($id);
        if (!$menu) {
            return redirect('menu')->with("errorMessage", "Data tidak ditemukan");
        }
        
        $categories = Category::orderby('name')->get(); 
        
        $data = [
            "title" => "Edit Menu",
            "menu" => $menu,
            "categories" => $categories, 
        ];
    
        return view('menu.form', $data);
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
                'description' => 'required|unique:menus,description,' . $id,
            ], $messages);
        try {
                $menu = Menu::find($id);
                $data['user_id'] = auth()->user()->id;
                $menu->update($data);

                Alert::success('Sukses', 'Edit data sukses');
                
        } catch (\Throwable $th) {
            Alert::error('Error', $th->getMessage());
           
        } finally{
            return redirect('menu');
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        try {
            $menu = Menu::find($id);
            $menu->delete();

            Alert::success('Sukses', 'Delete data sukses');
            return redirect('menu');
            // return redirect('menu')->with("successMessage", "Delete data sukses");
        } catch (\Throwable $th){
            Alert::error('Error', $th->getMessage());
            return redirect('menu');
            // return redirect('menu')->with("errorMessage", $th->getMessage());
        }
    }
}
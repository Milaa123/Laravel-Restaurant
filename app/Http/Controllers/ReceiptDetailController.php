<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\ReceiptDetail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use RealRashid\SweetAlert\Facades\Alert;

class ReceiptDetailController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // select * from receiptDetails where role='receiptDetail' order by name
        $receiptDetails = ReceiptDetail::with('user', 'category')->orderby('name')->get();
        $data = [
            "title" => "ReceiptDetails",
            "receiptDetails" => $receiptDetails,
        ];

        return view('receiptDetail.index', $data);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $categories = Category::orderby('name')->get();
        $data = [
            "title" => "Add ReceiptDetail",
            "categories" => $categories,
        ];

        return view('receiptDetail.form', $data);
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

            ReceiptDetail::create($data);

            Alert::success('Sukses', 'Add data sukses');
            
        } catch (\Throwable $th) {
            Alert::error('Error', $th->getMessage());

        } finally{
            return redirect('receiptDetail');
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        // select * from receiptDetails where id='$id'
        $receiptDetail = ReceiptDetail::find($id);
        $data = [
            "title" => "ReceiptDetail Detail",
            "receiptDetail" => $receiptDetail,
        ];

        return view('receiptDetail.detail', $data);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $receiptDetail = ReceiptDetail::find($id);
        if (!$receiptDetail) {
            return redirect('receiptDetail')->with("errorMessage", "Data tidak ditemukan");
        }
        
        $categories = Category::orderby('name')->get(); 
        
        $data = [
            "title" => "Edit ReceiptDetail",
            "receiptDetail" => $receiptDetail,
            "categories" => $categories, 
        ];
    
        return view('receiptDetail.form', $data);
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
                'description' => 'required|unique:receiptDetails,description,' . $id,
            ], $messages);
        try {
                $receiptDetail = ReceiptDetail::find($id);
                $data['user_id'] = auth()->user()->id;
                $receiptDetail->update($data);

                Alert::success('Sukses', 'Edit data sukses');
                
        } catch (\Throwable $th) {
            Alert::error('Error', $th->getMessage());
           
        } finally{
            return redirect('receiptDetail');
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        try {
            $receiptDetail = ReceiptDetail::find($id);
            $receiptDetail->delete();

            Alert::success('Sukses', 'Delete data sukses');
            return redirect('receiptDetail');
            // return redirect('receiptDetail')->with("successMessage", "Delete data sukses");
        } catch (\Throwable $th){
            Alert::error('Error', $th->getMessage());
            return redirect('receiptDetail');
            // return redirect('receiptDetail')->with("errorMessage", $th->getMessage());
        }
    }
}
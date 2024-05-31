<?php

namespace App\Http\Controllers;

use App\Models\Menu;
use App\Models\Receipt;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use RealRashid\SweetAlert\Facades\Alert;

class ReceiptController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // select * from receipts where role='receipt' order by name
        $receipts = Receipt::with('user')->where('status', 'entry')->orderby('receipt_date','desc')->get();
        $data = [
            "title" => "Receipts",
            "receipts" => $receipts,
        ];

        return view('receipt.index', $data);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $data = [
            "title" => "Add Receipt",
        ];

        return view('receipt.form', $data);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {

        $data = $request->validate([
                'name' => 'required',
                'description' => 'required',
                'status' => 'required',
        ]);

        try {
            $data['user_id'] = auth()->user()->id;
            $data['receipt_date'] = Carbon::now();
            Receipt::create($data);
            Alert::success('Sukses', 'Add data success.');
            return redirect('receipt');
        } catch (\Throwable $th) {
            Alert::error('Error', $th->getMessage());
            return redirect('receipt');
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        // select * from receipts where id='$id'
        $receipt = Receipt::find($id);
        $data = [
            "title" => "Receipt Detail",
            "receipt" => $receipt,
        ];

        return view('receipt.detail', $data);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $receipt = Receipt::find($id);
        if (!$receipt) {
            return redirect('receipt')->with("errorMessage", "Data tidak ditemukan");
        }

        $menus = Menu::with('user', 'category')->orderby('name')->get();

        $data = [
            "title" => "Edit Receipt",
            "receipt" => $receipt,
            "menus" =>  $menus,
        ];

        return view('receipt.form', $data);
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
                'description' => 'required|unique:receipts,description,' . $id,
            ], $messages);
        try {
                $receipt = Receipt::find($id);
                $data['user_id'] = auth()->user()->id;
                $receipt->update($data);
                Alert::success('Sukses', 'Update data success.');
                return redirect('receipt');
        } catch (\Throwable $th) {
            Alert::error('Error', $th->getMessage());
            return redirect('receipt');
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        try {
            $receipt = Receipt::find($id);
            $receipt->delete();
            Alert::success('Sukses', 'Delete data success.');
            return redirect('receipt');
        } catch (\Throwable $th){
            Alert::error('Error', $th->getMessage());
            return redirect('receipt');
        }
    }
}
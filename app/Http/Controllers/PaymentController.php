<?php

namespace App\Http\Controllers;

use App\Models\Payment;
use Illuminate\Http\Request;
use RealRashid\SweetAlert\Facades\Alert;

class PaymentController extends Controller
{

    public function list()
    {
        $payments = Payment::orderBy('created_at', 'desc')->paginate(5);
        return view('admin.payments.index', compact('payments'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'account_number' => 'required',
            'account_name' => 'required',
            'type' => 'required',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        $data = $request->all();

        if ($request->hasFile('image')) {
            $imageName = uniqid() . $request->file('image')->getClientOriginalName();
            $request->image->move(public_path('images'), $imageName);
            $data['image'] = $imageName;
        }

        Payment::create($data);

        Alert::success('Payment Created', 'Payment Created Successfully!');

        return back();
    }

    public function destory($id)
    {
        Payment::destroy($id);
        Alert::success('Payment Deleted', 'Payment Deleted Successfully!');
        return back();
    }
}

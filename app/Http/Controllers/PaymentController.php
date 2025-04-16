<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PaymentController extends Controller
{
    /**
     * Handle image upload, validate, store, and redirect to /home with a success message.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function uploadApproval(Request $request)
    {
        $request->validate([
            'approval_image' => 'required | image | mimes:jpeg,png,jpg,gif | max:2048',
        ]);
        $image = $request->file('approval_image');
        $imageName = time().'_'.uniqid().'.'.$image->getClientOriginalExtension();
        $image->move(public_path('img/approvals'), $imageName);
        
        return redirect('/home')->with('success', 'Approval image uploaded successfully!');
    }
}

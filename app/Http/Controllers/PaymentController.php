<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Approval;

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
            'organiser_id' => 'required | integer',
            'requester_id' => 'required | integer',
            'status' => 'required | string',
        ]);
        $image = $request->file('approval_image');
        $imageName = time().'_'.uniqid().'.'.$image->getClientOriginalExtension();
        $image->move(public_path('img/approvals'), $imageName);

        Approval::create([
            'organiser_id' => $request->input('organiser_id'),
            'requester_id' => $request->input('requester_id'),
            'status' => $request->input('status'),
            'approval_image' => 'img/approvals/'.$imageName,
        ]);
        
        return redirect('/home')->with('success', 'Approval image uploaded successfully!');
    }

    
}

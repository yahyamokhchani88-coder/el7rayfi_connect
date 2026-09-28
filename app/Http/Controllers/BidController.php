<?php

namespace App\Http\Controllers;

use App\Models\Bid;
use Illuminate\Http\Request;
use App\Notifications\NewBidReceived;

// داخل الدالة store وبعد Bid::create

class BidController extends Controller
{
   public function store(Request $request)
{
    $request->validate([
        'job_request_id' => 'required|exists:job_requests,id',
        'price' => 'required|numeric|min:1',
        'message' => 'nullable|string|max:255',
    ]);

    // 1. هنا سمينا المتغير $bid
    $bid = \App\Models\Bid::create([
        'job_request_id' => $request->job_request_id,
        'artisan_id' => auth()->id(),
        'price' => $request->price,
        'message' => $request->message,
        'status' => 'pending',
    ]);

    // 2. كنجبدو الطلب والزبون لي حطو
    $jobRequest = \App\Models\JobRequest::find($request->job_request_id);
    $client = $jobRequest->client;

    // 3. كنصيفطو الإشعار ونستعملو نفس المتغير $bid
    $client->notify(new \App\Notifications\NewBidReceived($bid));

    return back()->with('success', 'تم إرسال عرضك بنجاح!');
}

    // الزبون يقبل واحد العرض
    public function accept($id)
    {
        $bid = Bid::with('jobRequest')->findOrFail($id);
        
        // تأكد بلي الزبون هو مول الطلب
        if ($bid->jobRequest->client_id !== auth()->id()) {
            abort(403);
        }

        // قبول هاد العرض
        $bid->update(['status' => 'accepted']);
        
        // سد الطلب باش ما يبقاش يبان لحريفية آخرين
        $bid->jobRequest->update(['status' => 'closed']);

        return back()->with('success', 'مبروك! تم قبول العرض. يمكنك الآن التواصل مع الحريفي.');
    }
}
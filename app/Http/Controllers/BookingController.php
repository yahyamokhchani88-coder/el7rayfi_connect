<?php

namespace App\Http\Controllers;

use App\Models\Booking;
use Illuminate\Http\Request;

class BookingController extends Controller
{
    // صيفط طلب جديد
    public function store(Request $request)
    {
        $request->validate([
            'artisan_id' => 'required|exists:users,id',
            'message' => 'required|string|min:10',
        ]);

        Booking::create([
            'client_id' => auth()->id(),
            'artisan_id' => $request->artisan_id,
            'message' => $request->message,
        ]);

        return back()->with('success', 'تم إرسال طلبك بنجاح! المعلم غايتصل بك قريباً.');
    }

    // تبديل حالة الطلب (قبول/إتمام)
    public function updateStatus(Request $request, $id)
    {
        $booking = Booking::where('artisan_id', auth()->id())->findOrFail($id);
        $booking->update(['status' => $request->status]);

        return back()->with('success', 'تم تحديث حالة الطلب.');
    }
}
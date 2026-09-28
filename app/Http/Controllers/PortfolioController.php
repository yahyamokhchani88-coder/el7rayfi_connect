<?php

namespace App\Http\Controllers;

use App\Models\Portfolio;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class PortfolioController extends Controller
{
    public function store(Request $request)
    {
        $request->validate([
            'image' => 'required|image|mimes:jpeg,png,jpg|max:2048', // ما تفوتش 2MB
        ]);

        if ($request->hasFile('image')) {
            // تخزين التصويرة فـ دوسي public/portfolios
            $path = $request->file('image')->store('portfolios', 'public');

            Portfolio::create([
                'user_id' => auth()->id(),
                'image_path' => $path,
            ]);

            return back()->with('success', 'تم إضافة الصورة بنجاح!');
        }
    }

    public function destroy($id)
    {
        $photo = Portfolio::where('user_id', auth()->id())->findOrFail($id);
        Storage::disk('public')->delete($photo->image_path);
        $photo->delete();

        return back()->with('success', 'تم مسح الصورة.');
    }
}
<?PHP 

namespace App\Http\Controllers;

use App\Models\Review;
use Illuminate\Http\Request;

class ReviewController extends Controller
{
    public function store(Request $request)
    {
        $request->validate([
            'artisan_id' => 'required|exists:users,id',
            'rating' => 'required|integer|min:1|max:5',
            'comment' => 'nullable|string|max:500',
        ]);

        // نأكدوا بلي الزبون ما كايقيمش راسو
        if (auth()->id() == $request->artisan_id) {
            return back()->with('error', 'مايمكنش تقيم راسك!');
        }

        Review::create([
            'client_id' => auth()->id(),
            'artisan_id' => $request->artisan_id,
            'rating' => $request->rating,
            'comment' => $request->comment,
        ]);

        return back()->with('success', 'شكراً على التقييم ديالك!');
    }
}
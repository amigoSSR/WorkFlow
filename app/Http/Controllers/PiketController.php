<?php

namespace App\Http\Controllers;

use App\Models\Piket;
use Illuminate\Http\Request;

class PiketController extends Controller
{
    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'user_id' => 'required|exists:users,id',
            'zone' => 'required|string|max:100',
            'day_type' => 'required|string',
        ]);

        $dayType = $request->day_type;
        $day = '';
        $weekType = 'none';

        if (in_array($dayType, ['senin', 'selasa', 'rabu', 'kamis'])) {
            $day = $dayType;
        } elseif (str_starts_with($dayType, 'jumat_')) {
            $day = 'jumat';
            $weekType = str_replace('jumat_', '', $dayType); // ganjil or genap
        } elseif (str_starts_with($dayType, 'sabtu_')) {
            $day = 'sabtu';
            $weekType = str_replace('sabtu_', '', $dayType); // ganjil or genap
        }

        // Prevent duplicate assignment for the same user on the same day/week_type
        $existing = Piket::where('user_id', $request->user_id)
            ->where('day', $day)
            ->where('week_type', $weekType)
            ->first();

        if ($existing) {
            return redirect()->back()->with('error', 'User sudah terdaftar pada jadwal ini!');
        }

        Piket::create([
            'user_id' => $request->user_id,
            'day' => $day,
            'week_type' => $weekType,
            'zone' => $request->zone,
        ]);

        return redirect()->back()->with('success', 'Jadwal piket berhasil ditambahkan.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Piket $piket)
    {
        $piket->delete();
        return redirect()->back()->with('success', 'Jadwal piket berhasil dihapus.');
    }
}

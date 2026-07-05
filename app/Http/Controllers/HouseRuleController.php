<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\HouseRule;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use Illuminate\Validation\Rule;

class HouseRuleController extends Controller
{
    /**
     * Display a listing of house rules.
     */
    public function index(Request $request): JsonResponse
    {
        $query = HouseRule::with('creator:id,name')
            ->active()
            ->ordered();

        // Search functionality
        if ($request->filled('search')) {
            $query->search($request->search);
        }

        // Filter by category
        if ($request->filled('kategori')) {
            $query->where('kategori', $request->kategori);
        }

        // Pagination
        $perPage = $request->get('per_page', 15);
        $houseRules = $query->paginate($perPage);

        // Get distinct categories for filter dropdown
        $categories = HouseRule::active()->distinct()->pluck('kategori')->filter()->values();

        return response()->json([
            'data' => $houseRules->items(),
            'meta' => [
                'current_page' => $houseRules->currentPage(),
                'last_page' => $houseRules->lastPage(),
                'per_page' => $houseRules->perPage(),
                'total' => $houseRules->total(),
                'categories' => $categories,
            ],
        ]);
    }

    /**
     * Store a newly created house rule.
     */
    public function store(Request $request): JsonResponse
    {
        $validated = $request->validate([
            'judul_rule' => 'required|string|max:255',
            'deskripsi_rule' => 'required|string',
            'kategori' => 'required|string|max:100',
            'icon' => 'nullable|string|max:100',
            'order_column' => 'nullable|integer|min:0',
            'is_active' => 'nullable|boolean',
        ]);

        $validated['dibuat_oleh'] = $request->user()->id;
        $validated['is_active'] = $validated['is_active'] ?? true;
        $validated['order_column'] = $validated['order_column'] ?? 0;
        $validated['icon'] = $validated['icon'] ?? 'gavel';

        $houseRule = HouseRule::create($validated);
        $houseRule->load('creator:id,name');

        return response()->json([
            'message' => 'House rule berhasil ditambahkan.',
            'data' => $houseRule,
        ], 201);
    }

    /**
     * Display the specified house rule.
     */
    public function show(HouseRule $houseRule): JsonResponse
    {
        $houseRule->load('creator:id,name');

        return response()->json([
            'data' => $houseRule,
        ]);
    }

    /**
     * Update the specified house rule.
     */
    public function update(Request $request, HouseRule $houseRule): JsonResponse
    {
        $validated = $request->validate([
            'judul_rule' => 'sometimes|required|string|max:255',
            'deskripsi_rule' => 'sometimes|required|string',
            'kategori' => 'sometimes|required|string|max:100',
            'icon' => 'nullable|string|max:100',
            'order_column' => 'nullable|integer|min:0',
            'is_active' => 'nullable|boolean',
        ]);

        $houseRule->update($validated);
        $houseRule->load('creator:id,name');

        return response()->json([
            'message' => 'House rule berhasil diperbarui.',
            'data' => $houseRule,
        ]);
    }

    /**
     * Remove the specified house rule.
     */
    public function destroy(HouseRule $houseRule): JsonResponse
    {
        $houseRule->delete();

        return response()->json([
            'message' => 'House rule berhasil dihapus.',
        ]);
    }

    /**
     * Get categories for filter dropdown.
     */
    public function categories(): JsonResponse
    {
        $categories = HouseRule::active()
            ->distinct()
            ->pluck('kategori')
            ->filter()
            ->values();

        return response()->json([
            'data' => $categories,
        ]);
    }
}
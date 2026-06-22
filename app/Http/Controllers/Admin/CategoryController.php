<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\EventCategory;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class CategoryController extends Controller
{
    public function index()
    {
        $categories = EventCategory::withCount('events')->orderBy('sort_order')->get();
        return view('admin.categories.index', compact('categories'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255|unique:event_categories,name',
            'icon' => 'nullable|string|max:100',
            'color' => 'nullable|string|max:7',
        ]);

        $validated['slug'] = Str::slug($validated['name']);
        $validated['is_active'] = true;
        $validated['sort_order'] = EventCategory::max('sort_order') + 1;

        EventCategory::create($validated);

        return back()->with('success', 'Kategori berhasil ditambahkan!');
    }

    public function update(Request $request, EventCategory $category)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255|unique:event_categories,name,' . $category->id,
            'icon' => 'nullable|string|max:100',
            'color' => 'nullable|string|max:7',
        ]);

        $validated['slug'] = Str::slug($validated['name']);

        $category->update($validated);

        return back()->with('success', 'Kategori berhasil diperbarui!');
    }

    public function destroy(EventCategory $category)
    {
        // Check if category has events
        if ($category->events()->count() > 0) {
            return back()->with('error', 'Kategori tidak dapat dihapus karena masih memiliki ' . $category->events()->count() . ' event!');
        }

        $category->delete();

        return back()->with('success', 'Kategori berhasil dihapus!');
    }

    public function toggleActive(EventCategory $category)
    {
        $category->update(['is_active' => !$category->is_active]);

        $message = $category->is_active 
            ? 'Kategori berhasil diaktifkan!' 
            : 'Kategori berhasil dinonaktifkan!';

        return back()->with('success', $message);
    }
}

<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Listing;
use Illuminate\Support\Facades\DB;

class DeduplicationController extends Controller
{
    public function index()
    {
        // Find duplicate groups based on exact match of business_name, area, city, address
        // Exclude records that are already marked as duplicates (merged)
        $duplicates = Listing::where('is_duplicate', false)
            ->select('business_name', 'area', 'city', 'address', DB::raw('COUNT(*) as count_dupes'))
            ->groupBy('business_name', 'area', 'city', 'address')
            ->having('count_dupes', '>', 1)
            ->get();

        $duplicateGroups = [];
        
        foreach ($duplicates as $dupe) {
            $records = Listing::where('business_name', $dupe->business_name)
                ->where('area', $dupe->area)
                ->where('city', $dupe->city)
                ->where('address', $dupe->address)
                ->where('is_duplicate', false)
                ->get();
                
            $duplicateGroups[] = $records;
        }

        return view('deduplicate.index', compact('duplicateGroups'));
    }

    public function merge(Request $request, $id) // primary id
    {
        $primaryRecord = Listing::findOrFail($id);
        
        $request->validate([
            'duplicate_ids' => 'required|array',
            'duplicate_ids.*' => 'exists:listings,id'
        ]);

        $duplicateIds = $request->input('duplicate_ids');

        foreach ($duplicateIds as $dupeId) {
            if ($dupeId != $primaryRecord->id) {
                $dupeRecord = Listing::find($dupeId);
                if ($dupeRecord) {
                    $dupeRecord->is_duplicate = true;
                    $dupeRecord->merged_into_id = $primaryRecord->id;
                    $dupeRecord->save();
                }
            }
        }

        return redirect()->route('deduplicate.index')->with('success', 'Records merged successfully.');
    }
}

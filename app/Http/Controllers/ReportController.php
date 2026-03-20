<?php

namespace App\Http\Controllers;

use App\Models\Listing;
use Illuminate\Support\Facades\DB;

class ReportController extends Controller
{
    public function index()
    {
        // 1) Total Name (Total records)
        $totalNames = Listing::count();

        // 2) City wise data
        $cityWiseData = Listing::select('city', DB::raw('COUNT(*) as total'))
            ->groupBy('city')
            ->get();

        // 3) Category + city-wise data
        $categoryCityWiseData = Listing::select('category', 'city', DB::raw('COUNT(*) as total'))
            ->groupBy('category', 'city')
            ->get();

        // 4) Category + area wise data
        $categoryAreaWiseData = Listing::select('category', 'area', DB::raw('COUNT(*) as total'))
            ->groupBy('category', 'area')
            ->get();

        // 5) Unique Listing (Not marked as duplicate and distinct basic properties)
        $uniqueListingCount = Listing::where('is_duplicate', false)->count();

        // 6) Duplicate listing (Marked as duplicate)
        $duplicateListingCount = Listing::where('is_duplicate', true)->count();

        // 7) Incomplete Listing (Missing important info like mobile_no)
        $incompleteListingCount = Listing::whereNull('business_name')
            ->orWhere('business_name', '')
            ->orWhereNull('mobile_no')
            ->orWhere('mobile_no', '')
            ->orWhereNull('city')
            ->orWhere('city', '')
            ->count();

        return view('report.index', compact(
            'totalNames',
            'cityWiseData',
            'categoryCityWiseData',
            'categoryAreaWiseData',
            'uniqueListingCount',
            'duplicateListingCount',
            'incompleteListingCount'
        ));
    }
}

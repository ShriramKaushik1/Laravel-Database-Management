<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Listing;
use Illuminate\Support\Facades\Http;

class ImportController extends Controller
{
    public function index()
    {
        return view('import.index');
    }

    public function store(Request $request)
    {
        $request->validate([
            'csv_url' => 'required|url'
        ]);

        try {
            $url = $request->csv_url;
            
            // Automatically convert a Google Sheets "edit" link into a direct "export CSV" link
            if (strpos($url, 'docs.google.com/spreadsheets') !== false && preg_match('/\/d\/([a-zA-Z0-9-_]+)/', $url, $matches)) {
                $fileId = $matches[1];
                $url = "https://docs.google.com/spreadsheets/d/{$fileId}/export?format=csv";
            }

            $response = Http::get($url);
            
            if (!$response->successful()) {
                return back()->with('error', 'Failed to fetch data from the provided URL. Ensure it is a public CSV link.');
            }

            $csvData = $response->body();
            $lines = explode(PHP_EOL, $csvData);
            
            $header = null;
            $importedCount = 0;

            foreach ($lines as $line) {
                if (empty(trim($line))) continue;

                $row = str_getcsv($line);

                if (!$header) {
                    $header = $row;
                    continue; // Skip header row
                }

                // Assuming CSV columns are in this exact order or we just map by index:
                // Business Name, Area, City, Mobile No., Category, Sub-category, Address
                if (count($row) >= 6) {
                    Listing::create([
                        'business_name' => $row[0] ?? null,
                        'area'          => $row[1] ?? null,
                        'city'          => $row[2] ?? null,
                        'mobile_no'     => $row[3] ?? null,
                        'category'      => $row[4] ?? null,
                        'sub_category'  => $row[5] ?? null,
                        'address'       => $row[6] ?? null,
                    ]);
                    $importedCount++;
                }
            }

            return redirect()->route('import.index')->with('success', "Successfully imported $importedCount records.");
            
        } catch (\Exception $e) {
            return back()->with('error', 'Error processing CSV: ' . $e->getMessage());
        }
    }
}

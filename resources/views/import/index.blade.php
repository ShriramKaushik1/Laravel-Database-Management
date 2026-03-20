@extends('layouts.app')

@section('content')
<div class="glass overflow-hidden shadow-xl sm:rounded-2xl p-8 bg-white/80">
    <div class="border-b border-gray-200 pb-5 mb-5">
        <h3 class="text-2xl leading-6 font-semibold text-gray-900">Import Bulk Data</h3>
        <p class="mt-2 max-w-4xl text-sm text-gray-500">Provide a public Google Drive CSV Link to import business listings data.</p>
    </div>

    <form method="POST" action="{{ route('import.store') }}" class="space-y-6">
        @csrf
        
        <div>
            <label for="csv_url" class="block text-sm font-medium text-gray-700">Google Drive Sheets URL</label>
            <div class="mt-1 relative rounded-md shadow-sm">
                <input type="url" name="csv_url" id="csv_url" class="focus:ring-indigo-500 focus:border-indigo-500 block w-full sm:text-sm border-gray-300 rounded-lg p-3 border" value="https://docs.google.com/spreadsheets/d/1p_KRF1P-fno5iKK_vgGMMwwMkf2JgXIP/edit?usp=sharing&ouid=110761474731611781451&rtpof=true&sd=true" required>
            </div>
            <p class="mt-2 text-xs text-gray-500">The application will automatically convert this read-only link into a downloadable CSV format behind the scenes.</p>
        </div>

        <div class="pt-2">
            <button type="submit" class="w-full flex justify-center py-3 px-4 border border-transparent rounded-lg shadow-sm text-sm font-medium text-white bg-gradient-to-r from-blue-600 to-indigo-600 hover:from-blue-700 hover:to-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 transition-all transform hover:scale-[1.01]">
                Import Data Now
            </button>
        </div>
    </form>
</div>
@endsection

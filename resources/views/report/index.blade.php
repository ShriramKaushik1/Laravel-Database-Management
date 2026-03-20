@extends('layouts.app')

@section('content')
<div class="glass overflow-hidden shadow-xl sm:rounded-2xl p-8 bg-white/80">
    <div class="border-b border-gray-200 pb-5 mb-5">
        <h3 class="text-2xl leading-6 font-semibold text-gray-900">Data Report</h3>
        <p class="mt-2 max-w-4xl text-sm text-gray-500">Application statistics and data breakdowns.</p>
    </div>

    <!-- Top Stats -->
    <div class="grid grid-cols-1 gap-5 sm:grid-cols-4 mb-8">
        <div class="bg-white overflow-hidden shadow sm:rounded-lg border border-gray-100">
            <div class="px-4 py-5 sm:p-6">
                <dt class="text-sm font-medium text-gray-500 truncate">Total Data Listings</dt>
                <dd class="mt-1 text-3xl font-semibold text-gray-900">{{ $totalNames }}</dd>
            </div>
        </div>
        <div class="bg-white overflow-hidden shadow sm:rounded-lg border border-gray-100">
            <div class="px-4 py-5 sm:p-6">
                <dt class="text-sm font-medium text-gray-500 truncate">Unique Listings</dt>
                <dd class="mt-1 text-3xl font-semibold text-indigo-600">{{ $uniqueListingCount }}</dd>
            </div>
        </div>
        <div class="bg-white overflow-hidden shadow sm:rounded-lg border border-gray-100">
            <div class="px-4 py-5 sm:p-6">
                <dt class="text-sm font-medium text-gray-500 truncate">Duplicate Parts</dt>
                <dd class="mt-1 text-3xl font-semibold text-amber-500">{{ $duplicateListingCount }}</dd>
            </div>
        </div>
        <div class="bg-white overflow-hidden shadow sm:rounded-lg border border-gray-100">
            <div class="px-4 py-5 sm:p-6">
                <dt class="text-sm font-medium text-gray-500 truncate">Incomplete Listings</dt>
                <dd class="mt-1 text-3xl font-semibold text-red-500">{{ $incompleteListingCount }}</dd>
            </div>
        </div>
    </div>

    <div class="grid grid-cols-1 gap-8 lg:grid-cols-3 shadow-sm">
        
        <!-- City Wise -->
        <div class="bg-white border text-sm border-gray-200 rounded-xl overflow-hidden">
            <div class="px-4 py-3 bg-gray-50 border-b border-gray-200 font-semibold text-gray-700">City-wise Data</div>
            <ul class="divide-y divide-gray-200">
                @forelse($cityWiseData as $row)
                <li class="px-4 py-3 flex justify-between items-center bg-white hover:bg-gray-50">
                    <span class="text-gray-600">{{ $row->city ?: 'Unknown City' }}</span>
                    <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-blue-100 text-blue-800">{{ $row->total }}</span>
                </li>
                @empty
                <li class="px-4 py-3 text-gray-500">No data available.</li>
                @endforelse
            </ul>
        </div>

        <!-- Category + City Wise -->
        <div class="bg-white border text-sm border-gray-200 rounded-xl overflow-hidden">
            <div class="px-4 py-3 bg-gray-50 border-b border-gray-200 font-semibold text-gray-700">Category + City</div>
            <ul class="divide-y divide-gray-200 max-h-96 overflow-y-auto">
                @forelse($categoryCityWiseData as $row)
                <li class="px-4 py-3 flex justify-between items-center bg-white hover:bg-gray-50">
                    <span class="text-gray-600 break-words flex-1 pr-2">{{ $row->category ?: 'N/A' }} <span class="text-gray-400 text-xs text-uppercase">in</span> {{ $row->city ?: 'N/A' }}</span>
                    <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-indigo-100 text-indigo-800">{{ $row->total }}</span>
                </li>
                @empty
                <li class="px-4 py-3 text-gray-500">No data available.</li>
                @endforelse
            </ul>
        </div>

        <!-- Category + Area Wise -->
        <div class="bg-white border text-sm border-gray-200 rounded-xl overflow-hidden">
            <div class="px-4 py-3 bg-gray-50 border-b border-gray-200 font-semibold text-gray-700">Category + Area</div>
            <ul class="divide-y divide-gray-200 max-h-96 overflow-y-auto">
                @forelse($categoryAreaWiseData as $row)
                <li class="px-4 py-3 flex justify-between items-center bg-white hover:bg-gray-50">
                    <span class="text-gray-600 break-words flex-1 pr-2">{{ $row->category ?: 'N/A' }} <span class="text-gray-400 text-xs text-uppercase">in</span> {{ $row->area ?: 'N/A' }}</span>
                    <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-teal-100 text-teal-800">{{ $row->total }}</span>
                </li>
                @empty
                <li class="px-4 py-3 text-gray-500">No data available.</li>
                @endforelse
            </ul>
        </div>

    </div>
</div>
@endsection

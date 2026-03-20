<?php $__env->startSection('content'); ?>
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
                <dd class="mt-1 text-3xl font-semibold text-gray-900"><?php echo e($totalNames); ?></dd>
            </div>
        </div>
        <div class="bg-white overflow-hidden shadow sm:rounded-lg border border-gray-100">
            <div class="px-4 py-5 sm:p-6">
                <dt class="text-sm font-medium text-gray-500 truncate">Unique Listings</dt>
                <dd class="mt-1 text-3xl font-semibold text-indigo-600"><?php echo e($uniqueListingCount); ?></dd>
            </div>
        </div>
        <div class="bg-white overflow-hidden shadow sm:rounded-lg border border-gray-100">
            <div class="px-4 py-5 sm:p-6">
                <dt class="text-sm font-medium text-gray-500 truncate">Duplicate Parts</dt>
                <dd class="mt-1 text-3xl font-semibold text-amber-500"><?php echo e($duplicateListingCount); ?></dd>
            </div>
        </div>
        <div class="bg-white overflow-hidden shadow sm:rounded-lg border border-gray-100">
            <div class="px-4 py-5 sm:p-6">
                <dt class="text-sm font-medium text-gray-500 truncate">Incomplete Listings</dt>
                <dd class="mt-1 text-3xl font-semibold text-red-500"><?php echo e($incompleteListingCount); ?></dd>
            </div>
        </div>
    </div>

    <div class="grid grid-cols-1 gap-8 lg:grid-cols-3 shadow-sm">
        
        <!-- City Wise -->
        <div class="bg-white border text-sm border-gray-200 rounded-xl overflow-hidden">
            <div class="px-4 py-3 bg-gray-50 border-b border-gray-200 font-semibold text-gray-700">City-wise Data</div>
            <ul class="divide-y divide-gray-200">
                <?php $__empty_1 = true; $__currentLoopData = $cityWiseData; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $row): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                <li class="px-4 py-3 flex justify-between items-center bg-white hover:bg-gray-50">
                    <span class="text-gray-600"><?php echo e($row->city ?: 'Unknown City'); ?></span>
                    <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-blue-100 text-blue-800"><?php echo e($row->total); ?></span>
                </li>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                <li class="px-4 py-3 text-gray-500">No data available.</li>
                <?php endif; ?>
            </ul>
        </div>

        <!-- Category + City Wise -->
        <div class="bg-white border text-sm border-gray-200 rounded-xl overflow-hidden">
            <div class="px-4 py-3 bg-gray-50 border-b border-gray-200 font-semibold text-gray-700">Category + City</div>
            <ul class="divide-y divide-gray-200 max-h-96 overflow-y-auto">
                <?php $__empty_1 = true; $__currentLoopData = $categoryCityWiseData; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $row): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                <li class="px-4 py-3 flex justify-between items-center bg-white hover:bg-gray-50">
                    <span class="text-gray-600 break-words flex-1 pr-2"><?php echo e($row->category ?: 'N/A'); ?> <span class="text-gray-400 text-xs text-uppercase">in</span> <?php echo e($row->city ?: 'N/A'); ?></span>
                    <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-indigo-100 text-indigo-800"><?php echo e($row->total); ?></span>
                </li>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                <li class="px-4 py-3 text-gray-500">No data available.</li>
                <?php endif; ?>
            </ul>
        </div>

        <!-- Category + Area Wise -->
        <div class="bg-white border text-sm border-gray-200 rounded-xl overflow-hidden">
            <div class="px-4 py-3 bg-gray-50 border-b border-gray-200 font-semibold text-gray-700">Category + Area</div>
            <ul class="divide-y divide-gray-200 max-h-96 overflow-y-auto">
                <?php $__empty_1 = true; $__currentLoopData = $categoryAreaWiseData; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $row): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                <li class="px-4 py-3 flex justify-between items-center bg-white hover:bg-gray-50">
                    <span class="text-gray-600 break-words flex-1 pr-2"><?php echo e($row->category ?: 'N/A'); ?> <span class="text-gray-400 text-xs text-uppercase">in</span> <?php echo e($row->area ?: 'N/A'); ?></span>
                    <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-teal-100 text-teal-800"><?php echo e($row->total); ?></span>
                </li>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                <li class="px-4 py-3 text-gray-500">No data available.</li>
                <?php endif; ?>
            </ul>
        </div>

    </div>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\Users\SHRI RAM KAUSHIK\Desktop\PHP ASSIGN\db_manager\resources\views/report/index.blade.php ENDPATH**/ ?>
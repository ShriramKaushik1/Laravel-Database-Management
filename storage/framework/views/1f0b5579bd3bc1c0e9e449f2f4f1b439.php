<?php $__env->startSection('content'); ?>
<div class="glass overflow-hidden shadow-xl sm:rounded-2xl p-8 bg-white/80">
    <div class="border-b border-gray-200 pb-5 mb-5 flex justify-between items-center">
        <div>
            <h3 class="text-2xl leading-6 font-semibold text-gray-900">Duplicate Listings</h3>
            <p class="mt-2 max-w-4xl text-sm text-gray-500">Identify and merge duplicates mapping to the same name, area, city, and address.</p>
        </div>
    </div>

    <?php if(count($duplicateGroups) > 0): ?>
        <div class="space-y-6">
            <?php $__currentLoopData = $duplicateGroups; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $index => $group): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <div class="bg-gray-50/50 rounded-xl border border-gray-200 overflow-hidden shadow-sm">
                    <div class="px-4 py-3 border-b border-gray-200 bg-gray-100/50 flex justify-between items-center">
                        <span class="font-semibold text-gray-700">Group #<?php echo e($index + 1); ?> - <?php echo e($group[0]->business_name); ?> (<?php echo e(count($group)); ?> duplicates)</span>
                    </div>
                    
                    <form method="POST" action="<?php echo e(route('deduplicate.merge', $group[0]->id)); ?>" class="p-4">
                        <?php echo csrf_field(); ?>
                        <div class="overflow-x-auto mb-4">
                            <table class="min-w-full divide-y divide-gray-200 text-sm focus:outline-none">
                                <thead>
                                    <tr>
                                        <th class="px-3 py-2 text-left font-medium text-gray-500">Select</th>
                                        <th class="px-3 py-2 text-left font-medium text-gray-500">Business Name</th>
                                        <th class="px-3 py-2 text-left font-medium text-gray-500">Area</th>
                                        <th class="px-3 py-2 text-left font-medium text-gray-500">City</th>
                                        <th class="px-3 py-2 text-left font-medium text-gray-500">Address</th>
                                        <th class="px-3 py-2 text-left font-medium text-gray-500">Mobile No</th>
                                        <th class="px-3 py-2 text-left font-medium text-gray-500">Category</th>
                                    </tr>
                                </thead>
                                <tbody class="bg-white divide-y divide-gray-200">
                                    <?php $__currentLoopData = $group; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $dupKey => $record): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <tr class="<?php echo e($dupKey == 0 ? 'bg-indigo-50/30' : ''); ?>">
                                            <td class="px-3 py-2">
                                                <input type="checkbox" name="duplicate_ids[]" value="<?php echo e($record->id); ?>" checked class="rounded border-gray-300 text-indigo-600 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50" <?php echo e($dupKey == 0 ? 'disabled' : ''); ?>>
                                                <?php if($dupKey == 0): ?>
                                                    <input type="hidden" name="duplicate_ids[]" value="<?php echo e($record->id); ?>">
                                                    <span class="text-xs text-indigo-600 block mt-1">Primary</span>
                                                <?php endif; ?>
                                            </td>
                                            <td class="px-3 py-2 font-medium"><?php echo e($record->business_name); ?></td>
                                            <td class="px-3 py-2 text-gray-500"><?php echo e($record->area); ?></td>
                                            <td class="px-3 py-2 text-gray-500"><?php echo e($record->city); ?></td>
                                            <td class="px-3 py-2 text-gray-500"><?php echo e($record->address); ?></td>
                                            <td class="px-3 py-2 text-gray-500"><?php echo e($record->mobile_no); ?></td>
                                            <td class="px-3 py-2 text-gray-500"><?php echo e($record->category); ?></td>
                                        </tr>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                </tbody>
                            </table>
                        </div>
                        <div class="flex justify-end">
                            <button type="submit" class="inline-flex items-center px-4 py-2 border border-transparent text-sm font-medium rounded-md shadow-sm text-white bg-indigo-600 hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                                Merge Selected into Primary
                            </button>
                        </div>
                    </form>
                </div>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </div>
    <?php else: ?>
        <div class="text-center py-12">
            <svg class="mx-auto h-12 w-12 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 13V6a2 2 0 00-2-2H6a2 2 0 00-2 2v7m16 0v5a2 2 0 01-2 2H6a2 2 0 01-2-2v-5m16 0h-2.586a1 1 0 00-.707.293l-2.414 2.414a1 1 0 01-.707.293h-3.172a1 1 0 01-.707-.293l-2.414-2.414A1 1 0 006.586 13H4"></path></svg>
            <h3 class="mt-2 text-sm font-medium text-gray-900">No Duplicates Found</h3>
            <p class="mt-1 text-sm text-gray-500">Your database is currently clean and deduplicated.</p>
        </div>
    <?php endif; ?>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\Users\SHRI RAM KAUSHIK\Desktop\PHP ASSIGN\db_manager\resources\views/deduplicate/index.blade.php ENDPATH**/ ?>
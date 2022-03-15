<?php if(count(Nova::availableResources(request()))): ?>
    <h3 class="flex items-center font-normal text-white mb-6 text-base no-underline">
        <svg class="sidebar-icon" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
            <path fill="var(--sidebar-icon)"
                  d="M3 1h4c1.1045695 0 2 .8954305 2 2v4c0 1.1045695-.8954305 2-2 2H3c-1.1045695 0-2-.8954305-2-2V3c0-1.1045695.8954305-2 2-2zm0 2v4h4V3H3zm10-2h4c1.1045695 0 2 .8954305 2 2v4c0 1.1045695-.8954305 2-2 2h-4c-1.1045695 0-2-.8954305-2-2V3c0-1.1045695.8954305-2 2-2zm0 2v4h4V3h-4zM3 11h4c1.1045695 0 2 .8954305 2 2v4c0 1.1045695-.8954305 2-2 2H3c-1.1045695 0-2-.8954305-2-2v-4c0-1.1045695.8954305-2 2-2zm0 2v4h4v-4H3zm10-2h4c1.1045695 0 2 .8954305 2 2v4c0 1.1045695-.8954305 2-2 2h-4c-1.1045695 0-2-.8954305-2-2v-4c0-1.1045695.8954305-2 2-2zm0 2v4h4v-4h-4z"
            />
        </svg>
        <span class="sidebar-label"><?php echo e(__('Resources')); ?></span>
    </h3>

    <?php $__currentLoopData = $navigation; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $group => $resources): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
        <?php
        $my_resources = [];
        foreach ($resources as $r) {
            $my_resources[] = $r::uriKey();
        }
        ?>
        <grouped-resource-collapsible header="<?php echo e($group); ?>" :last="<?php echo json_encode($loop->last, 15, 512) ?>"
                                      :expanded="<?php if(in_array(explode("/",url()->current())[count(explode("/",url()->current()))-1],$my_resources)): ?> true <?php else: ?> false <?php endif; ?>">
            <?php $__currentLoopData = $resources; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $resource): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <li class="leading-wide mb-4 text-sm" key="<?php echo e($key); ?>">
                    <router-link :to="{
                    name: 'index',
                    params: {
                        resourceName: '<?php echo e($resource::uriKey()); ?>'
                    }
                }" class="text-white ml-6 no-underline dim block">
                        <?php echo e($resource::label()); ?>

                    </router-link>
                </li>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </grouped-resource-collapsible>
    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
<?php endif; ?>

<?php /**PATH C:\xampp\htdocs\admin\vendor\tanmuhittin\nova-collapsible-groups\src/../resources/views/resources/navigation.blade.php ENDPATH**/ ?>
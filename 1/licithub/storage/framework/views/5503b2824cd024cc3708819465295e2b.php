<?php $attributes ??= new \Illuminate\View\ComponentAttributeBag;

$__newAttributes = [];
$__propNames = \Illuminate\View\ComponentAttributeBag::extractPropNames((['plans' => []]));

foreach ($attributes->all() as $__key => $__value) {
    if (in_array($__key, $__propNames)) {
        $$__key = $$__key ?? $__value;
    } else {
        $__newAttributes[$__key] = $__value;
    }
}

$attributes = new \Illuminate\View\ComponentAttributeBag($__newAttributes);

unset($__propNames);
unset($__newAttributes);

foreach (array_filter((['plans' => []]), 'is_string', ARRAY_FILTER_USE_KEY) as $__key => $__value) {
    $$__key = $$__key ?? $__value;
}

$__defined_vars = get_defined_vars();

foreach ($attributes->all() as $__key => $__value) {
    if (array_key_exists($__key, $__defined_vars)) unset($$__key);
}

unset($__defined_vars); ?>

<div class="plans-section">
    <h2>Planos Disponíveis</h2>
    
    <?php if(count($plans) > 0): ?>
    <div class="plans-grid">
        <?php $__currentLoopData = $plans; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $plan): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
        <div class="plan-card">
            <h3><?php echo e($plan->name); ?></h3>
            <div class="plan-price">
                R$ <?php echo e(number_format($plan->price, 2, ',', '.')); ?> / <?php echo e($plan->interval); ?>

            </div>
            <p class="plan-description"><?php echo e($plan->description); ?></p>

            <?php
                $features = is_array($plan->features) ? $plan->features : explode("\n", $plan->features);
            ?>
            
            <ul class="plan-features">
                <?php $__currentLoopData = $features; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $feature): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <?php if(trim($feature)): ?>
                        <li><?php echo e($feature); ?></li>
                    <?php endif; ?>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </ul>
            
            <a href="<?php echo e(route('subscriptions.checkout', $plan->id)); ?>" class="btn-subscribe">
                Assinar
            </a>
        </div>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
    </div>
    <?php else: ?>
    <p class="no-plans">Nenhum plano disponível no momento.</p>
    <?php endif; ?>
</div>
<?php /**PATH C:\xampp\htdocs\dashboard\licithub\resources\views/components/plans.blade.php ENDPATH**/ ?>
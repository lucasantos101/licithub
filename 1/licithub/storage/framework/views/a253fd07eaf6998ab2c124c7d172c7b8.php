<?php
    $user = auth()->user();
    if (!($user->user_type === 'customer' && $user->hasActiveCashierSubscription())) {
        header('Location: ' . url('/'));
        exit;
    }
?>



<?php if($user->user_type === 'customer' && $user->hasActiveCashierSubscription()): ?>





<?php $__env->startSection('content'); ?>
    <div class="container">
        <h1>Dashboard do Cliente</h1>
        <p>Bem-vindo ao painel do cliente!</p>
    </div>
<?php $__env->stopSection(); ?>
<?php endif; ?>
<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\xampp\htdocs\dashboard\licithub\resources\views/client/dashboard.blade.php ENDPATH**/ ?>
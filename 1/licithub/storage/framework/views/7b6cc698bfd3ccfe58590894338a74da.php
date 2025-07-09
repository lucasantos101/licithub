<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <title>Detalhes do Plano</title>
    <?php echo app('Illuminate\Foundation\Vite')(['resources/css/admin.css']); ?>
</head>
<body class="light-mode">
    <main class="content-wrapper">
        <div class="page-header" style="justify-content: space-between;">
            <h1 class="page-title">Detalhes do Plano: <?php echo e($plan->name); ?></h1>
            <a href="<?php echo e(route('plans.edit', $plan)); ?>" class="btn btn-warning">Editar Plano</a>
        </div>

        <div class="cards-grid">
            <div class="card">
                <div class="card-info">
                    <h3>Informações Básicas</h3>
                    <ul class="list-group mt-2">
                        <li class="list-group-item"><strong>Nome:</strong> <?php echo e($plan->name); ?></li>
                        <li class="list-group-item"><strong>Slug:</strong> <?php echo e($plan->slug); ?></li>
                        <li class="list-group-item"><strong>Preço:</strong> R$ <?php echo e(number_format($plan->price, 2, ',', '.')); ?></li>
                        <li class="list-group-item"><strong>Intervalo:</strong> <?php echo e($plan->interval === 'month' ? 'Mensal' : 'Anual'); ?></li>
                    </ul>
                </div>
            </div>

            <div class="card">
                <div class="card-info">
                    <h3>Configurações</h3>
                    <ul class="list-group mt-2">
                        <li class="list-group-item">
                            <strong>Status:</strong>
                            <span class="badge <?php echo e($plan->is_active ? 'badge-success' : 'badge-secondary'); ?>">
                                <?php echo e($plan->is_active ? 'Ativo' : 'Inativo'); ?>

                            </span>
                        </li>
                        <li class="list-group-item"><strong>Trial:</strong> <?php echo e($plan->trial_days); ?> dias</li>
                        <li class="list-group-item"><strong>ID Stripe:</strong> <?php echo e($plan->stripe_price_id ?? 'Não configurado'); ?></li>
                        <li class="list-group-item">
                            <strong>Assinantes:</strong>
                            <span class="badge badge-primary"><?php echo e($plan->subscriptions()->count()); ?></span>
                        </li>
                    </ul>
                </div>
            </div>
        </div>

        <div class="card mt-6">
            <div class="card-info">
                <h3>Descrição</h3>
                <p class="mt-2"><?php echo e($plan->description ?? 'Nenhuma descrição fornecida.'); ?></p>
            </div>
        </div>

        <?php
            $features = is_array($plan->features) ? $plan->features : json_decode($plan->features, true) ?? [];
            $featuresOff = is_array($plan->features_off) ? $plan->features_off : json_decode($plan->features_off, true) ?? [];
        ?>

        <?php if(count($features) > 0): ?>
        <div class="card mt-6">
            <div class="card-info">
                <h3>Recursos Ativos</h3>
                <ul class="list-group mt-2">
                    <?php $__currentLoopData = $features; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $feature): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <li class="list-group-item">
                            ✅ <?php echo e($feature); ?>

                        </li>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </ul>
            </div>
        </div>
        <?php endif; ?>

        <?php if(count($featuresOff) > 0): ?>
        <div class="card mt-6">
            <div class="card-info">
                <h3>Recursos Bloqueados</h3>
                <ul class="list-group mt-2">
                    <?php $__currentLoopData = $featuresOff; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $feature): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <li class="list-group-item text-muted">
                            ❌ <?php echo e($feature); ?>

                        </li>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </ul>
            </div>
        </div>
        <?php endif; ?>

        <div class="card-footer mt-6">
            <small class="text-muted">Criado em: <?php echo e($plan->created_at->format('d/m/Y H:i')); ?></small>
        </div>
    </main>
</body>
</html>
<?php /**PATH C:\xampp\htdocs\dashboard\licithub\resources\views/admin/plans/show.blade.php ENDPATH**/ ?>
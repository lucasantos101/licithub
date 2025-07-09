<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <title>Editar Plano</title>
    <?php echo app('Illuminate\Foundation\Vite')(['resources/css/admin.css']); ?>
</head>
<body class="light-mode">
    <main class="content-wrapper">
        <div class="page-header">
            <h1 class="page-title">Editar Plano: <?php echo e($plan->name); ?></h1>
        </div>

        <form action="<?php echo e(route('plans.update', $plan)); ?>" method="POST" style="max-width: 800px;">
            <?php echo csrf_field(); ?>
            <?php echo method_field('PUT'); ?>

            <div class="form-group">
                <label for="name">Nome do Plano*</label>
                <input type="text" name="name" id="name" class="form-control" value="<?php echo e($plan->name); ?>" required>
            </div>

            <div class="form-group">
                <label for="slug">Slug*</label>
                <input type="text" name="slug" id="slug" class="form-control" value="<?php echo e($plan->slug); ?>" required>
                <small class="text-muted">Identificador único (ex: plano-basico)</small>
            </div>

            <div class="form-group">
                <label for="description">Descrição</label>
                <textarea name="description" id="description" class="form-control" rows="3"><?php echo e($plan->description); ?></textarea>
            </div>

            <div class="form-group">
                <label for="price">Preço* (R$)</label>
                <input type="number" name="price" id="price" class="form-control" step="0.01" min="0" value="<?php echo e($plan->price); ?>" required>
            </div>

            <div class="form-group">
                <label for="interval">Intervalo*</label>
                <select name="interval" id="interval" class="form-control" required>
                    <option value="month" <?php echo e($plan->interval == 'month' ? 'selected' : ''); ?>>Mensal</option>
                    <option value="year" <?php echo e($plan->interval == 'year' ? 'selected' : ''); ?>>Anual</option>
                </select>
            </div>

            <div class="form-group">
                <label for="trial_days">Dias de Trial</label>
                <input type="number" name="trial_days" id="trial_days" class="form-control" min="0" value="<?php echo e($plan->trial_days); ?>">
            </div>

            <div class="form-group">
                <label for="stripe_price_id">ID do Preço no Stripe</label>
                <input type="text" name="stripe_price_id" id="stripe_price_id" class="form-control" value="<?php echo e($plan->stripe_price_id); ?>">
            </div>

            <div class="form-group">
                <label>
                    <input type="hidden" name="is_active" value="0">
                    <input type="checkbox" name="is_active" value="1" <?php echo e($plan->is_active ? 'checked' : ''); ?>>
                    Plano Ativo
                </label>
            </div>

            
            <div class="form-group">
                <label>Recursos Ativos (features)</label>
                <div id="features-container">
                    <?php
                        $features = is_array($plan->features) ? $plan->features : json_decode($plan->features, true) ?? [];
                    ?>

                    <?php $__empty_1 = true; $__currentLoopData = $features; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $feature): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                        <div class="input-group mb-2">
                            <input type="text" name="features[]" class="form-control" value="<?php echo e($feature); ?>">
                            <div class="input-group-append">
                                <button class="btn btn-outline-danger remove-feature" type="button">−</button>
                            </div>
                        </div>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                        <div class="input-group mb-2">
                            <input type="text" name="features[]" class="form-control" placeholder="Recurso incluído">
                            <div class="input-group-append">
                                <button class="btn btn-outline-secondary add-feature" type="button">+</button>
                            </div>
                        </div>
                    <?php endif; ?>
                </div>
                <button type="button" class="btn btn-outline-secondary add-feature mt-2">+ Adicionar Recurso</button>
            </div>

            
            <div class="form-group">
                <label>Recursos Bloqueados (features_off)</label>
                <div id="features-off-container">
                    <?php
                        $featuresOff = is_array($plan->features_off) ? $plan->features_off : json_decode($plan->features_off, true) ?? [];
                    ?>

                    <?php $__empty_1 = true; $__currentLoopData = $featuresOff; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $featureOff): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                        <div class="input-group mb-2">
                            <input type="text" name="features_off[]" class="form-control" value="<?php echo e($featureOff); ?>">
                            <div class="input-group-append">
                                <button class="btn btn-outline-danger remove-feature-off" type="button">−</button>
                            </div>
                        </div>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                        <div class="input-group mb-2">
                            <input type="text" name="features_off[]" class="form-control" placeholder="Recurso bloqueado">
                            <div class="input-group-append">
                                <button class="btn btn-outline-secondary add-feature-off" type="button">+</button>
                            </div>
                        </div>
                    <?php endif; ?>
                </div>
                <button type="button" class="btn btn-outline-secondary add-feature-off mt-2">+ Adicionar Recurso Bloqueado</button>
            </div>

            <div class="btn-group" style="margin-top: 1rem;">
                <button type="submit" class="btn btn-success">Atualizar Plano</button>
                <a href="<?php echo e(route('plans.index')); ?>" class="btn btn-secondary">Cancelar</a>
            </div>
        </form>
    </main>

    <script>
        document.addEventListener('DOMContentLoaded', function () {
            document.addEventListener('click', function (e) {
                if (e.target.classList.contains('add-feature')) {
                    const container = document.getElementById('features-container');
                    const newInput = document.createElement('div');
                    newInput.className = 'input-group mb-2';
                    newInput.innerHTML = `
                        <input type="text" name="features[]" class="form-control" placeholder="Recurso incluído">
                        <div class="input-group-append">
                            <button class="btn btn-outline-danger remove-feature" type="button">−</button>
                        </div>
                    `;
                    container.appendChild(newInput);
                }

                if (e.target.classList.contains('add-feature-off')) {
                    const container = document.getElementById('features-off-container');
                    const newInput = document.createElement('div');
                    newInput.className = 'input-group mb-2';
                    newInput.innerHTML = `
                        <input type="text" name="features_off[]" class="form-control" placeholder="Recurso bloqueado">
                        <div class="input-group-append">
                            <button class="btn btn-outline-danger remove-feature-off" type="button">−</button>
                        </div>
                    `;
                    container.appendChild(newInput);
                }

                if (e.target.classList.contains('remove-feature')) {
                    e.target.closest('.input-group').remove();
                }

                if (e.target.classList.contains('remove-feature-off')) {
                    e.target.closest('.input-group').remove();
                }
            });
        });
    </script>
</body>
</html>
<?php /**PATH C:\xampp\htdocs\dashboard\licithub\resources\views/admin/plans/edit.blade.php ENDPATH**/ ?>
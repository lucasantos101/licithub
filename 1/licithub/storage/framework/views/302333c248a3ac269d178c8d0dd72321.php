<?php $__env->startSection("content"); ?>
<div class="container">
    <?php if(auth()->user()->user_type === 'customer'): ?>
        <div class="alert alert-danger mt-4">
            Você não tem permissão para acessar esta página.
        </div>
    <?php else: ?>
        <h1>Adicionar Novo Cliente</h1>

        <?php if($errors->any()): ?>
            <div class="alert alert-danger">
                <ul>
                    <?php $__currentLoopData = $errors->all(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $error): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <li><?php echo e($error); ?></li>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </ul>
            </div>
        <?php endif; ?>

        <form action="<?php echo e(route('clients.store')); ?>" method="POST">
            <?php echo csrf_field(); ?>

            <div class="mb-3">
                <label for="name" class="form-label">Nome</label>
                <input type="text" class="form-control" id="name" name="name" value="<?php echo e(old('name')); ?>" required>
            </div>

            <div class="mb-3">
                <label for="email" class="form-label">Email</label>
                <input type="email" class="form-control" id="email" name="email" value="<?php echo e(old('email')); ?>" required>
            </div>

            <div class="mb-3">
                <label for="user_type" class="form-label">Tipo de Usuário</label>
                <select class="form-control" id="user_type" name="user_type" required>
                    <option value="customer" <?php echo e(old('user_type') == 'customer' ? 'selected' : ''); ?>>Cliente</option>
                    <option value="admin" <?php echo e(old('user_type') == 'admin' ? 'selected' : ''); ?>>Administrador</option>
                </select>
            </div>

            <div class="mb-3">
                <label for="password" class="form-label">Senha</label>
                <input type="password" class="form-control" id="password" name="password" required>
            </div>

            <div class="mb-3">
                <label for="password_confirmation" class="form-label">Confirmar Senha</label>
                <input type="password" class="form-control" id="password_confirmation" name="password_confirmation" required>
            </div>

            <button type="submit" class="btn btn-primary">Salvar Cliente</button>
            <a href="<?php echo e(route('clients.index')); ?>" class="btn btn-secondary">Cancelar</a>
        </form>
    <?php endif; ?>
</div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make("layouts.admin", array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\xampp\htdocs\dashboard\licithub\resources\views/admin/clients/create.blade.php ENDPATH**/ ?>
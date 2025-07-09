<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Cadastro</title>
    <?php echo app('Illuminate\Foundation\Vite')(['resources/css/cadastro.css']); ?>
</head>
<body>
    <div class="register-container">
        <div class="register-left">
            <h2>Bem-vindo de volta!</h2>
            <p>Grandes oportunidades nascem de boas escolhas. Faça parte da melhor licitação hoje!</p>
            <a class="signin-button" href="<?php echo e(route('login')); ?>">Entrar</a>
        </div>

        <div class="register-right">
            <h2>Crie Sua Conta</h2>

            <form method="POST" action="<?php echo e(route('register')); ?>">
                <?php echo csrf_field(); ?>

                <input id="name" type="text" name="name" placeholder="Nome Completo" value="<?php echo e(old('name')); ?>" required autofocus>
                <?php $__errorArgs = ['name'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                    <div class="error-message"><?php echo e($message); ?></div>
                <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>

                <input id="email" type="email" name="email" placeholder="Email" value="<?php echo e(old('email')); ?>" required>
                <?php $__errorArgs = ['email'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                    <div class="error-message"><?php echo e($message); ?></div>
                <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>

                <div class="password-container">
                    <input id="password" type="password" name="password" placeholder="Senha" required>
                    <span class="toggle-password" onclick="togglePasswordVisibility('password')"></span>
                </div>
                <?php $__errorArgs = ['password'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                    <div class="error-message"><?php echo e($message); ?></div>
                <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>

                <div class="password-container">
                    <input id="confirm-password" type="password" name="password_confirmation" placeholder="Confirmar Senha" required>
                    <span class="toggle-password" onclick="togglePasswordVisibility('confirm-password')"></span>
                </div>

                <button class="register-button" type="submit">Criar Conta</button>
            </form>
        </div>
    </div>

    <script>
        function togglePasswordVisibility(id) {
            const input = document.getElementById(id);
            const toggle = input.nextElementSibling;

            if (input.type === 'password') {
                input.type = 'text';
                toggle.classList.add('show');
            } else {
                input.type = 'password';
                toggle.classList.remove('show');
            }
        }
    </script>
</body>
</html>
<?php /**PATH C:\xampp\htdocs\dashboard\licithub\resources\views/auth/register.blade.php ENDPATH**/ ?>
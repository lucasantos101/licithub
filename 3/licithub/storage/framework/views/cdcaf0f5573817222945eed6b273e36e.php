<?php $__env->startSection('content'); ?>
<div class="container">
    <div class="row">
        <div class="col-md-3">
            <div class="card">
                <div class="card-header">Clientes Assinantes</div>
                <div class="card-body p-0">
                    <ul class="list-group list-group-flush">
                        <?php $__currentLoopData = $clients; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $client): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <?php if($client->user_type === 'customer' && $client->hasActiveCashierSubscription()): ?>
                                <li class="list-group-item <?php echo e($selectedClient && $selectedClient->id == $client->id ? 'active' : ''); ?>">
                                    <a href="<?php echo e(route('admin.chat', ['client_id' => $client->id])); ?>" class="d-flex justify-content-between align-items-center">
                                        <?php echo e($client->name); ?>

                                        <?php if($client->unread_count > 0): ?>
                                            <span class="badge bg-primary rounded-pill"><?php echo e($client->unread_count); ?></span>
                                        <?php endif; ?>
                                    </a>
                                </li>
                            <?php endif; ?>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </ul>
                </div>
            </div>
        </div>
        <div class="col-md-9">
            <div class="card">
                <div class="card-header">
                    <?php if($selectedClient): ?>
                        Chat com <?php echo e($selectedClient->name); ?>

                    <?php else: ?>
                        Selecione um cliente para iniciar o chat
                    <?php endif; ?>
                </div>
                <div class="card-body">
                    <?php if($selectedClient): ?>
                        <div class="chat-messages" id="chat-messages" style="height: 400px; overflow-y: auto;">
                            <?php $__currentLoopData = $messages; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $message): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <div class="message mb-3 <?php echo e($message->from_user_id == Auth::id() ? 'text-end' : 'text-start'); ?>">
                                    <div class="message-content p-2 d-inline-block <?php echo e($message->from_user_id == Auth::id() ? 'bg-primary text-white' : 'bg-light'); ?>" style="border-radius: 10px; max-width: 80%;">
                                        <?php echo e($message->message); ?>

                                        <div class="message-time small text-<?php echo e($message->from_user_id == Auth::id() ? 'light' : 'muted'); ?>">
                                            <?php echo e($message->created_at->format('H:i')); ?>

                                            <?php if($message->from_user_id == Auth::id() && $message->is_read): ?>
                                                <i class="fas fa-check-double"></i>
                                            <?php endif; ?>
                                        </div>
                                    </div>
                                </div>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </div>
                        <form action="<?php echo e(route('admin.chat.send')); ?>" method="POST" class="mt-3">
                            <?php echo csrf_field(); ?>
                            <input type="hidden" name="to_user_id" value="<?php echo e($selectedClient->id); ?>">
                            <div class="input-group">
                                <input type="text" name="message" class="form-control" placeholder="Digite sua mensagem..." required>
                                <button type="submit" class="btn btn-primary">Enviar</button>
                            </div>
                        </form>
                    <?php else: ?>
                        <p class="text-center">Selecione um cliente para iniciar o chat.</p>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </div>
</div>

<?php if($selectedClient): ?>
<script>
    // Rolar para o final das mensagens
    document.addEventListener('DOMContentLoaded', function() {
        const chatMessages = document.getElementById('chat-messages');
        chatMessages.scrollTop = chatMessages.scrollHeight;
        
        // Configurar polling para novas mensagens
        let lastMessageId = <?php echo e($messages->count() ? $messages->last()->id : 0); ?>;
        
        setInterval(function() {
            fetch(`<?php echo e(route('admin.chat.new-messages')); ?>?client_id=<?php echo e($selectedClient->id); ?>&last_message_id=${lastMessageId}`, {
                headers: {
                    'X-Requested-With': 'XMLHttpRequest',
                    'X-CSRF-TOKEN': '<?php echo e(csrf_token()); ?>'
                }
            })
            .then(response => response.json())
            .then(data => {
                if (data.messages.length > 0) {
                    data.messages.forEach(message => {
                        const messageDiv = document.createElement('div');
                        messageDiv.className = `message mb-3 ${message.from_user_id == <?php echo e(Auth::id()); ?> ? 'text-end' : 'text-start'}`;
                        
                        const messageContent = document.createElement('div');
                        messageContent.className = `message-content p-2 d-inline-block ${message.from_user_id == <?php echo e(Auth::id()); ?> ? 'bg-primary text-white' : 'bg-light'}`;
                        messageContent.style.borderRadius = '10px';
                        messageContent.style.maxWidth = '80%';
                        messageContent.textContent = message.message;
                        
                        const messageTime = document.createElement('div');
                        messageTime.className = `message-time small text-${message.from_user_id == <?php echo e(Auth::id()); ?> ? 'white' : 'muted'}`;
                        
                        // Formatar a data
                        const date = new Date(message.created_at);
                        const hours = date.getHours().toString().padStart(2, '0');
                        const minutes = date.getMinutes().toString().padStart(2, '0');
                        messageTime.textContent = `${hours}:${minutes}`;
                        
                        messageContent.appendChild(messageTime);
                        messageDiv.appendChild(messageContent);
                        chatMessages.appendChild(messageDiv);
                    });
                    
                    // Atualizar o último ID de mensagem
                    lastMessageId = data.last_id;
                    
                    // Rolar para o final
                    chatMessages.scrollTop = chatMessages.scrollHeight;
                }
            });
        }, 5000); // Verificar a cada 5 segundos
    });
</script>
<?php endif; ?>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.admin', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\xampp\htdocs\dashboard\licithub\resources\views/admin/chat/index.blade.php ENDPATH**/ ?>
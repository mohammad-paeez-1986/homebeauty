<div id="toast-container" class="fixed bottom-4 right-4 z-50 space-y-2"></div>
<script>
    document.addEventListener('livewire:initialized', () => {
        Livewire.on('alert', (data) => {
            showToast(data.message, data.type);
        });

        function showToast(message, type = 'success') {
            const container = document.getElementById('toast-container');
            const toast = document.createElement('div');

            // Style based on type
            const colors = {
                success: 'bg-green-500',
                error: 'bg-red-500',
                warning: 'bg-yellow-500',
                info: 'bg-blue-500'
            };

            toast.className =
                `${colors[type] || colors.success} text-white px-4 py-2 rounded-lg shadow-lg mb-2 transition-all duration-300 transform translate-x-0`;
            toast.innerHTML = `
                <div class="flex items-center gap-2">
                    <span>${message}</span>
                    <button onclick="this.parentElement.parentElement.remove()" class="text-white hover:text-gray-200">×</button>
                </div>
            `;

            container.appendChild(toast);

            // Auto remove after 3 seconds
            setTimeout(() => {
                toast.style.opacity = '0';
                setTimeout(() => toast.remove(), 300);
            }, 3000);
        }

        @if (session()->has('message'))
            showToast(@json(session('message')), 'success');
        @endif
    })
</script>

<!DOCTYPE html>
<html lang="pt-br">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">
        <title>LevelUp Briefing — WebSpaceship</title>
        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;600;700;800&display=swap" rel="stylesheet">
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    </head>
    <body style="font-family: 'Inter', sans-serif;">
{{ $slot }}

    <script>
        const STORAGE_KEY = 'levelup_briefing_autosave';

        document.addEventListener('livewire:initialized', () => {
            const saved = localStorage.getItem(STORAGE_KEY);
            if (saved) {
                try {
                    const data = JSON.parse(saved);
                    if (Object.keys(data).length > 0) {
                        Livewire.getByName('briefing-form')[0].call('restoreFromStorage', data);
                    }
                } catch(e) {}
            }

            Livewire.on('autosave', (data) => {
                localStorage.setItem(STORAGE_KEY, JSON.stringify(data[0]));
                showSaveBadge();
            });

            Livewire.on('formSubmitted', () => {
                localStorage.removeItem(STORAGE_KEY);
            });
        });

        function showSaveBadge() {
            const badge = document.getElementById('autosave-badge');
            if (!badge) return;
            badge.style.opacity = '1';
            badge.style.display = 'flex';
            clearTimeout(window._saveTimer);
            window._saveTimer = setTimeout(() => {
                badge.style.opacity = '0';
                setTimeout(() => badge.style.display = 'none', 500);
            }, 2000);
        }
            if ('serviceWorker' in navigator) {
                navigator.serviceWorker.getRegistrations().then(registrations => {
                    registrations.forEach(r => r.unregister());
                });
            }
        </script>        
    </body>
</html>
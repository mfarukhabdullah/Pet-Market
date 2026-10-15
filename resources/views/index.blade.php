<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" data-theme="light">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Pet Marketplace</title>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <!-- SEO Meta Tags -->
    <meta name="description" content="Trusted pet marketplace connecting responsible buyers, sellers, breeders, and pet businesses.">
    <!-- Google Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Outfit:wght@500;600;700;800&family=Plus+Jakarta+Sans:wght@400;500;600;700;800&family=Manrope:wght@400;500;600;700;800&family=DM+Sans:wght@400;500;700&display=swap" rel="stylesheet">
    <!-- FontAwesome Icons -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <!-- Custom CSS -->
    <link rel="stylesheet" href="{{ asset('css/pet-style.css') }}">
    <link rel="stylesheet" href="{{ asset('css/home.css') }}">
    <script>
        if ('scrollRestoration' in history) {
            history.scrollRestoration = 'manual';
        }
        // Force hero section (top: 0) on page refresh / reload
        try {
            const nav = window.performance.getEntriesByType('navigation');
            const isReload = (nav && nav.length > 0 && nav[0].type === 'reload') || (window.performance && window.performance.navigation && window.performance.navigation.type === 1);
            if (isReload) {
                if (window.location.hash) {
                    history.replaceState(null, document.title, window.location.pathname + window.location.search);
                }
                window.scrollTo(0, 0);
            }
        } catch(e) {}

        window.addEventListener('beforeunload', function() {
            window.scrollTo(0, 0);
        });

        window.addEventListener('pageshow', function(e) {
            const nav = window.performance.getEntriesByType('navigation');
            const isReload = (nav && nav.length > 0 && nav[0].type === 'reload') || (window.performance && window.performance.navigation && window.performance.navigation.type === 1);
            if (isReload || !window.location.hash) {
                window.scrollTo(0, 0);
            }
        });
    </script>
</head>
<body>

    <!-- HEADER COMPONENT -->
    <x-header />

    <!-- PAGE BODY SHELL -->
    @include('home')

    <!-- FOOTER COMPONENT -->
    <x-footer />

    <!-- Custom JavaScript -->
    <script src="{{ asset('js/pet-script.js') }}"></script>
</body>
</html>

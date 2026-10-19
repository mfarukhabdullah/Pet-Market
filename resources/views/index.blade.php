<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" data-theme="light">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    {{-- USER PROMPT: "yer admin pannel bnao or seo related ho or jo cheezain user id ky ilawa hain un ko dynamick ro or side main un ky alag alag tab bnao" --}}
    <title>{{ \App\Models\SiteSetting::get('seo_meta_title', 'Pet Marketplace - Buy & Sell Verified Pets in Pakistan') }}</title>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <!-- Dynamic SEO Meta Tags -->
    <meta name="description" content="{{ \App\Models\SiteSetting::get('seo_meta_description', 'Discover verified dogs, cats, birds, and exotic pets from trusted breeders.') }}">
    <meta name="keywords" content="{{ \App\Models\SiteSetting::get('seo_meta_keywords', 'pets pakistan, dogs lahore, cats karachi') }}">
    <meta name="robots" content="{{ \App\Models\SiteSetting::get('seo_robots', 'index, follow') }}">
    <link rel="canonical" href="{{ \App\Models\SiteSetting::get('seo_canonical_base', url('/')) }}">

    <!-- OpenGraph Social Sharing -->
    <meta property="og:title" content="{{ \App\Models\SiteSetting::get('seo_og_title', \App\Models\SiteSetting::get('seo_meta_title')) }}">
    <meta property="og:description" content="{{ \App\Models\SiteSetting::get('seo_og_description', \App\Models\SiteSetting::get('seo_meta_description')) }}">
    <meta property="og:image" content="{{ asset(\App\Models\SiteSetting::get('seo_og_image', 'images/seller-profile-hero.jpg')) }}">
    <meta property="og:type" content="website">

    {!! \App\Models\SiteSetting::get('seo_header_scripts', '') !!}
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
        {{-- USER PROMPT: "when i click on these option it scrool up to curent page ... i want that when i click on any of these opton it directly goes to pet card no scrol up no scrool down" --}}
        {{-- Fix: Removed beforeunload scrollTo(0,0) so page navigation does not trigger a scroll-up on the current page --}}
        if ('scrollRestoration' in history) {
            history.scrollRestoration = 'manual';
        }
        // Force hero section (top: 0) on page refresh / reload only
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

        window.addEventListener('pageshow', function(e) {
            const nav = window.performance.getEntriesByType('navigation');
            const isReload = (nav && nav.length > 0 && nav[0].type === 'reload') || (window.performance && window.performance.navigation && window.performance.navigation.type === 1);
            if (isReload) {
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

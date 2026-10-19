<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" data-theme="light">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    {{-- USER PROMPT: "yr idher robot tag do roebot text ni" --}}
    <meta name="robots" content="{{ \App\Models\SiteSetting::get('seo_robots', 'index, follow') }}">
    <meta name="description" content="Golden Retriever puppy, 2 months, male, vaccinated and dewormed. View pet details, health information and contact the verified seller in Lahore.">
    <!-- Google Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Outfit:wght@500;600;700;800&family=Plus+Jakarta+Sans:wght@400;500;600;700;800&family=Manrope:wght@400;500;600;700;800&family=DM+Sans:wght@400;500;700&display=swap" rel="stylesheet">
    <!-- FontAwesome Icons -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <!-- Custom CSS -->
    <link rel="stylesheet" href="{{ asset('css/pet-style.css') }}">
    <style>
        /* USER PROMPT: "mera pet detail page k cards ko bhi set kro" */
        /* ===== Shared section + card styles (matching home & category cards) ===== */
        .my-sec-title { font-family: 'Outfit', sans-serif; font-size: 2rem; font-weight: 700; color: #0F172A; margin-bottom: 10px; }
        .my-sec-desc { color: #64748B; font-size: 16px; font-weight: 400; line-height: 24px; margin-bottom: 40px; }
        /* USER PROMPT: "decrease margin bottom it is very much" */
        .my-pets-grid { display: grid; grid-template-columns: repeat(4, 1fr); gap: 24px; margin-bottom: 0; }
        .my-pet-card { background: #fff; border-radius: 12px; overflow: hidden; box-shadow: 0 10px 25px rgba(0,0,0,0.15); border: none; transition: 0.3s; cursor: pointer; position: relative; text-decoration: none; color: inherit; display: flex; flex-direction: column; margin-bottom: 10px; }
        .my-pet-card:hover { transform: translateY(-5px); box-shadow: 0 15px 30px rgba(0,0,0,0.18); }
        .my-pet-img { width: 100%; height: 236px; object-fit: cover; display: block; border-radius: 12px 12px 0 0; }
        .my-badge { position: absolute; top: 12px; left: 12px; background: #FADFA7; color: #161616; padding: 4px 10px; border-radius: 6px; font-size: 9px; font-weight: 800; text-transform: uppercase; letter-spacing: 0.5px; z-index: 5; line-height: normal; }
        .my-pet-fav { position: absolute; top: 12px; right: 12px; background: white; width: 28px; height: 28px; border-radius: 50%; display: flex; align-items: center; justify-content: center; color: #94a3b8; font-size: 12px; cursor: pointer; transition: 0.2s ease; z-index: 10; border: none; }
        .my-pet-fav i { color: #94a3b8; transition: color 0.2s ease, transform 0.2s ease; }
        .my-pet-fav:hover i { color: #ff4b68; transform: scale(1.15); }
        .my-pet-fav.active i, .my-pet-fav.favorited i { color: #ff4b68 !important; }
        .my-pet-info { padding: 16px; flex: 1; display: flex; flex-direction: column; }
        .my-pet-title { font-family: 'Outfit', sans-serif; font-size: 16px; font-weight: 700; color: #0F172A; margin: 0 0 2px; line-height: 1.3; display: -webkit-box; -webkit-line-clamp: 2; -webkit-box-orient: vertical; overflow: hidden; min-height: 42px; }
        .my-pet-breed { font-size: 12px; color: #64748B; margin: 0 0 12px; white-space: nowrap; overflow: hidden; text-overflow: ellipsis; }
        .my-pet-price { font-family: 'Outfit', sans-serif; font-size: 18px; font-weight: 800; color: #0C5E3A; margin-bottom: 14px; }
        .my-pet-meta, .my-pet-loc { display: flex; align-items: center; justify-content: flex-start; gap: 16px; font-size: 12px; color: #64748B; border: none; padding: 0; margin-bottom: 6px; }
        .my-pet-loc { margin-bottom: 0; flex-wrap: wrap; }
        .my-pet-meta span, .my-pet-loc span { display: inline-flex; align-items: center; gap: 6px; color: #64748B; }
        .my-pet-meta i, .my-pet-loc i { color: #64748B; font-size: 12px; margin-right: 0; }

        /* USER PROMPT: "decrease margin bottom it is very much" */
        .pd-page { background: #FBF8F3; padding: 24px 0 35px; }
        .pd-wrap { width: 100%; max-width: 1200px; margin: 0 auto; }
        .pd-card { background: #FFFFFF; border-radius: 16px; box-shadow: 0 6px 24px rgba(17, 24, 39, 0.06); border: 1px solid #F1ECE3; box-sizing: border-box; }

        /* Row 1: Gallery + Summary */
        .pd-top { display: grid; grid-template-columns: 1fr 580px; gap: 20px; align-items: stretch; }
        .pd-gallery { padding: 16px; display: flex; flex-direction: column; }
        .pd-main-img { width: 100%; height: 380px; flex: 1 0 380px; object-fit: cover; object-position: center 30%; border-radius: 12px; display: block; transition: opacity 0.25s ease; }
        .pd-thumbs { display: grid; grid-template-columns: repeat(5, 1fr); gap: 12px; margin-top: 12px; }
        .pd-thumb { width: 100%; height: 78px; object-fit: cover; border-radius: 8px; cursor: pointer; border: 2px solid transparent; opacity: 0.8; transition: 0.2s; box-sizing: border-box; }
        .pd-thumb:hover { opacity: 1; }
        .pd-thumb.active { border-color: #147A4D; opacity: 1; }

        .pd-summary { padding: 24px; display: flex; flex-direction: column; justify-content: space-between; }
        .pd-sum-head { display: flex; justify-content: space-between; align-items: flex-start; gap: 16px; }
        .pd-title { font-family: 'Manrope', sans-serif; font-size: 34px; font-weight: 700; color: #17211C; line-height: 42px; margin: 0; }
        .pd-icon-btns { display: flex; gap: 4px; }
        .pd-icon-btn { width: 36px; height: 36px; border-radius: 10px; border: 1px solid #E5E7EB; background: #fff; color: #4B5563; display: flex; align-items: center; justify-content: center; cursor: pointer; font-size: 14px; transition: 0.2s; }
        .pd-icon-btn:hover { border-color: #147A4D; color: #147A4D; }
        .pd-icon-btn.liked { color: #E11D48; border-color: #FBCFE8; background: #FFF1F2; }
        .pd-icon-btn.liked i { color: #E11D48; }
        #pdShareBtn { color: #4B5563; }
        #pdShareBtn i { color: #4B5563; }
        #pdShareBtn:hover { border-color: #147A4D; color: #147A4D; }
        #pdShareBtn:hover i { color: #147A4D; }
        .pd-price { font-family: 'Outfit', sans-serif; font-size: 28px; font-weight: 800; color: #147A4D; margin: 8px 0 8px; }
        .pd-sub-meta { display: flex; gap: 18px; font-size: 13px; color: #6B7280; margin-bottom: 16px; }
        .pd-sub-meta i { margin-right: 5px; }
        .pd-attr-grid { display: grid; grid-template-columns: 1fr 1fr; gap: 10px; margin-bottom: 16px; }
        .pd-attr { background: #FAFAF8; border-radius: 13px; border: 1px solid #E2E7E3; padding: 14px 16px; box-sizing: border-box; }
        .pd-attr span { display: block; font-size: 10px; font-weight: 700; color: #147A4D; letter-spacing: 0.5px; text-transform: uppercase; margin-bottom: 4px; }
        .pd-attr strong { display: block; font-family: 'DM Sans', sans-serif; font-size: 16px; font-weight: 700; color: #17211C; line-height: 21.7px; }
        .pd-btn-row { display: grid; grid-template-columns: 1fr 1fr; gap: 12px; margin-bottom: 14px; }
        .pd-btn { height: 56px; border-radius: 8px; font-size: 15px; font-weight: 600; display: flex; align-items: center; justify-content: center; gap: 8px; cursor: pointer; text-decoration: none; box-sizing: border-box; transition: 0.2s; font-family: inherit; box-shadow: 0 2px 7px rgba(0, 0, 0, 0.1); }
        .pd-btn-primary { background: #147A4D; color: #fff; border: 1px solid #147A4D; }
        .pd-btn-primary:hover { background: #0E6B40; }
        .pd-btn-outline { background: #fff; color: #161616; border: 1px solid #282828; }
        .pd-btn-outline:hover { border-color: #147A4D; color: #147A4D; }
        .pd-verify-note { background: #EAF7F0; border-radius: 10px; padding: 14px 16px; display: flex; gap: 10px; align-items: flex-start; font-size: 13px; color: #1F2937; line-height: 20px; }
        .pd-verify-note i { color: #147A4D; margin-top: 3px; }

        /* Row 2: Details + Sidebar */
        .pd-mid { display: grid; grid-template-columns: 1fr 370px; gap: 20px; margin-top: 40px; align-items: start; }
        .pd-details { padding: 30px; }
        .pd-h3 { font-family: 'Outfit', sans-serif; font-size: 20px; font-weight: 700; color: #161616; margin: 0 0 18px; }
        .pd-table { display: grid; grid-template-columns: 1fr 1fr; column-gap: 40px; }
        .pd-row { display: flex; justify-content: space-between; padding: 14px 0; border-bottom: 1px solid #EFEFEF; font-size: 14px; }
        .pd-row span { color: #4B5563; }
        .pd-row strong { color: #161616; font-weight: 700; }
        .pd-divider { height: 1px; background: #EFEFEF; margin: 30px 0; border: none; }
        .pd-health-grid { display: grid; grid-template-columns: 1fr 1fr; gap: 14px; }
        .pd-health { background: #F6F3EB; border-radius: 12px; padding: 18px 20px; display: flex; gap: 14px; align-items: flex-start; }
        .pd-health-icon { color: #147A4D; font-size: 18px; margin-top: 1px; }
        .pd-health strong { display: block; font-size: 14px; font-weight: 700; color: #161616; margin-bottom: 6px; }
        .pd-health span { font-size: 13px; color: #161616; line-height: 1.4; }
        .pd-desc { font-size: 15px; color: #202020; line-height: 26px; margin: 0; text-align: justify; }

        .pd-side { display: flex; flex-direction: column; gap: 20px; }
        .pd-seller { padding: 24px; }
        .pd-seller-head { display: flex; align-items: center; gap: 12px; margin-bottom: 16px; }
        .pd-avatar { width: 52px; height: 52px; border-radius: 50%; object-fit: cover; }
        .pd-seller-name { font-size: 17px; font-weight: 700; color: #161616; display: flex; align-items: center; gap: 6px; }
        .pd-seller-name i { color: #147A4D; font-size: 14px; }
        .pd-seller-type { font-size: 12px; color: #6B7280; }
        .pd-seller-meta { display: flex; flex-direction: column; gap: 8px; font-size: 13px; color: #4B5563; margin-bottom: 18px; }
        .pd-seller-meta i { width: 16px; color: #6B7280; margin-right: 6px; }
        .pd-seller .pd-btn { width: 100%; margin-bottom: 10px; height: 46px; }
        .pd-report { display: flex; align-items: center; justify-content: center; gap: 6px; color: #DC2626; font-size: 13px; font-weight: 600; text-decoration: none; margin-top: 6px; }
        .pd-report:hover { text-decoration: underline; }
        .pd-safety { background: #F7EFE2; border-radius: 16px; padding: 24px; }
        .pd-safety h3 { font-family: 'Outfit', sans-serif; font-size: 20px; font-weight: 700; color: #161616; margin: 0 0 12px; }
        .pd-safety p { font-size: 14px; color: #161616; line-height: 22px; margin: 0 0 20px; }
        .pd-safety ul { list-style: none; padding: 0; margin: 0; display: flex; flex-direction: column; gap: 16px; }
        .pd-safety li { display: flex; gap: 10px; font-size: 14px; color: #161616; line-height: 22px; align-items: flex-start; }
        .pd-safety li i { color: #000000; font-size: 13px; line-height: 13px; margin-top: 4px; }

        /* Listings sections */
        /* USER PROMPT: "decrease margin bottom it is very much" */
        .pd-listings { margin-top: 60px; margin-bottom: 0; }
        .pd-listings .my-sec-title { font-size: 28px; margin-bottom: 8px; }
        .pd-listings .my-sec-desc { margin-bottom: 30px; }

        @media (max-width: 1240px) {
            .pd-wrap { padding: 0 20px; box-sizing: border-box; }
        }
        @media (max-width: 1100px) {
            .pd-top, .pd-mid { grid-template-columns: 1fr; }
            .my-pets-grid { grid-template-columns: repeat(2, 1fr); }
        }
        @media (max-width: 768px) {
            .pd-wrap { padding: 0 16px; }
            .pd-summary { padding: 16px; justify-content: flex-start; gap: 4px; }
            .pd-title { font-size: 24px; line-height: 30px; }
            .pd-price { font-size: 24px; margin: 12px 0; }
            .pd-attr { padding: 14px 10px; }
            .pd-attr strong { white-space: nowrap; overflow: hidden; text-overflow: ellipsis; }
            .pd-btn-row { grid-template-columns: 1fr; gap: 12px; }
            .pd-thumbs { grid-template-columns: repeat(4, 1fr); gap: 10px; margin-top: 12px; }
            .pd-thumbs img:nth-child(n+5) { display: none; }
            .pd-main-img { height: 347px; flex: none; }
            .pd-thumb { height: auto; aspect-ratio: 1 / 1; }
            .pd-top { gap: 16px; }
            .pd-table, .pd-health-grid { grid-template-columns: 1fr; }
            .pd-divider { display: none; }
            .pd-desc-box { border: 1px solid #E5E7EB; border-radius: 12px; padding: 16px; margin-top: 24px; margin-bottom: 24px; }
            .pd-desc-box .pd-h3 { margin-top: 0; }
            .pd-side { display: flex; flex-direction: column; gap: 20px; }
            .pd-safety { order: -1; margin-top: 0; }
            .pd-seller { margin-top: 0; }
            .pd-card { padding: 16px; }

            /* Horizontal Scroll for Cards */
            /* USER PROMPT: "decrease margin bottom it is very much" */
            .my-pets-grid { 
                display: flex; 
                flex-wrap: nowrap; 
                overflow-x: auto; 
                gap: 16px; 
                padding-bottom: 12px; 
                margin-bottom: 10px;
                scroll-snap-type: x mandatory; 
                -webkit-overflow-scrolling: touch;
                scrollbar-width: none;
                -ms-overflow-style: none;
            }
            .my-pets-grid::-webkit-scrollbar { display: none; }
            /* USER PROMPT: "decrease margin bottom it is very much" */
            .my-pets-grid .my-pet-card {
                flex: 0 0 calc(50% - 8px); 
                scroll-snap-align: start;
                border-radius: 12px;
                margin-bottom: 4px;
            }
            .my-pets-grid .my-pet-img { height: 160px; }
            .my-pets-grid .my-pet-info { padding: 10px 10px 12px; }
            .my-pets-grid .my-pet-title { font-size: 13.5px; min-height: 34px; margin-bottom: 2px; }
            .my-pets-grid .my-pet-breed { font-size: 11px; margin-bottom: 6px; }
            .my-pets-grid .my-pet-price { font-size: 15px; margin-bottom: 8px; }
            .my-pets-grid .my-pet-meta,
            .my-pets-grid .my-pet-loc {
                display: flex;
                align-items: center;
                justify-content: flex-start;
                gap: 12px;
                font-size: 11px;
                line-height: 14px;
                color: #64748B;
                margin-bottom: 5px;
                padding: 0;
                border: none;
                flex-wrap: wrap;
                row-gap: 3px;
            }
            .my-pets-grid .my-pet-loc { margin-bottom: 0; padding-top: 0; }
            .my-pets-grid .my-pet-meta span,
            .my-pets-grid .my-pet-loc span {
                display: inline-flex;
                align-items: center;
                gap: 4px;
                white-space: nowrap;
                color: #64748B;
            }
            .my-pets-grid .my-pet-meta i,
            .my-pets-grid .my-pet-loc i {
                color: #64748B;
                font-size: 11px;
                margin-right: 0;
            }
        }

        /* Modal Backdrop & Report Styling */
        .modal-backdrop {
            position: fixed;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background: rgba(0, 0, 0, 0.5);
            display: none;
            align-items: center;
            justify-content: center;
            z-index: 10000;
        }
        .modal-backdrop.show {
            display: flex;
        }
        .modal-close-icon {
            position: absolute;
            top: 16px;
            right: 16px;
            background: none;
            border: none;
            font-size: 18px;
            color: #6b7280;
            cursor: pointer;
        }
        .report-modal-card {
            background: #ffffff;
            border-radius: 20px;
            padding: 24px 28px 28px 28px;
            width: 90%;
            max-width: 440px;
            position: relative;
            box-shadow: 0 20px 25px -5px rgba(0, 0, 0, 0.15);
            max-height: 90vh;
            overflow: hidden;
            display: flex;
            flex-direction: column;
        }
        .report-modal-title {
            font-size: 20px;
            font-weight: 700;
            color: #111827;
            margin-bottom: 18px;
            padding-right: 24px;
        }
        .report-reasons-list {
            display: flex;
            flex-direction: column;
            gap: 14px;
            max-height: 280px;
            overflow-y: auto;
            padding-right: 6px;
            margin-bottom: 18px;
        }
        .report-reasons-list::-webkit-scrollbar {
            width: 5px;
        }
        .report-reasons-list::-webkit-scrollbar-thumb {
            background: #cbd5e1;
            border-radius: 4px;
        }
        .report-reason-option {
            display: flex;
            align-items: center;
            gap: 12px;
            cursor: pointer;
            font-size: 14px;
            font-weight: 500;
            color: #1f2937;
        }
        .report-reason-option input[type="radio"] {
            accent-color: #128c5a;
            width: 18px;
            height: 18px;
            cursor: pointer;
            flex-shrink: 0;
        }
        .report-textarea {
            width: 100%;
            border: 1px solid #d1d5db;
            border-radius: 12px;
            padding: 12px 14px;
            font-size: 14px;
            outline: none;
            resize: none;
            height: 80px;
            margin-bottom: 20px;
            font-family: inherit;
            box-sizing: border-box;
        }
        .report-textarea:focus {
            border-color: #128c5a;
        }
        .btn-submit-report {
            background-color: #128c5a;
            color: white;
            border: none;
            border-radius: 10px;
            padding: 14px 24px;
            font-size: 15px;
            font-weight: 700;
            cursor: pointer;
            width: 100%;
            display: block;
            text-align: center;
        }
        .btn-submit-report:hover {
            background-color: #0f764a;
        }
    </style>
</head>
<body>

    <!-- HEADER COMPONENT -->
    <x-header />

    <main class="site-wrapper pd-page">
        <div class="pd-wrap">

            <!-- ROW 1: GALLERY + SUMMARY -->
            <section class="pd-top">
                <!-- Gallery -->
                <div class="pd-card pd-gallery">
                    <img id="pdMainImg" class="pd-main-img" src="{{ $listing->primary_image_url }}" alt="{{ $listing->title }}" onerror="this.src='{{ asset('images/pets/golden-retriever.jpg') }}'">
                    <div class="pd-thumbs">
                        @if($listing->images && $listing->images->isNotEmpty())
                            @foreach($listing->images as $img)
                                <img class="pd-thumb {{ $loop->first ? 'active' : '' }}" src="{{ $img->image_url }}" alt="{{ $listing->title }} photo {{ $loop->iteration }}" onerror="this.src='{{ asset('images/pets/golden-retriever.jpg') }}'">
                            @endforeach
                        @else
                            <img class="pd-thumb active" src="{{ $listing->primary_image_url }}" alt="{{ $listing->title }}" onerror="this.src='{{ asset('images/pets/golden-retriever.jpg') }}'">
                        @endif
                    </div>
                </div>

                <!-- Summary -->
                <div class="pd-card pd-summary">
                    <div class="pd-sum-head">
                        <h1 class="pd-title">{{ $listing->title }}</h1>
                        <div class="pd-icon-btns">
                            @php
                                $currentUser = auth()->user();
                                $isFavorited = $currentUser ? $currentUser->hasFavorited($listing->id) : false;
                            @endphp
                            <button type="button" 
                                    id="pdLikeBtn" 
                                    class="pd-icon-btn {{ $isFavorited ? 'liked active favorited' : '' }}" 
                                    data-url="{{ route('favorites.toggle', ['listingId' => $listing->id]) }}" 
                                    data-id="{{ $listing->id }}"
                                    aria-label="Save to favourites"
                                    title="{{ $isFavorited ? 'Remove from favorites' : 'Save to favorites' }}">
                                <i class="{{ $isFavorited ? 'fa-solid fa-heart' : 'fa-regular fa-heart' }}" style="{{ $isFavorited ? 'color: #E11D48;' : '' }}"></i>
                            </button>
                            <button type="button" 
                                    id="pdShareBtn" 
                                    class="pd-icon-btn" 
                                    aria-label="Share listing"
                                    title="Share listing">
                                <i class="fa-solid fa-share-nodes"></i>
                            </button>
                        </div>
                    </div>
                    <div class="pd-price">{{ $listing->formatted_price }}</div>
                    <div class="pd-sub-meta">
                        <span><i class="fa-solid fa-location-dot"></i>{{ $listing->city }}</span>
                        <span><i class="fa-regular fa-clock"></i>Posted {{ $listing->created_at->diffForHumans() }}</span>
                        <span><i class="fa-regular fa-eye"></i>{{ $listing->views_count }} views</span>
                    </div>
                    <div class="pd-attr-grid">
                        <div class="pd-attr"><span>Breed</span><strong>{{ $listing->breed_name ?: ($listing->breed ? $listing->breed->name : 'N/A') }}</strong></div>
                        <div class="pd-attr"><span>Age</span><strong>{{ $listing->age_text }}</strong></div>
                        <div class="pd-attr"><span>Gender</span><strong>{{ ucfirst($listing->gender) }}</strong></div>
                        <div class="pd-attr"><span>Color</span><strong>{{ $listing->color ?: 'Standard' }}</strong></div>
                    </div>
                    <div class="pd-btn-row">
                        @if(auth()->check())
                            <a href="{{ route('chat.start', ['listingId' => $listing->id]) }}" id="pdSendMsgBtn" class="pd-btn pd-btn-primary"><i class="fa-regular fa-message"></i> Send Message</a>
                        @else
                            <a href="{{ route('sign') }}?redirect={{ urlencode(route('chat.start', ['listingId' => $listing->id])) }}" id="pdSendMsgBtn" class="pd-btn pd-btn-primary"><i class="fa-regular fa-message"></i> Send Message</a>
                        @endif
                        <a href="tel:{{ $listing->masked_phone }}" id="pdContactBtn" class="pd-btn pd-btn-outline"><i class="fa-solid fa-phone"></i> {{ $listing->masked_phone }}</a>
                    </div>
                    <div class="pd-verify-note">
                        <i class="fa-solid fa-circle-check"></i>
                        <span>Verify the animal, seller and health documentation before completing a transaction.</span>
                    </div>
                </div>
            </section>

            <!-- ROW 2: DETAILS + SIDEBAR -->
            <section class="pd-mid">
                <div class="pd-card pd-details">
                    <!-- Pet Details -->
                    <h2 class="pd-h3">Pet Details</h2>
                    <div class="pd-table">
                        <div class="pd-row"><span>Category</span><strong>{{ $listing->category ? $listing->category->name : 'General' }}</strong></div>
                        <div class="pd-row"><span>Breed</span><strong>{{ $listing->breed_name ?: ($listing->breed ? $listing->breed->name : 'N/A') }}</strong></div>
                        <div class="pd-row"><span>Age</span><strong>{{ $listing->age_text }}</strong></div>
                        <div class="pd-row"><span>Gender</span><strong>{{ ucfirst($listing->gender) }}</strong></div>
                        <div class="pd-row"><span>Color</span><strong>{{ $listing->color ?: 'Standard' }}</strong></div>
                        <div class="pd-row"><span>Pedigree / Papers</span><strong>{{ $listing->has_papers ? 'Yes' : 'No' }}</strong></div>
                    </div>

                    <hr class="pd-divider">

                    {{-- USER PROMPT: "change this to for fish and reptiles" --}}
                    @php
                        $isExemptCategory = $listing->category && in_array(strtolower($listing->category->slug), ['fish', 'fishes', 'reptile', 'reptiles']);
                        $hasHealthDescription = !$listing->no_health_description && !($isExemptCategory && !$listing->vaccinated && !$listing->dewormed);
                    @endphp
                    @if($hasHealthDescription)
                        <!-- Health Information -->
                        <h2 class="pd-h3">Health Information</h2>
                        <div class="pd-health-grid">
                            <div class="pd-health">
                                <div class="pd-health-icon"><i class="fa-solid fa-syringe"></i></div>
                                <div><strong>Vaccination</strong><span>{{ $listing->vaccinated ? 'Vaccinated' : 'Not Vaccinated' }}</span></div>
                            </div>
                            <div class="pd-health">
                                <div class="pd-health-icon"><i class="fa-solid fa-shield-heart"></i></div>
                                <div><strong>Deworming</strong><span>{{ $listing->dewormed ? 'Completed' : 'Pending' }}</span></div>
                            </div>
                            <div class="pd-health">
                                <div class="pd-health-icon"><i class="fa-solid fa-notes-medical"></i></div>
                                <div><strong>Health Status</strong><span>{{ $listing->vaccinated && $listing->dewormed ? 'Fully Checked' : 'Standard Health' }}</span></div>
                            </div>
                            <div class="pd-health">
                                <div class="pd-health-icon"><i class="fa-solid fa-file-lines"></i></div>
                                <div><strong>Papers</strong><span>{{ $listing->has_papers ? 'Available' : 'Not Available' }}</span></div>
                            </div>
                        </div>

                        <hr class="pd-divider">
                    @endif

                    <!-- Description -->
                    <div class="pd-desc-box">
                        <h2 class="pd-h3">Description</h2>
                        <p class="pd-desc">{{ $listing->description }}</p>
                    </div>
                </div>

                <!-- Sidebar -->
                <aside class="pd-side">
                    <div class="pd-card pd-seller">
                        <a href="{{ route('seller.profile', ['id' => $seller->id]) }}" class="pd-seller-head" style="text-decoration: none; color: inherit; display: flex; align-items: center; gap: 12px;">
                            <img class="pd-avatar" src="{{ $seller->avatar_url }}" alt="{{ $seller->name }}" onerror="this.src='{{ asset('images/seller-avatar.jpg') }}'">
                            <div>
                                <div class="pd-seller-name">{{ $seller->name }} @if($seller->is_verified)<i class="fa-solid fa-circle-check"></i>@endif</div>
                                <div class="pd-seller-type">{{ ucfirst($seller->seller_type) }} Seller</div>
                            </div>
                        </a>
                        <div class="pd-seller-meta">
                            <span><i class="fa-solid fa-location-dot"></i>{{ $seller->city ?: $listing->city }}</span>
                            <span><i class="fa-solid fa-shield-halved"></i>Trust: {{ $seller->trust_score }}%</span>
                            <span><i class="fa-solid fa-paw"></i>{{ $sellerActiveCount }} active ads</span>
                        </div>
                        @if(auth()->check())
                            <a href="{{ route('chat.start', ['listingId' => $listing->id]) }}" id="pdSellerMsgBtn" class="pd-btn pd-btn-primary"><i class="fa-regular fa-message"></i> Send Message</a>
                        @else
                            <a href="{{ route('sign') }}?redirect={{ urlencode(route('chat.start', ['listingId' => $listing->id])) }}" id="pdSellerMsgBtn" class="pd-btn pd-btn-primary"><i class="fa-regular fa-message"></i> Send Message</a>
                        @endif
                        <a href="{{ route('seller.profile', ['id' => $seller->id]) }}" id="pdSellerProfileBtn" class="pd-btn pd-btn-outline"><i class="fa-regular fa-user"></i> View Seller Profile</a>
                        <a href="#" id="pdReportBtn" class="pd-report"><i class="fa-regular fa-flag"></i> Report Listing</a>
                    </div>

                    <div class="pd-safety">
                        <h3>Safety Notice</h3>
                        <p>Take reasonable steps to verify the pet and seller before making a decision.</p>
                        <ul>
                            <li><i class="fa-solid fa-circle-check"></i>Verify the animal and seller.</li>
                            <li><i class="fa-solid fa-circle-check"></i>Check ownership and available health documentation.</li>
                            <li><i class="fa-solid fa-circle-check"></i>Review applicable local legal requirements.</li>
                            <li><i class="fa-solid fa-circle-check"></i>Report suspicious or misleading listings.</li>
                        </ul>
                    </div>
                </aside>
            </section>

            <!-- SELLER'S OTHER LISTINGS -->
            <section class="pd-listings">
                <h2 class="my-sec-title">Seller's Other Listings</h2>
                <p class="my-sec-desc">More active listings from this seller.</p>
                <div class="my-pets-grid">
                    @forelse($sellerOtherListings as $sellerPet)
                        @php
                            $isSellerPetFav = auth()->user() ? auth()->user()->hasFavorited($sellerPet->id) : false;
                        @endphp
                        <a href="{{ route('pet.details', ['slug' => $sellerPet->slug ?: $sellerPet->id]) }}" class="my-pet-card" id="listing-{{ $sellerPet->id }}" style="scroll-margin-top: 100px;">
                            <div style="position: relative;">
                                <img src="{{ $sellerPet->primary_image_url }}" alt="{{ $sellerPet->title }}" class="my-pet-img" onerror="this.src='{{ asset('images/pets/golden-retriever.jpg') }}'">
                                @if($sellerPet->is_featured)
                                    <span class="my-badge">FEATURED</span>
                                @endif
                                <div class="my-pet-fav {{ $isSellerPetFav ? 'active favorited' : '' }}" 
                                     data-id="{{ $sellerPet->id }}" 
                                     data-url="{{ route('favorites.toggle', ['listingId' => $sellerPet->id]) }}"
                                     title="{{ $isSellerPetFav ? 'Remove from favorites' : 'Add to favorites' }}"
                                     aria-label="Add to favorites">
                                    <i class="{{ $isSellerPetFav ? 'fa-solid fa-heart' : 'fa-regular fa-heart' }}" style="{{ $isSellerPetFav ? 'color: #ff4b68;' : '' }}"></i>
                                </div>
                            </div>
                            <div class="my-pet-info">
                                <h3 class="my-pet-title">{{ $sellerPet->title }}</h3>
                                <p class="my-pet-breed">{{ $sellerPet->breed_name ?: ($sellerPet->breed ? $sellerPet->breed->name : 'Pet') }}</p>
                                <div class="my-pet-price">{{ $sellerPet->formatted_price }}</div>
                                {{-- USER PROMPT: "mera pet detail page k cards ko bhi set kro" --}}
                                <div class="my-pet-meta">
                                    <span><i class="fa-regular fa-clock"></i> {{ $sellerPet->age_text }}</span>
                                    <span><i class="fa-solid fa-{{ $sellerPet->gender === 'female' ? 'venus' : 'mars' }}"></i> {{ ucfirst($sellerPet->gender) }}</span>
                                </div>
                                <div class="my-pet-loc">
                                    <span><i class="fa-solid fa-location-dot"></i> {{ $sellerPet->city }}</span>
                                    <span><i class="fa-regular fa-clock"></i> {{ $sellerPet->created_at->diffForHumans() }}</span>
                                </div>
                            </div>
                        </a>
                    @empty
                        <div style="grid-column: 1 / -1; text-align: center; color: #64748b; padding: 20px;">
                            No other active listings from this seller currently.
                        </div>
                    @endforelse
                </div>
            </section>

            <!-- SIMILAR PETS -->
            <section class="pd-listings" style="text-align: center;">
                <h2 class="my-sec-title">Similar Pets</h2>
                <p class="my-sec-desc">Related listings that may also match your search.</p>
                <div class="my-pets-grid" style="text-align: left;">
                    @forelse($similarListings as $similar)
                        <a href="{{ route('pet.details', ['slug' => $similar->slug ?: $similar->id]) }}" class="my-pet-card" id="listing-{{ $similar->id }}" style="scroll-margin-top: 100px;">
                            <div style="position: relative;">
                                <img src="{{ $similar->primary_image_url }}" alt="{{ $similar->title }}" class="my-pet-img" onerror="this.src='{{ asset('images/pets/golden-retriever.jpg') }}'">
                                @if($similar->is_featured)
                                    <span class="my-badge">FEATURED</span>
                                @endif
                                @php
                                    $isSimFav = auth()->user() ? auth()->user()->hasFavorited($similar->id) : false;
                                @endphp
                                <div class="my-pet-fav {{ $isSimFav ? 'active favorited' : '' }}" data-id="{{ $similar->id }}" data-url="{{ route('favorites.toggle', ['listingId' => $similar->id]) }}">
                                    <i class="{{ $isSimFav ? 'fa-solid fa-heart' : 'fa-regular fa-heart' }}" style="{{ $isSimFav ? 'color: #ff4b68;' : '' }}"></i>
                                </div>
                            </div>
                            <div class="my-pet-info">
                                <h3 class="my-pet-title">{{ $similar->title }}</h3>
                                <p class="my-pet-breed">{{ $similar->breed_name ?: ($similar->breed ? $similar->breed->name : 'Pet') }}</p>
                                <div class="my-pet-price">{{ $similar->formatted_price }}</div>
                                {{-- USER PROMPT: "mera pet detail page k cards ko bhi set kro" --}}
                                <div class="my-pet-meta">
                                    <span><i class="fa-regular fa-clock"></i> {{ $similar->age_text }}</span>
                                    <span><i class="fa-solid fa-{{ $similar->gender == 'female' ? 'venus' : 'mars' }}"></i> {{ ucfirst($similar->gender) }}</span>
                                </div>
                                <div class="my-pet-loc">
                                    <span><i class="fa-solid fa-location-dot"></i> {{ $similar->city }}</span>
                                    <span><i class="fa-regular fa-clock"></i> {{ $similar->created_at->diffForHumans() }}</span>
                                </div>
                            </div>
                        </a>
                    @empty
                        <div style="grid-column: 1 / -1; text-align: center; color: #64748b; padding: 20px;">
                            No other similar pets currently listed in this category.
                        </div>
                    @endforelse
                </div>
            </section>

        </div>
    {{-- USER PROMPT: "in my pet detail page give this card some margin bottom like on other pages just do this chnage" --}}
    </main>
    <!-- Report User Modal -->
    <div id="reportModal" class="modal-backdrop">
        <div class="report-modal-card">
            <button type="button" class="modal-close-icon" onclick="closeReportModal()"><i class="fa-solid fa-xmark"></i></button>
            <h3 class="report-modal-title">Report This User</h3>
            <form id="reportUserForm" onsubmit="handleReportSubmit(event)">
                <div class="report-reasons-list">
                    <label class="report-reason-option">
                        <input type="radio" name="report_reason" value="Scam / Fraud" checked>
                        <span>Scam / Fraud</span>
                    </label>
                    <label class="report-reason-option">
                        <input type="radio" name="report_reason" value="Fake Listing or Misleading Product">
                        <span>Fake Listing or Misleading Product</span>
                    </label>
                    <label class="report-reason-option">
                        <input type="radio" name="report_reason" value="Asking for Payment Outside the Platform">
                        <span>Asking for Payment Outside the Platform</span>
                    </label>
                    <label class="report-reason-option">
                        <input type="radio" name="report_reason" value="Spam / Unwanted Messages">
                        <span>Spam / Unwanted Messages</span>
                    </label>
                    <label class="report-reason-option">
                        <input type="radio" name="report_reason" value="Harassment / Abusive Messages">
                        <span>Harassment / Abusive Messages</span>
                    </label>
                    <label class="report-reason-option">
                        <input type="radio" name="report_reason" value="Fake Identity / Impersonation">
                        <span>Fake Identity / Impersonation</span>
                    </label>
                    <label class="report-reason-option">
                        <input type="radio" name="report_reason" value="Suspicious Payment Activity">
                        <span>Suspicious Payment Activity</span>
                    </label>
                    <label class="report-reason-option">
                        <input type="radio" name="report_reason" value="Threats or Blackmail">
                        <span>Threats or Blackmail</span>
                    </label>
                    <label class="report-reason-option">
                        <input type="radio" name="report_reason" value="Sharing Personal Information">
                        <span>Sharing Personal Information</span>
                    </label>
                    <label class="report-reason-option">
                        <input type="radio" name="report_reason" value="Other">
                        <span>Other</span>
                    </label>
                </div>
                <textarea class="report-textarea" id="reportDetailsInput" placeholder="Additional details"></textarea>
                <button type="submit" class="btn-submit-report">Submit Report</button>
            </form>
        </div>
    </div>

    <!-- FOOTER COMPONENT -->
    <x-footer />

    <!-- Custom JavaScript -->
    <script src="{{ asset('js/pet-script.js') }}"></script>
    
    <div id="toast" style="visibility: hidden; min-width: 200px; background-color: #282828; color: #fff; text-align: center; border-radius: 8px; padding: 12px 16px; position: fixed; z-index: 1000; left: 50%; bottom: 30px; font-size: 14px; font-weight: 500; font-family: 'DM Sans', sans-serif; transform: translateX(-50%); box-shadow: 0 4px 12px rgba(0,0,0,0.15); transition: visibility 0s, opacity 0.3s linear; opacity: 0;">
        Copied to clipboard
    </div>

    <script>
        function openReportModal() {
            const modal = document.getElementById('reportModal');
            if (modal) modal.classList.add('show');
        }

        function closeReportModal() {
            const modal = document.getElementById('reportModal');
            if (modal) modal.classList.remove('show');
        }

        function handleReportSubmit(e) {
            if (e) e.preventDefault();
            const reason = document.querySelector('input[name="report_reason"]:checked')?.value || 'Scam / Fraud';
            const details = document.getElementById('reportDetailsInput')?.value || '';
            
            fetch('{{ route('reports.submit') }}', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'Accept': 'application/json',
                    'X-CSRF-TOKEN': '{{ csrf_token() }}'
                },
                body: JSON.stringify({
                    listing_id: {{ $listing->id }},
                    seller_id: {{ $seller->id }},
                    reason: reason,
                    details: details
                })
            }).catch(function(){});

            const detailsInput = document.getElementById('reportDetailsInput');
            if (detailsInput) detailsInput.value = '';
            closeReportModal();
            
            var toast = document.getElementById("toast");
            toast.textContent = "Thank you. Your report has been submitted.";
            toast.style.visibility = "visible";
            toast.style.opacity = "1";
            setTimeout(function(){ 
                toast.style.opacity = "0"; 
                setTimeout(function(){ toast.style.visibility = "hidden"; toast.textContent = "Copied to clipboard"; }, 300);
            }, 3000);
        }

        // Gallery: thumbnail click swaps main image
        (function () {
            const reportBtn = document.getElementById('pdReportBtn');
            if (reportBtn) {
                reportBtn.addEventListener('click', function(e) {
                    e.preventDefault();
                    openReportModal();
                });
            }

            const main = document.getElementById('pdMainImg');
            document.querySelectorAll('.pd-thumb').forEach(function (thumb) {
                thumb.addEventListener('click', function () {
                    document.querySelectorAll('.pd-thumb').forEach(t => t.classList.remove('active'));
                    thumb.classList.add('active');
                    main.style.opacity = '0';
                    setTimeout(function () { main.src = thumb.src; main.style.opacity = '1'; }, 200);
                });
            });

            // Favourite toggle
            const like = document.getElementById('pdLikeBtn');
            if (like) {
                like.addEventListener('click', function (e) {
                    e.preventDefault();
                    e.stopPropagation();

                    const icon = like.querySelector('i');
                    const isLiked = like.classList.contains('liked');
                    const url = like.getAttribute('data-url');

                    if (isLiked) {
                        like.classList.remove('liked', 'active', 'favorited');
                        if (icon) {
                            icon.className = 'fa-regular fa-heart';
                            icon.style.color = '';
                        }
                        like.setAttribute('title', 'Save to favorites');
                    } else {
                        like.classList.add('liked', 'active', 'favorited');
                        if (icon) {
                            icon.className = 'fa-solid fa-heart';
                            icon.style.color = '#E11D48';
                        }
                        like.setAttribute('title', 'Remove from favorites');
                    }

                    // Micro-animation feedback
                    like.style.transition = 'transform 0.15s ease-in-out';
                    like.style.transform = 'scale(1.25)';
                    setTimeout(() => { like.style.transform = 'scale(1)'; }, 150);

                    if (url) {
                        const token = '{{ csrf_token() }}';
                        const returnUrl = window.location.pathname + window.location.search + '#pdLikeBtn';
                        const fullUrl = url + (url.includes('?') ? '&' : '?') + 'redirect=' + encodeURIComponent(returnUrl);
                        fetch(fullUrl, {
                            method: 'POST',
                            headers: {
                                'Content-Type': 'application/json',
                                'Accept': 'application/json',
                                'X-CSRF-TOKEN': token
                            },
                            body: JSON.stringify({ redirect: returnUrl })
                        })
                        .then(r => {
                            if (r.status === 401) {
                                return r.json().then(data => {
                                    window.location.href = (data && data.redirect) ? data.redirect : ('{{ route('login') }}?favorite_listing={{ $listing->id }}&redirect=' + encodeURIComponent(returnUrl));
                                }).catch(() => {
                                    window.location.href = '{{ route('login') }}?favorite_listing={{ $listing->id }}&redirect=' + encodeURIComponent(returnUrl);
                                });
                            }
                            return r.json();
                        })
                        .then(data => {
                            if (data && typeof data.is_favorited !== 'undefined') {
                                if (data.is_favorited) {
                                    like.classList.add('liked', 'active', 'favorited');
                                    if (icon) {
                                        icon.className = 'fa-solid fa-heart';
                                        icon.style.color = '#E11D48';
                                    }
                                    like.setAttribute('title', 'Remove from favorites');
                                } else {
                                    like.classList.remove('liked', 'active', 'favorited');
                                    if (icon) {
                                        icon.className = 'fa-regular fa-heart';
                                        icon.style.color = '';
                                    }
                                    like.setAttribute('title', 'Save to favorites');
                                }
                            }
                        })
                        .catch(err => console.warn('Favorite toggle error:', err));
                    }
                });

                // Real-time synchronization with server state
                window.syncPdFavorite = function() {
                    fetch('{{ route('favorites.ids') }}', {
                        headers: { 'Accept': 'application/json' },
                        cache: 'no-store'
                    })
                    .then(r => r.json())
                    .then(data => {
                        if (data && Array.isArray(data.favorite_ids)) {
                            const favSet = new Set(data.favorite_ids.map(String));
                            const isFav = favSet.has('{{ $listing->id }}');
                            const icon = like.querySelector('i');
                            if (isFav) {
                                like.classList.add('liked', 'active', 'favorited');
                                like.setAttribute('title', 'Remove from favorites');
                                if (icon) {
                                    icon.className = 'fa-solid fa-heart';
                                    icon.style.color = '#E11D48';
                                }
                            } else {
                                like.classList.remove('liked', 'active', 'favorited');
                                like.setAttribute('title', 'Save to favorites');
                                if (icon) {
                                    icon.className = 'fa-regular fa-heart';
                                    icon.style.color = '';
                                }
                            }

                            // Sync all .my-pet-fav buttons (Seller other listings & similar pets)
                            document.querySelectorAll('.my-pet-fav').forEach(btn => {
                                const id = btn.getAttribute('data-id');
                                if (!id) return;
                                const isItemFav = favSet.has(String(id));
                                const bIcon = btn.querySelector('i');
                                if (isItemFav) {
                                    btn.classList.add('active', 'favorited');
                                    btn.setAttribute('title', 'Remove from favorites');
                                    if (bIcon) {
                                        bIcon.className = 'fa-solid fa-heart';
                                        bIcon.style.color = '#ff4b68';
                                    }
                                } else {
                                    btn.classList.remove('active', 'favorited');
                                    btn.setAttribute('title', 'Add to favorites');
                                    if (bIcon) {
                                        bIcon.className = 'fa-regular fa-heart';
                                        bIcon.style.color = '';
                                    }
                                }
                            });
                        }
                    })
                    .catch(err => console.warn('Favorite sync error:', err));
                };

                window.addEventListener('pageshow', function() {
                    window.syncPdFavorite();
                });

                document.addEventListener('visibilitychange', function() {
                    if (document.visibilityState === 'visible') {
                        window.syncPdFavorite();
                    }
                });

                // Similar pets favorite buttons
                document.querySelectorAll('.my-pet-fav').forEach(favBtn => {
                    favBtn.addEventListener('click', function(e) {
                        e.preventDefault();
                        e.stopPropagation();
                        const sId = this.getAttribute('data-id');
                        const sUrl = this.getAttribute('data-url');
                        if (sUrl) {
                            const returnUrl = window.location.pathname + window.location.search + '#listing-' + sId;
                            const fullUrl = sUrl + (sUrl.includes('?') ? '&' : '?') + 'redirect=' + encodeURIComponent(returnUrl);
                            fetch(fullUrl, {
                                method: 'POST',
                                headers: {
                                    'Content-Type': 'application/json',
                                    'Accept': 'application/json',
                                    'X-CSRF-TOKEN': '{{ csrf_token() }}'
                                },
                                body: JSON.stringify({ redirect: returnUrl })
                            })
                            .then(r => {
                                if (r.status === 401) {
                                    return r.json().then(data => {
                                        window.location.href = (data && data.redirect) ? data.redirect : ('{{ route('login') }}?favorite_listing=' + sId + '&redirect=' + encodeURIComponent(returnUrl));
                                    }).catch(() => {
                                        window.location.href = '{{ route('login') }}?favorite_listing=' + sId + '&redirect=' + encodeURIComponent(returnUrl);
                                    });
                                }
                                return r.json();
                            })
                            .then(data => {
                                if (data && typeof data.is_favorited !== 'undefined') {
                                    const icon = this.querySelector('i');
                                    if (data.is_favorited) {
                                        this.classList.add('active', 'favorited');
                                        if (icon) { icon.className = 'fa-solid fa-heart'; icon.style.color = '#ff4b68'; }
                                    } else {
                                        this.classList.remove('active', 'favorited');
                                        if (icon) { icon.className = 'fa-regular fa-heart'; icon.style.color = ''; }
                                    }
                                }
                            });
                        }
                    });
                });

                // Auto-scroll to card or favorite button if returning from auth
                if (window.location.hash) {
                    const targetEl = document.querySelector(window.location.hash);
                    if (targetEl) {
                        setTimeout(() => {
                            targetEl.scrollIntoView({ behavior: 'smooth', block: 'center' });
                            setTimeout(() => {
                                if (window.location.hash) {
                                    history.replaceState(null, document.title, window.location.pathname + window.location.search);
                                }
                            }, 1500);
                        }, 300);
                    }
                }
            }

            // Reveal masked phone number (anti-scraper & lead tracking)
            const contactBtn = document.getElementById('pdContactBtn');
            if (contactBtn) {
                contactBtn.addEventListener('click', function (e) {
                    if (contactBtn.dataset.revealed !== 'true') {
                        e.preventDefault();
                        fetch('{{ route('listings.reveal-phone', ['id' => $listing->id]) }}')
                            .then(r => r.json())
                            .then(data => {
                                if (data.success && data.phone) {
                                    contactBtn.innerHTML = '<i class="fa-solid fa-phone"></i> ' + data.phone;
                                    contactBtn.href = 'tel:' + data.phone;
                                    contactBtn.dataset.revealed = 'true';
                                }
                            })
                            .catch(function(){});
                    }
                });
            }

            // Share: copy link
            const shareBtn = document.getElementById('pdShareBtn');
            if (shareBtn) {
                shareBtn.addEventListener('click', function (e) {
                    if (e) {
                        e.preventDefault();
                        e.stopPropagation();
                    }

                    var copyToClipboard = function() {
                        navigator.clipboard.writeText(location.href).catch(function(){});
                    };
                    
                    // Show toast
                    var toast = document.getElementById("toast");
                    if (toast) {
                        toast.textContent = "Copied to clipboard";
                        toast.style.visibility = "visible";
                        toast.style.opacity = "1";
                    }
                    
                    // Try to copy to clipboard
                    if (navigator.clipboard) { copyToClipboard(); }
                    
                    setTimeout(function(){ 
                        if (toast) {
                            toast.style.opacity = "0"; 
                            setTimeout(function(){ toast.style.visibility = "hidden"; toast.textContent = "Copied to clipboard"; }, 300);
                        }
                    }, 3000);
                });
            }
        })();
    </script>
</body>
</html>

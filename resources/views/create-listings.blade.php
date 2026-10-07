<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" data-theme="light">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>My Listings - Pet Marketplace</title>

    <!-- Google Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&family=DM+Sans:wght@400;500;700&family=Manrope:wght@600;700;800&family=Outfit:wght@500;600;700;800&family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    
    <!-- FontAwesome Icons -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

    <!-- Custom CSS -->
    <link rel="stylesheet" href="{{ asset('css/pet-style.css') }}">

    <style>
        .create-listings-body {
            background-color: #FAFAF8;
            font-family: 'DM Sans', sans-serif;
            color: #17211C;
        }

        .main-content {
            padding: 40px 0;
            background-color: transparent;
        }

        /* Top Welcome Card / Header Box */
        .page-header-card {
            background-color: #147A4D;
            border-radius: 16px;
            padding: 24px 32px;
            color: white;
            margin-bottom: 24px;
        }

        .page-header-title {
            font-family: 'Manrope', sans-serif;
            font-size: 24px;
            font-weight: 700;
            margin: 0 0 8px 0;
            color: #FFFFFF !important;
        }

        .page-header-subtitle {
            font-size: 14px;
            font-weight: 400;
            margin: 0;
            opacity: 0.9;
            color: #FFFFFF !important;
        }

        /* Stepper */
        .stepper-container {
            background-color: #FFFFFF;
            border-radius: 19px;
            height: 85px;
            box-shadow: 0px 0px 7px rgba(0, 0, 0, 0.10);
            padding: 0 24px;
            display: flex;
            align-items: center;
            justify-content: space-evenly;
            margin-bottom: 24px;
        }

        .step-item {
            display: flex;
            align-items: center;
            gap: 8px;
            font-family: 'DM Sans', sans-serif;
            font-size: 16px;
            font-weight: 700;
            color: #667069;
            line-height: 1;
            cursor: pointer;
        }

        .step-item.active {
            color: #147A4D;
        }

        .step-number {
            width: 24px;
            height: 24px;
            border-radius: 50%;
            border: 1.5px solid #147A4D;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 14px;
        }

        .step-item.active .step-number {
            background-color: #147A4D;
            border-color: #147A4D;
            color: white;
        }
        
        .step-item.active-bg {
            background-color: #EAF7F0;
            padding: 0 20px;
            height: 64px;
            border-radius: 11px;
            justify-content: center;
        }

        .step-item.completed {
            color: #667069;
        }

        .step-item.completed .step-number {
            background-color: #147A4D;
            border-color: #147A4D;
            color: white;
        }

        /* Form Card */
        .form-card {
            background-color: #FFFFFF;
            border: 0.7px solid #E2E7E3;
            border-radius: 21px;
            padding: 32px;
        }

        .form-section-title {
            font-family: 'Manrope', sans-serif;
            font-size: 20px;
            font-weight: 700;
            margin: 0 0 8px 0;
            color: #17211C;
        }

        .form-section-subtitle {
            font-size: 14px;
            color: #667069;
            margin: 0 0 32px 0;
        }
        
        .subtitle-with-line {
            padding-bottom: 16px;
            border-bottom: 1px solid #EFEFEF;
            margin-left: -32px;
            margin-right: -32px;
            padding-left: 32px;
            padding-right: 32px;
            margin-bottom: 24px;
        }

        .form-grid {
            display: grid;
            grid-template-columns: repeat(3, 1fr);
            gap: 24px;
            margin-bottom: 32px;
        }

        .form-group {
            display: flex;
            flex-direction: column;
            gap: 8px;
            margin-bottom: 24px;
        }

        .form-label {
            font-family: 'DM Sans', sans-serif;
            font-size: 16px;
            font-weight: 600;
            color: #17211C;
            line-height: 1;
        }

        .form-input, .form-select {
            width: 100%;
            height: 46px;
            padding: 0 16px;
            background-color: #FFFFFF;
            border: 0.67px solid #E2E7E3;
            border-radius: 11px;
            font-family: 'DM Sans', sans-serif;
            font-size: 16px;
            font-weight: 400;
            line-height: 1;
            color: #000000;
            outline: none;
            transition: border-color 0.2s;
            appearance: none; /* For custom select arrows */
        }
        
        .form-input::placeholder, .form-textarea::placeholder {
            color: #9CA3AF;
        }
        
        .form-select {
            background: url('data:image/svg+xml;utf8,<svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="none" stroke="%23000000" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" viewBox="0 0 24 24"><polyline points="6 9 12 15 18 9"></polyline></svg>') no-repeat right 16px center;
            padding-right: 40px;
        }

        .form-input:focus, .form-select:focus, .form-textarea:focus {
            border-color: #147A4D;
        }

        .form-textarea {
            width: 100%;
            min-height: 100px;
            padding: 16px;
            background-color: #FFFFFF;
            border: 0.67px solid #E2E7E3;
            border-radius: 11px;
            font-family: 'DM Sans', sans-serif;
            font-size: 16px;
            font-weight: 400;
            line-height: 1.5;
            color: #000000;
            outline: none;
            transition: border-color 0.2s;
            resize: vertical;
        }

        /* Radio Buttons */
        .radio-group {
            display: flex;
            gap: 40px;
            margin-top: 8px;
        }

        .radio-label {
            display: flex;
            align-items: center;
            gap: 12px;
            font-family: 'DM Sans', sans-serif;
            font-size: 15px;
            font-weight: 600;
            color: #17211C;
            cursor: pointer;
        }

        .radio-input {
            display: none;
        }

        .radio-custom {
            width: 22px;
            height: 22px;
            border: 2px solid #147A4D;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            transition: all 0.2s;
        }

        .radio-input:checked + .radio-custom {
            background-color: #147A4D;
        }

        .radio-input:checked + .radio-custom::after {
            content: '';
            width: 8px;
            height: 8px;
            background-color: #FFFFFF;
            border-radius: 50%;
        }

        .radio-input:checked ~ .radio-text {
            color: #147A4D;
        }

        /* Actions */
        .form-actions {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding-top: 24px;
        }
        
        .right-actions {
            display: flex;
            gap: 16px;
        }

        .btn-outline {
            height: 44px;
            padding: 0 35px !important;
            border: 1px solid #EFEFEF !important;
            border-radius: 11px !important;
            background: transparent !important;
            font-family: 'DM Sans', sans-serif !important;
            font-weight: 700 !important;
            font-size: 14px !important;
            color: #17211C !important;
            cursor: pointer;
            transition: all 0.2s;
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 8px;
            box-shadow: none !important;
            letter-spacing: normal !important;
            text-transform: none !important;
        }
        
        .btn-outline:hover {
            border-color: #17211C !important;
        }

        .btn-primary {
            height: 44px;
            padding: 0 40px !important;
            border: none !important;
            border-radius: 11px !important;
            background: #147A4D !important;
            font-family: 'DM Sans', sans-serif !important;
            font-weight: 700 !important;
            font-size: 14px !important;
            color: white !important;
            cursor: pointer;
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 8px;
            transition: background 0.2s;
            box-shadow: none !important;
            letter-spacing: normal !important;
            text-transform: none !important;
        }
        
        .btn-primary:hover {
            background: #0e5e39 !important;
        }

        /* Upload Box & Previews */
        .upload-box {
            border: 1.5px dashed #A3C9B8;
            border-radius: 11px;
            background-color: #FAFAF8;
            padding: 48px 24px;
            text-align: center;
            cursor: pointer;
            margin-bottom: 24px;
            transition: background 0.2s;
        }

        .upload-box:hover {
            background-color: #F1F7F4;
        }

        .upload-icon {
            font-size: 28px;
            color: #147A4D;
            margin-bottom: 12px;
        }

        .upload-title {
            font-family: 'DM Sans', sans-serif;
            font-size: 16px;
            font-weight: 700;
            color: #17211C;
            margin-bottom: 8px;
        }

        .upload-subtitle {
            font-size: 14px;
            color: #667069;
        }

        .image-previews {
            display: flex;
            gap: 16px;
            margin-bottom: 32px;
        }

        .image-preview-item {
            position: relative;
            width: 215px;
            height: 165px;
            border-radius: 11px;
            overflow: hidden;
            border: 0.67px solid #E2E7E3;
        }

        .image-preview-item img {
            width: 100%;
            height: 100%;
            object-fit: cover;
        }

        .image-remove-btn {
            position: absolute;
            top: 8px;
            right: 8px;
            width: 24px;
            height: 24px;
            background-color: #FFFFFF;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            border: none;
            cursor: pointer;
            box-shadow: 0 2px 4px rgba(0,0,0,0.15);
            color: #17211C;
            font-size: 12px;
        }

        /* Step display logic */
        .form-step {
            display: none;
        }
        
        .form-step.active-step {
            display: block;
            animation: fadeIn 0.3s ease;
        }

        @keyframes fadeIn {
            from { opacity: 0; transform: translateY(10px); }
            to { opacity: 1; transform: translateY(0); }
        }

        /* Image Preview Modal */
        .image-modal {
            display: none;
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background-color: rgba(0, 0, 0, 0.85);
            z-index: 9999;
            align-items: center;
            justify-content: center;
            opacity: 0;
            transition: opacity 0.3s;
        }

        .image-modal.active-modal {
            display: flex;
            opacity: 1;
        }

        .image-modal img {
            max-width: 90%;
            max-height: 90%;
            border-radius: 11px;
            object-fit: contain;
        }

        .modal-close-btn {
            position: absolute;
            top: 40px;
            right: 40px;
            width: 44px;
            height: 44px;
            background-color: #FFFFFF;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            border: none;
            cursor: pointer;
            box-shadow: 0 4px 12px rgba(0,0,0,0.3);
            color: #17211C;
            font-size: 20px;
            transition: transform 0.2s;
        }
        
        .modal-close-btn:hover {
            transform: scale(1.1);
        }

        /* Review Cards */
        .review-card {
            border: 1px solid #E2E7E3;
            border-radius: 11px;
            padding: 32px;
            margin-bottom: 24px;
        }

        .review-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 32px;
        }

        .review-title {
            font-family: 'DM Sans', sans-serif;
            font-size: 16px;
            font-weight: 700;
            color: #17211C;
        }

        .review-edit {
            color: #147A4D;
            font-weight: 600;
            font-size: 14px;
            text-decoration: underline;
            cursor: pointer;
        }
        
        .review-edit:hover {
            opacity: 0.8;
        }

        .review-grid {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 24px 64px;
        }

        .review-item {
            display: flex;
            justify-content: space-between;
            align-items: flex-start;
            border-bottom: 1px solid #E2E7E3;
            padding-bottom: 16px;
        }

        .review-item.review-desc.has-content {
            flex-direction: column;
            gap: 8px;
            grid-column: 1 / -1;
        }
        
        .review-item.review-desc.has-content .review-label,
        .review-item.review-desc.has-content .review-value {
            display: block !important;
            margin-bottom: 0 !important;
            text-align: left;
            max-width: 100%;
        }

        .review-label {
            font-size: 14px;
            color: #667069;
        }

        .review-value {
            font-size: 14px;
            font-weight: 700;
            color: #17211C;
        }

        .review-full-width {
            grid-column: 1 / -1;
            margin-top: 8px;
        }

        /* Success Step */
        .success-content {
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            padding: 80px 24px 60px;
            text-align: center;
        }

        .success-icon {
            width: 80px;
            height: 80px;
            background-color: #147A4D;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            margin-bottom: 24px;
            box-shadow: 0 8px 16px rgba(20, 122, 77, 0.15);
        }

        .success-icon i {
            color: #FFFFFF;
            font-size: 40px;
        }

        .success-title {
            font-family: 'DM Sans', sans-serif;
            font-size: 28px;
            font-weight: 700;
            color: #17211C;
            margin-bottom: 16px;
        }

        .success-subtitle {
            font-size: 16px;
            color: #17211C;
            margin-bottom: 40px;
        }

        .success-actions {
            display: flex;
            gap: 16px;
        }

        /* Mobile Header */
        .mobile-header {
            display: none;
            justify-content: space-between;
            align-items: center;
            padding: 16px;
            background-color: #FFFFFF;
            border-bottom: 1px solid #E2E7E3;
            margin-left: -32px;
            margin-right: -32px;
            margin-top: -32px;
            margin-bottom: 24px;
        }
        
        .mobile-brand {
            display: flex;
            align-items: center;
            gap: 8px;
        }

        .mobile-header-actions {
            display: flex;
            align-items: center;
            gap: 16px;
            font-size: 20px;
            color: #17211C;
        }

        .mobile-stepper-title {
            display: none;
            justify-content: space-between;
            align-items: baseline;
            margin-bottom: 16px;
            padding: 0 4px;
        }

        /* Mobile View Styles */
        @media (max-width: 768px) {
            .main-content {
                padding: 32px 0;
            }

            .mobile-header {
                display: none !important;
            }
            
            .stepper-container {
                display: none !important;
            }

            .mobile-stepper-title {
                display: flex !important;
            }

            .page-header-card {
                padding: 24px;
                border-radius: 12px;
                margin-bottom: 24px;
            }

            .form-section-title {
                font-size: 21px;
                line-height: 1;
            }

            .form-card {
                padding: 24px 16px;
                border: 1px solid #EFEFEF;
                border-radius: 12px;
            }
            .subtitle-with-line {
                margin-left: -16px;
                margin-right: -16px;
                padding-left: 16px;
                padding-right: 16px;
            }

            .form-grid {
                grid-template-columns: 1fr 1fr;
                gap: 16px;
            }
            
            .form-group {
                grid-column: span 2;
            }

            .half-width-mobile {
                grid-column: span 1 !important;
            }

            .review-header {
                margin-bottom: 16px;
            }

            .review-grid {
                display: flex;
                flex-direction: column;
                gap: 0;
            }

            .review-card {
                border: none;
                border-radius: 0;
                padding: 0 0 16px 0;
                margin-bottom: 16px;
            }
            .review-card:last-of-type {
                margin-bottom: 0;
            }
            
            .review-item {
                display: flex;
                justify-content: space-between;
                align-items: flex-start;
                border-bottom: 1px solid #EFEFEF;
                padding: 16px 0;
            }
            .review-value {
                text-align: right;
                max-width: 60%;
            }
            .review-item.review-desc.has-content {
                flex-direction: column;
                align-items: flex-start;
                gap: 8px;
            }
            .review-item.review-desc.has-content .review-label,
            .review-item.review-desc.has-content .review-value {
                display: block !important;
                margin-bottom: 0 !important;
                text-align: left;
                max-width: 100%;
            }

            .form-actions {
                flex-direction: row;
                gap: 16px;
            }
            .form-actions button {
                width: auto;
                flex: 1;
                padding: 0 8px;
                justify-content: center;
            }

            .form-actions-split {
                flex-direction: row;
                flex-wrap: wrap;
                gap: 16px;
            }
            .form-actions-split > button {
                order: 2;
                flex: 1;
                justify-content: center;
                padding: 0 8px;
            }
            .form-actions-split .right-actions {
                display: contents;
            }
            .form-actions-split .right-actions .btn-primary {
                order: 1;
                flex: 0 0 100%;
                justify-content: center;
            }
            .form-actions-split .right-actions .btn-outline {
                order: 3;
                flex: 1;
                justify-content: center;
                padding: 0 8px;
            }
            
            .radio-group {
                gap: 16px;
                flex-wrap: wrap;
            }
        }

    </style>
</head>
<body class="create-listings-body">

    <!-- HEADER COMPONENT -->
    <x-header />

    <!-- PAGE BODY SHELL -->
    <main class="site-wrapper" style="background-color: #FAFAF8;">
        <div class="shell-1440">
            <div class="container">
                <!-- Main Content -->
                <div class="main-content">
            


            <!-- Welcome / Header Card -->
            <div class="page-header-card">
                <h1 class="page-header-title">Create Pet Listing</h1>
                <p class="page-header-subtitle">Add accurate details about your pet. Save as draft and continue later if needed.</p>
            </div>

            <!-- Stepper -->
            <div class="stepper-container">
                <div class="step-item active active-bg" id="stepper-1" onclick="goToStep(1)">
                    <span class="step-number">1</span>
                    Pet Details
                </div>
                <div class="step-item" id="stepper-2" onclick="goToStep(2)">
                    <span class="step-number">2</span>
                    Health &amp; Description
                </div>
                <div class="step-item" id="stepper-3" onclick="goToStep(3)">
                    <span class="step-number">3</span>
                    Price, Location &amp; Contact
                </div>
                <div class="step-item" id="stepper-4" onclick="goToStep(4)">
                    <span class="step-number">4</span>
                    Media
                </div>
                <div class="step-item" id="stepper-5" onclick="goToStep(5)">
                    <span class="step-number">5</span>
                    Review
                </div>
            </div>

            <!-- Mobile Stepper Title -->
            <div class="mobile-stepper-title" id="mobile-stepper-container">
                <h2 id="mobile-step-name" style="font-family: 'DM Sans', sans-serif; font-size: 24px; font-weight: 700; color: #000000; margin: 0; line-height: 1;">
                    <span style="letter-spacing: -1px;">Step 1</span><span style="letter-spacing: 0px;">: Pet Details</span>
                </h2>
                <span id="mobile-step-count" style="font-family: 'DM Sans', sans-serif; font-size: 16px; font-weight: 600; color: #667069;">1/5</span>
            </div>

            <!-- Form Area (Step 1) -->
            <div class="form-card form-step active-step" id="step-1">
                <h2 class="form-section-title">Pet Details</h2>
                <p class="form-section-subtitle subtitle-with-line">Add key details buyers usually compare.</p>

                <div class="form-grid">
                    <div class="form-group">
                        <label class="form-label">Pet Category *</label>
                        <select id="input-category" class="form-select">
                            <option value="" disabled selected>Select Category</option>
                            <option>Dog</option>
                            <option>Cat</option>
                        </select>
                    </div>
                    
                    <div class="form-group">
                        <label class="form-label">Breed *</label>
                        <input type="text" id="input-breed" class="form-input" placeholder="Enter the pet's breed">
                    </div>

                    <div class="form-group">
                        <label class="form-label">Listing Title *</label>
                        <input type="text" id="input-title" class="form-input" placeholder="Provide a descriptive title for your listing">
                    </div>

                    <div class="form-group half-width-mobile">
                        <label class="form-label">Age Value *</label>
                        <input type="text" id="input-age-value" class="form-input" placeholder="Enter the age value">
                    </div>

                    <div class="form-group half-width-mobile">
                        <label class="form-label">Age Unit</label>
                        <select id="input-age-unit" class="form-select">
                            <option value="" disabled selected>Select Unit</option>
                            <option>Month</option>
                            <option>Year</option>
                        </select>
                    </div>

                    <div class="form-group half-width-mobile">
                        <label class="form-label">Gender</label>
                        <select id="input-gender" class="form-select">
                            <option value="" disabled selected>Select Gender</option>
                            <option>Male</option>
                            <option>Female</option>
                        </select>
                    </div>

                    <div class="form-group half-width-mobile">
                        <label class="form-label">Color</label>
                        <input type="text" id="input-color" class="form-input" placeholder="Specify the pet's color">
                    </div>

                    <div class="form-group">
                        <label class="form-label">Pedigree / Papers</label>
                        <select id="input-pedigree" class="form-select">
                            <option value="" disabled selected>Select Option</option>
                            <option>Yes</option>
                            <option>No</option>
                        </select>
                    </div>
                </div>

                <div class="form-actions">
                    <button type="button" class="btn-outline">Save Draft</button>
                    <button type="button" class="btn-primary" onclick="goToStep(2)">Next <i class="fa-solid fa-arrow-right"></i></button>
                </div>
            </div>

            <!-- Form Area (Step 2) -->
            <div class="form-card form-step" id="step-2">
                <h2 class="form-section-title">Health &amp; Description</h2>
                <p class="form-section-subtitle subtitle-with-line">Add key details buyers usually compare.</p>

                <div class="form-group">
                    <label class="form-label">Vaccination Status *</label>
                    <div class="radio-group">
                        <label class="radio-label">
                            <input type="radio" name="vaccination" class="radio-input" checked>
                            <div class="radio-custom"></div>
                            <span class="radio-text">Vaccinated</span>
                        </label>
                        <label class="radio-label">
                            <input type="radio" name="vaccination" class="radio-input">
                            <div class="radio-custom"></div>
                            <span class="radio-text">Partially Vaccinated</span>
                        </label>
                        <label class="radio-label">
                            <input type="radio" name="vaccination" class="radio-input">
                            <div class="radio-custom"></div>
                            <span class="radio-text">Not Vaccinated</span>
                        </label>
                    </div>
                </div>

                <div class="form-group">
                    <label class="form-label">Deworming Status</label>
                    <div class="radio-group">
                        <label class="radio-label">
                            <input type="radio" name="deworming" class="radio-input" checked>
                            <div class="radio-custom"></div>
                            <span class="radio-text">Yes</span>
                        </label>
                        <label class="radio-label">
                            <input type="radio" name="deworming" class="radio-input">
                            <div class="radio-custom"></div>
                            <span class="radio-text">No</span>
                        </label>
                        <label class="radio-label">
                            <input type="radio" name="deworming" class="radio-input">
                            <div class="radio-custom"></div>
                            <span class="radio-text">Not Sure</span>
                        </label>
                    </div>
                </div>

                <div class="form-group">
                    <label class="form-label">Health Notes</label>
                    <input type="text" class="form-input" placeholder="Include any medical conditions or dietary needs">
                </div>

                <div class="form-group">
                    <label class="form-label">Pet Description *</label>
                    <textarea id="input-description" class="form-textarea" placeholder="Describe your pet's personality, behavior, and reason for rehoming."></textarea>
                </div>

                <div class="form-actions form-actions-split">
                    <button type="button" class="btn-outline">Save Draft</button>
                    <div class="right-actions">
                        <button type="button" class="btn-outline" onclick="goToStep(1)"><i class="fa-solid fa-arrow-left"></i> Back</button>
                        <button type="button" class="btn-primary" onclick="goToStep(3)">Next <i class="fa-solid fa-arrow-right"></i></button>
                    </div>
                </div>
            </div>

            <!-- Form Area (Step 3) -->
            <div class="form-card form-step" id="step-3">
                <h2 class="form-section-title">Price, Location &amp; Contact</h2>
                <p class="form-section-subtitle subtitle-with-line">Set the asking price and general location. Exact address should not be public by default.</p>

                <div class="form-grid">
                    <div class="form-group">
                        <label class="form-label">Price *</label>
                        <input type="text" id="input-price" class="form-input" placeholder="Enter your asking price">
                    </div>
                    
                    <div class="form-group">
                        <label class="form-label">Currency</label>
                        <input type="text" id="input-currency" class="form-input" placeholder="Specify the currency">
                    </div>

                    <div class="form-group">
                        <label class="form-label">Negotiable</label>
                        <select id="input-negotiable" class="form-select">
                            <option value="" disabled selected>Select Option</option>
                            <option>Yes</option>
                            <option>No</option>
                        </select>
                    </div>

                    <div class="form-group">
                        <label class="form-label">Country</label>
                        <input type="text" class="form-input" id="country-input" placeholder="Enter your country">
                    </div>

                    <div class="form-group">
                        <label class="form-label">City *</label>
                        <select class="form-select" id="city-select">
                            <option value="" disabled selected>Select City</option>
                        </select>
                    </div>

                    <div class="form-group">
                        <label class="form-label">Area</label>
                        <input type="text" id="input-area" class="form-input" placeholder="Enter your local area or neighborhood">
                    </div>

                    <div class="form-group">
                        <label class="form-label">Seller</label>
                        <input type="text" id="input-seller" class="form-input" placeholder="Enter the seller's full name">
                    </div>

                    <div class="form-group">
                        <label class="form-label">Contact Preference</label>
                        <select id="input-contact" class="form-select">
                            <option value="" disabled selected>Select Preference</option>
                            <option>Marketplace Messages</option>
                            <option>Phone Call</option>
                            <option>WhatsApp</option>
                        </select>
                    </div>
                </div>

                <div class="form-actions form-actions-split">
                    <button type="button" class="btn-outline">Save Draft</button>
                    <div class="right-actions">
                        <button type="button" class="btn-outline" onclick="goToStep(2)"><i class="fa-solid fa-arrow-left"></i> Back</button>
                        <button type="button" class="btn-primary" onclick="goToStep(4)">Next <i class="fa-solid fa-arrow-right"></i></button>
                    </div>
                </div>
            </div>

            <!-- Form Area (Step 4) -->
            <div class="form-card form-step" id="step-4">
                <h2 class="form-section-title">Media</h2>
                <p class="form-section-subtitle subtitle-with-line">Upload multiple clear photos. Video is optional.</p>

                <div class="upload-box" onclick="document.getElementById('pet-photos-input').click()">
                    <i class="fa-solid fa-cloud-arrow-up upload-icon"></i>
                    <div class="upload-title">Upload Pet Photos</div>
                    <div class="upload-subtitle">Choose multiple clear images of the pet.</div>
                </div>
                <input type="file" id="pet-photos-input" multiple accept="image/*" style="display: none;">

                <div class="image-previews" id="image-preview-container">
                    <!-- Dynamic image previews will appear here -->
                </div>

                <div class="form-group" style="margin-bottom: 0;">
                    <label class="form-label">Video URL <span style="color: #667069; font-weight: 400;">(Optional)</span></label>
                    <input type="text" class="form-input" placeholder="Provide a video URL for your listing">
                </div>

                <div class="form-actions form-actions-split">
                    <button type="button" class="btn-outline">Save Draft</button>
                    <div class="right-actions">
                        <button type="button" class="btn-outline" onclick="goToStep(3)"><i class="fa-solid fa-arrow-left"></i> Back</button>
                        <button type="button" class="btn-primary" onclick="goToStep(5)">Next <i class="fa-solid fa-arrow-right"></i></button>
                    </div>
                </div>
            </div>

            <!-- Form Area (Step 5) -->
            <div class="form-card form-step" id="step-5">
                <h2 class="form-section-title">Review Your Listings</h2>
                <p class="form-section-subtitle" style="border-bottom: 1px solid #EFEFEF; padding-bottom: 16px; margin-bottom: 16px;">Check everything before submitting for review.</p>

                <div class="review-card">
                    <div class="review-header">
                        <div class="review-title">Pet Details</div>
                        <a onclick="goToStep(1)" class="review-edit">Edit</a>
                    </div>
                    <div class="review-grid">
                        <div class="review-item">
                            <span class="review-label">Category</span>
                            <span class="review-value" id="review-category">Dog</span>
                        </div>
                        <div class="review-item">
                            <span class="review-label">Breed</span>
                            <span class="review-value" id="review-breed">Golden Retriever</span>
                        </div>
                        <div class="review-item">
                            <span class="review-label">Listing Title</span>
                            <span class="review-value" id="review-title">Golden Retriever Puppy</span>
                        </div>
                        <div class="review-item">
                            <span class="review-label">Age</span>
                            <span class="review-value" id="review-age">3 Months</span>
                        </div>
                        <div class="review-item">
                            <span class="review-label">Gender</span>
                            <span class="review-value" id="review-gender">Male</span>
                        </div>
                        <div class="review-item">
                            <span class="review-label">Color</span>
                            <span class="review-value" id="review-color">Golden</span>
                        </div>
                        <div class="review-item" style="grid-column: 1;">
                            <span class="review-label">Pedigree / Papers</span>
                            <span class="review-value" id="review-pedigree">Yes</span>
                        </div>
                    </div>
                </div>

                <div class="review-card">
                    <div class="review-header">
                        <div class="review-title">Health &amp; Description</div>
                        <a onclick="goToStep(2)" class="review-edit">Edit</a>
                    </div>
                    <div class="review-grid">
                        <div class="review-item">
                            <span class="review-label">Vaccination Status</span>
                            <span class="review-value" id="review-vaccination">Vaccinated</span>
                        </div>
                        <div class="review-item">
                            <span class="review-label">Deworming Status</span>
                            <span class="review-value" id="review-deworming">Yes</span>
                        </div>
                        <div class="review-item review-desc has-content">
                            <span class="review-label">Description</span>
                            <span class="review-value" id="review-description" style="line-height: 1.6;">Friendly Golden Retriever puppy, active and playful. Raised in a home environment and comfortable around people.</span>
                        </div>
                    </div>
                </div>

                <div class="review-card">
                    <div class="review-header">
                        <div class="review-title">Price, Location &amp; Contact</div>
                        <a onclick="goToStep(3)" class="review-edit">Edit</a>
                    </div>
                    <div class="review-grid">
                        <div class="review-item">
                            <span class="review-label">Price</span>
                            <span class="review-value" id="review-price">PKR 80,000</span>
                        </div>
                        <div class="review-item">
                            <span class="review-label">Location</span>
                            <span class="review-value" id="review-location">DHA, Lahore, Pakistan</span>
                        </div>
                        <div class="review-item no-border">
                            <span class="review-label">Seller</span>
                            <span class="review-value" id="review-seller">Ahmed Khan</span>
                        </div>
                        <div class="review-item no-border">
                            <span class="review-label">Contact Preference</span>
                            <span class="review-value" id="review-contact">Marketplace Message</span>
                        </div>
                    </div>
                </div>

                <div class="form-actions form-actions-split">
                    <button type="button" class="btn-outline">Save Draft</button>
                    <div class="right-actions">
                        <button type="button" class="btn-outline" onclick="goToStep(4)"><i class="fa-solid fa-arrow-left"></i> Back</button>
                        <button type="button" class="btn-primary" onclick="goToStep('success')"><i class="fa-solid fa-paper-plane" style="margin-right: 8px;"></i> Submit for Review</button>
                    </div>
                </div>
            </div>

            <!-- Form Area (Success Step) -->
            <div class="form-card form-step" id="step-success">
                <div class="success-content">
                    <div class="success-icon">
                        <i class="fa-solid fa-check"></i>
                    </div>
                    <div class="success-title">Listing Submitted</div>
                    <div class="success-subtitle">Your listing has been submitted for moderation and is now Pending Review.</div>
                    <div class="success-actions">
                        <button type="button" class="btn-primary" onclick="window.location.reload()">Create Another Listing</button>
                        <button type="button" class="btn-outline" onclick="window.location.href='/seller/listings'">View My Listing</button>
                    </div>
                </div>
            </div>

    </div> <!-- End Main Content -->
            </div>
        </div>
    </main>

    <!-- FOOTER COMPONENT -->
    <x-footer />

    <!-- Image Preview Modal -->
    <div id="image-modal" class="image-modal">
        <button type="button" class="modal-close-btn" id="modal-close"><i class="fa-solid fa-xmark"></i></button>
        <img id="modal-image" src="" alt="Full preview">
    </div>

    <script src="{{ asset('js/pet-script.js') }}"></script>
    <script>
        function goToStep(stepNumber) {
            // Hide all steps
            document.querySelectorAll('.form-step').forEach(function(step) {
                step.classList.remove('active-step');
            });
            
            // Show target step
            const targetStep = document.getElementById('step-' + stepNumber);
            if (targetStep) {
                targetStep.classList.add('active-step');
            }
            
            // Update Stepper UI
            document.querySelectorAll('.step-item').forEach(function(stepper, index) {
                const currentStepNum = index + 1;
                
                // Reset classes
                stepper.classList.remove('active', 'active-bg', 'completed');
                
                if (stepNumber === 'success') {
                    if (currentStepNum === 5) {
                        stepper.classList.add('active', 'active-bg');
                    } else {
                        stepper.classList.add('completed');
                    }
                } else {
                    if (currentStepNum === stepNumber) {
                        stepper.classList.add('active', 'active-bg');
                    } else if (currentStepNum < stepNumber) {
                        stepper.classList.add('completed');
                    }
                }
            });

            // Update Mobile Stepper
            const stepNames = {
                1: 'Pet Details',
                2: 'Health & Description',
                3: 'Price, Location & Contact',
                4: 'Media',
                5: 'Review'
            };
            const mobileContainer = document.getElementById('mobile-stepper-container');
            if (mobileContainer) {
                if (stepNumber === 'success') {
                    mobileContainer.style.display = 'none';
                } else {
                    document.getElementById('mobile-step-name').innerHTML = '<span style="letter-spacing: -1px;">Step ' + stepNumber + '</span><span style="letter-spacing: 0px;">: ' + stepNames[stepNumber] + '</span>';
                    document.getElementById('mobile-step-count').innerText = stepNumber + '/5';
                    // Re-apply display flex in case it was hidden by success step, but handled by media query
                }
            }

            if (stepNumber === 5) {
                updateReviewData();
            }
        }

        function updateReviewData() {
            const setVal = (id, val) => {
                const el = document.getElementById(id);
                if (el) el.innerText = val || '-';
            };
            
            // Step 1
            setVal('review-category', document.getElementById('input-category')?.value);
            setVal('review-breed', document.getElementById('input-breed')?.value);
            setVal('review-title', document.getElementById('input-title')?.value);
            
            const ageVal = document.getElementById('input-age-value')?.value || '';
            const ageUnit = document.getElementById('input-age-unit')?.value || '';
            setVal('review-age', ageVal ? (ageVal + (ageUnit ? ' ' + ageUnit + (ageVal > 1 ? 's' : '') : '')) : '-');
            
            setVal('review-gender', document.getElementById('input-gender')?.value);
            setVal('review-color', document.getElementById('input-color')?.value);
            setVal('review-pedigree', document.getElementById('input-pedigree')?.value);
            
            // Step 2
            const vax = document.querySelector('input[name="vaccination"]:checked');
            setVal('review-vaccination', vax ? vax.nextElementSibling.nextElementSibling.innerText : '-');
            
            const deworm = document.querySelector('input[name="deworming"]:checked');
            setVal('review-deworming', deworm ? deworm.nextElementSibling.nextElementSibling.innerText : '-');
            
            const descInput = document.getElementById('input-description')?.value;
            const descEl = document.getElementById('review-description');
            if (descEl) {
                descEl.innerText = (descInput && descInput.trim() !== '') ? descInput : '-';
                if (descInput && descInput.trim() !== '') {
                    descEl.parentElement.classList.add('has-content');
                } else {
                    descEl.parentElement.classList.remove('has-content');
                }
            }
            
            // Step 3
            const price = document.getElementById('input-price')?.value || '';
            const curr = document.getElementById('input-currency')?.value || '';
            setVal('review-price', (curr ? curr + ' ' : '') + price || '-');
            
            const area = document.getElementById('input-area')?.value || '';
            const city = document.getElementById('city-select')?.value || '';
            const country = document.getElementById('country-input')?.value || '';
            let locParts = [area, city, country].filter(p => p.trim() !== '');
            setVal('review-location', locParts.length > 0 ? locParts.join(', ') : '-');
            
            setVal('review-seller', document.getElementById('input-seller')?.value);
            setVal('review-contact', document.getElementById('input-contact')?.value);
        }

        // Dynamic City Population based on Country Input
        document.addEventListener('DOMContentLoaded', function() {
            const countryInput = document.getElementById('country-input');
            const citySelect = document.getElementById('city-select');

            const citiesData = {
                'usa': ['New York', 'Los Angeles', 'Chicago', 'Houston', 'Miami'],
                'united states': ['New York', 'Los Angeles', 'Chicago', 'Houston', 'Miami'],
                'pakistan': ['Lahore', 'Karachi', 'Islamabad', 'Rawalpindi', 'Peshawar'],
                'uk': ['London', 'Manchester', 'Birmingham', 'Liverpool'],
                'united kingdom': ['London', 'Manchester', 'Birmingham', 'Liverpool'],
                'india': ['Mumbai', 'Delhi', 'Bangalore', 'Hyderabad'],
                'canada': ['Toronto', 'Vancouver', 'Montreal', 'Calgary']
            };

            if(countryInput && citySelect) {
                countryInput.addEventListener('input', function(e) {
                    const country = e.target.value.toLowerCase().trim();
                    
                    // Reset city dropdown
                    citySelect.innerHTML = '<option value="" disabled selected>Select City</option>';
                    
                    if (citiesData[country]) {
                        citiesData[country].forEach(function(city) {
                            const option = document.createElement('option');
                            option.value = city;
                            option.textContent = city;
                            citySelect.appendChild(option);
                        });
                    }
                });
            }
            
            // Image Upload and Preview Logic
            const fileInput = document.getElementById('pet-photos-input');
            const previewContainer = document.getElementById('image-preview-container');
            const imageModal = document.getElementById('image-modal');
            const modalImage = document.getElementById('modal-image');
            const modalClose = document.getElementById('modal-close');
            
            if(modalClose) {
                modalClose.addEventListener('click', function() {
                    imageModal.classList.remove('active-modal');
                });
            }
            
            if(fileInput && previewContainer) {
                fileInput.addEventListener('change', function(e) {
                    const files = Array.from(e.target.files);
                    
                    files.forEach((file) => {
                        if(file.type.startsWith('image/')) {
                            const reader = new FileReader();
                            
                            reader.onload = function(event) {
                                const previewItem = document.createElement('div');
                                previewItem.className = 'image-preview-item';
                                
                                const img = document.createElement('img');
                                img.src = event.target.result;
                                img.alt = 'Uploaded pet photo';
                                img.style.cursor = 'pointer';
                                
                                // Open modal on click
                                img.addEventListener('click', function() {
                                    modalImage.src = event.target.result;
                                    imageModal.classList.add('active-modal');
                                });
                                
                                const removeBtn = document.createElement('button');
                                removeBtn.type = 'button';
                                removeBtn.className = 'image-remove-btn';
                                removeBtn.innerHTML = '<i class="fa-solid fa-xmark"></i>';
                                
                                removeBtn.addEventListener('click', function() {
                                    previewItem.remove();
                                });
                                
                                previewItem.appendChild(img);
                                previewItem.appendChild(removeBtn);
                                previewContainer.appendChild(previewItem);
                            }
                            
                            reader.readAsDataURL(file);
                        }
                    });
                    
                    // Reset input so users can select the same file again if they remove and re-add it
                    fileInput.value = ''; 
                });
            }
        });
    </script>
</body>
</html>

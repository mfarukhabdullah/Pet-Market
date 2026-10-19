{{-- USER PROMPT: "about us ky ya ection dynamic kro or yahi lgao dta admin main" --}}
@php
    $saferTitle = \App\Models\SiteSetting::get('about_safer_title', 'Safer interactions start with better information.');
    $saferDesc = \App\Models\SiteSetting::get('about_safer_desc', 'Pet transactions require more care than a typical classified listing. That is why the platform keeps safety, moderation and responsible ownership visible throughout the experience.');
    $saferPointsRaw = \App\Models\SiteSetting::get('about_safer_points', "Verify the animal, seller, ownership and available health information.\nUse reporting tools for suspicious or misleading listings and users.\nKeep exact seller address private by default.\nReview local requirements and responsible ownership considerations before proceeding.");
    $saferPoints = array_values(array_filter(array_map('trim', explode("\n", $saferPointsRaw))));

    $card1Icon = \App\Models\SiteSetting::get('about_safer_card_1_icon', 'fas fa-user-shield');
    $card1Title = \App\Models\SiteSetting::get('about_safer_card_1_title', 'Seller Profiles');
    $card1Desc = \App\Models\SiteSetting::get('about_safer_card_1_desc', 'Buyers can review seller information, active listings and relevant verification status before making contact.');

    $card2Icon = \App\Models\SiteSetting::get('about_safer_card_2_icon', 'fas fa-comments');
    $card2Title = \App\Models\SiteSetting::get('about_safer_card_2_title', 'Marketplace Messaging');
    $card2Desc = \App\Models\SiteSetting::get('about_safer_card_2_desc', 'Users can communicate through the platform without automatically exposing private contact information.');

    $card3Icon = \App\Models\SiteSetting::get('about_safer_card_3_icon', 'fas fa-flag');
    $card3Title = \App\Models\SiteSetting::get('about_safer_card_3_title', 'Reporting & Moderation');
    $card3Desc = \App\Models\SiteSetting::get('about_safer_card_3_desc', 'Listings and users can be reported so marketplace moderators can review possible policy or safety concerns.');
@endphp
<div class="safer-interactions-section">
    <div class="shell-1440">
        <div class="container safer-interactions-container">
            <!-- Left Box (Dark Green) -->
            <div class="safer-left-box">
                <h2 class="safer-title">{{ $saferTitle }}</h2>
                <p class="safer-desc">
                    {{ $saferDesc }}
                </p>
                <ul class="safer-checklist">
                    @foreach($saferPoints as $point)
                        <li>
                            <i class="fas fa-check"></i>
                            <span>{{ $point }}</span>
                        </li>
                    @endforeach
                </ul>
            </div>

            <!-- Right Column (Cards) -->
            <div class="safer-right-cards">
                
                <div class="safer-card">
                    <div class="safer-card-icon">
                        <i class="{{ $card1Icon }}"></i>
                    </div>
                    <div class="safer-card-content">
                        <h3 class="safer-card-title">{{ $card1Title }}</h3>
                        <p class="safer-card-desc">{{ $card1Desc }}</p>
                    </div>
                </div>

                <div class="safer-card">
                    <div class="safer-card-icon">
                        <i class="{{ $card2Icon }}"></i>
                    </div>
                    <div class="safer-card-content">
                        <h3 class="safer-card-title">{{ $card2Title }}</h3>
                        <p class="safer-card-desc">{{ $card2Desc }}</p>
                    </div>
                </div>

                <div class="safer-card">
                    <div class="safer-card-icon">
                        <i class="{{ $card3Icon }}"></i>
                    </div>
                    <div class="safer-card-content">
                        <h3 class="safer-card-title">{{ $card3Title }}</h3>
                        <p class="safer-card-desc">{{ $card3Desc }}</p>
                    </div>
                </div>

            </div>
        </div>
    </div>
</div>

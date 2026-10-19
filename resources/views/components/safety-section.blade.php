{{-- USER PROMPT: "ya admin pannel home page main ya section dynamic kro" --}}
<!-- SAFETY & RESPONSIBLE PET OWNERSHIP SECTION COMPONENT (Dynamic via Admin Panel) -->
<section id="safety" class="safety-ownership-section">
    <div class="shell-1440">
        <div class="container">
            <div class="safety-grid">

                <!-- Left Visual Image Column -->
                <div class="safety-image-col">
                    <img src="{{ asset(\App\Models\SiteSetting::get('safety_image', 'images/safety-responsible.png')) }}" alt="{{ \App\Models\SiteSetting::get('safety_title', 'Safety & Responsible') }} {{ \App\Models\SiteSetting::get('safety_title_highlight', 'Pet Ownership') }}" class="safety-group-img">
                </div>

                <!-- Right Content Column -->
                <div class="safety-content-col">
                    <h2 class="safety-title">
                        {{ \App\Models\SiteSetting::get('safety_title', 'Safety & Responsible') }} <br>
                        <span class="safety-title-highlight">{{ \App\Models\SiteSetting::get('safety_title_highlight', 'Pet Ownership') }}</span>
                    </h2>

                    <p class="safety-lead">
                        <strong>{{ \App\Models\SiteSetting::get('safety_lead_bold', 'We promote safe pet transactions') }}</strong> {{ \App\Models\SiteSetting::get('safety_lead_text', 'and responsible ownership to help protect both pets and people.') }}
                    </p>

                    @php
                        $defaultPoints = [
                            "Verify the pet’s health and vaccination details before buying.",
                            "Meet the seller and pet in a safe location.",
                            "Never send advance payment without proper verification.",
                            "Understand the pet’s food, care, medical, and exercise needs.",
                            "Report suspicious or misleading listings."
                        ];
                        $rawPoints = \App\Models\SiteSetting::get('safety_points');
                        $points = !empty($rawPoints) ? array_values(array_filter(array_map('trim', explode("\n", $rawPoints)))) : $defaultPoints;
                    @endphp

                    <ul class="safety-checklist">
                        @foreach($points as $point)
                            <li class="safety-check-item">
                                <div class="safety-check-icon">
                                    <i class="fas fa-check"></i>
                                </div>
                                <span class="safety-check-text">{{ $point }}</span>
                            </li>
                        @endforeach
                    </ul>
                </div>

            </div>
        </div>
    </div>
</section>

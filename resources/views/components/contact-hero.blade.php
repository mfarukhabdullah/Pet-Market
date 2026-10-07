@props([
    'title' => 'How can we help?',
    'subtitle' => 'Contact Pet Marketplace for general support, account questions,<br>listing concerns or marketplace safety issues.'
])
<section class="contact-hero">
    <div class="shell-1440">
        <div class="container">
            <div class="contact-hero-inner">
                <h1 class="contact-title">{{ $title }}</h1>
                <p class="contact-desc">{!! $subtitle !!}</p>
            </div>
        </div>
    </div>
</section>

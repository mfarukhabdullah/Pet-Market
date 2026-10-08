<style>
    /* Pet Card - List View Style */
    .pet-card {
        display: flex;
        height: 248px;
        background-color: #ffffff;
        border-radius: 20px;
        overflow: hidden;
        border: 0.7px solid #D8DDD9;
        box-shadow: 0px 2px 12px 0px rgba(0, 0, 0, 0.10);
        position: relative;
        transition: box-shadow 0.3s ease, transform 0.3s ease;
    }
    
    .pet-card:hover {
        box-shadow: var(--shadow-lg);
        transform: translateY(-2px);
    }

    .pet-card-img {
        width: 320px;
        min-width: 320px;
        height: 100%;
        object-fit: cover;
    }

    .pet-card-content {
        padding: 24px;
        flex: 1;
        display: flex;
        flex-direction: column;
        justify-content: center;
    }

    .pet-title {
        font-family: 'Manrope', sans-serif;
        font-size: 20px;
        font-weight: 700;
        line-height: 23.64px;
        color: #17211C;
        margin-bottom: 6px;
    }

    .pet-breed {
        font-family: 'DM Sans', sans-serif;
        font-size: 15px;
        font-weight: 400;
        line-height: 22.79px;
        color: #667069;
        margin-bottom: 8px;
    }

    .pet-price {
        font-family: 'DM Sans', sans-serif;
        font-size: 22px;
        font-weight: 700;
        line-height: 32.56px;
        color: #147A4D;
        margin-bottom: 12px;
    }

    .pet-meta {
        display: flex;
        gap: 24px;
        font-size: 0.85rem;
        color: var(--text-muted);
        margin-bottom: 12px;
    }

    .pet-meta span {
        display: flex;
        align-items: center;
        gap: 8px;
    }

    .pet-location {
        font-family: 'DM Sans', sans-serif;
        font-size: 14px;
        color: #667069;
        display: flex;
        align-items: center;
        gap: 7.35px;
        border-top: 0.7px solid #E2E7E3;
        padding-top: 12.61px;
        width: 250px;
    }

    .favorite-btn {
        position: absolute;
        top: 16px;
        right: 16px;
        width: 39.92px;
        height: 39.92px;
        border-radius: 19.96px;
        background-color: rgba(255, 255, 255, 0.94);
        border: none;
        display: flex;
        align-items: center;
        justify-content: center;
        color: #17211C;
        font-size: 1.1rem;
        cursor: pointer;
        transition: all 0.2s ease;
        box-shadow: 0px 0px 10px 0px rgba(0, 0, 0, 0.16);
    }

    .favorite-btn:hover {
        color: var(--accent);
        border-color: var(--accent);
    }

    @media (max-width: 1024px) {
        .pet-card-img {
            width: 260px;
            min-width: 260px;
        }
    }

    @media (max-width: 768px) {
        .pet-card {
            flex-direction: column;
            height: auto;
        }
        .pet-card-img {
            width: 100%;
            min-width: 100%;
            height: 220px;
        }
        .pet-card-content {
            padding: 24px;
        }
    }
</style>

<div class="pet-card">
    <img src="{{ asset('images/cat-category.png') }}" alt="British Shorthair" class="pet-card-img">
    
    <div class="pet-card-content">
        <h3 class="pet-title">British Shorthair</h3>
        <p class="pet-breed">British Shorthair</p>
        <div class="pet-price">Rs. 42,000</div>
        
        <div class="pet-meta">
            <span><i class="fa-regular fa-clock"></i> 7 Months</span>
            <span><i class="fa-solid fa-venus"></i> Female</span>
        </div>
        
        <div class="pet-location">
            <i class="fa-solid fa-location-dot"></i> Islamabad
        </div>
    </div>
    
    <button class="favorite-btn" aria-label="Add to favorites">
        <i class="fa-solid fa-heart"></i>
    </button>
</div>

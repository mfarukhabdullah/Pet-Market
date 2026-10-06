<style>
    /* Filter Sidebar Styles */
    .filter-sidebar {
        background-color: #ffffff;
        border-radius: var(--radius-md);
        padding: 24px;
        box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.05), 0 2px 4px -1px rgba(0, 0, 0, 0.03);
        border: 1px solid var(--border-color);
        height: 1350px;
        display: flex;
        flex-direction: column;
        justify-content: space-between;
    }

    .filter-header {
        display: flex;
        justify-content: space-between;
        align-items: center;
        margin-bottom: 0;
    }

    .filter-title {
        font-family: 'Manrope', sans-serif;
        font-size: 19px;
        font-weight: 700;
        line-height: 28.5px;
        letter-spacing: -0.5px;
        color: #17211C;
        margin: 0;
    }

    .reset-link {
        font-family: 'DM Sans', sans-serif;
        font-size: 12px;
        font-weight: 700;
        line-height: 18px;
        letter-spacing: 0px;
        color: #147A4D;
        text-align: center;
        text-decoration: none;
    }

    .filter-group {
        padding-top: 16px;
        border-top: 0.67px solid #C4C4C4;
    }

    .filter-label {
        font-family: 'DM Sans', sans-serif;
        font-size: 14px;
        font-weight: 700;
        line-height: 21px;
        letter-spacing: 0px;
        color: #17211C;
        margin-bottom: 8px;
        display: block;
    }

    .filter-select {
        width: 100%;
        height: 44px;
        padding: 0 14px;
        border: 0.67px solid #C4C4C4;
        border-radius: 11px;
        font-size: 16px;
        font-family: "DM Sans";
        font-weight: 400;
        line-height: 100%;
        letter-spacing: 0px;
        color: #17211C;
        background-color: #ffffff;
        outline: none;
        cursor: pointer;
        appearance: none;
        background-image: url("data:image/svg+xml;charset=US-ASCII,%3Csvg%20xmlns%3D%22http%3A%2F%2Fwww.w3.org%2F2000%2Fsvg%22%20width%3D%2224%22%20height%3D%2224%22%20viewBox%3D%220%200%2024%2024%22%20fill%3D%22none%22%20stroke%3D%22%2317211C%22%20stroke-width%3D%222%22%20stroke-linecap%3D%22round%22%20stroke-linejoin%3D%22round%22%3E%3Cpolyline%20points%3D%226%209%2012%2015%2018%209%22%2F%3E%3C%2Fsvg%3E");
        background-repeat: no-repeat;
        background-position: right 14px top 50%;
        background-size: 16px auto;
    }

    .filter-range {
        display: flex;
        gap: 12px;
    }

    .filter-range input {
        width: 100%;
        height: 44px;
        padding: 0 12px;
        border: 0.67px solid #C4C4C4;
        border-radius: 11px;
        background-color: #FFFFFF;
        font-family: 'DM Sans', sans-serif;
        font-weight: 400;
        font-size: 16px;
        line-height: 100%;
        color: #17211C;
        outline: none;
    }
    
    .filter-range input::placeholder {
        color: #17211C;
        opacity: 1;
    }

    .checkbox-group {
        display: flex;
        flex-direction: column;
        gap: 8px;
    }

    .checkbox-label {
        display: flex;
        align-items: center;
        gap: 10px;
        font-family: 'DM Sans', sans-serif;
        font-weight: 400;
        font-size: 13px;
        line-height: 19.5px;
        color: #000000;
        cursor: pointer;
    }

    .checkbox-label input[type="radio"] {
        appearance: none;
        -webkit-appearance: none;
        width: 16px;
        height: 16px;
        border: 1px solid var(--border-color);
        border-radius: 4px;
        cursor: pointer;
        position: relative;
        background-color: #ffffff;
        margin: 0;
    }

    .checkbox-label input[type="radio"]:checked {
        background-color: #059669;
        border-color: #059669;
    }

    .checkbox-label input[type="radio"]:checked::after {
        content: '';
        position: absolute;
        left: 4.5px;
        top: 1.5px;
        width: 4px;
        height: 8px;
        border: solid white;
        border-width: 0 2px 2px 0;
        transform: rotate(45deg);
    }

    .btn-apply {
        width: 100%;
        height: 46px;
        padding: 0 18px;
        background-color: #147A4D;
        color: #ffffff;
        border-radius: 12px;
        font-family: 'DM Sans', sans-serif;
        font-weight: 700;
        font-size: 14px;
        line-height: 21px;
        text-align: center;
        border: none;
        cursor: pointer;
        transition: background-color 0.3s ease;
        display: flex;
        align-items: center;
        justify-content: center;
    }

    .btn-apply:hover {
        background-color: #116841;
    }

    @media (max-width: 768px) {
        .filter-sidebar {
            margin-bottom: 24px;
        }
    }
</style>

<aside class="filter-sidebar">
    <div class="filter-header">
        <h3 class="filter-title">Filters</h3>
        <a href="#" class="reset-link">Reset all</a>
    </div>

    <div class="filter-group">
        <label class="filter-label">Pet Category</label>
        <select class="filter-select">
            <option>All Categories</option>
            <option>Cats</option>
            <option>Dogs</option>
            <option>Birds</option>
        </select>
    </div>

    <div class="filter-group">
        <label class="filter-label">Breed</label>
        <select class="filter-select">
            <option>All Breeds</option>
            <option>British Shorthair</option>
            <option>Persian</option>
            <option>Siamese</option>
        </select>
    </div>

    <div class="filter-group">
        <label class="filter-label">Location / City</label>
        <select class="filter-select">
            <option>All Locations</option>
            <option>Islamabad</option>
            <option>Lahore</option>
            <option>Karachi</option>
        </select>
    </div>

    <div class="filter-group">
        <label class="filter-label">Price Range</label>
        <div class="filter-range">
            <input type="number" min="0" placeholder="Min">
            <input type="number" min="0" placeholder="Max">
        </div>
    </div>

    <div class="filter-group">
        <label class="filter-label">Age Range</label>
        <div class="filter-range">
            <input type="number" min="0" placeholder="Min">
            <input type="number" min="0" placeholder="Max">
        </div>
    </div>

    <div class="filter-group">
        <label class="filter-label">Gender</label>
        <div class="checkbox-group">
            <label class="checkbox-label"><input type="radio" name="gender"> Male</label>
            <label class="checkbox-label"><input type="radio" name="gender"> Female</label>
        </div>
    </div>

    <div class="filter-group">
        <label class="filter-label">Health</label>
        <div class="checkbox-group">
            <label class="checkbox-label"><input type="radio" name="health"> Vaccinated</label>
            <label class="checkbox-label"><input type="radio" name="health"> Health information available</label>
        </div>
    </div>

    <div class="filter-group">
        <label class="filter-label">Pedigree / Papers</label>
        <div class="checkbox-group">
            <label class="checkbox-label"><input type="radio" name="pedigree"> Yes</label>
            <label class="checkbox-label"><input type="radio" name="pedigree"> No</label>
            <label class="checkbox-label"><input type="radio" name="pedigree"> Not applicable</label>
        </div>
    </div>

    <div class="filter-group">
        <label class="filter-label">Seller Type</label>
        <div class="checkbox-group">
            <label class="checkbox-label"><input type="radio" name="seller_type"> Individual Seller</label>
            <label class="checkbox-label"><input type="radio" name="seller_type"> Breeder / Business</label>
            <label class="checkbox-label"><input type="radio" name="seller_type"> Verified Seller</label>
        </div>
    </div>
    
    <div class="filter-group">
        <label class="filter-label">Date Posted</label>
        <select class="filter-select">
            <option>Any Time</option>
            <option>Last 24 Hours</option>
            <option>Last 7 Days</option>
            <option>Last 30 Days</option>
        </select>
    </div>

    <button class="btn-apply">Apply Filters</button>
</aside>

/**
 * PAW-MARKET - Interactive Client Logic & Real-Time Layout Debugger
 */

document.addEventListener('DOMContentLoaded', () => {
  initThemeToggle();
  initMobileMenu();
  initContainerDebugger();
  initROICalculator();
  initInfluencerFilters();
  initFAQAccordion();
  initMobileFilters();
  initPagination();
  initSearchFilter();
  initSidebarFilter();
});

/* ==========================================
   1. Theme Switcher (Light / Dark)
   ========================================== */
function initThemeToggle() {
  const themeBtn = document.getElementById('themeToggleBtn');
  if (!themeBtn) return;

  const savedTheme = localStorage.getItem('paw_theme') || 'light';
  document.documentElement.setAttribute('data-theme', savedTheme);
  updateThemeIcon(savedTheme);

  themeBtn.addEventListener('click', () => {
    const currentTheme = document.documentElement.getAttribute('data-theme');
    const newTheme = currentTheme === 'dark' ? 'light' : 'dark';
    document.documentElement.setAttribute('data-theme', newTheme);
    localStorage.setItem('paw_theme', newTheme);
    updateThemeIcon(newTheme);
  });
}

function updateThemeIcon(theme) {
  const themeBtn = document.getElementById('themeToggleBtn');
  if (themeBtn) {
    themeBtn.innerHTML = theme === 'dark' ? '<i class="fas fa-sun"></i>' : '<i class="fas fa-moon"></i>';
  }
}

/* ==========================================
   2. Mobile Drawer Navigation
   ========================================== */
function initMobileMenu() {
  // Bottom Nav Account Button -> Account Drawer
  const accountToggleBtn = document.getElementById('mobileToggleBtn');
  const accountDrawer = document.getElementById('accountNavDrawer');
  
  // Top Header Menu Button -> Main Mobile Nav Drawer
  const mainToggleBtn = document.querySelector('.mobile-menu-btn');
  const mainDrawer = document.getElementById('mobileNavDrawer');
  const closeMainDrawerBtn = document.getElementById('closeDrawerBtn');

  // Open Account Drawer
  if (accountToggleBtn && accountDrawer) {
    accountToggleBtn.addEventListener('click', (e) => {
      e.stopPropagation();
      accountDrawer.classList.toggle('open');
      if (mainDrawer) mainDrawer.classList.remove('open');
    });
  }

  // Open Main Drawer
  if (mainToggleBtn && mainDrawer) {
    mainToggleBtn.addEventListener('click', (e) => {
      e.stopPropagation();
      mainDrawer.classList.toggle('open');
      if (accountDrawer) accountDrawer.classList.remove('open');
    });
  }

  // Close Main Drawer Button
  if (closeMainDrawerBtn && mainDrawer) {
    closeMainDrawerBtn.addEventListener('click', () => {
      mainDrawer.classList.remove('open');
    });
  }

  // Close both drawers when clicking outside
  document.addEventListener('click', (e) => {
    if (accountDrawer && accountDrawer.classList.contains('open') && !accountDrawer.contains(e.target)) {
      accountDrawer.classList.remove('open');
    }
    if (mainDrawer && mainDrawer.classList.contains('open') && !mainDrawer.contains(e.target)) {
      mainDrawer.classList.remove('open');
    }
  });

  // Close when clicking a link
  const mobileLinks = document.querySelectorAll('.mobile-nav-list a, .account-nav-list a');
  mobileLinks.forEach(link => {
    link.addEventListener('click', () => {
      if (mainDrawer) mainDrawer.classList.remove('open');
      if (accountDrawer) accountDrawer.classList.remove('open');
    });
  });
}

/* ==========================================
   3. Container & Screen Responsive Inspector
   ========================================== */
function initContainerDebugger() {
  const debugW = document.getElementById('debugViewportW');
  const debugWrapper = document.getElementById('debugWrapperW');
  const debugContainer = document.getElementById('debugContainerW');
  const debugZoom = document.getElementById('debugZoomScale');
  const guideToggleBtn = document.getElementById('toggleGuidesBtn');

  function updateMetrics() {
    const vw = window.innerWidth;
    const siteWrapper = document.querySelector('.site-wrapper');
    const container = document.querySelector('.container');

    if (debugW) debugW.textContent = `${vw}px`;

    if (siteWrapper && debugWrapper) {
      const swW = siteWrapper.getBoundingClientRect().width;
      debugWrapper.textContent = `${Math.round(swW)}px (Max 1440px)`;
    }

    if (container && debugContainer) {
      const cW = container.getBoundingClientRect().width;
      debugContainer.textContent = `${Math.round(cW)}px (Max 1250px)`;
    }

    if (debugZoom) {
      // Estimate zoom level relative to devicePixelRatio
      const zoomRatio = Math.round((window.devicePixelRatio || 1) * 100);
      debugZoom.textContent = `${zoomRatio}%`;
    }
  }

  window.addEventListener('resize', updateMetrics);
  updateMetrics();

  if (guideToggleBtn) {
    guideToggleBtn.addEventListener('click', () => {
      document.body.classList.toggle('show-container-guides');
      const isShowing = document.body.classList.contains('show-container-guides');
      guideToggleBtn.textContent = isShowing ? 'Hide Container Outlines' : 'Show Container Outlines';
      guideToggleBtn.style.backgroundColor = isShowing ? '#ef4444' : '#2563eb';
    });
  }
}

/* ==========================================
   4. Interactive Campaign ROI Calculator
   ========================================== */
function initROICalculator() {
  const budgetInput = document.getElementById('calcBudget');
  const budgetValDisplay = document.getElementById('calcBudgetValue');
  const resultReach = document.getElementById('calcResultReach');
  const resultClicks = document.getElementById('calcResultClicks');
  const resultRevenue = document.getElementById('calcResultRevenue');
  const categoryBtns = document.querySelectorAll('.category-btn');

  if (!budgetInput) return;

  let selectedMultiplier = 1.0; // default dog/all multiplier

  function calculate() {
    const budget = parseFloat(budgetInput.value);
    budgetValDisplay.textContent = `$${budget.toLocaleString()}`;

    // Calculation formulas
    const reach = Math.round(budget * 145 * selectedMultiplier);
    const clicks = Math.round(budget * 4.2 * selectedMultiplier);
    const projectedRevenue = Math.round(budget * 5.8 * selectedMultiplier);

    resultReach.textContent = reach.toLocaleString();
    resultClicks.textContent = clicks.toLocaleString();
    resultRevenue.textContent = `$${projectedRevenue.toLocaleString()}`;
  }

  budgetInput.addEventListener('input', calculate);

  categoryBtns.forEach(btn => {
    btn.addEventListener('click', () => {
      categoryBtns.forEach(b => b.classList.remove('active'));
      btn.classList.add('active');
      selectedMultiplier = parseFloat(btn.dataset.multiplier || 1.0);
      calculate();
    });
  });

  calculate();
}

/* ==========================================
   5. Influencer Filtering
   ========================================== */
function initInfluencerFilters() {
  const filterBtns = document.querySelectorAll('.influencer-filter-btn');
  const cards = document.querySelectorAll('.influencer-card');

  if (!filterBtns.length) return;

  filterBtns.forEach(btn => {
    btn.addEventListener('click', () => {
      filterBtns.forEach(b => b.classList.remove('active'));
      btn.classList.add('active');

      const filter = btn.dataset.filter;

      cards.forEach(card => {
        if (filter === 'all' || card.dataset.category === filter) {
          card.style.display = 'block';
        } else {
          card.style.display = 'none';
        }
      });
    });
  });
}

/* ==========================================
   6. FAQ Accordion
   ========================================== */
function initFAQAccordion() {
  const faqItems = document.querySelectorAll('.faq-item');

  faqItems.forEach(item => {
    const questionBtn = item.querySelector('.faq-question');
    if (questionBtn) {
      questionBtn.addEventListener('click', () => {
        const isActive = item.classList.contains('active');

        faqItems.forEach(i => i.classList.remove('active'));

        if (!isActive) {
          item.classList.add('active');
        }
      });
    }
  });
}

/* ==========================================
   7. Mobile Filters Drawer Toggle
   ========================================== */
function initMobileFilters() {
  const filterToggleBtn = document.getElementById('mobileFilterToggleBtn');
  const closeFiltersBtn = document.getElementById('closeFiltersBtn');
  const filtersSidebar = document.getElementById('filtersSidebarCard');

  if (filterToggleBtn && filtersSidebar) {
    filterToggleBtn.addEventListener('click', () => {
      filtersSidebar.classList.add('mobile-open');
    });
  }

  if (closeFiltersBtn && filtersSidebar) {
    closeFiltersBtn.addEventListener('click', () => {
      filtersSidebar.classList.remove('mobile-open');
    });
  }
}

/* ==========================================
   8. Category Pagination
   ========================================== */
function initPagination() {
  const paginationRow = document.querySelector('.category-pagination-row');
  if (!paginationRow) return;

  const pageBtns = Array.from(paginationRow.querySelectorAll('.page-num-btn'));
  const prevBtn = paginationRow.querySelector('button[aria-label="Previous Page"]');
  const nextBtn = paginationRow.querySelector('button[aria-label="Next Page"]');

  if (!pageBtns.length) return;

  function updateActivePage(newIndex) {
    if (newIndex < 0 || newIndex >= pageBtns.length) return;

    pageBtns.forEach(btn => btn.classList.remove('active'));
    pageBtns[newIndex].classList.add('active');
  }

  pageBtns.forEach((btn, index) => {
    btn.addEventListener('click', () => {
      updateActivePage(index);
    });
  });

  if (prevBtn) {
    prevBtn.addEventListener('click', () => {
      const activeIndex = pageBtns.findIndex(btn => btn.classList.contains('active'));
      if (activeIndex > 0) {
        updateActivePage(activeIndex - 1);
      }
    });
  }

  if (nextBtn) {
    nextBtn.addEventListener('click', () => {
      const activeIndex = pageBtns.findIndex(btn => btn.classList.contains('active'));
      if (activeIndex !== -1 && activeIndex < pageBtns.length - 1) {
        updateActivePage(activeIndex + 1);
      }
    });
  }
}

// Profile Dropdown Logic
document.addEventListener('DOMContentLoaded', function() {
    const profileBtn = document.getElementById('profileDropdownBtn');
    const profileMenu = document.getElementById('profileDropdownMenu');
    
    if (profileBtn && profileMenu) {
        profileBtn.addEventListener('click', function(e) {
            e.stopPropagation();
            profileMenu.classList.toggle('show');
        });
        
        document.addEventListener('click', function(e) {
            if (!profileBtn.contains(e.target) && !profileMenu.contains(e.target)) {
                profileMenu.classList.remove('show');
            }
        });
    }
});

/* ==========================================
   9. Category Search Filter
   ========================================== */
function initSearchFilter() {
  const searchForm = document.getElementById('searchFilterForm');
  if (!searchForm) return;

  const searchInput = searchForm.querySelector('.search-form-input');
  const categorySelect = searchForm.querySelector('select[name="category"]');
  const locationSelect = searchForm.querySelector('select[name="location"]');
  const petCards = document.querySelectorAll('.pet-card');

  function filterPets() {
    const searchTerm = searchInput ? searchInput.value.toLowerCase() : '';
    const categoryVal = categorySelect ? categorySelect.value.toLowerCase() : '';
    const locationVal = locationSelect ? locationSelect.value.toLowerCase() : '';

    petCards.forEach(card => {
      const titleEl = card.querySelector('.pet-name');
      const title = titleEl ? titleEl.innerText.toLowerCase() : '';
      const breedTagEl = card.querySelector('.pet-breed-tag');
      const breedTag = breedTagEl ? breedTagEl.innerText.toLowerCase() : '';
      const location = (card.dataset.location || '').toLowerCase();

      // Check text search
      const matchesSearch = title.includes(searchTerm) || breedTag.includes(searchTerm);
      
      // Check category (simple mockup mapping)
      let matchesCategory = true;
      if (categoryVal) {
          const cat = categoryVal.replace(/s$/, ''); // 'dogs' -> 'dog'
          if (cat === 'dog' && (title.includes('retriever') || title.includes('puppy') || title.includes('dog'))) matchesCategory = true;
          else if (cat === 'cat' && (title.includes('persian') || title.includes('cat'))) matchesCategory = true;
          else if (cat === 'bird' && (title.includes('macaw') || title.includes('parrot') || title.includes('bird'))) matchesCategory = true;
          else matchesCategory = false;
      }
      
      // Check location
      const matchesLocation = !locationVal || location.includes(locationVal);

      if (matchesSearch && matchesCategory && matchesLocation) {
        card.style.display = '';
      } else {
        card.style.display = 'none';
      }
    });
  }

  // Bind events for live filtering
  if (searchInput) searchInput.addEventListener('input', filterPets);
  if (categorySelect) categorySelect.addEventListener('change', filterPets);
  if (locationSelect) locationSelect.addEventListener('change', filterPets);
  
  // Prevent form submission refresh
  searchForm.addEventListener('submit', (e) => {
    e.preventDefault();
    filterPets();
  });
}

/* ==========================================
   10. Sidebar Filters Logic
   ========================================== */
function initSidebarFilter() {
  const sidebarForm = document.getElementById('sidebarFiltersForm');
  if (!sidebarForm) return;

  const categorySelect = document.getElementById('filterCategory');
  const breedSelect = document.getElementById('filterBreed');
  const locationSelect = document.getElementById('filterLocation');
  const petCards = document.querySelectorAll('.pet-card');

  function applySidebarFilters() {
    const categoryVal = categorySelect ? categorySelect.value.toLowerCase() : '';
    const breedVal = breedSelect ? breedSelect.value.toLowerCase() : '';
    const locationVal = locationSelect ? locationSelect.value.toLowerCase() : '';
    
    // Get checked genders
    const checkedGenders = Array.from(sidebarForm.querySelectorAll('input[name="gender"]:checked')).map(cb => cb.value.toLowerCase());

    // Parse Price Range Filters
    const priceMinEl = document.getElementById('priceMin');
    const priceMin = priceMinEl ? parseInt(priceMinEl.value) : NaN;
    const priceMaxEl = document.getElementById('priceMax');
    const priceMax = priceMaxEl ? parseInt(priceMaxEl.value) : NaN;

    // Parse Age Range Filters
    const ageMinEl = document.getElementById('ageMin');
    const minAgeVal = ageMinEl ? parseInt(ageMinEl.value) : NaN;
    const ageMinUnitEl = document.getElementById('ageMinUnit');
    const minAgeUnit = ageMinUnitEl ? ageMinUnitEl.value : 'months';
    let minDays = null;
    if (!isNaN(minAgeVal)) {
        if (minAgeUnit === 'years') minDays = minAgeVal * 365;
        else if (minAgeUnit === 'months') minDays = minAgeVal * 30;
        else minDays = minAgeVal;
    }

    const ageMaxEl = document.getElementById('ageMax');
    const maxAgeVal = ageMaxEl ? parseInt(ageMaxEl.value) : NaN;
    const ageMaxUnitEl = document.getElementById('ageMaxUnit');
    const maxAgeUnit = ageMaxUnitEl ? ageMaxUnitEl.value : 'months';
    let maxDays = null;
    if (!isNaN(maxAgeVal)) {
        if (maxAgeUnit === 'years') maxDays = maxAgeVal * 365;
        else if (maxAgeUnit === 'months') maxDays = maxAgeVal * 30;
        else maxDays = maxAgeVal;
    }

    let visibleCount = 0;

    petCards.forEach(card => {
      const breed = (card.dataset.breed || '').toLowerCase();
      const location = (card.dataset.location || '').toLowerCase();
      const gender = (card.dataset.gender || '').toLowerCase();
      const titleEl = card.querySelector('.pet-name');
      const title = titleEl ? titleEl.innerText.toLowerCase() : '';

      // Check category
      let matchesCategory = true;
      if (categoryVal) {
          const cat = categoryVal.replace(/s$/, ''); // 'dogs' -> 'dog'
          if (cat === 'dog' && (title.includes('retriever') || title.includes('puppy') || title.includes('dog') || title.includes('shih tzu') || title.includes('shepherd'))) matchesCategory = true;
          else if (cat === 'cat' && (title.includes('persian') || title.includes('cat') || title.includes('shorthair'))) matchesCategory = true;
          else if (cat === 'bird' && (title.includes('macaw') || title.includes('parrot') || title.includes('bird') || title.includes('lovebird'))) matchesCategory = true;
          else if (cat === 'rabbit' && title.includes('rabbit')) matchesCategory = true;
          else matchesCategory = false;
      }

      // Check breed
      const matchesBreed = !breedVal || breed === breedVal;

      // Check location
      const matchesLocation = !locationVal || location === locationVal;
      
      // Check gender
      const matchesGender = checkedGenders.length === 0 || checkedGenders.includes(gender);

      // Check Age
      let matchesAge = true;
      const clockIcon = card.querySelector('.meta-item i.fa-clock');
      const ageText = (clockIcon && clockIcon.parentElement) ? clockIcon.parentElement.innerText.toLowerCase().trim() : '';
      let cardAgeDays = null;
      if (ageText) {
          const match = ageText.match(/(\d+)\s*(day|month|year)/);
          if (match) {
              const num = parseInt(match[1]);
              const unit = match[2];
              if (unit === 'year') cardAgeDays = num * 365;
              else if (unit === 'month') cardAgeDays = num * 30;
              else if (unit === 'day') cardAgeDays = num;
          }
      }
      if (cardAgeDays !== null) {
          if (minDays !== null && cardAgeDays < minDays) matchesAge = false;
          if (maxDays !== null && cardAgeDays > maxDays) matchesAge = false;
      }

      // Check Price
      let matchesPrice = true;
      const priceEl = card.querySelector('.pet-price');
      if (priceEl) {
          const priceText = priceEl.innerText.replace(/[^0-9]/g, '');
          const priceVal = parseInt(priceText);
          if (!isNaN(priceVal)) {
              if (!isNaN(priceMin) && priceVal < priceMin) matchesPrice = false;
              if (!isNaN(priceMax) && priceVal > priceMax) matchesPrice = false;
          }
      }

      // Check Featured
      const urlParams = new URLSearchParams(window.location.search);
      const isFeaturedOnly = urlParams.get('featured') === 'true';
      let matchesFeatured = true;
      if (isFeaturedOnly) {
          const featuredBadge = card.querySelector('.featured-badge');
          if (!featuredBadge) {
              matchesFeatured = false;
          }
      }

      if (matchesCategory && matchesBreed && matchesLocation && matchesGender && matchesAge && matchesPrice && matchesFeatured) {
        card.style.display = '';
        visibleCount++;
      } else {
        card.style.display = 'none';
      }
    });

    // Handle No Results Message
    const grid = document.getElementById('petCardsGrid');
    const noResultsMsg = document.getElementById('noResultsMessage');
    
    if (grid && noResultsMsg) {
      if (visibleCount === 0) {
        grid.style.display = 'none';
        noResultsMsg.style.display = 'block';
      } else {
        grid.style.display = 'grid'; // Restore grid
        noResultsMsg.style.display = 'none';
      }
    }

    // Handle Reset Button and Pagination Visibility
    const hasActiveFilters = categoryVal || breedVal || locationVal || checkedGenders.length > 0 || minDays !== null || maxDays !== null || !isNaN(priceMin) || !isNaN(priceMax);
    const resetBtn = document.getElementById('resetFiltersBtn');
    const paginationRow = document.querySelector('.category-pagination-row');

    if (resetBtn) {
      resetBtn.style.display = hasActiveFilters ? 'inline-block' : 'none';
    }

    if (paginationRow) {
      paginationRow.style.display = hasActiveFilters ? 'none' : 'flex';
    }
  }

  sidebarForm.addEventListener('submit', (e) => {
    e.preventDefault(); // Prevent page refresh
    applySidebarFilters();
  });

  // Live filter on any change or input
  sidebarForm.addEventListener('change', applySidebarFilters);
  sidebarForm.addEventListener('input', applySidebarFilters);

  const resetBtn = document.getElementById('resetFiltersBtn');
  if (resetBtn) {
    resetBtn.addEventListener('click', () => {
      sidebarForm.reset();
      applySidebarFilters();
    });
  }

  // Parse URL parameters and apply
  const urlParams = new URLSearchParams(window.location.search);
  let hasUrlParams = false;

  if (urlParams.has('category')) {
      const val = urlParams.get('category');
      if (categorySelect) categorySelect.value = val;
      hasUrlParams = true;
  }
  if (urlParams.has('breed')) {
      const val = urlParams.get('breed');
      if (breedSelect) breedSelect.value = val;
      hasUrlParams = true;
  }
  if (urlParams.has('location')) {
      const val = urlParams.get('location');
      if (locationSelect) locationSelect.value = val;
      hasUrlParams = true;
  }
  if (urlParams.has('price')) {
      const priceVal = urlParams.get('price'); // e.g., "0-20000", "20000-50000", "100000+"
      if (priceVal.endsWith('+')) {
          const minVal = priceVal.replace('+', '');
          const priceMinEl = document.getElementById('priceMin');
          if (priceMinEl) priceMinEl.value = minVal;
      } else {
          const parts = priceVal.split('-');
          if (parts.length === 2) {
              const priceMinEl = document.getElementById('priceMin');
              const priceMaxEl = document.getElementById('priceMax');
              if (priceMinEl) priceMinEl.value = parts[0];
              if (priceMaxEl) priceMaxEl.value = parts[1];
          }
      }
      hasUrlParams = true;
  }
  if (urlParams.has('featured')) {
      hasUrlParams = true;
  }

  if (hasUrlParams) {
      applySidebarFilters();
  }
}

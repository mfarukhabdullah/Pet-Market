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
  initFavorites();
  initSettingsMenuScroll();
});

/* ==========================================
   1. Theme Switcher (Light / Dark)
   ========================================== */
function initSettingsMenuScroll() {
  const settingsMenu = document.querySelector('.settings-menu');
  if (settingsMenu && window.innerWidth <= 768) {
    const activeItem = settingsMenu.querySelector('.menu-item.active');
    if (activeItem) {
      const scrollPos = activeItem.offsetLeft - (settingsMenu.offsetWidth / 2) + (activeItem.offsetWidth / 2);
      settingsMenu.scrollLeft = scrollPos > 0 ? scrollPos : 0;
    }
  }
}

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
    const profileContainer = document.querySelector('.user-profile-dropdown');
    if (profileContainer) {
        profileContainer.addEventListener('mouseenter', function() {
            document.querySelectorAll('#bannerNotifMenu, .notif-dropdown-menu').forEach(m => m.classList.remove('show'));
        });
    }
    const notifContainer = document.querySelector('.notification-dropdown-container');
    if (notifContainer) {
        notifContainer.addEventListener('mouseenter', function() {
            const pm = document.getElementById('profileDropdownMenu');
            if (pm) pm.classList.remove('show');
        });
    }
    const profileBtn = document.getElementById('profileDropdownBtn');
    const profileMenu = document.getElementById('profileDropdownMenu');
    
    if (profileBtn && profileMenu) {
        profileBtn.addEventListener('click', function(e) {
            e.stopPropagation();
            document.querySelectorAll('#bannerNotifMenu, .notif-dropdown-menu').forEach(m => m.classList.remove('show'));
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
      
      // Check category
      let matchesCategory = true;
      if (categoryVal) {
          const cardCat = (card.dataset.category || '').toLowerCase();
          const targetCat = categoryVal.toLowerCase();
          const normalize = (c) => {
              if (c === 'fishes' || c === 'fish') return 'fish';
              if (c === 'reptile' || c === 'reptiles') return 'reptiles';
              if (c === 'horse' || c === 'horses' || c === 'horses-farm') return 'horses-farm';
              if (c === 'exotic' || c === 'exotic-pets') return 'exotic';
              return c.replace(/s$/, '');
          };
          if (cardCat) {
              matchesCategory = (cardCat === targetCat) || (normalize(cardCat) === normalize(targetCat));
          } else {
              const catNorm = normalize(targetCat);
              if (catNorm === 'dog' && (title.includes('retriever') || title.includes('puppy') || title.includes('dog') || title.includes('shih tzu') || title.includes('shepherd') || title.includes('pug'))) matchesCategory = true;
              else if (catNorm === 'cat' && (title.includes('persian') || title.includes('cat') || title.includes('shorthair') || title.includes('siamese'))) matchesCategory = true;
              else if (catNorm === 'bird' && (title.includes('macaw') || title.includes('parrot') || title.includes('bird') || title.includes('lovebird'))) matchesCategory = true;
              else if (catNorm === 'rabbit' && title.includes('rabbit')) matchesCategory = true;
              else if (catNorm === 'fish' && (title.includes('fish') || title.includes('betta') || title.includes('discus'))) matchesCategory = true;
              else if (catNorm === 'reptiles' && (title.includes('gecko') || title.includes('turtle') || title.includes('snake') || title.includes('reptile'))) matchesCategory = true;
              else if (catNorm === 'horses-farm' && (title.includes('horse') || title.includes('mare') || title.includes('goat') || title.includes('colt'))) matchesCategory = true;
              else if (catNorm === 'exotic' && (title.includes('grey') || title.includes('ringneck') || title.includes('glider') || title.includes('exotic'))) matchesCategory = true;
              else matchesCategory = false;
          }
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
  
  searchForm.addEventListener('submit', (e) => {
    e.preventDefault();
    const catVal = categorySelect ? (categorySelect.value || '').trim() : '';
    const locVal = locationSelect ? (locationSelect.value || '').trim() : '';
    const qVal = searchInput ? (searchInput.value || '').trim() : '';

    let basePath = '/category';
    if (catVal && catVal !== 'all' && locVal && locVal !== 'all') {
      basePath = '/category/' + encodeURIComponent(catVal) + '/' + encodeURIComponent(locVal);
    } else if (catVal && catVal !== 'all') {
      basePath = '/category/' + encodeURIComponent(catVal);
    } else if (locVal && locVal !== 'all') {
      basePath = '/category/' + encodeURIComponent(locVal);
    }

    const params = new URLSearchParams();
    if (qVal) params.set('q', qVal);
    const qStr = params.toString();
    window.location.href = basePath + (qStr ? '?' + qStr : '');
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

  // Helper: Normalize category names/slugs
  function normalizeCat(c) {
    if (!c || c === 'all') return '';
    c = c.toLowerCase().trim();
    if (c === 'fishes' || c === 'fish') return 'fish';
    if (c === 'reptile' || c === 'reptiles') return 'reptiles';
    if (c === 'horse' || c === 'horses' || c === 'horses-farm' || c === 'horse-farm' || c === 'farm') return 'horses-farm';
    if (c === 'exotic' || c === 'exotic-pets' || c === 'exotic-pet' || c === 'exotics') return 'exotic';
    if (c === 'dog' || c === 'dogs') return 'dogs';
    if (c === 'cat' || c === 'cats') return 'cats';
    if (c === 'bird' || c === 'birds') return 'birds';
    if (c === 'rabbit' || c === 'rabbits') return 'rabbits';
    return c.replace(/s$/, '');
  }

  // Dynamic Breed Cascading based on selected Category
  function updateBreedDropdown() {
    if (!categorySelect || !breedSelect) return;
    const catVal = (categorySelect.value || '').toLowerCase().trim();
    const targetNormCat = normalizeCat(catVal);

    const breedOptions = Array.from(breedSelect.querySelectorAll('option'));
    let currentlySelectedAvailable = false;
    const currentBreedVal = (breedSelect.value || '').toLowerCase().trim();

    breedOptions.forEach(opt => {
      if (!opt.value) {
        opt.hidden = false;
        opt.style.display = '';
        return;
      }
      const optCat = (opt.dataset.categorySlug || '').toLowerCase().trim();
      const normOptCat = normalizeCat(optCat);

      if (!targetNormCat || normOptCat === targetNormCat || optCat === catVal) {
        opt.hidden = false;
        opt.style.display = '';
        if (opt.value.toLowerCase().trim() === currentBreedVal) {
          currentlySelectedAvailable = true;
        }
      } else {
        opt.hidden = true;
        opt.style.display = 'none';
      }
    });

    if (currentBreedVal && !currentlySelectedAvailable) {
      breedSelect.value = '';
    }
  }

  if (categorySelect) {
    categorySelect.addEventListener('change', () => {
      updateBreedDropdown();
      applySidebarFilters();
    });
  }
  // Initialize dropdown state on page load
  updateBreedDropdown();

  // Helper function to parse user-entered price into a clean integer PKR
  function parsePriceValue(val) {
    if (val === null || val === undefined) return NaN;
    let s = String(val).toLowerCase().trim();
    if (!s) return NaN;
    // Strip PKR / Rs / Rs. / /- and commas
    s = s.replace(/pkr|rs\.?|\/\-/g, '').replace(/,/g, '').trim();
    if (!s) return NaN;
    // Support 'k' (thousands) and 'm' (millions)
    if (/^(\d+(\.\d+)?)\s*k$/i.test(s)) {
      const match = s.match(/^(\d+(\.\d+)?)\s*k$/i);
      return Math.round(parseFloat(match[1]) * 1000);
    }
    if (/^(\d+(\.\d+)?)\s*m$/i.test(s)) {
      const match = s.match(/^(\d+(\.\d+)?)\s*m$/i);
      return Math.round(parseFloat(match[1]) * 1000000);
    }
    const num = parseFloat(s);
    if (isNaN(num)) return NaN;
    // Auto-scale compact thousands (e.g. 50 or 60 means 50k / 60k, since minimum pet price is 4,500 PKR)
    if (num > 0 && num < 1000) {
      return Math.round(num * 1000);
    }
    return Math.round(num);
  }

  function applySidebarFilters() {
    const categoryVal = categorySelect ? categorySelect.value.toLowerCase().trim() : '';
    const breedVal = breedSelect ? breedSelect.value.toLowerCase().trim() : '';
    const locationVal = locationSelect ? locationSelect.value.toLowerCase().trim() : '';
    
    // Get checked genders
    const checkedGenders = Array.from(sidebarForm.querySelectorAll('input[name="gender[]"]:checked, input[name="gender"]:checked')).map(cb => cb.value.toLowerCase());

    // Parse Price Range Filters with smart typing detection & range swapping
    const priceMinEl = document.getElementById('priceMin');
    const priceMaxEl = document.getElementById('priceMax');
    const rawMinStr = priceMinEl ? priceMinEl.value.trim() : '';
    const rawMaxStr = priceMaxEl ? priceMaxEl.value.trim() : '';
    const priceMin = parsePriceValue(rawMinStr);
    const priceMax = parsePriceValue(rawMaxStr);

    let effectiveMin = priceMin;
    let effectiveMax = priceMax;

    if (!isNaN(priceMin) && !isNaN(priceMax)) {
      if (priceMin > priceMax) {
        // Check if user is actively typing in the Max input field (e.g. Min is '50000' and user has only typed '6')
        const isTypingMax = (document.activeElement === priceMaxEl) && (rawMaxStr.length < rawMinStr.length);
        const isTypingMin = (document.activeElement === priceMinEl) && (rawMinStr.length < rawMaxStr.length);

        if (isTypingMax) {
          // Temporarily ignore incomplete Max value while user is typing it out
          effectiveMax = NaN;
        } else if (isTypingMin) {
          // Temporarily ignore incomplete Min value while user is typing it out
          effectiveMin = NaN;
        } else {
          // Both numbers are completely typed but inverted (e.g. min 60000, max 50000): swap them
          effectiveMin = Math.min(priceMin, priceMax);
          effectiveMax = Math.max(priceMin, priceMax);
        }
      }
    }

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
      const cardCat = (card.dataset.category || '').toLowerCase();
      const cardBreedSlug = (card.dataset.breed || '').toLowerCase();
      const cardBreedName = (card.dataset.breedName || '').toLowerCase();
      const location = (card.dataset.location || '').toLowerCase();
      const gender = (card.dataset.gender || '').toLowerCase();
      const titleEl = card.querySelector('.pet-name');
      const title = titleEl ? titleEl.innerText.toLowerCase() : '';
      const breedTagEl = card.querySelector('.pet-breed-tag');
      const breedTag = breedTagEl ? breedTagEl.innerText.toLowerCase() : '';

      // Check category
      let matchesCategory = true;
      if (categoryVal) {
          const targetCatNorm = normalizeCat(categoryVal);
          const cardCatNorm = normalizeCat(cardCat);
          if (cardCat) {
              matchesCategory = (cardCat === categoryVal) || (cardCatNorm === targetCatNorm);
          } else {
              if (targetCatNorm === 'dogs' && (title.includes('retriever') || title.includes('puppy') || title.includes('dog') || title.includes('shih tzu') || title.includes('shepherd') || title.includes('pug'))) matchesCategory = true;
              else if (targetCatNorm === 'cats' && (title.includes('persian') || title.includes('cat') || title.includes('shorthair') || title.includes('siamese'))) matchesCategory = true;
              else if (targetCatNorm === 'birds' && (title.includes('macaw') || title.includes('parrot') || title.includes('bird') || title.includes('lovebird'))) matchesCategory = true;
              else if (targetCatNorm === 'rabbits' && title.includes('rabbit')) matchesCategory = true;
              else if (targetCatNorm === 'fish' && (title.includes('fish') || title.includes('betta') || title.includes('discus'))) matchesCategory = true;
              else if (targetCatNorm === 'reptiles' && (title.includes('gecko') || title.includes('turtle') || title.includes('snake') || title.includes('reptile'))) matchesCategory = true;
              else if (targetCatNorm === 'horses-farm' && (title.includes('horse') || title.includes('mare') || title.includes('goat') || title.includes('colt'))) matchesCategory = true;
              else if (targetCatNorm === 'exotic' && (title.includes('grey') || title.includes('ringneck') || title.includes('glider') || title.includes('exotic'))) matchesCategory = true;
              else matchesCategory = false;
          }
      }

      // Check breed (handles slug, clean spaced text, title, and breed tag)
      let matchesBreed = true;
      if (breedVal) {
          const cleanVal = breedVal.replace(/[^a-z0-9]/g, '');
          const spacedVal = breedVal.replace(/[-_]+/g, ' ').trim();
          const cleanCardBreed = cardBreedSlug.replace(/[^a-z0-9]/g, '');
          const cleanCardBreedName = cardBreedName.replace(/[^a-z0-9]/g, '');
          const cleanBreedTag = breedTag.replace(/[^a-z0-9]/g, '');
          const cleanTitle = title.replace(/[^a-z0-9]/g, '');

          matchesBreed = 
              cardBreedSlug === breedVal ||
              cardBreedName === spacedVal ||
              cleanCardBreed === cleanVal ||
              cleanCardBreedName === cleanVal ||
              cardBreedName.includes(spacedVal) ||
              breedTag.includes(spacedVal) ||
              title.includes(spacedVal) ||
              cleanBreedTag.includes(cleanVal) ||
              cleanTitle.includes(cleanVal);
      }

      // Check location
      const matchesLocation = !locationVal || location === locationVal || location.includes(locationVal);
      
      // Check gender
      const matchesGender = checkedGenders.length === 0 || checkedGenders.includes(gender);

      // Check Age
      let matchesAge = true;
      let cardAgeDays = null;
      if (card.dataset.ageMonths) {
          const m = parseInt(card.dataset.ageMonths);
          if (!isNaN(m)) cardAgeDays = m * 30;
      }
      if (cardAgeDays === null) {
          const clockIcon = card.querySelector('.meta-item i.fa-clock');
          const ageText = (clockIcon && clockIcon.parentElement) ? clockIcon.parentElement.innerText.toLowerCase().trim() : '';
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
      }
      if (cardAgeDays !== null) {
          if (minDays !== null && cardAgeDays < minDays) matchesAge = false;
          if (maxDays !== null && cardAgeDays > maxDays) matchesAge = false;
      }

      // Check Price
      let matchesPrice = true;
      let cardPrice = null;
      if (card.dataset.price) {
          const p = parseFloat(card.dataset.price);
          if (!isNaN(p)) cardPrice = p;
      }
      if (cardPrice === null) {
          const priceEl = card.querySelector('.pet-price');
          if (priceEl) {
              const priceText = priceEl.innerText.replace(/[^0-9.]/g, '');
              const p = parseFloat(priceText);
              if (!isNaN(p)) cardPrice = p;
          }
      }
      if (cardPrice !== null) {
          if (!isNaN(effectiveMin) && cardPrice < effectiveMin) matchesPrice = false;
          if (!isNaN(effectiveMax) && cardPrice > effectiveMax) matchesPrice = false;
      }

      // Check Featured
      const urlParams = new URLSearchParams(window.location.search);
      const isFeaturedOnly = urlParams.get('featured') === 'true' || urlParams.get('featured') === '1';
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
    const hasActiveFilters = categoryVal || breedVal || locationVal || checkedGenders.length > 0 || minDays !== null || maxDays !== null || !isNaN(effectiveMin) || !isNaN(effectiveMax);
    const resetBtn = document.getElementById('resetFiltersBtn');
    const paginationRow = document.querySelector('.category-pagination-row');

    if (resetBtn) {
      resetBtn.style.display = hasActiveFilters ? 'inline-block' : 'none';
    }

    if (paginationRow) {
      paginationRow.style.display = hasActiveFilters ? 'none' : 'flex';
    }
  }

  let filterDebounceTimer = null;
  function debouncedSidebarFilters() {
    if (filterDebounceTimer) clearTimeout(filterDebounceTimer);
    filterDebounceTimer = setTimeout(() => {
      applySidebarFilters();
    }, 250);
  }

  // Handle Form Submission: submit cleanly to server for full database filtering
  sidebarForm.addEventListener('submit', (e) => {
    e.preventDefault();

    // 1. Determine clean base URL path
    const isFeaturedPage = window.location.pathname.includes('/featured-pets');
    let basePath = isFeaturedPage ? '/featured-pets' : '/category';
    
    const catVal = categorySelect ? (categorySelect.value || '').trim() : '';
    const locVal = locationSelect ? (locationSelect.value || '').trim() : '';

    if (!isFeaturedPage) {
      if (catVal && catVal !== 'all' && locVal && locVal !== 'all') {
        basePath = '/category/' + encodeURIComponent(catVal) + '/' + encodeURIComponent(locVal);
      } else if (catVal && catVal !== 'all') {
        basePath = '/category/' + encodeURIComponent(catVal);
      } else if (locVal && locVal !== 'all') {
        basePath = '/category/' + encodeURIComponent(locVal);
      }
    }

    const params = new URLSearchParams();

    // Breed
    const breedVal = breedSelect ? (breedSelect.value || '').trim() : '';
    if (breedVal && breedVal !== 'all') {
      params.set('breed', breedVal);
    }

    // Price Range (smart swapped if inverted)
    const priceMinEl = document.getElementById('priceMin');
    const priceMaxEl = document.getElementById('priceMax');
    const pMin = priceMinEl ? parsePriceValue(priceMinEl.value.trim()) : NaN;
    const pMax = priceMaxEl ? parsePriceValue(priceMaxEl.value.trim()) : NaN;
    if (!isNaN(pMin) && !isNaN(pMax) && pMin > pMax) {
      params.set('price_min', pMax);
      params.set('price_max', pMin);
    } else {
      if (!isNaN(pMin)) params.set('price_min', pMin);
      if (!isNaN(pMax)) params.set('price_max', pMax);
    }

    // Age Min (only append unit if not default 'months')
    const ageMinEl = document.getElementById('ageMin');
    const ageMinVal = ageMinEl ? ageMinEl.value.trim() : '';
    const ageMinUnitEl = document.getElementById('ageMinUnit');
    const ageMinUnit = ageMinUnitEl ? ageMinUnitEl.value : 'months';
    if (ageMinVal !== '') {
      params.set('age_min', ageMinVal);
      if (ageMinUnit && ageMinUnit !== 'months') {
        params.set('age_min_unit', ageMinUnit);
      }
    }

    // Age Max (only append unit if not default 'months')
    const ageMaxEl = document.getElementById('ageMax');
    const ageMaxVal = ageMaxEl ? ageMaxEl.value.trim() : '';
    const ageMaxUnitEl = document.getElementById('ageMaxUnit');
    const ageMaxUnit = ageMaxUnitEl ? ageMaxUnitEl.value : 'months';
    if (ageMaxVal !== '') {
      params.set('age_max', ageMaxVal);
      if (ageMaxUnit && ageMaxUnit !== 'months') {
        params.set('age_max_unit', ageMaxUnit);
      }
    }

    // Gender (clean string or comma-separated without array brackets %5B%5D)
    const checkedGenders = Array.from(sidebarForm.querySelectorAll('input[name="gender"]:checked, input[name="gender[]"]:checked'))
      .map(cb => cb.value.toLowerCase().trim())
      .filter(Boolean);
    if (checkedGenders.length > 0) {
      params.set('gender', checkedGenders.join(','));
    }

    // Health
    const healthCb = sidebarForm.querySelector('input[name="health"]:checked');
    if (healthCb && healthCb.value) {
      params.set('health', healthCb.value);
    }
    const healthInfoCb = sidebarForm.querySelector('input[name="health_info"]:checked');
    if (healthInfoCb) {
      params.set('health_info', '1');
    }

    // Pedigree
    const pedigreeCb = sidebarForm.querySelector('input[name="pedigree"]:checked');
    if (pedigreeCb && pedigreeCb.value) {
      params.set('pedigree', pedigreeCb.value);
    }

    // Seller Type
    const sellerTypeCb = sidebarForm.querySelector('input[name="seller_type"]:checked');
    if (sellerTypeCb && sellerTypeCb.value) {
      params.set('seller_type', sellerTypeCb.value);
    }

    // Date
    const dateSelect = document.getElementById('filterDate');
    const dateVal = dateSelect ? (dateSelect.value || '').trim() : '';
    if (dateVal) {
      params.set('date', dateVal);
    }

    // Preserve sort or search query if present
    const currentParams = new URLSearchParams(window.location.search);
    if (currentParams.has('q')) {
      params.set('q', currentParams.get('q'));
    } else if (currentParams.has('search')) {
      params.set('search', currentParams.get('search'));
    }
    if (currentParams.has('sort')) {
      params.set('sort', currentParams.get('sort'));
    }

    const queryStr = params.toString();
    window.location.href = basePath + (queryStr ? '?' + queryStr : '');
  });

  // Live filter on change (immediate) or input (debounced)
  sidebarForm.addEventListener('change', () => {
    if (filterDebounceTimer) clearTimeout(filterDebounceTimer);
    applySidebarFilters();
  });
  sidebarForm.addEventListener('input', debouncedSidebarFilters);

  // When user finishes typing in price fields (blur), re-evaluate immediately
  const priceMinInputEl = document.getElementById('priceMin');
  const priceMaxInputEl = document.getElementById('priceMax');
  if (priceMinInputEl) {
    priceMinInputEl.addEventListener('blur', () => {
      if (filterDebounceTimer) clearTimeout(filterDebounceTimer);
      applySidebarFilters();
    });
  }
  if (priceMaxInputEl) {
    priceMaxInputEl.addEventListener('blur', () => {
      if (filterDebounceTimer) clearTimeout(filterDebounceTimer);
      applySidebarFilters();
    });
  }

  const resetBtn = document.getElementById('resetFiltersBtn');
  if (resetBtn) {
    resetBtn.addEventListener('click', (e) => {
      e.preventDefault();
      window.location.href = window.location.pathname;
    });
  }

  // Parse URL parameters and apply
  const urlParams = new URLSearchParams(window.location.search);
  let hasUrlParams = false;

  if (urlParams.has('category')) {
      const val = urlParams.get('category');
      if (categorySelect) categorySelect.value = val;
      const topCategorySelect = document.querySelector('.search-input-group select[name="category"]');
      if (topCategorySelect) topCategorySelect.value = val;
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
      const topLocationSelect = document.querySelector('.search-input-group select[name="location"]');
      if (topLocationSelect) topLocationSelect.value = val;
      hasUrlParams = true;
  }

  // Price Range Parameters (supports price_min, price_max, min_price, max_price, and legacy price)
  const paramPriceMin = urlParams.get('price_min') || urlParams.get('min_price');
  const paramPriceMax = urlParams.get('price_max') || urlParams.get('max_price');
  if (paramPriceMin) {
      const priceMinEl = document.getElementById('priceMin');
      if (priceMinEl) priceMinEl.value = paramPriceMin;
      hasUrlParams = true;
  }
  if (paramPriceMax) {
      const priceMaxEl = document.getElementById('priceMax');
      if (priceMaxEl) priceMaxEl.value = paramPriceMax;
      hasUrlParams = true;
  }
  if (urlParams.has('price') && !paramPriceMin && !paramPriceMax) {
      const priceVal = urlParams.get('price'); // e.g., "0-20000", "20000-50000", "100000+"
      if (priceVal.endsWith('+')) {
          const minVal = priceVal.replace('+', '');
          const priceMinEl = document.getElementById('priceMin');
          if (priceMinEl && !priceMinEl.value) priceMinEl.value = minVal;
      } else {
          const parts = priceVal.split('-');
          if (parts.length === 2) {
              const priceMinEl = document.getElementById('priceMin');
              const priceMaxEl = document.getElementById('priceMax');
              if (priceMinEl && !priceMinEl.value) priceMinEl.value = parts[0];
              if (priceMaxEl && !priceMaxEl.value) priceMaxEl.value = parts[1];
          }
      }
      hasUrlParams = true;
  }
  if (urlParams.has('gender') || urlParams.has('age_min') || urlParams.has('age_max') || urlParams.has('health') || urlParams.has('pedigree') || urlParams.has('seller_type') || urlParams.has('featured')) {
      hasUrlParams = true;
  }

  if (hasUrlParams) {
      applySidebarFilters();
  }
}

/* ==========================================
   8. Favorites Toggle (Mobile & Desktop)
   ========================================== */
function syncAllFavoriteButtons(favoriteIds) {
  const favSet = new Set((favoriteIds || []).map(String));
  document.querySelectorAll('.home-pet-fav, .fav-heart-btn, .btn-wishlist-heart, .favorite-btn, .my-pet-fav, .pet-card-fav, #pdLikeBtn').forEach(btn => {
    if (btn.classList.contains('fav-heart-btn') && btn.closest('.fav-card')) return;
    const id = btn.getAttribute('data-id') || (btn.getAttribute('data-url') || '').match(/\/favorites\/toggle\/(\d+)/)?.[1];
    if (!id) return;
    const isFav = favSet.has(String(id));
    const icon = btn.querySelector('i') || (btn.tagName === 'I' ? btn : null);
    if (isFav) {
      btn.classList.add('active', 'favorited', 'liked');
      btn.setAttribute('title', 'Remove from favorites');
      if (icon) {
        icon.className = 'fa-solid fa-heart';
        icon.style.color = btn.id === 'pdLikeBtn' ? '#E11D48' : '#ff4b68';
      }
    } else {
      btn.classList.remove('active', 'favorited', 'liked');
      btn.setAttribute('title', 'Save to favorites');
      if (icon) {
        icon.className = 'fa-regular fa-heart';
        icon.style.color = '';
      }
    }
  });
}

function fetchAndSyncFavorites() {
  fetch('/favorites/ids', { headers: { 'Accept': 'application/json' }, cache: 'no-store' })
    .then(r => r.json())
    .then(data => {
      if (data && Array.isArray(data.favorite_ids)) {
        syncAllFavoriteButtons(data.favorite_ids);
      }
    })
    .catch(() => {});
}

window.addEventListener('pageshow', fetchAndSyncFavorites);
document.addEventListener('visibilitychange', function() {
  if (document.visibilityState === 'visible') {
    fetchAndSyncFavorites();
  }
});

function initFavorites() {
  if (window._favoritesInitialized) return;
  window._favoritesInitialized = true;

  document.addEventListener('click', function(e) {
    const heartBtn = e.target.closest(
      '.fav-heart, .fav-heart-btn, .favorite-btn, .my-pet-fav, .pet-card-fav'
    );

    if (!heartBtn) return;

    e.preventDefault();
    e.stopPropagation();

    const icon = heartBtn.querySelector('i') || (heartBtn.tagName === 'I' ? heartBtn : null);

    if (icon) {
      const isSolid = icon.classList.contains('fa-solid') || icon.classList.contains('fas');

      if (isSolid) {
        // Toggle OFF (Filled -> Outline)
        icon.classList.remove('fa-solid', 'fas');
        icon.classList.add('fa-regular', 'far');
        icon.style.color = '#9ca3af';
        heartBtn.classList.remove('active', 'favorited');

        // If inside a favorite list item, animate removal
        const favContainer = heartBtn.closest('.favorite-item, .fav-card, .fav-card-modern');
        if (favContainer) {
          favContainer.style.pointerEvents = 'none';
          favContainer.style.transition = 'opacity 0.3s cubic-bezier(0.4, 0, 0.2, 1), transform 0.3s cubic-bezier(0.4, 0, 0.2, 1)';
          favContainer.style.opacity = '0';
          favContainer.style.transform = 'scale(0.88)';
          setTimeout(() => {
            const cardId = favContainer.getAttribute('data-fav-id');
            if (cardId) {
              const removed = JSON.parse(localStorage.getItem('removed_favorites') || '{}');
              removed[cardId] = true;
              localStorage.setItem('removed_favorites', JSON.stringify(removed));
            }
            if (favContainer.parentNode) {
              favContainer.remove();
            }
            if (typeof window.checkEmptyFavorites === 'function') {
              window.checkEmptyFavorites();
            }
          }, 300);
        }
      } else {
        // Toggle ON (Outline -> Filled)
        icon.classList.remove('fa-regular', 'far');
        icon.classList.add('fa-solid', 'fas');
        icon.style.color = '#ff4b68';
        heartBtn.classList.add('active', 'favorited');
      }
    } else {
      heartBtn.classList.toggle('active');
    }

    // Micro-animation feedback
    heartBtn.style.transition = 'transform 0.15s ease-in-out';
    heartBtn.style.transform = 'scale(1.25)';
    setTimeout(() => {
      heartBtn.style.transform = 'scale(1)';
    }, 150);

    // Sync with backend if URL provided
    const toggleUrl = heartBtn.getAttribute('data-url') || (heartBtn.dataset ? heartBtn.dataset.url : null) || (heartBtn.closest('form') ? heartBtn.closest('form').action : null);
    if (toggleUrl) {
      const csrfMeta = document.querySelector('meta[name="csrf-token"]');
      const token = csrfMeta ? csrfMeta.getAttribute('content') : '';
      fetch(toggleUrl, {
        method: 'POST',
        headers: {
          'Content-Type': 'application/json',
          'Accept': 'application/json',
          'X-CSRF-TOKEN': token
        }
      })
      .then(r => {
        if (r.status === 401) {
          return r.json().then(data => {
            if (data && data.redirect) {
              window.location.href = data.redirect;
            } else {
              const match = toggleUrl.match(/\/favorites\/toggle\/(\d+)/);
              const lid = match ? match[1] : '';
              window.location.href = '/login' + (lid ? '?favorite_listing=' + lid + '&redirect=' + encodeURIComponent('/seller/favorites') : '');
            }
          }).catch(() => {
            const match = toggleUrl.match(/\/favorites\/toggle\/(\d+)/);
            const lid = match ? match[1] : '';
            window.location.href = '/login' + (lid ? '?favorite_listing=' + lid + '&redirect=' + encodeURIComponent('/seller/favorites') : '');
          });
        }
        return r.json();
      })
      .then(data => {
        if (data && typeof data.is_favorited !== 'undefined' && icon) {
          if (data.is_favorited) {
            icon.classList.remove('fa-regular', 'far');
            icon.classList.add('fa-solid', 'fas');
            icon.style.color = '#ff4b68';
            heartBtn.classList.add('active', 'favorited');
          } else {
            icon.classList.remove('fa-solid', 'fas');
            icon.classList.add('fa-regular', 'far');
            icon.style.color = '#9ca3af';
            heartBtn.classList.remove('active', 'favorited');
          }
        }
      })
      .catch(err => {
        console.warn('Favorite sync error:', err);
      });
    }
  });
}


/* ==========================================
   9. Banner Notification Dropdown
   ========================================== */
document.addEventListener('DOMContentLoaded', function() {
    document.addEventListener('click', function(e) {
        const notifBtns = document.querySelectorAll('#bannerNotifBtn, .btn-notification');
        const notifMenus = document.querySelectorAll('#bannerNotifMenu, .notif-dropdown-menu');
        const profileMenu = document.getElementById('profileDropdownMenu');
        
        let clickedOnBtn = false;
        notifBtns.forEach(btn => {
            if (btn.contains(e.target)) {
                clickedOnBtn = true;

                // Automatically close profile dropdown when opening notification dropdown
                if (profileMenu) {
                    profileMenu.classList.remove('show');
                }

                const menu = btn.nextElementSibling;
                // Close other notification menus
                notifMenus.forEach(m => {
                    if (m !== menu) {
                        m.classList.remove('show');
                    }
                });

                if (menu && menu.classList.contains('notif-dropdown-menu')) {
                    menu.classList.toggle('show');
                }
            }
        });

        if (!clickedOnBtn) {
            notifMenus.forEach(menu => {
                if (!menu.contains(e.target)) {
                    menu.classList.remove('show');
                }
            });
        }
    });
});

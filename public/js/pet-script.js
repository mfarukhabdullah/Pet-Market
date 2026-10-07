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

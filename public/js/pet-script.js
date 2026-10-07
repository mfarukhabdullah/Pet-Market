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
  initFavorites();
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
  const mobileToggleBtn = document.getElementById('mobileToggleBtn');
  const closeDrawerBtn = document.getElementById('closeDrawerBtn');
  const drawer = document.getElementById('mobileNavDrawer');
  const mobileLinks = document.querySelectorAll('.mobile-nav-list a');

  if (mobileToggleBtn && drawer) {
    mobileToggleBtn.addEventListener('click', () => {
      drawer.classList.add('open');
    });
  }

  if (closeDrawerBtn && drawer) {
    closeDrawerBtn.addEventListener('click', () => {
      drawer.classList.remove('open');
    });
  }

  mobileLinks.forEach(link => {
    link.addEventListener('click', () => {
      if (drawer) drawer.classList.remove('open');
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
   7. Favorites Toggle
   ========================================== */
function initFavorites() {
  const favBtns = document.querySelectorAll('.my-pet-fav, .home-pet-fav, .pd-fav-btn');
  favBtns.forEach(btn => {
    // Add transition styling for smooth animation
    const icon = btn.querySelector('i');
    if (icon) {
      icon.style.transition = 'transform 0.2s cubic-bezier(0.175, 0.885, 0.32, 1.275), color 0.2s';
    }

    btn.addEventListener('click', function(e) {
      e.preventDefault(); // Stop navigation if inside a link
      e.stopPropagation(); // Stop event bubbling
      
      const i = this.querySelector('i');
      if (!i) return;

      if (i.classList.contains('fa-regular')) {
        // Mark as favorite
        i.classList.remove('fa-regular');
        i.classList.add('fa-solid');
        i.style.color = '#f43f5e'; // Brand accent red/pink color
        
        // Pop animation
        i.style.transform = 'scale(1.3)';
        setTimeout(() => i.style.transform = 'scale(1)', 200);
      } else {
        // Unmark as favorite
        i.classList.remove('fa-solid');
        i.classList.add('fa-regular');
        i.style.color = ''; // Revert to default color
        
        // Pop animation
        i.style.transform = 'scale(0.8)';
        setTimeout(() => i.style.transform = 'scale(1)', 200);
      }
    });
  });
}

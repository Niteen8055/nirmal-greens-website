(() => {
  'use strict';

  const prefersReducedMotion = window.matchMedia('(prefers-reduced-motion: reduce)').matches;
  const revealTargets = document.querySelectorAll('[data-reveal]');

  if (revealTargets.length && !prefersReducedMotion && 'IntersectionObserver' in window) {
    document.documentElement.classList.add('has-scroll-reveal');

    const revealObserver = new IntersectionObserver((entries, observer) => {
      entries.forEach((entry) => {
        if (entry.isIntersecting) {
          entry.target.classList.add('is-visible');
          observer.unobserve(entry.target);
        }
      });
    }, {
      threshold: 0.15,
      rootMargin: '0px 0px -5% 0px'
    });

    revealTargets.forEach((target) => revealObserver.observe(target));
  }

  const progressIndicator = document.querySelector('.scroll-progress-indicator');
  const progressValue = document.querySelector('.scroll-progress-indicator__percentage');

  if (progressIndicator && progressValue) {
    const clamp = (value, minimum, maximum) => Math.min(Math.max(value, minimum), maximum);

    const updateScrollProgress = () => {
      const scrollTop = window.scrollY || document.documentElement.scrollTop || document.body.scrollTop || 0;
      const scrollHeight = document.documentElement.scrollHeight || document.body.scrollHeight || 0;
      const viewportHeight = window.innerHeight || document.documentElement.clientHeight || 0;
      const maxScroll = Math.max(scrollHeight - viewportHeight, 1);
      const percent = clamp((scrollTop / maxScroll) * 100, 0, 100);
      const roundedPercent = Math.round(percent);

      progressValue.textContent = `${roundedPercent}%`;
      progressIndicator.setAttribute('aria-label', `Back to top, ${roundedPercent} percent`);
    };

    let frameId = null;

    const scheduleUpdate = () => {
      if (frameId !== null) {
        return;
      }

      frameId = window.requestAnimationFrame(() => {
        updateScrollProgress();
        frameId = null;
      });
    };

    progressIndicator.addEventListener('click', () => {
      window.scrollTo({
        top: 0,
        behavior: prefersReducedMotion ? 'auto' : 'smooth'
      });
    });

    window.addEventListener('scroll', scheduleUpdate, { passive: true });
    window.addEventListener('resize', scheduleUpdate, { passive: true });
    updateScrollProgress();
  }

  const preloader = document.getElementById('preloader');
  const preloaderBar = document.querySelector('.preloader__progress-bar');

  if (!preloader || !preloaderBar) {
    return;
  }

  const removePreloader = () => {
    const duration = prefersReducedMotion ? 0 : 420;
    preloader.classList.add('is-hidden');

    window.setTimeout(() => {
      preloader.remove();
      document.body.classList.remove('preloader-open');
    }, duration);
  };

  const completePreloader = () => {
    preloaderBar.style.width = '100%';
    preloader.classList.add('is-complete');

    if (prefersReducedMotion) {
      removePreloader();
      return;
    }

    window.setTimeout(removePreloader, 220);
  };

  let progress = 0;
  const updateProgress = () => {
    if (progress >= 100) {
      return;
    }

    progress = Math.min(progress + 7 + Math.random() * 18, 96);
    preloaderBar.style.width = `${progress}%`;

    if (progress < 96) {
      window.requestAnimationFrame(updateProgress);
    }
  };

  document.body.classList.add('preloader-open');
  preloaderBar.style.width = '0%';

  const failSafeTimer = window.setTimeout(() => {
    completePreloader();
  }, 1400);

  window.addEventListener('load', () => {
    window.clearTimeout(failSafeTimer);
    window.requestAnimationFrame(() => {
      preloaderBar.style.width = '96%';
      window.requestAnimationFrame(() => {
        completePreloader();
      });
    });
  }, { once: true });

  if (!prefersReducedMotion) {
    window.requestAnimationFrame(updateProgress);
  } else {
    preloaderBar.style.width = '100%';
    completePreloader();
  }
})();
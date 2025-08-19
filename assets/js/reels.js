(function(){
  function formatTime(sec){ if(isNaN(sec)) return '0:00'; const m = Math.floor(sec/60); const s = Math.floor(sec%60); return m+':' + (s<10?'0':'') + s; }
  function buildControls(container, video){
    container.classList.add('has-custom-controls');
    const controls = document.createElement('div');
    controls.className = 'reel-controls';
    controls.innerHTML = `
      <div class="reel-progress" aria-label="Postęp" role="slider" tabindex="0">
        <div class="reel-progress-bar"></div>
        <div class="reel-seek-hover"></div>
      </div>
      <div class="reel-controls-row">
        <button class="reel-btn reel-play" aria-label="Pauzuj / Odtwórz">▶</button>
        <button class="reel-btn reel-mute" aria-label="Wycisz / Włącz dźwięk">🔇</button>
        <div class="reel-volume-wrapper">
          <input type="range" class="reel-volume" min="0" max="1" step="0.05" value="0" aria-label="Głośność">
        </div>
        <span class="reel-time">0:00 / 0:00</span>
      </div>`;
    const indicator = document.createElement('div');
    indicator.className = 'reel-play-state-indicator';
    indicator.innerHTML = '<span>▶</span>';
    container.appendChild(indicator);
    container.appendChild(controls);
    return {controls, indicator};
  }

  function initVideo(video){
    const container = video.closest('.reel-item') || video.parentElement;
    const projectId = video.dataset.projectId;
    if (projectId) {
      initPortfolioVideoInteraction(container, video, projectId);
      return;
    }
    
    const ui = buildControls(container, video);
    const progress = ui.controls.querySelector('.reel-progress');
    const progressBar = ui.controls.querySelector('.reel-progress-bar');
    const seekHover = ui.controls.querySelector('.reel-seek-hover');
    const playBtn = ui.controls.querySelector('.reel-play');
    const muteBtn = ui.controls.querySelector('.reel-mute');
    const volumeInput = ui.controls.querySelector('.reel-volume');
    const timeEl = ui.controls.querySelector('.reel-time');

    let hideTimer; function scheduleHide(){ clearTimeout(hideTimer); hideTimer=setTimeout(()=>{ container.classList.remove('show-controls'); }, 2500);} 
    function showControls(){ container.classList.add('show-controls'); scheduleHide(); }

    container.addEventListener('mousemove', showControls);
    container.addEventListener('touchstart', showControls, {passive:true});

    function updateTime(){ timeEl.textContent = formatTime(video.currentTime)+' / '+formatTime(video.duration); const percent = (video.currentTime / video.duration) * 100; progressBar.style.width = percent + '%'; }

    function togglePlay(){ if(video.paused){ video.play(); } else { video.pause(); } }
    function updatePlayBtn(){ playBtn.textContent = video.paused ? '▶' : '❚❚'; ui.indicator.innerHTML = video.paused ? '<span>❚❚</span>' : '<span>▶</span>'; container.classList.add('show-indicator'); setTimeout(()=>container.classList.remove('show-indicator'), 500); }

    function toggleMute(){ video.muted = !video.muted; updateMuteBtn(); }
    function updateMuteBtn(){ muteBtn.textContent = video.muted || video.volume===0 ? '🔇' : '🔊'; }

    function seek(e){ const rect = progress.getBoundingClientRect(); const x = (e.clientX|| (e.touches&& e.touches[0].clientX)); const percent = Math.min(Math.max(0,(x-rect.left)/rect.width),1); video.currentTime = percent * video.duration; }
    function updateSeekHover(e){ const rect = progress.getBoundingClientRect(); const x = (e.clientX|| (e.touches&& e.touches[0].clientX)); const percent = Math.min(Math.max(0,(x-rect.left)/rect.width),1); seekHover.style.left = (percent*100)+'%'; }

    progress.addEventListener('mousedown', e=>{ seek(e); });
    progress.addEventListener('mousemove', e=>{ updateSeekHover(e); });
    progress.addEventListener('touchstart', e=>{ seek(e); updateSeekHover(e); }, {passive:true});
    progress.addEventListener('touchmove', e=>{ updateSeekHover(e); }, {passive:true});

    playBtn.addEventListener('click', togglePlay);
    muteBtn.addEventListener('click', toggleMute);
    volumeInput.addEventListener('input', ()=>{ video.volume = parseFloat(volumeInput.value); if(video.volume>0) video.muted=false; updateMuteBtn(); });

    video.addEventListener('timeupdate', updateTime);
    video.addEventListener('play', updatePlayBtn); video.addEventListener('pause', updatePlayBtn);
    video.addEventListener('loadedmetadata', ()=>{ updateTime(); if(video.muted) volumeInput.value = 0; else volumeInput.value = video.volume; });
    container.tabIndex = 0;
    container.addEventListener('keydown', e=>{ switch(e.key){ case ' ': case 'k': e.preventDefault(); togglePlay(); break; case 'm': toggleMute(); break; case 'ArrowRight': video.currentTime = Math.min(video.duration, video.currentTime+5); break; case 'ArrowLeft': video.currentTime = Math.max(0, video.currentTime-5); break; case 'ArrowUp': video.volume = Math.min(1, video.volume+0.05); volumeInput.value = video.volume.toFixed(2); if(video.volume>0) video.muted=false; updateMuteBtn(); break; case 'ArrowDown': video.volume = Math.max(0, video.volume-0.05); volumeInput.value = video.volume.toFixed(2); if(video.volume===0) video.muted=true; updateMuteBtn(); break; } });
    video.muted = true; video.volume = 0; updateMuteBtn();
    showControls();
  }

  function initPortfolioVideoInteraction(container, video, projectId) {
    container.addEventListener('mouseenter', function() {
      if (video.paused) {
        video.play().catch(e => {
          console.log('Preview play blocked:', e);
        });
      }
    });
    container.addEventListener('mouseleave', function() {
      if (!video.paused) {
        video.pause();
        video.currentTime = 0;
      }
    });
    const clickHandler = function(e) {
      e.preventDefault();
      e.stopPropagation();
      if (!video.paused) {
        video.pause();
      }
      setTimeout(() => {
        const portfolioItem = document.querySelector(`.portfolio-item[data-post-id="${projectId}"]`);
        if (portfolioItem && typeof openPortfolioModal === 'function') {
          openPortfolioModal(portfolioItem);
        } else {
          const portfolioUrl = (typeof grafikaReels !== 'undefined' && grafikaReels.portfolioUrl) 
            ? grafikaReels.portfolioUrl 
            : window.location.origin + '/portfolio';
          window.location.href = portfolioUrl + '?project=' + projectId;
        }
      }, 100);
    };
    
    container.addEventListener('click', clickHandler);
    const overlay = container.querySelector('.reel-overlay');
    if (overlay) {
      overlay.addEventListener('click', clickHandler);
    }
    container.style.cursor = 'pointer';
    if (overlay) {
      overlay.style.cursor = 'pointer';
    }
  }

  function init(){ document.querySelectorAll('video.reel-video').forEach(v=>{ if(!v.dataset.hasReels){ v.dataset.hasReels = '1'; initVideo(v); }}); }
  if(document.readyState==='loading'){ document.addEventListener('DOMContentLoaded', init); } else { init(); }
})();

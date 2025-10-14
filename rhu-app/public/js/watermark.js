// Watermark System
(function() {
    // Check if system is expired
    const checkExpiration = () => {
        const expirationDate = new Date('2025-10-31T23:59:59');
        const now = new Date();
        return now > expirationDate;
    };
    
    // Add demo watermarks (always visible)
    const addDemoWatermarks = () => {
        // Only add watermarks to safe containers that won't interfere with buttons
        document.querySelectorAll('.container, .content, main, .main-content').forEach(container => {
            // Check if watermark already exists
            if (!container.querySelector('.js-watermark')) {
                const watermark = document.createElement('div');
                watermark.className = 'js-watermark';
                watermark.style.cssText = 'position:absolute;top:15px;right:15px;color:rgba(255,0,0,0.18);font-size:12px;font-weight:bold;pointer-events:none;z-index:0;font-family:monospace;text-shadow:0 0 1px rgba(255,255,255,0.5);';
                watermark.textContent = 'NOT PAID';
                container.style.position = 'relative';
                container.appendChild(watermark);
            }
        });
        
        // Add watermarks to tables (safe positioning)
        document.querySelectorAll('table').forEach(table => {
            if (!table.querySelector('.js-table-watermark')) {
                const watermark = document.createElement('div');
                watermark.className = 'js-table-watermark';
                watermark.style.cssText = 'position:absolute;top:5px;right:5px;color:rgba(255,0,0,0.12);font-size:10px;font-weight:bold;pointer-events:none;z-index:0;font-family:monospace;';
                watermark.textContent = 'TRIAL';
                table.style.position = 'relative';
                table.appendChild(watermark);
            }
        });
        
        // Console message
        console.log('%cTRIAL VERSION - NOT PAID', 'color: red; font-size: 16px; font-weight: bold;');
    };
    
    // Add dynamic watermarks (after expiration)
    const addExpirationWatermarks = () => {
        if (!checkExpiration()) return;
        
        // Add to all input fields
        document.querySelectorAll('input, textarea, select').forEach(element => {
            if (Math.random() > 0.7) { // 30% chance
                element.style.backgroundImage = 'repeating-linear-gradient(45deg, transparent, transparent 35px, rgba(255,0,0,0.02) 35px, rgba(255,0,0,0.02) 70px)';
            }
        });
        
        // Add to all tables
        document.querySelectorAll('table').forEach(table => {
            const watermark = document.createElement('div');
            watermark.style.cssText = 'position:absolute;top:50%;left:50%;transform:translate(-50%,-50%) rotate(-45deg);color:rgba(255,0,0,0.05);font-size:48px;font-weight:bold;pointer-events:none;z-index:1;';
            watermark.textContent = 'NOT PAID';
            table.style.position = 'relative';
            table.appendChild(watermark);
        });
        
        // Add to all cards
        document.querySelectorAll('.card, .modal-content').forEach(card => {
            if (Math.random() > 0.5) { // 50% chance
                const watermark = document.createElement('span');
                watermark.style.cssText = 'position:absolute;top:10px;right:10px;color:rgba(255,0,0,0.08);font-size:10px;font-weight:600;pointer-events:none;z-index:1;font-family:monospace;';
                watermark.textContent = 'UNPAID';
                card.style.position = 'relative';
                card.appendChild(watermark);
            }
        });
        
        // Add floating text randomly
        setInterval(() => {
            if (Math.random() > 0.95) { // 5% chance every second
                const floater = document.createElement('div');
                floater.style.cssText = 'position:fixed;color:rgba(255,0,0,0.1);font-size:12px;font-weight:bold;pointer-events:none;z-index:9995;animation:float-across 10s linear;';
                floater.textContent = 'NOT PAID';
                floater.style.top = Math.random() * window.innerHeight + 'px';
                floater.style.left = '-100px';
                
                const style = document.createElement('style');
                style.textContent = '@keyframes float-across { to { transform: translateX(calc(100vw + 200px)); } }';
                document.head.appendChild(style);
                
                document.body.appendChild(floater);
                setTimeout(() => floater.remove(), 10000);
            }
        }, 1000);
        
        // Console watermark
        console.log('%cSYSTEM NOT PAID - LICENSE EXPIRED', 'color: red; font-size: 20px; font-weight: bold;');
        
        // Title modification
        const originalTitle = document.title;
        setInterval(() => {
            document.title = document.title === originalTitle ? '⚠️ UNPAID - ' + originalTitle : originalTitle;
        }, 3000);
    };
    
    // Initialize on DOM ready
    if (document.readyState === 'loading') {
        document.addEventListener('DOMContentLoaded', () => {
            addDemoWatermarks(); // Always run demo watermarks
            addExpirationWatermarks(); // Only run if expired
        });
    } else {
        addDemoWatermarks(); // Always run demo watermarks
        addExpirationWatermarks(); // Only run if expired
    }
    
    // Re-apply on AJAX content
    const observer = new MutationObserver(() => {
        addDemoWatermarks(); // Always apply demo watermarks
        if (checkExpiration()) {
            addExpirationWatermarks(); // Apply expiration watermarks if expired
        }
    });
    
    observer.observe(document.body, {
        childList: true,
        subtree: true
    });
})();

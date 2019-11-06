'use strict';

let deferredInstallPrompt = null;

window.addEventListener('beforeinstallprompt', (e) => {
    e.prompt();
});
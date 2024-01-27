window.__runtime = {
    sidebar: {
        visible: window.isMobile() ? false : window.desktopDefault(),
    }
}

import Alpine from 'alpinejs'

window.Alpine = Alpine

Alpine.start()

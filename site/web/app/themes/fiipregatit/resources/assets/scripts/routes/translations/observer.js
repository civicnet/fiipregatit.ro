import { whichClientTranslation } from './whichClientTranslation';
import { whichProxyTranslation } from './whichProxyTranslation';

export default {
  observe({ onClientTranslate, onProxyTranslate }) {
    const observer = new MutationObserver(function () {
      const client = whichClientTranslation();
      if (client) {
        onClientTranslate(client, document.documentElement.lang);
      }

      const proxy = whichProxyTranslation();
      if (proxy) {
        onProxyTranslate(proxy, document.documentElement.lang);
      }
    });

    observer.observe(document.documentElement, {
      attributes: true,
      attributeFilter: ['class', '_msttexthash'],
      childList: false,
      characterData: false,
    });
  },
}

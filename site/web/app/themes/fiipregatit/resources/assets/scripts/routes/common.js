import translationObserver from './translations/observer';
import isDev from '../util/isDev';
import * as LogRocket from 'logrocket';

export default {
  init() {
    !isDev() && LogRocket.init('9odlte/fiipregatitro');
  },
  logEvent(category, action, label) {
    if ('ga' in window) {
      const tracker = window.ga.getAll()[0];
      if (tracker) {
        tracker.send('event', category, action, label);
      }
    }
  },
  finalize() {
    jQuery('#contribute-button').on('click', () => {
      this.logEvent('civicnet', 'Clicked element', 'PayPal Donation');
    });

    const getAction = (client, type) => `${client} ${type} translation`;

    translationObserver.observe({
      onClientTranslate: (client, lang) => {
        this.logEvent('i18n', getAction(client, 'client'), lang)
      },
      onProxyTranslate: (proxy, lang) => {
        this.logEvent('i18n', getAction(proxy, 'proxy'), lang);
      },
    });
  },
};

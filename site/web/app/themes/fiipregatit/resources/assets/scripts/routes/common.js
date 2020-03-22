import translationObserver from './translations/observer';

export default {
  init() {
    // JavaScript to be fired on all pages
  },
  logEvent(action, label) {
    if ('ga' in window) {
      const tracker = window.ga.getAll()[0];
      if (tracker) {
        tracker.send('event', 'i18n', action, label);
      }
    }
  },
  finalize() {
    const getAction = (client, type) => `${client} ${type} translation`;

    translationObserver.observe({
      onClientTranslate: (client, lang) => {
        this.logEvent(getAction(client, 'client'), lang)
        console.log(getAction(client, 'client'), lang);
      },
      onProxyTranslate: (proxy, lang) => {
        this.logEvent(getAction(proxy, 'proxy'), lang);
      },
    });
  },
};

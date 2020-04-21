import { observe } from 'detect-translation';
import isDev from '../util/isDev';
import * as LogRocket from 'logrocket';
import coinflip from '../util/coinflip';

const LOG_ROCKET_EXPIRY = 1000 * 60 * 60 * 3; // 3 hrs
export default {
  init() {
    const lastLogRocketSession =
      window.localStorage.getItem('last_logrocket_sess');
    if (lastLogRocketSession) {
      // If expired, remove
      if (
        Date.now() - parseInt(lastLogRocketSession, 10)
        > LOG_ROCKET_EXPIRY
      ) {
        window.localStorage.removeItem('last_logrocket_sess');
        return;
      }
    }

    const shouldLog = !isDev() && coinflip(20);

    // No coinflip, no active session, skip
    if (!shouldLog && !lastLogRocketSession) {
      return;
    }

    //  New session
    if (!lastLogRocketSession && shouldLog) {
      window.localStorage.setItem(
        'last_logrocket_sess',
        Date.now()
      );
    }

    LogRocket.init('9odlte/fiipregatitro');
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

    observe({
      onClient: (client, lang) => {
        this.logEvent('i18n', getAction(client, 'client'), lang)
      },
      onProxy: (proxy, lang) => {
        this.logEvent('i18n', getAction(proxy, 'proxy'), lang);
      },
    });
  },
};

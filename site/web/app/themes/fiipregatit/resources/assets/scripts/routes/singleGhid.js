import autocomplete from './algolia/autocomplete'
import capitalize from '../util/capitalize';

export default {
  init() {
    // JavaScript to be fired on all pages
  },
  finalize() {
    autocomplete.init();

    jQuery('#accordion .card-header button').each(function (idx, element) {
      element.addEventListener('click', function (e) {
        const accordionAction = e.target.getAttribute('aria-expanded') === 'true' ? 'collapse' : 'expand';

        let guideSection = '';
        if (e.target.nodeName === 'button') {
          guideSection = e.target.innerText;
        } else {
          guideSection = e.target.parentElement.innerText;
        }

        const currentGuide = capitalize(jQuery('h2')[0].innerText);

        if ('ga' in window) {
          const tracker = window.ga.getAll()[0];
          if (tracker) {
            tracker.send('event', currentGuide, accordionAction, guideSection);
          }
        }
      })
    })
  },
};

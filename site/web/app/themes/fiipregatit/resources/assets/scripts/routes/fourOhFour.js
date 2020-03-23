import autocomplete from './algolia/autocomplete'

export default {
  init() {
    // JavaScript to be fired on all pages
  },
  finalize() {
    autocomplete.init();
  },
};

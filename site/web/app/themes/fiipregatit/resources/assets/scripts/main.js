// import external dependencies
import 'jquery';

// import 'algoliasearch';
// import 'instantsearch.js';

// Import everything from autoload
import './autoload/**/*'

// import local dependencies
import Router from './util/Router';
import common from './routes/common';
import home from './routes/home';
import aboutUs from './routes/about';
import search from './routes/search';
import pageTemplate from './routes/anyPage';
import singleGhid from './routes/singleGhid';
import singleCampanie from './routes/singleCampanie';
import error404 from './routes/fourOhFour';
import singleSectiuneGhid from './routes/singleSectiuneGhid';

/** Populate Router instance with DOM routes */
const routes = new Router({
  // All pages
  common,
  // Home page
  home,
  // About Us page, note the change from about-us to aboutUs.
  aboutUs,
  pageTemplate,
  singleGhid,
  singleCampanie,
  search,
  error404,
  singleSectiuneGhid,
});

// Load Events
jQuery(document).ready(() => routes.loadEvents());

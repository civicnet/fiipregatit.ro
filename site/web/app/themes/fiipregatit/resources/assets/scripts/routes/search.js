import * as algoliasearch from 'algoliasearch';
import * as instantsearch from 'instantsearch.js/dist/instantsearch.development';
import * as _ from 'underscore';

export default {
  init() {
    // JavaScript to be fired on the about us page
  },
  finalize() {
    // jQuery(function() {
      const algolia = window.algolia;

      if(jQuery('#algolia-search-box').length > 0) {
        if (algolia.indices.posts_ghid === undefined && jQuery('.admin-bar').length > 0) {
          console.warn('Posts not indexed');
        }

        /* Instantiate instantsearch.js */
        var search = instantsearch({
          searchClient: algoliasearch(algolia.application_id, algolia.search_api_key),
          indexName: algolia.indices.posts_ghid.name,
          urlSync: {
            mapping: {'q': 's'},
            trackedParameters: ['s'],
          },
          /* searchParameters: {
            facetingAfterDistinct: true,
            highlightPreTag: '__ais-highlight__',
            highlightPostTag: '__/ais-highlight__',
          }, */
         });

        /* Search box widget */
        search.addWidgets([
          instantsearch.widgets.searchBox({
            container: '#algolia-search-box',
            placeholder: 'Caută aici, de ex. coronavirus sau carantină',
            wrapInput: false,
            poweredBy: true,
            showReset: false,
            cssClasses: {
              form: 'search-form-instantsearch',
            },
          }),
          instantsearch.widgets.configure({
            'facetingAfterDistinct': true,
            'highlightPreTag': '__ais-highlight__',
            'highlightPostTag': '__/ais-highlight__',
          }),
          instantsearch.widgets.stats({
            container: '#algolia-stats',
            autoHideContainer: true,
            templates: {
              text: `
                {{#hasOneResult}}<h2>Un rezultat</h2>{{/hasOneResult}}
                {{#hasManyResults}}<h2>{{#helpers.formatNumber}}{{nbHits}}{{/helpers.formatNumber}} rezultate găsite {{#query}} pentru "<em>{{query}}</em>" </h2>{{/query}}{{/hasManyResults}}
              `,
            },
          }),
          instantsearch.widgets.hits({
            container: '#algolia-hits',
            hitsPerPage: 10,
            templates: {
              empty: wp.template('instantsearch-blank'), // 'Nu am găsit rezultate pentru "<strong>{{query}}</strong>".',
              item: wp.template('instantsearch-hit'),
            },
            transformData: {
              item: function (hit) {
                for(var key in hit._highlightResult) {
                  // We do not deal with arrays.
                  if(typeof hit._highlightResult[key].value !== 'string') {
                    continue;
                  }
                  hit._highlightResult[key].value = _.escape(hit._highlightResult[key].value);
                  hit._highlightResult[key].value = hit._highlightResult[key].value.replace(/__ais-highlight__/g, '<em>').replace(/__\/ais-highlight__/g, '</em>');
                }

                for(var skey in hit._snippetResult) {
                  // We do not deal with arrays.
                  if(typeof hit._snippetResult[skey].value !== 'string') {
                    continue;
                  }

                  hit._snippetResult[skey].value = _.escape(hit._snippetResult[skey].value);
                  hit._snippetResult[skey].value = hit._snippetResult[skey].value.replace(/__ais-highlight__/g, '<em>').replace(/__\/ais-highlight__/g, '</em>');
                }

                return hit;
              },
            },
          }),
        ]);

        /* Pagination widget */
        // !FIXME
        /*search.addWidget(
          instantsearch.widgets.pagination({
            container: '#algolia-pagination'
          })
        );*/

        /* Start */
        search.start();
        // jQuery('#s input').attr('type', 'search').select();
      }
    // });
  },
};

import * as algoliasearch from 'algoliasearch';
import * as algoliaAutocomplete from 'autocomplete.js';
import * as _ from 'underscore';


export default {
  init() {
      // JavaScript to be fired on all pages, after page specific JS is fired
  const algolia = window.algolia;

  /* init Algolia client */
  var client = algoliasearch(algolia.application_id, algolia.search_api_key);

  function newHitsSource(index, params) {
    return function doSearch(query, cb) {
      index
        .search(query, params)
        .then(function(res) {
          cb(res.hits, res);
        })
        .catch(function(err) {
          console.error(err);
          cb([]);
        });
    };
  }

  /* setup default sources */
  var sources = [];
  jQuery.each(algolia.autocomplete.sources, function (i, config) {
    var suggestion_template = wp.template(config['tmpl_suggestion']);

    sources.push({
      source: newHitsSource(client.initIndex(config['index_name']), {
        hitsPerPage: config['max_suggestions'],
        attributesToSnippet: [
          'content:30',
          'subtitle:20',
        ],
        highlightPreTag: '__ais-highlight__',
        highlightPostTag: '__/ais-highlight__',
      }),
      templates: {
        header: function () {
          return null;
        },
        suggestion: function (hit) {
          for (var key in hit._highlightResult) {
            /* We do not deal with arrays. */
            if (typeof hit._highlightResult[key].value !== 'string') {
              continue;
            }
            hit._highlightResult[key].value = _.escape(hit._highlightResult[key].value);
            hit._highlightResult[key].value = hit._highlightResult[key].value.replace(/__ais-highlight__/g, '<em>').replace(/__\/ais-highlight__/g, '</em>');
          }

          for (var skey in hit._snippetResult) {
            /* We do not deal with arrays. */
            if (typeof hit._snippetResult[skey].value !== 'string') {
              continue;
            }

            hit._snippetResult[skey].value = _.escape(hit._snippetResult[skey].value);
            hit._snippetResult[skey].value = hit._snippetResult[skey].value.replace(/__ais-highlight__/g, '<em>').replace(/__\/ais-highlight__/g, '</em>');
          }

          if (config['index_name'] === 'wp_posts_sectiune_ghid'
            || config['index_name'] === 'wp_posts_ghid') {
            hit.type = 'Ghid'
          }

          if (config['index_name'] === 'wp_posts_campanie') {
            hit.type = 'Campanie'
          }

          return suggestion_template(hit);
        },
      },
      });
    });

    /* Setup dropdown menus */
    jQuery(algolia.autocomplete.input_selector).each(function () {
      var $searchInput = jQuery(this);

      var config = {
        debug: algolia.debug,
        hint: false,
        openOnFocus: false,
        appendTo: 'body',
        templates: {
          empty: wp.template('autocomplete-empty'),
        },
      };

      if (algolia.powered_by_enabled) {
        config.templates.footer = wp.template('autocomplete-footer');
      }

      /* Instantiate autocomplete.js */
      var autocomplete = algoliaAutocomplete($searchInput[0], config, sources)
        .on('autocomplete:selected', function (e, suggestion) {
        /* Redirect the user when we detect a suggestion selection. */
          window.location.href = suggestion.permalink;
      });

      /* Force the dropdown to be re-drawn on scroll to handle fixed containers. */
      jQuery(window).scroll(function() {
        if(autocomplete.autocomplete.getWrapper().style.display === 'block') {
          autocomplete.autocomplete.close();
          autocomplete.autocomplete.open();
        }
      });
    });

    jQuery(document).on('click', '.algolia-powered-by-link', function (e) {
      e.preventDefault();
      window.location = 'https://www.algolia.com/?utm_source=WordPress&utm_medium=extension&utm_content=' + window.location.hostname + '&utm_campaign=poweredby';
    });
  },
}

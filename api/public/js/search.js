/* global instantsearch algoliasearch */
'use strict';

var search = instantsearch({
    indexName: 'apartments',
    searchClient: algoliasearch('RJ3KVXJDS0', 'aa87273b8cf837f15bb3dbf00be5311d'),
    routing: true,
});

var customSearchbox = instantsearch.connectors.connectSearchBox(function (
    renderOptions,
    isFirstRender
) {
    var widgetParams = renderOptions.widgetParams;

    if (isFirstRender) {
        document.querySelector(widgetParams.container).innerHTML =
            '<div class="input-group">' +
            '<input type="search" autocomplete="off" class="form-control" id="q" placeholder="' +
            widgetParams.placeholder +
            '" />' +
            '<span class="input-group-btn">' +
            '<button class="btn btn-default"><i class="fa fa-search"></button>' +
            '</span>' +
            '</div>';

        document.querySelector('#q').addEventListener('input', function (event) {
            renderOptions.refine(event.target.value);
        });
    }
});

search.addWidget(
    customSearchbox({
        container: '#searchbox',
        placeholder: 'Search Apartment',
    })
);

search.addWidget(
    instantsearch.widgets.stats({
        container: '#stats',
    })
);

search.on('render', function () {
    $('.product-picture img').addClass('transparent');
    $('.product-picture img')
        .one('load', function () {
            $(this).removeClass('transparent');
        })
        .each(function () {
            if (this.complete) $(this).load();
        });
});

var hitTemplate =
    '<article class="hit">' +
    '<div class="product-picture-wrapper">' +
    '<div class="product-picture"><img src="{{image}}" /></div>' +
    '</div>' +
    '<div class="product-desc-wrapper">' +
    '<div class="product-name">{{#helpers.highlight}}{ "attribute": "name.en" }{{/helpers.highlight}}</div>' +
    '<div class="product-type">{{#helpers.highlight}}{ "attribute": "apartmentType.name.en" }{{/helpers.highlight}}</div>' +
    '<div class="product-price">${{price}}</div>' +
    '</div>' +
    '</article>';

var noResultsTemplate =
    '<div class="text-center">No results found matching <strong>{{query}}</strong>.</div>';

var menuTemplate =
    '<a href="javascript:void(0);" class="facet-item {{#isRefined}}active{{/isRefined}}"><span class="facet-name"><i class="fa fa-angle-right"></i> {{label}}</span class="facet-name"></a>';

// for checkbox & count
var facetTemplateCheckbox =
    '<a href="javascript:void(0);" class="facet-item">' +
    '<input type="checkbox" class="{{cssClasses.checkbox}}" value="{{label}}" {{#isRefined}}checked{{/isRefined}} />{{label}}' +
    '<span class="facet-count">({{count}})</span>' +
    '</a>';

// list of items
search.addWidget(
    instantsearch.widgets.hits({
        container: '#hits',
        hitsPerPage: 16,
        templates: {
            empty: noResultsTemplate,
            item: hitTemplate,
        }
    })
);

// pagination
search.addWidget(
    instantsearch.widgets.pagination({
        container: '#pagination',
    })
);

var typeList = instantsearch.widgets.panel({
    templates: {
        header: '<h5>Property Type</h5>',
    },
})(instantsearch.widgets.refinementList);

search.addWidget(
    typeList({
        container: '#types',
        attribute: 'apartment_type.name.en',
        operator: 'or',
        templates: {
            item: facetTemplateCheckbox,
        },
    })
);

// city list
/*var city = instantsearch.widgets.panel({
    templates: {
        header: '<h5>City</h5>',
    },
})(instantsearch.widgets.menuSelect);
search.addWidget(
    city({
        container: '#cities',
        attribute: 'city.name.en',
        sortBy: ['name.en:asc'],
        templates: {
            item: menuTemplate,
        },
    })
);*/

// facilities list
/*var facilitiesList = instantsearch.widgets.panel({
    templates: {
        header: '<h5>Facilities</h5>',
    },
})(instantsearch.widgets.refinementList);

search.addWidget(
    facilitiesList({
        container: '#facilities',
        attribute: 'project.facilities.name.en',
        operator: 'or',
        templates: {
            item: facetTemplateCheckbox,
        },
    })
);*/

var rooms = instantsearch.widgets.panel({
    templates: {
        header: '<h5>Bed Rooms</h5>',
    },
})(instantsearch.widgets.refinementList);

search.addWidget(
    rooms({
        container: '#rooms',
        attribute: 'meta.rooms.en',
        operator: 'or',
        templates: {
            item: facetTemplateCheckbox,
        },
    })
);

/*// bed rooms list
var rooms = instantsearch.widgets.panel({
    templates: {
        header: '<h5>Bed Rooms</h5>',
    },
})(instantsearch.widgets.numericMenu);

search.addWidget(
    rooms({
        container: '#rooms',
        attribute: 'bedrooms',
        operator: 'or',
        items: [
            {label: 'All'},
            {label: 'Studio [استوديو]', end: 0},
            {label: 'غرفة وصالة', end: 1, start: 1},
            {label: 'غرفتين وصالة', end: 2, start: 2},
            {label: '3 غرف وصالة', end: 3, start: 3},
            {label: '4 غرف وصالة', end: 4, start: 4},
            {label: 'اعلى من 4 غرف وصالة', start: 5},
        ],
        templates: {
            item: facetTemplateCheckbox,
        },
    })
);*/

// area list
var area = instantsearch.widgets.panel({
    templates: {
        header: '<h5>المساحة الكلية</h5>',
    },
})(instantsearch.widgets.numericMenu);

search.addWidget(
    area({
        container: '#area',
        attribute: 'total_area',
        operator: 'or',
        items: [
            {label: 'All'},
            {label: 'less than 50 m2', end: 50},
            {label: 'between 50 m2 and 100 m2', end: 100, start: 50},
            {label: 'between 100 m2 and 150 m2', end: 150, start: 100},
            {label: 'between 150 m2 and 200 m2', end: 200, start: 150},
            {label: 'between 200 m2 and 250 m2', end: 250, start: 200},
            {label: 'more than 250 m2', start: 250},
        ],
        templates: {
            item: facetTemplateCheckbox,
        },
    })
);

// price list
var price = instantsearch.widgets.panel({
    templates: {
        header: '<h5>السعر</h5>',
    },
})(instantsearch.widgets.numericMenu);

search.addWidget(
    price({
        container: '#price',
        attribute: 'price',
        operator: 'or',
        items: [
            {label: 'less than 500000', end: 50000},
            {label: 'between 500000 and 1000000', end: 1000000, start: 500000},
            {label: 'between 1000000 and 1500000', end: 1500000, start: 1000000},
            {label: 'between 1500000 and 2000000', end: 2000000, start: 1500000},
            {label: 'between 2000000 and 2500000', end: 2500000, start: 2000000},
            {label: 'between 2500000 and 3000000', end: 3000000, start: 2500000},
            {label: 'more than 3000000', start: 3000000},
        ],
        templates: {
            item: facetTemplateCheckbox,
        },
    })
);

// municipality list
var municipality = instantsearch.widgets.panel({
    templates: {
        header: '<h5>Municipality</h5>',
    },
})(instantsearch.widgets.refinementList);

search.addWidget(
    municipality({
        container: '#municipality',
        attribute: 'municipality.name.en',
        operator: 'or',
        templates: {
            item: facetTemplateCheckbox,
        },
    })
);

// payment type list
var payment = instantsearch.widgets.panel({
    templates: {
        header: '<h5>Payment Type</h5>',
    },
})(instantsearch.widgets.refinementList);

search.addWidget(
    payment({
        container: '#payment',
        attribute: 'payment_type.name.en',
        operator: 'or',
        templates: {
            item: facetTemplateCheckbox,
        },
    })
);

// investment list
var investment = instantsearch.widgets.panel({
    templates: {
        header: '<h5>Investment Return</h5>',
    },
})(instantsearch.widgets.refinementList);

search.addWidget(
    investment({
        container: '#investment',
        attribute: 'investment_return.name.en',
        operator: 'or',
        templates: {
            item: facetTemplateCheckbox,
        },
    })
);

// views list
var views = instantsearch.widgets.panel({
    templates: {
        header: '<h5>Views الاطلالة</h5>',
    },
})(instantsearch.widgets.refinementList);

search.addWidget(
    views({
        container: '#views',
        attribute: 'views.name.en',
        operator: 'or',
        templates: {
            item: facetTemplateCheckbox,
        },
    })
);

// ready list
var ready = instantsearch.widgets.panel({
    templates: {
        header: '<h5>ready الجهوزية</h5>',
    },
})(instantsearch.widgets.refinementList);

search.addWidget(
    ready({
        container: '#ready',
        attribute: 'project.status.name.en',
        operator: 'or',
        templates: {
            item: facetTemplateCheckbox,
        },
    })
);

// price range filter
/*var priceInput = instantsearch.widgets.panel({
    templates: {
        header: '<h5>Price</h5>',
    },
})(instantsearch.widgets.rangeSlider);

search.addWidget(
    priceInput({
        container: '#price',
        attribute: 'price',
    })
);*/

// area range filter
/*var area = instantsearch.widgets.panel({
    templates: {
        header: '<h5>Space Area</h5>',
    },
})(instantsearch.widgets.rangeSlider);

search.addWidget(
    area({
        container: '#area',
        attribute: 'net_area',
    })
);*/

// clear refinements
search.addWidget(
    instantsearch.widgets.clearRefinements({
        container: '#clear-refinements',
    })
);

search.start();
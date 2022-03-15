export default function ({ isHMR, app, store, route, params, error, redirect }) {
  const routes = [
    {
      "old_url": "/steps-of-buying-property-in-turkey",
      "destination_url": "/blog/Steps-to-owning-a-property-in-Turkey"
    },
    {
      "old_url": "/property-for-sale-istanbul-featured",
      "destination_url": "/properties/istanbul"
    },
    {
      "old_url": "/city/property-for-sale-istanbul",
      "destination_url": "/properties/istanbul"
    },
    {
      "old_url": "/investments-in-turkey",
      "destination_url": "/blog/The-main-reasons-for-investment-in-Turkey"
    },
    {
      "old_url": "/best-places-to-buy-property-in-turkey-part-2",
      "destination_url": "/blog/Best-area-to-buy-an-apartment-in-Istanbul"
    },
    {
      "old_url": "/shopping-malls-in-istanbul-and-their-relation-to-real-estate",
      "destination_url": "/blog/shopping-centers-in-istanbul"
    },
    {
      "old_url": "/learn-about-tax-details-on-real-estate-in-turkey",
      "destination_url": "/blog/Real-estate-taxes-in-Turkey"
    },
    {
      "old_url": "/the-real-estate-and-investment-future-of-the-basaksehir-district-in-istanbul",
      "destination_url": "/blog/real-estate-future-of-basaksehir"
    },
    {
      "old_url": "/how-do-i-get-a-successful-investment-in-real-estate-under-construction-in-turkey",
      "destination_url": "/blog/Investment-in-under-construction-properties-in-turkey"
    },
    {
      "old_url": "/advantages-of-investing-in-properties-under-construction-in-turkey",
      "destination_url": "/blog/advantages-of-investing-in-properties-under-construction-in-turkey"
    },
    {
      "old_url": "/factors-affecting-real-estate-investment-in-turkey",
      "destination_url": "/blog/factors-affecting-real-estate-investment-in-turkey"
    },
    {
      "old_url": "/five-reasons-to-buy-property-in-istanbul",
      "destination_url": "/blog/five-reasons-to-buy-property-in-Istanbul"
    },
    {
      "old_url": "/buying-home-turkey-part-1",
      "destination_url": "/blog/Buying-a-house-in-Turkey"
    },
    {
      "old_url": "/what-do-you-know-about-the-tabu-in-turkey",
      "destination_url": "/blog/Tabu-in-Turkey"
    },
    {
      "old_url": "/turkish-real-estate-developers-are-demanding-amendments-to-the-nationality-law",
      "destination_url": "/blog/turks-demand-amendment-of-nationality-law"
    },
    {
      "old_url": "/beylikduzu-real-estate-in-istanbul",
      "destination_url": "/blog/beylikduzu-Real-Estate-in-Istanbul"
    },
    {
      "old_url": "/guide-to-buying-and-selling-villas-in-turkey",
      "destination_url": "/blog/Sale-and-purchase-of-villas-in-Turkey"
    },
    {
      "old_url": "/figures-and-facts-about-real-estate-in-turkey",
      "destination_url": "/blog/facts-about-real-estate-in-turkey"
    },
    {
      "old_url": "/high-increase-of-real-estate-sales-in-turkey-for-foreigners-in-may-2018",
      "destination_url": "/blog/turkish-real-estate-sales-for-foreigners-increased-may-2018"
    },
    {
      "old_url": "/real-estate-investment-opportunities-in-turkey",
      "destination_url": "/blog/Real-estate-investment-opportunities-in-Turkey"
    },
    {
      "old_url": "/real-estate-in-turkey-attracts-more-saudi-investors",
      "destination_url": "/blog/turkey-properties-attracts-more-saudi-investors"
    },
    {
      "old_url": "/people-who-live-alone-in-turkey-tend-to-buy-real-estate-in-turkey-instead-of-renting-it",
      "destination_url": "/blog/buying-or-renting-a-property-in-turkey"
    },
    {
      "old_url": "/omani-investments-in-turkey",
      "destination_url": "/blog/omani-Investment-in-turkey"
    },
    {
      "old_url": "/five-points-in-which-the-real-estate-of-turkey-is-superior-to-the-properties-of-spain",
      "destination_url": "/blog/turkey-properties-outperform-spain-properties"
    },
    {
      "old_url": "/how-did-turkeys-real-estate-investment-sector-recover-in-2017",
      "destination_url": "/blog/how-turkey-real-estate-sector-recovered-in-2017"
    },
    {
      "old_url": "/statistics-and-figures-investing-in-real-estate-turkey-increasingly-attracts-foreigners",
      "destination_url": "/blog/Investing-in-Turkey-real-estate-attracts-foreigners-increasingly"
    },
    {
      "old_url": "/informations-about-the-aurassia-tunnel-in-istanbul",
      "destination_url": "/blog/Eurasia%20-Tunnel-in-Istanbul"
    },
    {
      "old_url": "/real-estate-investment-in-turkey",
      "destination_url": "/blog/The-best-real-estate-investment-cities-in-Turkey"
    },
    {
      "old_url": "/istanbuls-new-channel-is-a-gateway-to-real-estate-revolution-in-turkey",
      "destination_url": "/blog/Istanbuls-new-water-channel"
    },
    {
      "old_url": "/dont-hesitate-to-buy-appartments-in-istanbul",
      "destination_url": "/blog/motives-for-buying-apartments-in-Istanbul"
    },
    {
      "old_url": "/simple-tips-are-overlooked-by-the-seller-when-displaying-his-property-for-sale",
      "destination_url": "/blog/tips-property-sellers-in-turkey-usually-overlooks"
    },
    {
      "old_url": "/ask-these-questions-to-the-landlord-before-you-buy-them",
      "destination_url": "/blog/questions-to-the-owner-of-the-property-you-want-to-buy"
    },
    {
      "old_url": "/quiet-areas-in-turkey-and-property-prices-in-the-first-part",
      "destination_url": "/blog/prices-ofthe-properties-outside-the-city-in-turkey"
    },
    {
      "old_url": "/luxury-bahce-sehir-properties-in-istanbul-and-investment-opportunities",
      "destination_url": "/blog/Bahcesehir-properties-in-Istanbul"
    },
    {
      "old_url": "/importance-of-transportation-for-real-estate-in-istanbul",
      "destination_url": "/blog/Importance-of-transportation-for-real-estate-in-Istanbul"
    },
    {
      "old_url": "/find-out-about-istanbuls-sights",
      "destination_url": "/blog/Get-to-know-Istanbul-from-close"
    },
    {
      "old_url": "/where-to-find-the-cheapest-apartments-in-istanbul",
      "destination_url": "/blog/Cheapest-apartments-in-Istanbul"
    },
    {
      "old_url": "/what-do-you-know-about-commercial-investment-in-istanbul-real-estate",
      "destination_url": "/blog/Details-of-Commercial-Investment-in-Istanbul-Real-Estate"
    },
    {
      "old_url": "/real-estate-companies-and-their-role-in-completing-real-estate-sale-deals-in-turkey",
      "destination_url": "/blog/real-estate-companies-and-its-roles-in-turkey"
    },
    {
      "old_url": "/most-of-the-investors-in-the-real-estate-of-trabzon-of-the-arabs",
      "destination_url": "/blog/most-trabzon-real-estate-investors-are-arabs"
    },
    {
      "old_url": "/what-do-you-know-about-negotiations-between-seller-and-buyer-when-buying-real-estate-in-turkey",
      "destination_url": "/blog/Negotiations-between-buyer-and-seller-in-turkey-properties"
    },
    {
      "old_url": "/learn-about-the-most-attractive-areas-for-real-estate-investors-in-the-largest-turkish-cities",
      "destination_url": "/blog/areas-attracts-real-estate-investors-the-most-in-turkey"
    },
    {
      "old_url": "/buying-and-selling-real-estate-in-turkey-via-the-internet",
      "destination_url": "/blog/buying-properties-in-turkey-via-the-internet"
    },
    {
      "old_url": "/tips-and-information-before-buying-a-property-in-turkey",
      "destination_url": "/blog/Information-before-buying-property-in-Turkey"
    },
    {
      "old_url": "/property-sales-in-turkey-for-foreigners-increased-during-the-first-half-of-2018",
      "destination_url": "/blog/turkey-real-estate-sales-statistics-for-foreigners-2018-first-half"
    },
    {
      "old_url": "/what-makes-properties-of-fatih-special",
      "destination_url": "/blog/features-of-fatih-properties-in-istanbul"
    },
    {
      "old_url": "/house-prices-in-turkey-makes-high-increase-rates",
      "destination_url": "/blog/turkey-properties-prices-increased-in-2018"
    },
    {
      "old_url": "/avoid-these-mistakes-when-buying-property-in-turkey",
      "destination_url": "/blog/Mistakes-when-buying-real-estate-in-Turkey"
    },
    {
      "old_url": "/five-precise-topics-are-asked-by-real-estate-buyers-in-turkey",
      "destination_url": "/blog/questions-turkey-real-estate-buyers-asks"
    },
    {
      "old_url": "/four-tips-for-renting-apartments-in-istanbul-after-buying-them",
      "destination_url": "/blog/tips-for-property-renters-in-istanbul"
    },
    {
      "old_url": "/seven-questions-to-identify-the-best-real-estate-company-in-the-real-estate-sector-in-turkey",
      "destination_url": "/blog/how-to-know-the-best-real-estate-company-in-turkey"
    },
    {
      "old_url": "/more-than-22-increase-in-real-estate-sales-in-turkey-for-the-month-of-june-2018",
      "destination_url": "/blog/22-percent-increase-in-turkey-real-estate-sales-june-2018"
    },
    {
      "old_url": "/real-estate-contracting-companies-in-turkey-and-its-global-role",
      "destination_url": "/blog/turkish-construction-companies-and-their-global-role"
    },
    {
      "old_url": "/urban-transformation-and-rehabilitation-of-real-estate-in-turkey",
      "destination_url": "/blog/turkish-government-real-estate-projects"
    },
    {
      "old_url": "/features-buying-real-estate-in-turkey-in-the-summer-period",
      "destination_url": "/blog/advantages-of-buying-property-in-turkey-during-summer"
    },
    {
      "old_url": "/advices-to-help-you-find-your-property-in-istanbul",
      "destination_url": "/blog/how-to-choose-a-house-in-turkey"
    },
    {
      "old_url": "/wealthy-foreigners-prefer-to-buy-properties-in-istanbul",
      "destination_url": "/blog/why-wealthy-foreigners-prefer-to-buy-real-estate-in-Istanbul"
    },
    {
      "old_url": "/how-not-to-regret-after-buying-property-in-turkey",
      "destination_url": "/blog/Do-not-regret-after-buying-property-in-Turkey"
    },
    {
      "old_url": "/how-to-find-the-best-real-estate-agent-in-istanbul",
      "destination_url": "/blog/how-to-discover-the-best-real-estate-agent-in-turkey"
    },
    {
      "old_url": "/simple-steps-you-have-to-make-before-selling-property-in-istanbul",
      "destination_url": "/blog/simple-steps-to-do-before-selling-a-house-in-Istanbul"
    },
    {
      "old_url": "/how-turkeys-real-estate-market-got-affected-positively-in-2018-1",
      "destination_url": "/blog/evolution-of-turkey-real-estate-market-in-2018"
    },
    {
      "old_url": "/which-properties-in-istanbul-are-suitable-for-retired-people",
      "destination_url": "/blog/which-houses-in-Istanbul-are-suitable-for-retirees"
    },
    {
      "old_url": "/more-than-80-percent-of-arab-investors-wants-to-invest-in-turkey-real-estate-sector",
      "destination_url": "/blog/80-percent-of-arab-investors-are-interested-in-turkey-real-estate"
    },
    {
      "old_url": "/4-important-advice-to-organize-your-property-in-istanbul",
      "destination_url": "/blog/four-tips-for-organizing-your-home-in-Istanbul"
    },
    {
      "old_url": "/what-makes-basaksehir-properties-different-from-other-istanbul-properties",
      "destination_url": "/blog/features-of-basaksehir-properties-from-the-rest-of-Istanbul"
    },
    {
      "old_url": "/problems-and-solutions-of-turkey-properties-4",
      "destination_url": "/blog/problems-may-hinder-your-move-to-a-home-in-turkey"
    },
    {
      "old_url": "/problems-and-solutions-of-turkey-properties-5",
      "destination_url": "/blog/how-to-keep-your-home-in-turkey-new"
    },
    {
      "old_url": "/problems-and-solutions-of-turkey-properties",
      "destination_url": "/blog/Is-your-home-ready-to-live-in-Turkey"
    },
    {
      "old_url": "/problems-and-solutions-of-turkey-properties-3",
      "destination_url": "/blog/Perfect-home-specifications-in-Istanbul"
    },
    {
      "old_url": "/problems-and-solutions-of-turkey-properties-1",
      "destination_url": "/blog/What-to-do-if-your-apartment-in-Turkey-is-big-on-you"
    },
    {
      "old_url": "/antalya-properties-prices-risees-up-by-%85",
      "destination_url": "/blog/House-prices-in-Antalya-increased%20"
    },
    {
      "old_url": "/living-in-old-properties-in-turkey",
      "destination_url": "/blog/Accommodation-in-old-houses-in-Turkey"
    },
    {
      "old_url": "/rules-of-real-estate-investment-in-turkey",
      "destination_url": "/blog/Rules-in-real-estate-investing-in-Turkey"
    },
    {
      "old_url": "/lira-decrease-impact-on-turkey-real-estate-market",
      "destination_url": "/blog/Turkish-Lira-and-Turkey-Real-Estate-Market"
    },
    {
      "old_url": "/investment-in-students-housing-and-dormitories-in-istanbul",
      "destination_url": "/blog/Investment-in-student-housing-in-Istanbul"
    },
    {
      "old_url": "/investment-in-turkey-real-estate-again",
      "destination_url": "/blog/Why-invest-in-real-estate-Turkey-again"
    },
    {
      "old_url": "/investment-in-many-cities-properties-in-turkey-positive-an-negative-points",
      "destination_url": "/blog/Make-money-from-owning-real-estate-in-Turkey"
    },
    {
      "old_url": "/features-of-istanbul-properties-in-sisli",
      "destination_url": "/blog/Advantages-of-real-estate-in-sisli"
    },
    {
      "old_url": "/long-term-and-short-term-investment-in-turkey-properties",
      "destination_url": "/blog/Types-of-investment-in-real-estate-Turkey"
    },
    {
      "old_url": "/real-estate-investment-in-turkey-2",
      "destination_url": "/blog/Banks-or-real-estate-in-Turkey"
    },
    {
      "old_url": "/properties-prices-in-istanbul-guide",
      "destination_url": "/blog/Prices-of-apartments-in-Istanbul"
    },
    {
      "old_url": "/increasing-in-turkey-properties-sales-in-july-2018",
      "destination_url": "/blog/Turkey-real-estate-sales-for-foreigners-July-2018"
    },
    {
      "old_url": "/think-about-this-before-buying-property-in-istanbul",
      "destination_url": "/blog/If-you-want-to-own-an-apartment-in-Istanbul"
    },
    {
      "old_url": "/buying-old-property-in-istanbul-in-a-modern-neighborhood-or-the-opposite",
      "destination_url": "/blog/Old-or-new-apartments"
    },
    {
      "old_url": "/how-to-make-money-from-real-estate-investment-in-turkey-1",
      "destination_url": "/blog/Successful-real-estate-investments-in-Turkey"
    },
    {
      "old_url": "/most-important-features-of-istanbul-apartments",
      "destination_url": "/blog/Five-advantages-in-Istanbul-apartments"
    },
    {
      "old_url": "/discover-more-about-the-studio-apartments-in-turkey",
      "destination_url": "/blog/Studio-apartments-in-Turkey"
    },
    {
      "old_url": "/algerians-real-estate-investment-in-turkey",
      "destination_url": "/blog/Algeria's-investment-in-the-real-estate-of-Turkey"
    },
    {
      "old_url": "/gain-the-turkish-citizenship-by-investing-250000usd-in-turkey-real-estate-market",
      "destination_url": "/blog/Turkish-citizenship-through-real-estate-investment-1"
    },
    {
      "old_url": "/investment-in-istanbul-luxury-properties",
      "destination_url": "/blog/Luxury-real-estate-in-Istanbul"
    },
    {
      "old_url": "/istanbul-properties-prices-3",
      "destination_url": "/blog/How-to-find-suitable-property-in-Istanbul"
    },
    {
      "old_url": "/istanbul-properties-prices-5",
      "destination_url": "/blog/Supply-and-demand-in-the-Turkish-real-estate-market"
    },
    {
      "old_url": "/the-reasons-of-increase-in-saudis-investment-in-turkey-properties",
      "destination_url": "/blog/Saudi-investments-in-Turkey"
    },
    {
      "old_url": "/arabs-real-estate-investments-in-turkey-4",
      "destination_url": "/blog/Choose-the-right-property-in-Turkey"
    },
    {
      "old_url": "/arabs-real-estate-investments-in-turkey-3",
      "destination_url": "/blog/Turkey-benefits-from-buying-Arabs-for-real-estate"
    },
    {
      "old_url": "/arabs-real-estate-investments-in-turkey-1",
      "destination_url": "/blog/Attracting-foreign-investors-to-Turkey"
    },
    {
      "old_url": "/arabs-real-estate-investments-in-turkey-2",
      "destination_url": "/blog/Attract-Arabs-to-buy-real-estate-in-Turkey"
    },
    {
      "old_url": "/how-to-make-money-from-real-estate-investment-in-turkey-2",
      "destination_url": "/blog/Profit-from-real-estate-investments-in-Turkey"
    },
    {
      "old_url": "/how-to-make-money-from-real-estate-investment-in-turkey-4",
      "destination_url": "/blog/Real-estate-investment-returns-in-Turkey"
    },
    {
      "old_url": "/how-to-make-money-from-real-estate-investment-in-turkey-5",
      "destination_url": "/blog/Mortgage-Finance-in-Turkey"
    },
    {
      "old_url": "/how-to-make-money-from-real-estate-investment-in-turkey-3",
      "destination_url": "/blog/Invest-in-a-well-known-project-in-Turkey"
    },
    {
      "old_url": "/basin-express-real-estate-investors-first-choice-in-istanbul",
      "destination_url": "/blog/basinexpress-in-Istanbul-First-Investor-Option"
    },
    {
      "old_url": "/investment-in-the-restoration-of-real-estate-in-turkey",
      "destination_url": "/blog/Restoration-of-real-estate-Turkey"
    },
    {
      "old_url": "/how-to-determine-properties-prices-in-turkey",
      "destination_url": "/blog/Prices-of-apartments-in-Turkey"
    },
    {
      "old_url": "/best-places-to-buy-property-in-istanbul",
      "destination_url": "/blog/Best-area-to-buy-an-apartment-in-Turkey"
    },
    {
      "old_url": "/5-tips-for-those-wants-to-buy-apartments-in-turkey",
      "destination_url": "/blog/Tips-for-buying-apartments-in-Turkey"
    },
    {
      "old_url": "/high-increase-in-turkey-real-estate-sales-in-august-2018",
      "destination_url": "/blog/Real-estate-sales-for-foreigners-in-Turkey-August-2018"
    },
    {
      "old_url": "/real-estate-sales-in-september-2018",
      "destination_url": "/blog/turkey-real-estate-sales-for-foreigners-in-september-2018"
    },
    {
      "old_url": "/buying-property-in-turkey-is-a-great-chance",
      "destination_url": "/blog/Investing-in-real-estate-Turkey-is-an-irreplaceable-opportunity"
    },
    {
      "old_url": "/istanbul-palaces-on-the-bosphure",
      "destination_url": "/blog/The-palaces-of-Istanbul "
    },
    {
      "old_url": "/problems-and-solutions-of-turkey-properties-6",
      "destination_url": "/blog/Do-property-prices-in-Turkey-are-suitable-for-you"
    },
    {
      "old_url": "/arabs-real-estate-investments-in-turkey-5",
      "destination_url": "/blog/Long-term-real-estate-investment-in-Turkey"
    },
    {
      "old_url": "/arabs-real-estate-investments-in-turkey-6",
      "destination_url": "/blog/Real-estate-saves-Arab-money-in-Turkey"
    },
    {
      "old_url": "/advantages-of-buying-a-property-in-turkey",
      "destination_url": "/blog/Advantages-of-buying-property-in-Turkey"
    },
    {
      "old_url": "/istabul-esenyurt-properties",
      "destination_url": "/blog/esenyurt-properties-between-yesterday-and-today"
    },
    {
      "old_url": "/big-increase-in-property-prices-neard-istanbu-grand-airport",
      "destination_url": "/blog/Increase-prices-for-apartments-near-Istanbul-Airport"
    },
    {
      "old_url": "/turkey-real-estate-investment-details-and-conditions",
      "destination_url": "/blog/Terms-of-real-estate-investment-in-Turkey"
    },
    {
      "old_url": "/increase-in-turkey-real-estate-market-sales-in-2018-october",
      "destination_url": "/blog/Sales-of-real-estate-in-Turkey-October-2018"
    },
    {
      "old_url": "/iraqis-on-top-of-turkey-property-buying-foreigners",
      "destination_url": "/blog/Iraqi-real-estate-in-Turkey"
    },
    {
      "old_url": "/istanbul-real-estate-companies-goal-is-customer-satisfication",
      "destination_url": "/blog/Satisfaction-of-foreign-investors"
    },
    {
      "old_url": "/the-positive-impact-of-the-foreigner-investors-in-turkey-real-estate",
      "destination_url": "/blog/Foreign-investors-increase-in-real-estate-Turkey"
    },
    {
      "old_url": "/new-residential-compounds-in-besiktas-istanbul",
      "destination_url": "/blog/Besiktas-Properties-in-Istanbul"
    },
    {
      "old_url": "/investment-in-turkey-real-estate-for-arabs",
      "destination_url": "/blog/1500-new-Arab-investors-interested-in-real-estate-Turkey"
    },
    {
      "old_url": "/advantages-of-living-in-residential-compounds-in-istanbul",
      "destination_url": "/blog/Accommodation-in-residential-complexes-in-Istanbul"
    },
    {
      "old_url": "/rise-in-houses-prices-in-turkey",
      "destination_url": "/blog/Expectations-of-higher-home-prices-in-Turkey"
    },
    {
      "old_url": "/between-the-apartment-and-its-price",
      "destination_url": "/blog/When-you-hover-between-the-apartment-and-its-price"
    },
    {
      "old_url": "/iranian-real-estate-invesment-in-turkey",
      "destination_url": "/blog/Iranian-investments-in-the-real-estate-of-Turkey"
    },
    {
      "old_url": "/real-estate-investment-in-turkey-based-on-youtube-videos",
      "destination_url": "/blog/Real-Estate-Turkey-on-You-Tube-1"
    },
    {
      "old_url": "/real-estate-investment-in-turkey-based-on-youtube-videos-3",
      "destination_url": "/blog/Real-Estate-Turkey-on-You-Tube-2"
    },
    {
      "old_url": "/real-estate-investment-in-turkey-based-on-youtube-videos-2",
      "destination_url": "/blog/Real-Estate-Turkey-on-You-Tube-2"
    },
    {
      "old_url": "/qatari-real-estate-investments-in-turkey",
      "destination_url": "/blog/Qatari-investments-in-Turkey"
    },
    {
      "old_url": "/improvements-in-real-estate-investment-chances-between-2015-2018",
      "destination_url": "/blog/Improved-real-estate-investment-opportunities-in-Turkey"
    },
    {
      "old_url": "/6-houses-types-in-turkey",
      "destination_url": "/blog/I-am-a-cottage-in-Turkey"
    },
    {
      "old_url": "/2018-the-increase-on-the-price-of-rent-apartments-in-turkey",
      "destination_url": "/blog/Apartment-rentals-in-Turkey-October-2018"
    },
    {
      "old_url": "/risks-of-buying-property-in-turkey",
      "destination_url": "/blog/The-disadvantages-of-buying-a-property-in-Turkey"
    },
    {
      "old_url": "/construction-without-license-penalty",
      "destination_url": "/blog/Unlicensed-property-penalty-in-Turkey"
    },
    {
      "old_url": "/increase-in-real-estate-prices-around-north-marmara-highway",
      "destination_url": "/blog/Property-near-the-North-Marmara-Road"
    },
    {
      "old_url": "/turkey-real-estate-on-the-black-sea-prices",
      "destination_url": "/blog/Real-Estate-Turkish-cities-near-the-Black-Sea"
    },
    {
      "old_url": "/turkey-real-estate-sales-by-loans",
      "destination_url": "/blog/Decline-in-real-estate-loans-in-Turkey"
    },
    {
      "old_url": "/best-times-to-sell-your-property-in-turkey",
      "destination_url": "/blog/Best-times-to-sell-real-estate-in-Turkey"
    },
    {
      "old_url": "/save-money-when-buying-property-in-turkey",
      "destination_url": "/blog/Tips-to-save-money-when-buying-a-property-in-Turkey"
    },
    {
      "old_url": "/property-pictures-mistakes-in-turkey-real-estate",
      "destination_url": "/blog/Photographic-apartments-for-sale-in-Turkey"
    },
    {
      "old_url": "/average-real-estate-prices-in-turkey-2083tl-per-square-meter",
      "destination_url": "/blog/The-price-per-meter-in-real-estate-Turkey-is-2083-TL"
    },
    {
      "old_url": "/2018-the-increase-on-the-price-of-rent-apartments-in-turkey",
      "destination_url": "/blog/Apartment-rentals-in-Turkey-October-2018"
    },
    {
      "old_url": "/tips-for-beginners-in-real-estate-investing-in-turkey",
      "destination_url": "/blog/Tips-for-beginners-in-real-estate-investing-in-Turkey"
    },
    {
      "old_url": "/how-to-make-sure-you-are-investing-correctly-in-turkish-real-estate",
      "destination_url": "/blog/How-to-invest-properly-in-Turkey"
    },
    {
      "old_url": "/turkish-construction-companies-encourage-foreigners-to-invest-in-real-estate-turkey",
      "destination_url": "/blog/Turkish-construction-companies-encourage-foreigners-to-invest"
    },
    {
      "old_url": "/areas-to-invest-in-istanbul-real-estate",
      "destination_url": "/blog/Seven-areas-to-invest-in-Istanbul-real-estate"
    },
    {
      "old_url": "/focus-on-the-following-when-buying-house-in-istanbul",
      "destination_url": "/blog/Focus-on-Miley-when-buying-a-house-in-Istanbul"
    },
    {
      "old_url": "/real-estate-investment-in-arnavtokoy-istanbul",
      "destination_url": "/blog/Real-Estate-in-Arnavutkoy"
    },
    {
      "old_url": "/maktoums-palace-in-turkey",
      "destination_url": "/blog/Al-Maktoum-Palace-in-Turkey"
    },
    {
      "old_url": "/best-cities-to-buy-property-in-turkey-winter",
      "destination_url": "/blog/The-best-cities-to-buy-real-estate-in-Turkey"
    },
    {
      "old_url": "/turkey-real-estate-prices-november-2018",
      "destination_url": "/blog/Real-estate-prices-in-Turkey-November-2018"
    },
    {
      "old_url": "/foreign-ownership-of-turkey-real-estate-rises",
      "destination_url": "/blog/Foreigners-own-the-real-estate-of-Turkey-November-2018"
    },
    {
      "old_url": "/turkey-real-estate-sales-2018",
      "destination_url": "/blog/Foreigners-own-the-real-estate-of-Turkey-November-2018"
    },
    {
      "old_url": "/apartment-rents-in-turkey-increased-by-2019",
      "destination_url": "/blog/Apartment-rentals-in-Turkey-October-2018"
    },
    {
      "old_url": "/house-prices-rise-in-4-areas-of-istanbul",
      "destination_url": "/blog/Home-prices-in-Istanbul-near-metro"
    },
    {
      "old_url": "/students-housing-in-turkey",
      "destination_url": "/blog/Student-accommodation-in-Turkey"
    },
    {
      "old_url": "/best-way-to-search-for-house-in-istanbul",
      "destination_url": "/blog/Focus-on-Miley-when-buying-a-house-in-Istanbul"
    },
    {
      "old_url": "/increase-in-property-prices-antalya",
      "destination_url": "/blog/Prices-for-apartments-in-Antalya-increased"
    },
    {
      "old_url": "/real-estate-investment-in-turkey-with-300-thousand-lira",
      "destination_url": "/blog/Real-estate-investment-of-300-thousand-pounds"
    },
    {
      "old_url": "/real-estate-investment-in-kagithane-istanbul",
      "destination_url": "/blog/Focus-on-Miley-when-buying-a-house-in-Istanbul"
    },
    {
      "old_url": "/buying-a-small-apartment-in-turkey",
      "destination_url": "/blog/Buy-a-small-apartment-in-Turkey"
    },
    {
      "old_url": "/istanbul-homes-near-bosphorus",
      "destination_url": "/blog/Houses-near-the-Bosphorus-Strait"
    },
    {
      "old_url": "/turkey-real-estate-sales-october-2018",
      "destination_url": "/blog/Sales-of-real-estate-in-Turkey-October-2018"
    },
    {
      "old_url": "/basaksehir-in-istanbul",
      "destination_url": "/blog/basaksehir-area-of-istanbul"
    },
    {
      "old_url": "/statistics-67-of-real-estate-sales-turkey-in-may-real-estate-under-construction",
      "destination_url": "/blog/Real-Estate-in-Turkey-under-construction-in-May-2018"
    },
    {
      "old_url": "/istabul-esenyurt-properties",
      "destination_url": "/blog/Real-Estate-in-Esenyurt"
    },
    {
      "old_url": "/real-estate-exhibitions-in-turkey",
      "destination_url": "/blog/Real-Estate-Exhibitions-in-Turkey"
    },
    {
      "old_url": "/turkey-real-estate-sales-2020",
      "destination_url": "/blog/Sales-of-real-estate-in-Turkey-for-foreigners-2020"
    },
    {
      "old_url": "/real-estate-tours-in-turkey",
      "destination_url": "/blog/Real-Estate-Tours-in-Turkey"
    },
    {
      "old_url": "/turkish-home-decorations",
      "destination_url": "/blog/Turkish-home-decorations"
    },
    {
      "old_url": "/tourism-in-antalya-achieved-new-records",
      "destination_url": "/blog/Tourism-in-Antalya-achieved-new-records"
    },
    {
      "old_url": "/japanese-tourists-in-turkey",
      "destination_url": "/"
    },
    {
      "old_url": "/turkey-and-eu-relations",
      "destination_url": "/"
    },
    {
      "old_url": "/learn-the-details-of-turkish-carpets",
      "destination_url": "/"
    },
    {
      "old_url": "/high-income-tourists-expected-to-rise-in-turkey",
      "destination_url": "/"
    },
    {
      "old_url": "/turkey-wants-to-attract-the-asian-investors",
      "destination_url": "/"
    },
    {
      "old_url": "/turkish-economy-achieves-its-2018-goals",
      "destination_url": "/blog/The-success-of-the-Turkish-economy-in-2018"
    },
    {
      "old_url": "/ways-to-rationalize-electricity-consumption-in-turkey",
      "destination_url": "/blog/Electricity-consumption-in-Turkey"
    },
    {
      "old_url": "/turkeys-zero-waste-initiative",
      "destination_url": "/"
    },
    {
      "old_url": "/istanbul-grand-airport-iga",
      "destination_url": "/blog/The-largest-airport-in-the-world-the-new-Istanbul-airport"
    },
    {
      "old_url": "/turkish-economy-achieves-new-records-2018",
      "destination_url": "/blog/Turkish-economy-record-in-20187"
    },
    {
      "old_url": "/halal-products-exhibition-in-istanbul",
      "destination_url": "/"
    },
    {
      "old_url": "/turkish-lira-rises-against-the-dolar-in-paralel-with-improving-turkish-american-relations",
      "destination_url": "/blog/Turkish-lira-and-improved-Turkish-American-relations"
    },
    {
      "old_url": "/opening-bank-account-in-turkey-for-foreigners",
      "destination_url": "/blog/Opening-a-bank-account-in-Turkey"
    },
    {
      "old_url": "/transportation-in-istanbul-full-guide",
      "destination_url": "/blog/Transportation-in-Istanbul"
    },
    {
      "old_url": "/syrians-investments-in-turkey-scores-high-success-rate",
      "destination_url": "/blog/Syrian-investments-in-Turkey"
    },
    {
      "old_url": "/establishing-company-in-turkey-full-guide",
      "destination_url": "/blog/Establishment-of-company-in-Turkey"
    },
    {
      "old_url": "/mall-of-istanbul",
      "destination_url": "/blog/Mall-of-Istanbul"
    },
    {
      "old_url": "/cost-of-living-in-turkey-1",
      "destination_url": "/blog/Cost-of-living-in-Turkey"
    },
    {
      "old_url": "/turkeys-new-economy-program-and-plan",
      "destination_url": "/"
    },
    {
      "old_url": "/adha-eid-in-istanbul",
      "destination_url": "/"
    },
    {
      "old_url": "/turkeys-economic-growth-rates-achieves-high-records",
      "destination_url": "/blog/Economic-growth-rates-in-Turkey"
    },
    {
      "old_url": "/canadian-magazine-promotes-tourism-in-turkey",
      "destination_url": "/blog/Canadian-magazine-encourages-travel-to-Turkey"
    },
    {
      "old_url": "/using-money-in-turkey-guide",
      "destination_url": "/blog/Money-Guide-in-Turkey-1"
    },
    {
      "old_url": "/tourisim-in-turkey-in-2023",
      "destination_url": "/blog/Turkey-plans-for-tourism-in-2023"
    },
    {
      "old_url": "/free-national-trade-plan-between-turkey-and-jaban-2019",
      "destination_url": "/"
    },
    {
      "old_url": "/jawaher-mall-in-istanbul",
      "destination_url": "/blog/Jawaher-Mall-in-Istanbul"
    },
    {
      "old_url": "/erdogans-first-100-days-plan-as-a-president",
      "destination_url": "/"
    },
    {
      "old_url": "/18-millon-dolar-egyptian-investment-in-turkey",
      "destination_url": "/"
    },
    {
      "old_url": "/fatima-shaheen-gaziantep-real-estate-is-a-good-investment-opportunity",
      "destination_url": "/"
    },
    {
      "old_url": "/why-do-everyone-think-of-visiting-istanbul-or-staying-there",
      "destination_url": "/"
    },
    {
      "old_url": "/learn-about-turquoise-card-for-residence-in-turkey",
      "destination_url": "/"
    },
    {
      "old_url": "/learn-more-about-turkish-culture-and-traditions",
      "destination_url": "/"
    },
    {
      "old_url": "/turkey-has-a-date-with-120-new-luxury-hotels",
      "destination_url": "/"
    },
    {
      "old_url": "/india-and-turkey-and-economic-and-tourism-relations-between-them",
      "destination_url": "/"
    },
    {
      "old_url": "/turkish-economy-and-real-estate-investment-opportunities-in-turkey-after-the-elections",
      "destination_url": "/"
    },
    {
      "old_url": "/qatari-investments-in-turkey-and-partnership-between-the-two-countries",
      "destination_url": "/"
    },
    {
      "old_url": "/sudden-rise-in-chinese-investment-in-turkey",
      "destination_url": "/"
    },
    {
      "old_url": "/turkey-economy-grew-during-the-first-quarter-of-2018-by-7-percent",
      "destination_url": "/"
    },
    {
      "old_url": "/the-future-of-tourism-in-turkey",
      "destination_url": "/blog/The-future-of-tourism-in-Turkey"
    },
    {
      "old_url": "/about-the-most-famous-turkish-industries",
      "destination_url": "/blog/The-most-famous-industries-in-Turkey"
    },
    {
      "old_url": "/turkey-most-important-tourist-attractions-to-visit-this-year",
      "destination_url": "/"
    },
    {
      "old_url": "/turkish-government-plan-to-build-5-giant-industrial-zones",
      "destination_url": "/"
    },
    {
      "old_url": "/expectations-of-increased-investment-in-turkey-after-the-june-2018-elections",
      "destination_url": "/"
    },
    {
      "old_url": "/learn-about-grand-istanbul-airport",
      "destination_url": "fanarrealty.com/blog/The-largest-airport-in-the-world-the-new-Istanbul-airport"
    },
    {
      "old_url": "/foreign-tourists-in-mugla-rise-to-38-percent",
      "destination_url": "/"
    },
    {
      "old_url": "/value-of-real-estate-sales-in-turkey",
      "destination_url": "/"
    },
    {
      "old_url": "/turkish-election-results-their-impact-on-real-estate-investment-in-turkey",
      "destination_url": "/"
    },
    {
      "old_url": "/istanbul-to-welcome-another-automated-metro-system",
      "destination_url": "/"
    },
    {
      "old_url": "/in-urla-the-2018-artichoke-festival",
      "destination_url": "/"
    },
    {
      "old_url": "/swedish-meatballs-and-other-terrific-tales-of-turkish-food",
      "destination_url": "/"
    },
    {
      "old_url": "/financing-your-property",
      "destination_url": "/"
    },
    {
      "old_url": "/turkey-to-invest-over-46b-on-railways-expand-high-speed-network-to-41-cities-transport-minister",
      "destination_url": "/"
    },
    {
      "old_url": "/foreign-students-in-turkey-will-receive-health-insurance-work-permission",
      "destination_url": "/"
    },
    {
      "old_url": "/10-faces-of-bodrum-enjoy-summer-in-the-turkish-riviera",
      "destination_url": "/"
    },
    {
      "old_url": "/spring-in-bourdum",
      "destination_url": "/"
    },
    {
      "old_url": "/over-100000-foreigners-now-study-in-turkey",
      "destination_url": "/"
    },
    {
      "old_url": "/turkey-projects-2018",
      "destination_url": "/"
    },
    {
      "old_url": "/gaziantep-looks-to-lure-foreign-investments-at-top-real-estate-fair",
      "destination_url": "/"
    },
    {
      "old_url": "/updated-news-about-buying-property-turkey",
      "destination_url": "/"
    },
    {
      "old_url": "/british-people-buying-property-in-turkey",
      "destination_url": "/"
    },
    {
      "old_url": "/labour-force-statistics-january-2018",
      "destination_url": "/"
    },
    {
      "old_url": "/best-spots-photography-cappadocia-tour",
      "destination_url": "/"
    },
    {
      "old_url": "/foreign-trade-indices-february-2018",
      "destination_url": "/"
    },
    {
      "old_url": "/buying-property-in-certain-areas",
      "destination_url": "/"
    },
    {
      "old_url": "/key-facts-in-the-turkish-real-estate-sector",
      "destination_url": "/"
    },
    {
      "old_url": "/turks-eye-up-greek-real-estate-despite-tensions",
      "destination_url": "/"
    },
    {
      "old_url": "/womens-choice-in-turkey",
      "destination_url": "/"
    },
    {
      "old_url": "/buying-vs-renting-a-house",
      "destination_url": "/"
    },
    {
      "old_url": "/turkish-economy-statistics-2018",
      "destination_url": "/"
    },
    {
      "old_url": "/10-best-hiking-trails-in-turkey",
      "destination_url": "/"
    },
    {
      "old_url": "/house-sales-up-17-pct-sales-to-foreigners-soar-by-257-pct-in-january",
      "destination_url": "/"
    },
    {
      "old_url": "/turkey-real-estate-indices-march-2018-results",
      "destination_url": "/"
    },
    {
      "old_url": "/the-best-budget-friendly-tours-in-turkey",
      "destination_url": "/"
    },
    {
      "old_url": "/what-happens-if-you-dont-pay-property-taxes-your-home",
      "destination_url": "/"
    },
    {
      "old_url": "/economic-confidence-index-april-2018",
      "destination_url": "/"
    },
    {
      "old_url": "/how-to-visit-turkey-in-a-romantic-way",
      "destination_url": "/"
    },
    {
      "old_url": "/how-to-get-treated-like-sultans-in-a-turkish-bath",
      "destination_url": "/"
    },
    {
      "old_url": "/german-model-boost-turkeys-slowing-housing-market",
      "destination_url": "/"
    },
    {
      "old_url": "/historic-advantages-in-the-turkish-real-estate-market",
      "destination_url": "/"
    },
    {
      "old_url": "/real-estate-turkish-house-prices-rose-12-percent-2017",
      "destination_url": "/"
    },
    {
      "old_url": "/7-beautiful-trees-of-istanbul",
      "destination_url": "/"
    },
    {
      "old_url": "/cultural-things-to-do-everywhere",
      "destination_url": "/"
    },
    {
      "old_url": "/body-language-communication-for-your-travels",
      "destination_url": "/"
    },
    {
      "old_url": "/al-istanbul-how-turkeys-largest-city-became-a-hub-for-arab-tourists",
      "destination_url": "/"
    },
    {
      "old_url": "/turkish-cities-set-to-take-stage-at-worlds-biggest-real-estate-fair",
      "destination_url": "/"
    },
    {
      "old_url": "/istanbul-blossoms-with-worlds-largest-tulip-carpet",
      "destination_url": "/"
    },
    {
      "old_url": "/plant-species-in-turkey-being-driven-to-extinction-by-expanding-settlements",
      "destination_url": "/"
    },
    {
      "old_url": "/thing-to-do-in-turkey-in-winter",
      "destination_url": "/"
    },
    {
      "old_url": "/5-reasons-to-visit-cappadocia",
      "destination_url": "/"
    },
    {
      "old_url": "/making-money-from-real-estate-investing",
      "destination_url": "/"
    },
    {
      "old_url": "/ways-to-fund-living-in-turkey-as-a-foreigner",
      "destination_url": "/"
    },
    {
      "old_url": "/turkish-tulip-festival-brightens-up-park-in-switzerland",
      "destination_url": "/"
    },
    {
      "old_url": "/what-to-do-in-turkey",
      "destination_url": "/"
    },
    {
      "old_url": "/how-to-use-wi-fi-safely-at-hotels-and-resorts",
      "destination_url": "/"
    },
    {
      "old_url": "/real-estate-market-in-shade-of-world-business",
      "destination_url": "/"
    },
    {
      "old_url": "/what-defines-luxury-travel-in-turkey",
      "destination_url": "/"
    },
    {
      "old_url": "/turkeys-universities-host-75-million-students",
      "destination_url": "/"
    },
    {
      "old_url": "/presidential-elections-and-expectations-of-their-reflection-on-the-turkish-real-estate-market",
      "destination_url": "/"
    },
    {
      "old_url": "/cultural-differences-and-minority-rights-in-turkey",
      "destination_url": "/"
    },
    {
      "old_url": "/istanbul-shopping-guide-10-turkish-items-to-bring-home",
      "destination_url": "/blog/Gifts-from-Istanbul"
    },
    {
      "old_url": "/the-best-day-trips-from-izmir-turkey",
      "destination_url": "/"
    },
    {
      "old_url": "/where-to-go-in-turkey-based-on-your-personality",
      "destination_url": "/"
    },
    {
      "old_url": "/is-it-a-good-time-to-buy-real-estate-in-turkey",
      "destination_url": "/"
    },
    {
      "old_url": "/veiled-women-beypazari-burgu-turkey",
      "destination_url": "/"
    },
    {
      "old_url": "/turkey-sees-china-key-tourism-market-eyes-half-a-million-chinese-travelers-in-2018",
      "destination_url": "/"
    },
    {
      "old_url": "/russia-turkey-investment-fund-to-enhance-bilateral-ties",
      "destination_url": "/"
    },
    {
      "old_url": "/how-to-save-money-with-the-istanbul-tourist-pass",
      "destination_url": "/"
    },
    {
      "old_url": "/mobile-internet-access-connection-turkey",
      "destination_url": "/blog/Internet-connection-in-Turkey"
    },
    {
      "old_url": "/using-money-in-turkey",
      "destination_url": "/blog/Money-Guide-in-Turkey-1"
    },
    {
      "old_url": "/8-things-to-do-in-istanbul",
      "destination_url": "/"
    },
    {
      "old_url": "/10-reasons-why-you-should-visit-turkey-at-least-once-in-your-lifetime",
      "destination_url": "/"
    },
    {
      "old_url": "/about-turkish-tea",
      "destination_url": "/"
    },
    {
      "old_url": "/domestic-real-estate-firms-to-unveil-projects-at-dubai-fair",
      "destination_url": "/"
    },
    {
      "old_url": "/istanbulites-have-to-work-125-years-without-spending-to-buy-100m2-housing",
      "destination_url": "/"
    },
    {
      "old_url": "/tur-property-buy-commercial",
      "destination_url": "/blog/Details-of-Commercial-Investment-in-Istanbul-Real-Estate"
    },
    {
      "old_url": "/best-things-to-do-in-turkey",
      "destination_url": "/"
    },
    {
      "old_url": "/cheap-beach-holidays-in-turkey",
      "destination_url": "/"
    },
    {
      "old_url": "/turkish-culture-guide-social-traditions",
      "destination_url": "/"
    },
    {
      "old_url": "/turkish-economy-is-the-highest-in-2017",
      "destination_url": "/"
    },
    {
      "old_url": "/how-to-act-like-turk-turkish",
      "destination_url": "/"
    },
    {
      "old_url": "/food-to-eat-in-istanbul",
      "destination_url": "/"
    },
    {
      "old_url": "/turkey-realty-future-in-the-current-economy-challenges",
      "destination_url": "/"
    },
    {
      "old_url": "/investments-discussed-at-mipim-2018",
      "destination_url": "/"
    },
    {
      "old_url": "/good-reasons-to-visit-yalova-in-turkey",
      "destination_url": "/"
    },
    {
      "old_url": "/why-turkey-should-be-your-next-holiday-destination",
      "destination_url": "/"
    },
    {
      "old_url": "/useful-apps-expats-living-turkey/"
    },
    {
      "old_url": "/turkey-is-the-first-investment-destination-for-arabs",
      "destination_url": "/"
    },
    {
      "old_url": "/200000-buildings-in-istanbul-to-be-renewed-in-2018",
      "destination_url": "/"
    },
    {
      "old_url": "/4-documentaries-about-istanbul-worth-watching",
      "destination_url": "/"
    },
    {
      "old_url": "/izmir-new-star-turkeys-housing-market",
      "destination_url": "/"
    },
    {
      "old_url": "/8-of-the-best-museums-to-visit-in-istanbul",
      "destination_url": "/"
    },
    {
      "old_url": "/things-to-know-before-travelling-to-istanbul",
      "destination_url": "/"
    },
    {
      "old_url": "/turkeys-canakkale-bridge-highway-project-secures-2-3-bln-euro-financing-128858",
      "destination_url": "/"
    },
    {
      "old_url": "/new-rules-for-buying-process-for-foreign-buyers",
      "destination_url": "/"
    },
    {
      "old_url": "/turkish-govt-announces-new-plans-to-boost-investment-ease-doing-business",
      "destination_url": "/"
    },
    {
      "old_url": "/domestic-property-sales-slip-in-turkey-while-foreign-demand-soars",
      "destination_url": "/"
    },
    {
      "old_url": "/turkey-opens-investment-agency-in-qatar",
      "destination_url": "/"
    },
    {
      "old_url": "/about-turkey",
      "destination_url": "/"
    },
    {
      "old_url": "/foreigners-buy-over-22000-properties-in-turkey-in-2017",
      "destination_url": "/"
    },
    {
      "old_url": "/6-facts-about-turkey-that-will-surprise-you-part-2",
      "destination_url": "/"
    },
    {
      "old_url": "/turkey-to-grant-210-million-to-rural-development-minister",
      "destination_url": "/"
    },
    {
      "old_url": "/foreign-real-estate-investors-flock-to-coastal-cities-in-turkey",
      "destination_url": "/"
    },
    {
      "old_url": "/development-of-foreign-direct-investment-in-turkey",
      "destination_url": "/"
    },
    {
      "old_url": "/foreign-buyers-and-increase-in-realstate-market",
      "destination_url": "/"
    },
    {
      "old_url": "/saudi-arabia-begins-awarding-contracts-in-giant-red-sea-business-zone-project",
      "destination_url": "/"
    },
    {
      "old_url": "/invest-and-become-a-citizen",
      "destination_url": "/"
    },
    {
      "old_url": "/6-facts-about-turkey-that-will-surprise-you",
      "destination_url": "/"
    },
    {
      "old_url": "/families-turned-homes-to-istanbul",
      "destination_url": "/"
    },
    {
      "old_url": "/turkish-contractors-undertook-241-projects-in-2017",
      "destination_url": "/"
    },
    {
      "old_url": "/10-things-to-buy-in-istanbul",
      "destination_url": "/blog/Things-to-buy-when-you-visit-Turkey"
    },
    {
      "old_url": "/istanbul-ataturk-airport-transferred-to-third-airport",
      "destination_url": "fanarrealty.com/blog/The-largest-airport-in-the-world-the-new-Istanbul-airport"
    },
    {
      "old_url": "/residential-projects-for-foreigners-in-turkey",
      "destination_url": "/"
    },
    {
      "old_url": "/why-is-the-rate-of-foreign-buyers-increasing-in-turkeys-real-estate-market",
      "destination_url": "/"
    },
    {
      "old_url": "/turkey-ranked-fifth-in-the-price-increase-of-its-properties",
      "destination_url": "/"
    },
    {
      "old_url": "/the-influence-of-the-istanbul-canal-on-real-estate-investments",
      "destination_url": "/"
    },
    {
      "old_url": "/real-estate-investments-of-celebrities-in-turkey",
      "destination_url": "/"
    },
    {
      "old_url": "/foreigner-in-istanbul",
      "destination_url": "/"
    },
    {
      "old_url": "/5-big-projects-of-turkey",
      "destination_url": "/blog/Five-huge-projects-in-Turkey"
    },
    {
      "old_url": "/land-registration-expenses-in-turkey",
      "destination_url": "/"
    },
    {
      "old_url": "/report-about-turkish-summer",
      "destination_url": "/"
    },
    {
      "old_url": "/real-estate-in-turkey",
      "destination_url": "/"
    },
    {
      "old_url": "/qatars-projects-in-turkey",
      "destination_url": "/blog/Qatar-Projects-in-Turkey"
    },
    {
      "old_url": "/real-estate-conditions-in-turkey-between-the-failed-coup-and-successful-elections",
      "destination_url": "/"
    }
  ];
  const $route = route.fullPath.replace(/\/\s*$/, "");
  const redirect_to = routes.find((x => x.old_url === $route));
  if (redirect_to !== undefined) {
    return redirect(redirect_to.destination_url);
  }
  // if (route.fullPath.indexOf('/en') === 0) {
  // }
}

<!DOCTYPE html>
<html lang="en">
<head>
    <base href="{{ URL::asset('') }}">
    <meta charset="UTF-8"/>
    <title>Apartments Search</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/bootstrap/3.3.5/css/bootstrap.min.css"/>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.4.0/css/font-awesome.min.css"/>
    <link rel="stylesheet" href="https://unpkg.com/instantsearch.css@7.3.1/themes/algolia-min.css"/>
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Roboto"/>
    <link rel="stylesheet" href="css/main.css"/>
</head>

<body>
<div class="container-fluid">
    <header class="content-wrapper">
        <a href="https://community.algolia.com/instantsearch.js/" class="is-logo">
            <img src="img/logo-is.png" width="40"/>
        </a>
        <a href="./" class="logo">Fanar</a>

        <div class="input-group" id="searchbox"></div>
    </header>

    <div class="content-wrapper">
        <aside>
            <div id="clear-refinements"></div>

            <section class="facet-wrapper">
                <div class="facet-category-title">Refine by</div>
                <div id="types" class="facet"></div>
                <div id="rooms" class="facet"></div>
                <div id="area" class="facet"></div>
                <div id="price" class="facet"></div>
                <div id="municipality" class="facet"></div>
                <div id="payment" class="facet"></div>
                <div id="investment" class="facet"></div>
                <div id="views" class="facet"></div>
                <div id="ready" class="facet"></div>
            </section>

            <div class="thank-you">
                Data courtesy of
                <a href="https://developer.bestbuy.com/">Best Buy</a>
            </div>
        </aside>

        <div class="results-wrapper">
            <section id="results-topbar">
                <div class="sort-by">
                    <div id="sort-by"></div>
                </div>

                <div id="stats" class="text-muted"></div>
            </section>

            <main id="hits"></main>
            <section id="pagination"></section>
        </div>
    </div>
</div>

<script src="https://cdn.polyfill.io/v2/polyfill.min.js?features=default,Array.prototype.includes"></script>
<script src="https://cdn.jsdelivr.net/jquery/1.11.3/jquery.min.js" async
></script>
<script src="https://cdn.jsdelivr.net/npm/algoliasearch@3.32.0"></script>
<script src="https://cdn.jsdelivr.net/npm/instantsearch.js@3.0.0"></script>
<script src="js/search.js"></script>
</body>
</html>

<?php

namespace Tests\Unit;

use App\Models\Article;
use Tests\TestCase;

class ExampleTest extends TestCase
{
    /**
     * A basic test example.
     *
     * @return void
     */
    public function testBasicTest()
    {
        $article = Article::find(9);

        $myHtmlContent = $article->details;

        $markupFixer = new \TOC\MarkupFixer();
        $tocGenerator = new \TOC\TocGenerator();

        $htmlOut = "<div class='post-content'>" . $markupFixer->fix($myHtmlContent) . "</div>";

        // This generates the Table of Contents in HTML
        $ul = "<div class='post-table-of-content'>" . $tocGenerator->getHtmlMenu($htmlOut) . "</div>";

        echo $ul . $htmlOut;
    }
}

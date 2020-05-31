<aside>
    <div class="about">
        <h1>About.</h1>
        <p>I am Gregor J. That's it. A middle-aged second-career programmer just trying to figure things out. 
        Nothing more, nothing less. This site is my brutal truth.</p>
        <p>Oh yeah, I programmed the software that runs this blog, so I'll probably 
        be mentioning something about that from time to time.</p>
        <p>Check out the <a href="/article/16">privacy policy.</a></p>
    </div>

    <div class="latest">
        <h1>Latest Posts.</h1>
        <?php
        listLatest();
        ?>
    </div>
    <div class="categories">
        <h1>Categories.</h1>
        <?php
        listCategories();
        ?>
    </div>

    <div class = "search">
        <h1>Search.</h1>
    <form action="/search" method="post">
        <div class="row">
            <div class = lab>
            <label for="search" style="display:none">-></label>
            </div>
            <div class = inp style="width:100%">
            <input type="text" id="search" name="search" placeholder="Enter search term." required>
            </div>
        </div>
        <div class="row">
            <input type="submit" name="searching" value="Go.">
        </div>
    </form>    
    </div>

    <div class="contact">
        <h1>Contact.</h1>
        If you like what you see here, or hate what you see here, or are completely ambivalent about the whole thing, 
        hit me up on Twitter, because there too, <a href="https://twitter.com/IAmGregorJ" target="_blank" rel="noopener noreferrer">
        @IAmGregorJ</a>
        <br/><br/>
        <div class="center">
        <a href="https://twitter.com/intent/follow?screen_name=IAmGregorJ" target="_blank" rel="noopener noreferrer">
        <img src="/images/twitter-xxl.png" alt="Twitter" title="Follow me on Twitter."></a>
        <a href="rss" target="_blank"><img src="/images/rss-xxl.png" class=up alt="RSS" title="RSS feed"></a>
        </div>    
    </div>
</aside>
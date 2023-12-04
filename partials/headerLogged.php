<header>
        <!--BANNERI & SEARCH-->
        <div class="banner-search-container">
            <!--BANNERI-->
            <div class="banner">
                <img src="images/banner_small.png">
            </div>
        
          <!--SEARCHBAR-->
          <div class="search-container">
                <form action="index.php" method="get">
                    <input type="text" name="search" placeholder="Etsi tuotteita">
                    <button type="submit">
                        Etsi
                    </button>
                </form>
            </div>
        </div>
        
        <!--MENU & KIRJAUTUMINEN ULOS & OSTOSKORI-->
        <div class="menu-log-cart-container">
            <div class="menu">
                <a href=""><img src="images/menutext.png" class="log"> <!--Luotu luokka "log" javascriptia varten-->
            </div>
            <div class="logout">
                <form method="post" class="logout-button">
                    <button type="submit" name="logout">
                        <img src="images/logout.png">
                    </button>
                </form>
            </div>
            <div class="cart">
                <a href="shopping_cart.php?from_member_area=true"><img src="images/carttext.png"></a>
            </div>
        </div>
</header>
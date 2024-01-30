<!--TÄSSÄ TIEDOSTOSSA ON FOOTERIN RAKENNEKOODI-->
<footer>
        <div class="footer-header-body-container">
            <div class="footer-osoitetiedot">
                <h4>YHTEYSTIEDOT</h4>
                <ol>
                    <li>Yritystie 1 a 2</li>
                    <li>70100 Kuopio</li>
                </ol>
            </div>
            <div class="asiakaspalvelu">
                <h4>ASIAKASPALVELU</h4>
                    <ol>
                        <li>Asiakaspalvelu</li>
                        <li>Ota yhteyttä</li>
                        <li>Usein kysyttyä</li>
                        <li>Maksutavat</li>
                        <li>Kuljetustavat</li>
                        <!--Admin -linkki tulee esiin vain silloin jos käyttäjä on kirjautunut sisään ja 
                            ja hänellä on admin-oikeudet-->
                        <?php if (isset($_SESSION["from_login_page"]) && isset($_SESSION['user_username']) && $_SESSION['user_type'] === 'Admin') : ?>
                        <li><a href="admin_login.php">Admin</a></li>
                        <?php endif; ?>

                    </ol>
            </div>
            <div class="footer-avainlogo">
                <img src="images/avain.png">
            </div>
        <div>
</footer>
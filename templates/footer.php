<!-- Optional JavaScript; choose one of the two! -->
<!-- Option 1: Bootstrap Bundle with Popper -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<!-- <script src="js/jquery.MultiLanguage.min.js"></script> -->
<script src="js/lang.js"></script>
<link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@400;700&display=swap" rel="stylesheet">

<!-- tom select -->
<script src="https://cdn.jsdelivr.net/npm/tom-select@2.0.3/dist/js/tom-select.complete.min.js"></script>

<?php if ($_SESSION['logged_in'] && $_SESSION['app'] == 'GamePetition') { ?>
    <script type="text/javascript">
        function logout() {
            document.location = 'logout.php';
        }
        LogoutButton.addEventListener('click', logout, false);
    </script>
<?php } ?>

<footer>
    <div class="footer-content">
        <div class="footer-social">
            <a href="https://www.facebook.com/profile.php?id=100079271087200&locale=es_ES" target="_blank"><img src="/images/redes/FACEBOOK ICONO GP.png"></a>
            <a href="https://www.instagram.com/gamepetition/" target="_blank"><img src="/images/redes/INSTAGRAM ICONO GP.png"></a>
            <a href="https://www.twitch.tv/gamepetition" target="_blank"><img src="/images/redes/TWITCH ICONO GP.png"></a>
            <a href="https://x.com/theGamepetition" target="_blank"><img src="/images/redes/X ICONO GP.png"></a>
            <a href="https://www.youtube.com/@gamepetition" target="_blank"><img src="/images/redes/YOUTUBE ICONO GP.png"></a>
        </div>
        <div class="footer-links">
            <h6>Nuestro Proyecto</h6>
            <h6>Contacto</h6>
            <h6>Aviso Legal</h6>
            <h6>Política de Cookies</h6>
            <h6>Publicidad/ Advertising</h6>
        </div>
        <div class="footer-logo">
            <a href="#"><img src="/images/footer/A GAMEPETITION COMPANY ICONO GP.png"></a>
        </div>
    </div>
</footer>
</main>
</body>
</html>

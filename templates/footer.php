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
<style>
    .content1 {
        position: fixed;
        bottom: 0;
        width: 100%;
        background-color: white;
        z-index: 1000; /* Ensure it is above other elements */
    }
    .content1 img {
        display: block;
    }

    footer {
        position: relative;
        width: 100%;
        background-color: grey;
        padding: 10px 0;
        margin-top: 120px; /* Adjust margin-top to ensure footer is visible */
    }
    .footer-content {
        display: grid;
        grid-template-columns: repeat(3, 1fr);
        align-items: center;
        padding: 0 10px;
    }
    .footer-content a img {
        width: 20px;
        height: auto;
        margin-right: 10px;
    }
    .footer-social {
        display: flex;
        align-items: center;
    }
    .footer-links {
        display: flex;
        justify-content: center;
        flex-wrap: wrap;
        align-items: center;
    }
    .footer-links h6 {
        margin: 0 10px;
        color: white;
        font-weight: bold;
        text-align: center;
    }
    .footer-logo {
        display: flex;
        justify-content: flex-end;
        align-items: center;
    }
    .footer-logo img {
        width: 305px !important;
        height: 19px !important;
    }

    /* Media query for smaller screens */
    @media (max-width: 768px) {
        .footer-content {
            grid-template-columns: 1fr;
            text-align: center;
            place-items: center;
            justify-content: center;
        }
        .footer-logo {
            justify-content: center;
            margin-top: 10px;
        }
    }
</style>
</html>

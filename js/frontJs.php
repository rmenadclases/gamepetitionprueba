<script>
    $(".imgCross").mouseenter(function() {
        let img = $(this).attr('src')
        let chg
        let id = $(this).attr('id')
        $(this).addClass('drop-shadow')
        chg = img.substr(0, img.lastIndexOf('.'))
        $(this).attr('src', chg + '2.png')
        $("#bannerCross").hide();
        switch (id) {
            case 'LIGA':
                $("#bannerCrossLiga").show();
                break;
                case 'liga':
                $("#bannerCrossLiga").show();
                break;
            case 'TORNEO':
                $("#bannerCrossTorn").show();
                break;
                case 'torneo':
                $("#bannerCrossTorn").show();
                break;
            case 'COMPETICION':
                $("#bannerCrossComp").show();
                break;
                case 'competicion':
                $("#bannerCrossComp").show();
                break;
            case 'PERFIL':
                $("#bannerCrossPerf").show();
                break;
                case 'perfil':
                $("#bannerCrossPerf").show();
                break;
            default:
                break;
        }
    });
    $(".imgCross").mouseleave(function() {
        let img = $(this).attr('src')
        let chg
        $(this).removeClass('drop-shadow')
        chg = img.substr(0, img.lastIndexOf('.'))
        chg = chg.slice(0, -1)
        $(this).attr('src', chg + '.png')
        $("#bannerCross").show();
        $("#bannerCrossLiga").hide();
        $("#bannerCrossTorn").hide();
        $("#bannerCrossComp").hide();
        $("#bannerCrossPerf").hide();
    });

    $("#LIGA").click(function() {
        window.location.href = 'league.php'
    });
    $("#PERFIL").click(function() {
        window.location.href = 'profile.php'
    });
    $("#TORNEO").click(function() {
        window.location.href = 'tournament.php'
    });
    $("#COMPETICION").click(function() {
        window.location.href = 'competi.php'
    });
    $("#liga").click(function() {
        window.location.href = 'league.php'
    });
    $("#perfil").click(function() {
        window.location.href = 'profile.php'
    });
    $("#torneo").click(function() {
        window.location.href = 'tournament.php'
    });
    $("#competicion").click(function() {
        window.location.href = 'competi.php'
    });


    $(".fontMenu").mouseenter(function() {
        $(this).addClass('selMenu')
    });
    $(".fontMenu").mouseleave(function() {
        $(this).removeClass('selMenu')
    });
</script>

<!-- Cookie Consent by FreePrivacyPolicy.com https://www.FreePrivacyPolicy.com -->
<script type="text/javascript" src="//www.freeprivacypolicy.com/public/cookie-consent/4.1.0/cookie-consent.js" charset="UTF-8"></script>
<script type="text/javascript" charset="UTF-8">
document.addEventListener('DOMContentLoaded', function () {

    cookieconsent.run({
        "notice_banner_type":"simple",
        "consent_type":"express",
        "palette":"light",
        "language":"es",
        "page_load_consent_levels":["strictly-necessary"],
        "notice_banner_reject_button_hide":false,
        "preferences_center_close_button_hide":false,
        "page_refresh_confirmation_buttons":false,
        "website_name":"thegamepetition.com",
        "website_privacy_policy_url":"https://thegamepetition.com/privacy.php"});

});
</script>

<noscript>Cookie Consent by <a href="https://www.freeprivacypolicy.com/">Free Privacy Policy Generator</a></noscript>
<!-- End Cookie Consent by FreePrivacyPolicy.com https://www.FreePrivacyPolicy.com -->

<!-- Below is the link that users can use to open Preferences Center to change their preferences. Do not modify the ID parameter. Place it where appropriate, style it as needed. -->

<a href="#" id="open_preferences_center">Update cookies preferences</a>
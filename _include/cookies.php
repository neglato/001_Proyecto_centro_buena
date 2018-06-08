<link rel="stylesheet" type="text/css" href="//cdnjs.cloudflare.com/ajax/libs/cookieconsent2/3.0.3/cookieconsent.min.css" />
    <script src="//cdnjs.cloudflare.com/ajax/libs/cookieconsent2/3.0.3/cookieconsent.min.js"></script>
    <script>
        window.addEventListener("load", function(){
            window.cookieconsent.initialise({
                "palette": {
                    "popup": {
                        "background": "#3c404d",
                        "text": "#d6d6d6"
            },
            "button": {
                "background": "rgb(5, 137, 25)"
            }
        },
        "position": "bottom-right",
        "content": {
            "message": "<?= MENSAJE ?>",
            "dismiss": "<?= ACEPTAR ?>",
            "link": "<?= LEER_MAS ?>",
            "href": "http://www.agpd.es/portalwebAGPD/canaldocumentacion/cookies/index-ides-idphp.php"
        }
        })});
    </script>
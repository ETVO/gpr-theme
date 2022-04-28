import 'bootstrap';

(jQuery)(
    function($) {

        function showCookiePopup() {

            var consent = null;

            if(consent = localStorage.getItem('cookiesConsent')) {
                $('#cookiePopup').hide();

                consent = JSON.parse(consent);

                var datetime = new Date(Date.parse(consent.datetime));

                console.info('Consentimento a utilização de cookies fornecido em ' + datetime)
            }
            else {
                setTimeout(() => {
                    $('#cookiePopup').css('opacity', 1)
                }, 500)
    
                $('#cookieAccept').on('click', () => {

                    const cookiesConsent = {
                        consent: true,
                        datetime: new Date()
                    };
    
                    localStorage.setItem('cookiesConsent', JSON.stringify(cookiesConsent))
                    
                    $('#cookiePopup').fadeOut()
                })
            }
        }

        /**
         * Invoke functions when document.body is ready 
         */
        $(document.body).ready(function (){
            showCookiePopup();
        });
    }
)
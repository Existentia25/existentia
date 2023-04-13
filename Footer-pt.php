<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Footer</title>
</head>
<body>
    <!--==================== FOOTER ====================-->
    <footer class="footer section">
            <div class="footer__container container grid">
                <div class="footer__content">
                    <a href="#" class="footer__logo">
                        <img src="assets/img/logo_navbar.png" alt="" style="width: 150px;">
                    </a>

                    <h3 class="footer__title">
                        Assine a nossa newsletter <br> para ficar atualizado
                    </h3>
                    <!-- <form method="POST">
                        <div class="footer__subscribe">
                            <input type="email" name="mail_port" placeholder="Digite seu e-mail" class="footer__input">
                            <input type="submit" class="button button--flex footer__button" value=Cadastro>      
                        </div>
                    </form> -->
                    <div class="footer__subscribe">
                        <input type="email" id="newsletterport" placeholder="Digite seu e-mail" class="footer__input">

                        <input type="submit" class="button button--flex footer__button" onclick="whatsapp2()" value="Cadastro">

                        <!-- <button class="button button--flex footer__button">
                            Subscribe
                            <i class="ri-arrow-right-up-line button__icon"></i>
                        </button> -->
                    </div>
                    
                </div>

                <div class="footer__content">
                    <h3 class="footer__title">Nosso endereço</h3>

                    <ul class="footer__data">
                        <li class="footer__information">77 Rua Valentim Siti</li>
                        <li class="footer__information">Maputo - code postal</li>
                        <li class="footer__information">Mozambique</li>
                    </ul>
                </div>

                <div class="footer__content">
                    <h3 class="footer__title">Contate Nos</h3>

                    <ul class="footer__data">
                        <li class="footer__information">+258 84 294 5714  <br> +33 6 46 92 48 91  <br> user@email.com</li>
                        
                        <div class="footer__social">
                            <a href="https://www.facebook.com/" class="footer__social-link">
                                <i class="ri-facebook-fill"></i>
                            </a>
                            <a href="https://www.instagram.com/" class="footer__social-link">
                                <i class="ri-instagram-line"></i>
                            </a>
                            <a href="https://twitter.com/" class="footer__social-link">
                                <i class="ri-whatsapp-fill"></i>
                            </a>
                        </div>
                    </ul>
                </div>

                <div class="footer__content">
                    <h3 class="footer__title">
                        Nós aceitamos todos os cartões de crédito
                    </h3>

                    <div class="footer__cards">
                        <img src="assets/img/card1.png" alt="" class="footer__card">
                        <img src="assets/img/card2.png" alt="" class="footer__card">
                        <img src="assets/img/card3.png" alt="" class="footer__card">
                        <img src="assets/img/card4.png" alt="" class="footer__card">
                    </div>
                </div>
            </div>

            <p class="footer__copy">&#169; A-TEAM Développement. All rigths reserved</p>
        </footer>

       
</body>
</html>
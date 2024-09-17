<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sophia Store - <?php echo $titulo; ?></title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Alegreya+Sans+SC:ital,wght@0,100;0,300;0,400;0,500;0,700;0,800;0,900;1,100;1,300;1,400;1,500;1,700;1,800;1,900&family=Comfortaa:wght@300..700&family=Julius+Sans+One&family=Outfit:wght@100..900&family=Rancho&family=Sacramento&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.2/css/all.min.css" integrity="sha512-1sCRPdkRXhBV2PBLUdRb4tMg1w2YPf37qatUFeS7zlBy7jJI8Lf4VHwWfZZfpXtYSLy85pkm9GaYVYMfw5BC1A==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="/build/css/app.css">
    <!-- Swiper CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@latest/swiper-bundle.min.css">

    <style>

        html, body {
            overflow: auto;
            height: auto;
        }

        .swiper {
            position: relative;
            width: 100%;
            height: 60vh;
            border-radius: 0;

            &-wrapper {
                display: flex;
                height: 100%;
                overflow: hidden;
                border-radius: 0;
            }

            &-slide {
                position: relative;
                width: 100%;
                height: 100%;
                display: flex;
                justify-content: center;
                align-items: center;

                picture {
                    width: 100%;
                    height: 100%;
                    object-fit: cover;

                    img {
                        width: 100%;
                        height: 100%;
                        object-fit: cover;
                    }
                }
            }

            &-pagination {
                position: absolute;
                bottom: 10px;
                left: 50%;
                transform: translateX(-50%);
                z-index: 10;
            }

            &-scrollbar {
                position: absolute;
                bottom: 0;
                left: 0;
                width: 100%;
                z-index: 10;
            }
        }

        .auth__imagen--tamaño {
            width: 100%;
            height: 100%;
            object-fit: cover;
        }

        .auth__opacity {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background-color: rgba(0, 0, 0, 0.5);
            z-index: 5;
        }
            
        @media (min-width: 768px) {
            html, body {
                overflow: hidden;
                height: 100%;
            }

            .swiper {
                height: 100vh;
            }
        }

    </style>

</head>

<body class="auth">

    <div class="swiper">
        <!-- Additional required wrapper -->
        <div class="swiper-wrapper">
            <?php foreach ($imagenes as $imagen) { ?>
                <div class="swiper-slide">
                    <picture class="swiper__picture">
                        <source srcset="<?php echo '/build/img/auth/' . trim($imagen->token) . '.webp'; ?>" type="image/webp">
                        <source srcset="<?php echo '/build/img/auth/' . trim($imagen->token) . '.png'; ?>" type="image/png">
                        <img class="auth__imagen--tamaño" src="<?php echo '/build/img/auth/' . trim($imagen->token) . '.png'; ?>" alt="Imagen Login">
                    </picture>
                    <div class="auth__opacity"></div>
                </div>
            <?php } ?>
        </div>
        <!-- Swiper Pagination -->
        <div class="swiper-pagination"></div>
    </div>

    <!-- Main Content -->
    <?php echo $contenido; ?>

    <!-- Swiper JS -->
    <script src="https://cdn.jsdelivr.net/npm/swiper@latest/swiper-bundle.min.js"></script>
    <!-- Bundle JS -->
    <script src="/build/js/bundle.min.js" defer></script>
    <!-- SweetAlert JS -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>

    <script>
        // Swiper Initialization
        var swiper = new Swiper('.swiper', {
            slidesPerView: 1,
            loop: true,
            autoplay: {
                delay: 2500,
                disableOnInteraction: false,
            },
            pagination: {
                el: '.swiper-pagination',
                clickable: true,
            },
            navigation: {
                nextEl: '.swiper-button-next',
                prevEl: '.swiper-button-prev',
            },
        });
    </script>

</body>
</html>

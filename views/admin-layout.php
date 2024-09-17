<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sophia Store - <?php echo $titulo; ?></title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Alegreya+Sans+SC:ital,wght@0,100;0,300;0,400;0,500;0,700;0,800;0,900;1,100;1,300;1,400;1,500;1,700;1,800;1,900&family=Alfa+Slab+One&family=Comfortaa:wght@300..700&family=Julius+Sans+One&family=Outfit:wght@100..900&family=Rancho&family=Sacramento&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.2/css/all.min.css" integrity="sha512-1sCRPdkRXhBV2PBLUdRb4tMg1w2YPf37qatUFeS7zlBy7jJI8Lf4VHwWfZZfpXtYSLy85pkm9GaYVYMfw5BC1A==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="/build/css/app.css">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>
</head>
<body class="admin">
    
        <?php 
            include_once __DIR__ .'/templates/admin-header.php';
        ?>
        <div class="admin__grid">
            <?php
                include_once __DIR__ .'/templates/admin-sidebar.php';  
            ?>

            <main class="admin__contenido">
                <?php 
                    echo $contenido; 
                ?> 
            </main>
        </div>
    <script src="/build/js/bundle.min.js" defer></script>
</body>
</html>
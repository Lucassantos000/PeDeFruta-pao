
<link rel="stylesheet" href="/assets/css/root.css">
<link rel="stylesheet" href="/assets/css/header.css">
<script src="https://kit.fontawesome.com/302aee4cb4.js" crossorigin="anonymous"></script>


<header id="header_app">

    <div class="max-container header">
    
        <div id="logo">
            <a href="/">
                <img  src="/assets/img/logo_branco.svg" alt="">
            </a> 
        </div>

        <div id="itens_menu">
            <ul>
                <?php 
                    $linkActive = $_GET['linkActive'] ?? '';
                ?>
                <li><a href="/index.php?linkActive=home" <?php echo $linkActive == 'home' ? 'class="active"' : ''; ?>>Home</a></li>
                <li><a href="/juntar.php?linkActive=juntar" <?php echo $linkActive == 'juntar' ? 'class="active"' : ''; ?>>Juntar</a></li>
                <li><a href="/separar.php?linkActive=separar" <?php echo $linkActive == 'separar' ? 'class="active"' : ''; ?>>Separar</a></li>
                <li><a href="/contato.php?linkActive=contato" <?php echo $linkActive == 'contato' ? 'class="active"' : ''; ?>>Contato</a></li>
            </ul>
        </div>
    </div>

</header>
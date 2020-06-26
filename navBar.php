<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
    <a class="navbar-brand" href="#">Navbar</a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent"
            aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>

    <div class="collapse navbar-collapse" id="navbarSupportedContent">
        <ul class="navbar-nav mr-auto">
            <li class="nav-item active">
                <a class="nav-link" href="#">Home <span class="sr-only">(current)</span></a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="#">Link</a>
            </li>
            <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown"
                   aria-haspopup="true" aria-expanded="false">
                    Dropdown
                </a>
                <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                    <a class="dropdown-item" href="#">Action</a>
                    <a class="dropdown-item" href="#">Another action</a>
                    <div class="dropdown-divider"></div>
                    <a class="dropdown-item" href="#">Something else here</a>
                </div>
            </li>
            <li class="nav-item">
                <a class="nav-link disabled" href="#" tabindex="-1" aria-disabled="true">Disabled</a>
            </li>
        </ul>
        <ul class="navbar-nav ml-auto">
            <li class="nav-item active">
                <span class="nav-link">Olá <?php echo $_SESSION["nome"]; ?>!</span>
            </li>
            <?php
            if ($_SESSION["tipoUsuario"] == 2) {
                echo '
            <li class="nav-item" >
                <button class="btn nav-link" type = "button" data-toggle = "modal" data-target = "#minhasAmostras" ><i class="fa fa-signal mr-sm-1" ></i >Minhas Amostras</button >
            </li >';
            }
            ?>
            <li class="nav-item">
                <button class="btn nav-link" type="button" data-toggle="modal" data-target="#exampleModal"><i
                        class="fa fa-sign-out mr-sm-1"></i>Sair
                </button>
            </li>
        </ul>
    </div>
</nav>

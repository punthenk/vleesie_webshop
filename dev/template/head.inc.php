<!DOCTYPE html>
<html lang="nl">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">

  <title>Vleesie</title>

  <link rel="apple-touch-icon" sizes="180x180" href="img/apple-touch-icon.png">
  <link rel="icon" type="image/png" sizes="32x32" href="img/favicon-32x32.png">
  <link rel="icon" type="image/png" sizes="16x16" href="img/favicon-16x16.png">
  <link rel="manifest" href="img/site.webmanifest">

  <link rel="stylesheet" href="../css/uikit.min.css">
  <link rel="stylesheet" href="../css/style.css?v=1000">

</head>

<body>
  <nav class="uk-navbar-container">
    <div class="uk-container">
      <div uk-navbar>

        <div class="uk-navbar-left">
          <ul class="uk-navbar-nav">
            <li>
              <a href="/">
                <img class="logo" src="img/Vleesie-icon.png" alt="Vleesie" title="Vleesie" />
                Vleesie
              </a>
            </li>
          </ul>
        </div>

        <div class="uk-navbar-right">

          <ul class="uk-navbar-nav">
            <li class="uk-active"><a href="/"><span uk-icon="icon: home"></span>Home</a></li>
            <li><a href="../login.php"><span uk-icon="icon: sign-in"></span>Inloggen</a></li>
            <li><a href="register.php"><span uk-icon="icon: file-edit"></span>Registreren</a></li>
            <li>
              <a href="../cart.php">
                <span uk-icon="icon: cart"></span>
                Winkelwagen
                <span id="cart_amount_indicator" class="uk-badge">0</span>
              </a>
            </li>
            <li>
              <a href="#"><span uk-icon="icon: user"></span>Welkom Koen/Michiel <span uk-navbar-parent-icon></span></a>
              <div class="uk-navbar-dropdown">
                <ul class="uk-nav uk-navbar-dropdown-nav">
                  <li class="uk-nav-header">Uw gegevens</li>
                  <li><a href="#"><span uk-icon="icon: settings"></span>Profiel</a></li>
                  <li><a href="#"><span uk-icon="icon: bag"></span>Bestellingen</a></li>
                  <li><a href="#"><span uk-icon="icon: credit-card"></span>Facturen</a></li>
                  <li><a href="#"><span uk-icon="icon: refresh"></span>Retouren</a></li>
                  <li><a href="#"><span uk-icon="icon: heart"></span>Wensenlijst</a></li>
                  <li class="uk-nav-header">Contact</li>
                  <li><a href="#"><span uk-icon="icon: info"></span>Klantenservice</a></li>
                  <li class="uk-nav-divider"></li>
                  <li><a href="#"><span uk-icon="icon: sign-out"></span>Uitloggen</a></li>
                </ul>
              </div>
            </li>
          </ul>

        </div>
      </div>
    </div>
  </nav>

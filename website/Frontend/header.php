<header>
    <div id="header">
        <div id="left">
            <?php 
            if ($_SESSION['loggedIn'] == true) {
                echo '<a href="profile.php" id="profil">Profil</a>
            <a href="data.php" id="hist">Historique</a>';
            }  
            ?>

        </div>
        <div id="titleContainer">
            <a href="index.php" id="title">Station météo</a>
        </div>

        <?php 
            if ($_SESSION['loggedIn'] == true) {
                echo '
                <a href="../Backend/logout.php" id="logged">Déconnexion
                </a>';
            } else {
                echo '<div id="notLogged">
                <button id="signInButton">Connexion</button>
                <button id="signUpButton">Inscription</button>
                </div>';
            }
        ?>
        <dialog id="signUpDialog">
        <div class="signInOrUpform">

        <div id="signUpclose">
            <button aria-label="close" formnovalidate>X</button>
        </div>
            
            <form action="../Backend/create_user.php" method="POST">
                <input type="email" name="email" placeholder="jomayo@winners.fr">
                <div id="wrongmail"></div>
                <input type="password" name="password" placeholder="Mot de passe hyper compliqué">
                <input type="password" name="passwordcheck" placeholder="Confirmez le mot de passe">
                <button type="submit" id="signup">Créer mon compte</button>
            </form>
           
        </div>
        </dialog>

        <dialog id="signInDialog">
        <div class="signInOrUpform">
        <div id="signInclose">
            <button aria-label="close" formnovalidate>X</button>
        </div>
            <form action="../Backend/user_check.php" method="POST">
                <input type="email" name="email" id="email" placeholder="jomayo@winners.fr">
                <div id="wrongmail"></div>
                <input type="password" name="password" placeholder="Mot de passe hyper compliqué">
                <button type="submit" id="signin">Se connecter</button>
            </form>
            
        </div>
        </dialog>


    </div>
</header>
<header>
    <div id="header">
        <div id="left">
            <?php 
            // If the user is connected, these links appear
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
        // If the user is connected, this link appears
            if ($_SESSION['loggedIn'] == true) {
                echo '
                <a href="logout.php" id="logged">Déconnexion
                </a>';
            } else {
        // If the user is not connected, these links appear instead
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
        <h3>Entrez vos identifiants</h3>
            <form action="../Backend/create_user.php" method="POST">
                <div id="loginCredentials">
                    <h4>E-mail</h4>
                    <input type="email" name="email" placeholder="jomayo@winners.fr">            
                    <h4>Mot de passe</h4>
                    <input type="password" name="password" placeholder="Mot de passe hyper compliqué">
                    <h4>Confirmer le mot de passe</h4>
                    <input type="password" name="passwordcheck" placeholder="Confirmez le mot de passe">
                </div>
                <div id="submitBtn">
                    <button type="submit" id="signup">Créer mon compte</button>
                </div>
            </form>
           
        </div>
        </dialog>
        
        <dialog id="signInDialog">
        <div class="signInOrUpform">
        <div id="signInclose">
            <button aria-label="close" formnovalidate>X</button>
        </div>
        <h3>Entrez vos identifiants</h3>
            <form action="../Backend/user_check.php" method="POST">
                <div id="loginCredentials">
                    <h4>E-mail</h4>
                    <input type="email" name="email" id="email" placeholder="jomayo@winners.fr">
                    <h4>Mot de passe</h4>
                    <input type="password" name="password" placeholder="Mot de passe hyper compliqué">
                </div>
                <div id="submitBtn">
                    <button type="submit" id="signin">Se connecter</button>
                </div>
            </form>
            
        </div>
        </dialog>


    </div>
</header>
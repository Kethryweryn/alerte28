<?php
session_start();
session_destroy();
echo 'Vous êtes déconnecté-e... <a href="../index.php">Se connecter</a>';
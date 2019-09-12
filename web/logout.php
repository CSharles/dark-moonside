<?php
    session_unset(); // unset $_SESSION variable for the run-time
    session_destroy(); // destroy session data in storage
    header('Location:../../web/adm1nL0g1n.html');
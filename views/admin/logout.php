<?php
include("$_SERVER[DOCUMENT_ROOT]/GTST/lib/session.php");
Session::checkLogin();

Session::destroy();

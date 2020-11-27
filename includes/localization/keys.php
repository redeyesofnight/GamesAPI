<?php
    /*
        Example Usage:
        /api/keys
            -GET: Return all keys from whole db (maybe not allowed? Maybe eventually allowed with security level?)
        /api/keys/en
            -GET: Return all keys from locale en
            -PUT: Creates new Locale en
        /api/keys/en/keyCode
            -GET: Dumps Key/Value pair info for the given keycode in collection en
            -POST: Creates new keycode key for collection en. Require Parameter value
            -PUT: Creates or updates keyCode. Require Parameter value
            -DELETE: Deletes keyCode
    */

?>
<?php

/** Disable XML-RPC from brute force attacks */
add_filter( 'xmlrpc_enabled', '_return_false' );

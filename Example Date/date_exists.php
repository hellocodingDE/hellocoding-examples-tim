<?php

/* =============================================================================
                  TRUE
============================================================================= */
// lange schreibweise
if (checkdate(12, 30, 2001) === true) { echo "True<br>"; } else { echo "False<br>"; }

// kurze schreibweise
echo ((checkdate(12, 30, 2001) === true) ? "True<br>" : "False<br>");


/* =============================================================================
                  FALSE
============================================================================= */

// lange schreibweise
if (checkdate(02, 31, 2001) === true) { echo "True<br>"; } else { echo "False<br>"; }

// kurze schreibweise
echo ((checkdate(02, 31, 2001) === true) ? "True<br>" : "False<br>");

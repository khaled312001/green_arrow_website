<?php

// Read the final fixed SQL file
$content = file_get_contents('database/tables_and_data_final_fixed.sql');

// Remove all foreign key constraints
$content = preg_replace('/,\s*FOREIGN KEY\s*\(`[^`]+`\)\s*REFERENCES\s*`[^`]+`\(`[^`]+`\)\s*(?:ON DELETE\s+(?:CASCADE|SET NULL))?/', '', $content);

// Also remove any remaining foreign key patterns
$content = preg_replace('/,\s*FOREIGN KEY\s*\([^)]+\)\s*REFERENCES\s*[^)]+\)/', '', $content);

// Clean up any double commas that might result
$content = preg_replace('/,\s*,/', ',', $content);
$content = preg_replace('/,\s*\)/', ')', $content);

// Write the content without foreign keys
file_put_contents('database/tables_and_data_no_fk.sql', $content);

echo "Removed foreign key constraints. File created: database/tables_and_data_no_fk.sql\n";
echo "You can add foreign keys manually after importing the tables.\n";

?> 
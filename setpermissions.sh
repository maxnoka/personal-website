find private/ -type d -exec chmod 750 {} \;
find private/ -type f -exec chmod 640 {} \;
chmod 750 private/bin/futoshiki-solver

find public/ -type d -exec chmod 755 {} \;
find public/ -type f -exec chmod 644 {} \;

# Description
description "This is a basic WordPress theme configured to use Sass"

# Auto discover directories
discover :directories

file 'inc/theme-options/theme-options.php'
file 'inc/custom-header.php'
file 'inc/extras.php'
file 'inc/template-tags.php'

file 'javascripts/html5.js'
file 'javascripts/keyboard-image-navigation.js'
file 'javascripts/small-menu.js'

file 'languages/readme.txt'

file 'layouts/content-sidebar-sidebar.css'
file 'layouts/content-sidebar.css'
file 'layouts/sidebar-content-sidebar.css'
file 'layouts/sidebar-content.css'
file 'layouts/sidebar-sidebar-content.css'

file '404.php'
file 'archive.php'
file 'comments.php'
file 'content-page.php'
file 'content-single.php'
file 'content.php'
file 'footer.php'
file 'functions.php'
file 'header.php'
file 'image.php'
file 'index.php'
file 'license.txt'
file 'no-results.php'
file 'page.php'
file 'README.md'
file 'rtl.css'
file 'screenshot.png'
file 'search.php'
file 'searchform.php'
file 'sidebar.php'
file 'single.php'
file 'style.css'

# Stylesheet Import
stylesheet 'screen.scss', :media => 'screen, projection'
stylesheet 'print.scss', :media => 'screen, projection'
stylesheet 'ie.scss', :media => 'screen, projection', :condition => "lt IE 9"

# Compass Extension Help
help %Q{
    compass create -r wordpress-starter --using wordpress/starter -s compressed starter
}

# Compass Extension Welcome Message
# Users will see this when they create a new project using this template.
welcome_message %Q{
    This is a basic WordPress theme configured to use Sass
}

# Description
description "This is a blank WordPress theme configured to use Sass"

# Auto discover directories
discover :directories

# Wordpress Import
file '404.php'
file 'archive.php'
file 'category.php'
file 'comments.php'
file 'content-aside.php'
file 'content-image.php'
file 'content-link.php'
file 'content-none.php'
file 'content-page.php'
file 'content-quote.php'
file 'content-status.php'
file 'content.php'
file 'footer.php'
file 'functions.php'
file 'header.php'
file 'index.php'
file 'loop.php'
file 'page.php'
file 'readme.txt'
file 'search.php'
file 'sidebar.php'
file 'single.php'
file 'style.css'
file 'tag.php'

directory 'languages'

# Javascript Import
javascript 'app.js'
javascript 'moderninzr.min.js'

# Stylesheet Import
stylesheet 'editor-style.scss', :media => 'screen, projection'
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
    This is a blank WordPress theme configured to use Sass
}

# Description
description "This is a blank WordPress theme configured to use Sass"

file 'style.css'
file 'readme.txt'

# Stylesheet Import
stylesheet 'screen.scss', :media => 'screen, projection'
stylesheet 'print.scss', :media => 'screen, projection'
stylesheet 'ie.scss', :media => 'screen, projection', :condition => "lt IE 9"

# Compass Extension Help
help %Q{
    compass create -r wordpress-starter --using wordpress -s compressed default
}

# Compass Extension Welcome Message
# Users will see this when they create a new project using this template.
welcome_message %Q{
    The default project layout.
}

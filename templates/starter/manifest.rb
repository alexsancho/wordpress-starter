# Description
description "This is a basic WordPress theme configured to use Sass"

# Auto discover directories
discover :directories

file 'admin/assets/css/admin-style.css'
file 'admin/assets/css/colorpicker.css'

file 'admin/assets/images/colorpicker/blank.gif'
file 'admin/assets/images/colorpicker/colorpicker_background.png'
file 'admin/assets/images/colorpicker/colorpicker_hex.png'
file 'admin/assets/images/colorpicker/colorpicker_hsb_b.png'
file 'admin/assets/images/colorpicker/colorpicker_hsb_h.png'
file 'admin/assets/images/colorpicker/colorpicker_hsb_s.png'
file 'admin/assets/images/colorpicker/colorpicker_indic.gif'
file 'admin/assets/images/colorpicker/colorpicker_overlay.png'
file 'admin/assets/images/colorpicker/colorpicker_rgb_b.png'
file 'admin/assets/images/colorpicker/colorpicker_rgb_g.png'
file 'admin/assets/images/colorpicker/colorpicker_rgb_r.png'
file 'admin/assets/images/colorpicker/colorpicker_select.gif'
file 'admin/assets/images/colorpicker/colorpicker_submit.png'
file 'admin/assets/images/colorpicker/select.png'

file 'admin/assets/images/1col.png'
file 'admin/assets/images/2-col-portfolio.png'
file 'admin/assets/images/2cl.png'
file 'admin/assets/images/2cr.png'
file 'admin/assets/images/3-col-portfolio.png'
file 'admin/assets/images/3cm.png'
file 'admin/assets/images/3cr.png'
file 'admin/assets/images/4-col-portfolio.png'
file 'admin/assets/images/accept.png'
file 'admin/assets/images/button_check.png'
file 'admin/assets/images/dropdown-arrow.png'
file 'admin/assets/images/favicon.ico'
file 'admin/assets/images/icon_option.png'
file 'admin/assets/images/icon-add.png'
file 'admin/assets/images/icon-backup.png'
file 'admin/assets/images/icon-delete.png'
file 'admin/assets/images/icon-docs.png'
file 'admin/assets/images/icon-edit.png'
file 'admin/assets/images/icon-home.png'
file 'admin/assets/images/icon-info.png'
file 'admin/assets/images/icon-notice.png'
file 'admin/assets/images/icon-paint.png'
file 'admin/assets/images/icon-settings.png'
file 'admin/assets/images/icon-slider.png'
file 'admin/assets/images/icon-warn.png'
file 'admin/assets/images/loading-bottom.gif'
file 'admin/assets/images/select.png'
file 'admin/assets/images/sign_warning.png'
file 'admin/assets/images/stop.png'
file 'admin/assets/images/toggle_tabs.png'
file 'admin/assets/images/ui-bg_flat_0_aaaaaa_40x100.png'
file 'admin/assets/images/warning.png'
file 'admin/assets/images/wrench.png'
file 'admin/assets/images/wrench16.png'

file 'admin/assets/js/ajaxupload.js'
file 'admin/assets/js/colorpicker.js'
file 'admin/assets/js/cookie.js'
file 'admin/assets/js/jquery.maskedinput-1.2.2.js'
file 'admin/assets/js/jquery.tipsy.js'
file 'admin/assets/js/of-medialibrary-uploader.js'
file 'admin/assets/js/smof.js'

file 'admin/classes/class.options-machine.php'

file 'admin/front-end/options.php'

file 'admin/functions/functions.admin.php'
file 'admin/functions/functions.interface.php'
file 'admin/functions/functions.load.php'
file 'admin/functions/functions.mediauploader.php'
file 'admin/functions/functions.options.php'
file 'admin/functions/functions.php'

file 'admin/layouts/default.css'
file 'admin/layouts/placebo.css'

file 'admin/index.php'
file 'admin/README.txt'

file 'images/bg/bg0.png'
file 'images/bg/bg1.png'
file 'images/bg/bg2.png'
file 'images/bg/bg3.png'
file 'images/bg/bg4.png'
file 'images/bg/bg5.png'
file 'images/bg/bg6.jpg'
file 'images/bg/bg7.jpg'
file 'images/bg/bg8.png'
file 'images/bg/bg9.png'
file 'images/bg/bg10.png'
file 'images/bg/bg11.png'

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
file 'options.php'
file 'page.php'
file 'readme.txt'
file 'search.php'
file 'searchform.php'
file 'sidebar.php'
file 'single.php'
file 'style.css'
file 'tag.php'

directory 'languages'

image 'search.png'

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
    This is a basic WordPress theme configured to use Sass
}

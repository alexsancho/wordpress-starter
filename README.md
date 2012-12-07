WordPress Starter
==================

This Compass extension provides support for creating WordPress Themes using Sass.

Installing
==========

    sudo gem install wordpress-starter-0.1.gem

To install a theme into your existing compass project, add the following to your compass configuration file:

    require 'wordpress-starter'

OR, just run this command:

    compass -r wordpress-starter -f wordpress -s compressed /path/to/installation

What this does is call `compass`, requires the wordpress-starter extension, uses the framework wordpress, sets the Sass output to be compressed and finally ends with you setting the theme name.

Note on Patches/Pull Requests
==============================

1. Fork it
2. Create your feature branch (`git checkout -b my-new-feature`)
3. Commit your changes (`git commit -am 'Add some feature'`)
4. Push to the branch (`git push origin my-new-feature`)
5. Create new Pull Request


Copyright
===========

Copyright (c) 2012 Alex Sancho. See LICENSE for details.

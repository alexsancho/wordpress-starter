# Replace extension with the name of your extension's .rb file
require './lib/wordpress-starter'

Gem::Specification.new do |s|
  s.version = WordpressStarter::VERSION
  s.date = WordpressStarter::DATE

  # Gem Details
  s.name = "wordpress-starter"
  s.description = %q{This Compass extension provides support for creating WordPress Themes using Sass.}
  s.summary = %q{This is extension provides a starting point to build WordPress themes.}
  s.authors = ["Alex Sancho"]
  s.email = ["alex@alexsancho.name"]
  s.homepage = "https://github.com/alexsancho/wordpress-starter"

  # Gem Files
  s.files = ["CHANGELOG.md"]
  s.files += ["LICENSE"]
  s.files += ["README.md"]
  s.files += Dir.glob("lib/**/*.*")
  s.files += Dir.glob("stylesheets/**/*.*")
  s.files += Dir.glob("templates/**/*.*")

  # Gem Bookkeeping
  s.has_rdoc = false
  s.required_rubygems_version = ">= 1.3.6"
  s.rubygems_version = %q{1.3.6}

  # Gems Dependencies
  s.add_dependency("sass",    [">=3.2.0"])
  s.add_dependency("compass", [">= 0.12.2"])
  s.add_dependency("susy",    ["~> 1.0.5"])
end

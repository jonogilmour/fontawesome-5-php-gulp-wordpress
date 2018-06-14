# FontAwesome5 in PHP

Implements a workflow for using native SVG elements in your PHP code using Gulp pre-compilation. Plus added Wordpress-specific functionality.

Written using ES5 syntax.

## Rationale

In the move from v4 to v5, FA went from using purely CSS and font file based icons to using dynamic SVG elements. This was a good move, but introduced a lot of friction in moving from v4 to v5.

Yes, it's possible to use the provided JS libraries to convert v4 `<i>` elements to the appropriate SVG, but that involves adding another JS library to your front-end.

As a Wordpress developer using Gulp on the server for compilation of JS and CSS assets, and given the icon libraries are provided in JavaScript by FontAwesome, I figured there had to be a better way to get FA icons in their native SVG format so they could be echoed directly into my templates, without having to do much work.

Whilst this system perhaps isn't the _most elegant_, it has worked well for my needs, and could work for you too.

## Installation

Just put the Gulp task in your Gulpfile (or run `npm i` to install Gulp using the given `package.json`), change a couple of values as needed, and you should be good to go.

## Functionality

The Gulp task takes icon classes provided by the `@fortawesome/fontawesome` family of packages (see dependencies below) and compiles each into its own named template file, in a directory you choose.

The files are intentionally given the same name as the icon class, to match FA's own documentation on each icon.

Also provided is a very simple WordPress action. Pass in the class of the icon, and the SVG markup will be echoed.

By providing a list of icons to the Gulp task, only the icons you need are compiled, instead of compiling the entire icon library. To add a new one, just add another icon to the array as needed.

## Dependencies

All are dev dependencies as we aren't using NodeJS in prod with PHP.

Obviously you'll need to be using **Gulp**, but the setup is very simple, and doesn't necessarily need to rely on PHP, this is just the integration I've used as PHP doesn't have a nice way of integrating with the FontAwesome libraries.

You'll also need to install the `@fortawesome/*` package(s) you want to use. [See the NodeJS tutorial here.](https://fontawesome.com/how-to-use/use-with-node-js "FA 5 Use with NodeJS")

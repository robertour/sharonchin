# Sharon Chin

Contributors:		robertour, kobenland
Tags:				white, light, two-columns, left-sidebar, right-sidebar, flexible-width, custom-header, custom-background, threaded-comments, translation-ready, microformats, custom-menu, post-formats, sticky-posts
Requires at least:	3.8.0
Tested up to:		4.0
Stable tag:			3.2
License:			GNU General Public License v3.0
License URI:		http://www.gnu.org/licenses/gpl-3.0.html


### Description

This theme combines [Twitter Bootstrap 2.3.2](http://getbootstrap.com/2.3.2/)
and [Masonry](http://masonry.desandro.com/) to create a lilypad effect to list
the Posts.

It is 100% responsive - no need for mobile version. 


### Credits

This theme was designed by the Malaysian artist 
[Sharon Chin](http://www.sharonchin.com), content strategized by [Maryann Tan] 
(https://twitter.com/sultan88) and coded by 
[Roberto Ulloa](http://robertour.com)


### License

Unless otherwise specified, all the theme files, scripts and images (including 
the screenshot) are licensed under 
[GNU General Public License Version 3](http://www.gnu.org/copyleft/gpl.html). 
The exceptions to this license are the bundled resources, which licenses are 
specified in the next section.


### Bundled Resources Licenses

* Bootstrap by Twitter are licensed under the GPL-compatible 
[Apache License 2](http://www.apache.org/licenses/LICENSE-2.0 Apache License v2.0)
* html5shiv is dual licensed under 
[MIT](http://opensource.org/licenses/mit-license.php) or 
[GPL Version 2](http://www.gnu.org/licenses/gpl-2.0.html)
* masonry is licensed under [MIT](http://desandro.mit-license.org/)
* less.js is licensed under 
[Apache License 2](http://www.apache.org/licenses/LICENSE-2.0 Apache License v2.0)
* Respond.js: Copyright 2011: Scott Jehl, scottjehl.com. is dual licensed under 
[MIT](http://opensource.org/licenses/mit-license.php) or 
[GPL Version 2](http://www.gnu.org/licenses/gpl-2.0.html)


### Translations 

Currently available in:
* English

Partial support to:
* Armenian
* Dutch
* English
* French
* German
* Hungarian
* Japanese
* Russian


## Installation

The installation process of the theme requiere two parts, (1) The installation of the theme itself, and (2) the installation of the external libraries (masonry, bootstrap, html5shiv, respond, less, imagesloaded)

A. Install the theme (alternatively, you can use the theme manager in the wordpress admin)
    A.1 Download Sharon Chin Theme.
    A.2 Unzip the folder into the `/wp-content/themes/` directory
    A.3 Activate the Theme through the 'Appearance' menu in WordPress

B. Add external sources. You have to download the external sources files (bootstrap.min.js, masonry.min.js, imagesloaded.min.js, respond.min.js, html5shiv.min.js, less.min.js), and paste them into `/wp-content/themes/sharonchin/js/external/`. Make sure that the names coincide with the previous list. Following are specific instructions of how to get the files. Let me know if any of the links is dead.
    B.1 Install Bootstrap v2.3.2
        (a) Go to http://getbootstrap.com/2.3.2/
        (b) Download Bootstrap and uncompress the file bootstrap.zip
        (c) Look for the file `bootstrap.min.js` in `bootstrap/js` and paste it into `/wp-content/themes/sharonchin/js/external/`
    B.2 Install Masonry
        (a) Go to http://masonry.desandro.com/
        (b) Download the file masonry.pkgd.min.js and paste it into `/wp-content/themes/sharonchin/js/external/`
    B.3 Install imagesloaded.js
        (a) Go to http://imagesloaded.desandro.com/
        (b) Download the file imagesloaded.pkgd.min.js and paste it into `/wp-content/themes/sharonchin/js/external/`
    B.4 Install respond.js
        (a) Download the file https://raw.githubusercontent.com/scottjehl/Respond/master/dest/respond.min.js, and paste it into `/wp-content/themes/sharonchin/js/external/`
        (b) If the previous direct link doesn't work, then look for the file inside `https://github.com/scottjehl/Respond/`,  and paste it into `/wp-content/themes/sharonchin/js/external/` 
    B.5 Install html5shiv
        (a) Go to http://code.google.com/p/html5shiv/
        (b) Download html5shiv and uncompress the file 
    B.6 Install Less (just if you want to recompile the css of the theme)
        (a) Go to http://lesscss.org/
        (b) Download Less.js 
        (c) Change the name (currently less-1.7.5.min.js) to less.min.js and paste it into `/wp-content/themes/sharonchin/js/external/` 



## Versioning

For transparency and insight into my release cycle, and for striving to maintain backward compatibility, Sharon Chin Theme - as all my WordPress APIs - will be maintained under the Semantic Versioning guidelines.

Releases will be numbered with the following format:

`<major>.<minor>.<patch>`

And constructed with the following guidelines:

* Breaking backward compatibility bumps the major (and resets the minor and patch)
* New additions without breaking backward compatibility bumps the minor (and resets the patch)
* Bug fixes and misc changes bumps the patch

For more information on SemVer, please visit (http://semver.org/).

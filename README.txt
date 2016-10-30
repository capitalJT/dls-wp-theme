# The DLS Theme is a customized version of the Genesis Sample Theme
Github project link: https://github.com/copyblogger/genesis-sample


## Installation Instructions

1. Upload the Genesis Sample theme folder via FTP to your wp-content/themes/ directory. (The Genesis parent theme needs to be in the wp-content/themes/ directory as well.)
2. Go to your WordPress dashboard and select Appearance.
3. Activate the Genesis Sample theme.
4. Inside your WordPress dashboard, go to Genesis > Theme Settings and configure them to your liking.


## Theme Support
Please visit http://jabaltorres.com for theme support.

## Local Dev Setup  
Node.js and Gulp.js are required for local development  
- Install Node.js globally [https://nodejs.org/en/](https://nodejs.org/en/)  
- Install Gulp.js globally [https://github.com/gulpjs/gulp/blob/master/docs/getting-started.md](https://github.com/gulpjs/gulp/blob/master/docs/getting-started.md)  

After cloning repo to the theme directory run `npm install` from the theme root directory  
**NOTE:** The theme must be named `genesis-sample` to properly function.  
The `package.json` file contains all of the dev dependencies for the build.  
The `gulpfile.js` file contains all of the available tasks.  

After gulp been installed run `gulp` from the command line and it will start watching for changed files and create a browser-sync server to auto-reload the files on upon editing and saving. After reviewing the [Gulp.js documentation](https://github.com/gulpjs/gulp/blob/master/docs/getting-started.md) the `gulpfile.js` file from this repo should be pretty intuitive.  

A new browser window will open pointing to `localhost:3000`. It's source is `http://localhost:8888/dls/`. This can be changed in line # 87 of `gulpfile.js`.

Have fun and happy coding!   
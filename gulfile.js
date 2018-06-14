// Load packages
var gulp = require('gulp'),
	  fs = require('fs');

// FREE fontawesome libraries.
var fa = require("@fortawesome/fontawesome");
var fab = require("@fortawesome/fontawesome-free-brands");

// FA PRO libraries, uncomment if you have these installed
// var far = require("@fortawesome/fontawesome-pro-regular");
// var fas = require("@fortawesome/fontawesome-pro-solid");
// var fal = require("@fortawesome/fontawesome-pro-light");

// Fontawesome templates gen
gulp.task('fontawesome-gen', function() {
	var dir = "./templates/fa"; // Change to match your desired directory
	if (!fs.existsSync(dir)){
    fs.mkdirSync(dir);
	}
	var icons = [
		fa.faTimesCircle // example
	];
	return new Promise(function(resolve, reject) {
		icons.map(function(icon) {
      // Will save icon markup to {dir}/{prefix}-{icon-name}.php
			var nm = dir+"/"+icon.prefix+"-"+icon.iconName+".php";
			fs.writeFileSync(nm, fa.icon(icon).html);
		});
		resolve();
	});
});

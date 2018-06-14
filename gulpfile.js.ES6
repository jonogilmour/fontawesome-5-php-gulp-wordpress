// Load packages
const gulp = require('gulp'),
	  	fs = require('fs');

// FREE fontawesome libraries.
const fa = require('@fortawesome/fontawesome'),
		 	far = require('@fortawesome/fontawesome-free-regular'),
		 	fas = require('@fortawesome/fontawesome-free-solid'),
		 	fab = require('@fortawesome/fontawesome-free-brands');

// FA PRO libraries, uncomment if you have these installed
// const farPro = require('@fortawesome/fontawesome-pro-regular'),
// 			fasPro = require('@fortawesome/fontawesome-pro-solid'),
// 			falPro = require('@fortawesome/fontawesome-pro-light');

// Fontawesome templates gen
gulp.task('fontawesome-gen', () => {
	const dir = './fa'; // Change to match your desired directory
	if (!fs.existsSync(dir)) {
    fs.mkdirSync(dir);
	}
	const icons = [
		far.faTimesCircle // example
	];
	return new Promise((resolve) => {
		icons.map((icon) => {
			const nm = `${dir}/${icon.prefix}-${icon.iconName}.php`;
			fs.writeFileSync(nm, fa.icon(icon).html);
		});
		resolve();
	});
});

// Default task
gulp.task('default', gulp.series('fontawesome-gen'));

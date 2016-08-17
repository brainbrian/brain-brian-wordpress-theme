module.exports = {
	options: {
		stripBanners: true,
		banner: '/*! <%= pkg.title %> - v<%= pkg.version %>\n' +
			' * <%= pkg.homepage %>\n' +
			' * Copyright (c) <%= grunt.template.today("yyyy") %>;' +
			' * Licensed GPL-2.0+' +
			' */\n'
	},
	main: {
		src: [
			'assets/js/vendor/modernizr-3.3.1-touch.js',
			'assets/js/src/brain-brian.js'
		],
		dest: 'assets/js/brain-brian.js'
	}
};

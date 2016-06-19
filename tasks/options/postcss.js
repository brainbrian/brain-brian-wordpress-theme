module.exports = {
	dist: {
		options: {
			processors: [
				require('autoprefixer')({browsers: 'last 2 versions'})
			]
		},
		files: { 
			'assets/css/brain-brian.css': [ 'assets/css/brain-brian.css' ]
		}
	}
};
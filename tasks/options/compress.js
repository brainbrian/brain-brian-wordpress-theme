module.exports = {
	main: {
		options: {
			mode: 'zip',
			archive: './release/bb.<%= pkg.version %>.zip'
		},
		expand: true,
		cwd: 'release/<%= pkg.version %>/',
		src: ['**/*'],
		dest: 'bb/'
	}
};
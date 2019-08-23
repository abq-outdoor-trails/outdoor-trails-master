const proxy = require('http-proxy-middleware');
module.exports = function(app) {
	app.use(proxy('/apis', {
		logLevel: 'debug',
		target: "https://bootcamp-coders.cnm.edu/~wharris21/outdoor-trails-master/php/public_html/",
		changeOrigin: true,
		secure: true, }));
};

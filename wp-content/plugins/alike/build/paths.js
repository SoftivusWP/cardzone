/* eslint-disable */
var path = require('path');
var fs = require('fs');

var appDirectory = fs.realpathSync(process.cwd());

function resolveApp(relativePath) {
  return path.resolve(appDirectory, relativePath);
}

module.exports = {
  appPackageJson: resolveApp('package.json'),
  appNodeModules: resolveApp('node_modules'),
  appSrc: resolveApp('assets/src/'),
  // appCss: resolveApp('assets/src/css/'),
  appDest: resolveApp('assets/dist/js/'),
  lessPath: resolveApp('assets/src/less/'),
  lessDest: resolveApp('assets/dist/css/'),
};

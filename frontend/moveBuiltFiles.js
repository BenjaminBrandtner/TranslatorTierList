function move (currentPath, destinationPath) {
  mv(currentPath, destinationPath, { mkdirp: true }, function (err) {
    if (err) {
      throw err
    } else {
      console.log('Successfully moved ' + currentPath + ' to ' + destinationPath)
    }
  })
}

function delet (path) {
  del.sync(path, { force: true })
}

const del = require('del')
const mv = require('mv')
const laravelPath = '../backend/'

const indexCurrentPath = 'dist/index.html'
const indexDestinationPath = laravelPath + 'resources/views/index.html'

const assetsCurrentPath = 'dist/_assets'
const assetsDestinationPath = laravelPath + 'public/_assets'

delet(indexDestinationPath)
delet(assetsDestinationPath)
move(indexCurrentPath, indexDestinationPath)
move(assetsCurrentPath, assetsDestinationPath)

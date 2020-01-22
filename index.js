require('date-utils')
// const bs     = require('browser-sync').create()
const gaze   = require('gaze')
const fs     = require('fs-extra')
const path   = require('path')
const glob   = require('glob')
const sass   = require('./lib/sass')
const config = require('./config/config')
const cmd    = process.argv[2]

let srcDir = 'resources'
let distDir = 'public'
let sassPtn = path.join(srcDir, '/style/**/!(_)*.sass')

/* ターミナルから受け取ったコマンドを実行 */
// ----------------

switch (cmd) {
  case 'sass':
    buildSass()
    break
  case 'server':
    startServer(config.server)
    break
}


/* ビルド関数 */
// ----------------

function buildSass () {
  fileList(sassPtn)
  .then(files => {
    Promise.all(files.map(file => {
      readFile(file)
      .then(sass.bind(null, config.sass))
      .then(data => {
        outputFile(distPath('css', file), data.css.toString())
        outputFile(distPath('css.map', file), data.map)
      })
      .catch(err => console.error(err))
    }))
  })
  .then(() => {
    let dt = new Date()
    console.log(dt.toFormat("YYYY/MM/DD HH24:MI:SS") + ' Sass build finished!')
  })
  .catch(err => console.error(err))
}

function startServer () {
  // bs.init({
  //   server: distDir,
  //   files: path.join(distDir, '/**/+(*.html|*.js|*.css|*.jpg|*.png|*.ico)')
  // })
  gaze(path.join(srcDir, '/**/*.sass'), (err, watcher) => {
    if (err) console.error(err)
    watcher.on('all', (ev, file) => {
      buildSass()
    })
  })
}

/* ユーティリティ */
// ----------------

function readFile (path) {
  return new Promise((resolve, reject) => {
    fs.readFile(path, (err, data) => {
      if (err) reject(err)
      else {
        resolve(data);
      }
    })
  })
}

function fileList (pattern, option = {}) {
  return new Promise((resolve, reject) => {
    glob(pattern, option, (err, files) => {
      if (err) reject(err)
      else resolve(files)
    })
  })
}

function outputFile (file, data) {
  return new Promise((resolve, reject) => {
    fs.outputFile(file, data, err => {
      if (err) reject(err)
      else resolve()
    })
  })
}

function distPath (ext, file) {
  let parse = path.parse(file)
  return path.join(parse.dir.replace(srcDir, distDir), `${parse.name}.${ext}`)
}

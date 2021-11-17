# wp-webpack-theme



1. [Introduction](#1-introduction)
2. [Installation](#2-installation)
3. [Configuration](#3-configuration)
4. [Run webpack](#4-run-webpack)
4. [Contributing](#5-contributing)
5. [Credits](#6-credits)

## 1. Introduction

This blank WordPress theme will allow you to install dependecies to your project. You will be able to write .scss and webpack will compile it into minified .css file.

The theme comes with [BrowserSync](https://github.com/BrowserSync/browser-sync) to reload automatically your web server when a change is detected in your project files.

To use this theme you will need :

- node.js
- npm
- local web server
- wordpress installed

## 2. Installation

### Download

- Download the [ZIP folder of the project](https://github.com/louislspn/wp-webpack-theme/archive/refs/heads/main.zip).
- Unzip it
- Rename it "wp-webpack-theme"
- Move it to your WordPress themes folder

```
[wp-folder-name]/wp-content/themes/wp-webpack-theme
```

### Clone

If you prefere to clone the Github repository, go head and do so
```
cd [path/to/your/wp-folder]/wp-content/themes
```
```
git clone https://github.com/louislspn/wp-webpack-theme.git
```

### Install dependencies

In the freshly installed theme folder run the command below
```
npm install
```



## 3. Configuration

To make the webpack configuration works with your environment you will have to tell your WordPress theme the path of your local web server. So first of all, **launch your usual web local server on your computer** such as WAMP or MAMP.

Create the configuration file here ```bundler/config.js```, write the code below with the path you usually access to your WordPress website with your local server. For example :

```js
exports.datas = {
  'localPath': 'localhost:8888/my-wp-project'
}
```

SASS will be writen in the ```assets/src/sass/app.scss``` file.

JS will be writen in the ```assets/src/js/app.js``` file.

## 4. Run webpack

Once you have installed and configured the ```wp-webpack-theme```, you should be able to run webpack to start coding your project. You have 2 diffrent configurations for both development and production purpose.

|        environment         |   configuration    | command |
| :-----------------: | :---------: | :----------: |
|  development  | ```bundler/webpack.common.js```  | ```npm run watch```  |
|  production | ```bundler/webpack.prod.js``` | ```npm run build```|

### Development

```npm run watch```

This command will start your BrowserSync server, watch for changes in your file and compile your assets without sourcemaps for perfomances purpose.

|        options         |       |
| :-----------------: | :---------: |
|  ```--sourcemaps```  | generates sourcemaps with your compiled files, involves slower build times and reloads  |


## Production

```npm run build```

This command will build once minified CSS and JS files with sourcemaps to upload your website in production.

## 5. Contributing

This WordPress theme is open source, feel free to pull request any modification or improvement. You can change the webpack configuration to match your need as the current configuration is a basic one.

## 6. Credits

2021 © [LSPN.FR](https://lspn.fr)


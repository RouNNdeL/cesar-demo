[![Build Status](https://travis-ci.org/RouNNdeL/cesar-demo.svg?branch=master)](https://travis-ci.org/RouNNdeL/cesar-demo) [![Known Vulnerabilities](https://snyk.io/test/github/RouNNdeL/cesar-demo/badge.svg)](https://snyk.io/test/github/RouNNdeL/cesar-demo) [![dependencies Status](https://david-dm.org/RouNNdeL/cesar-demo/status.svg)](https://david-dm.org/RouNNdeL/cesar-demo) [![devDependencies Status](https://david-dm.org/RouNNdeL/cesar-demo/dev-status.svg)](https://david-dm.org/RouNNdeL/cesar-demo?type=dev)
# Introduction 
This is a demo for my IT class talk regarding the Cesar's Cipher. It can be previewed [here](https://demo.zdul.xyz/).

# Code samples
The project contains examples of implementing the algorithm in different programming or scripting languages (Batch, Bash, C, Java, Kotlin, PHP, Python and Javascript). The files are located in the `examples` directory except Javascript, since it is used by the site itself and is thus located in `src/js`.

# Clone and build
To mess with the page on your own you need [Node.js](https://nodejs.org/) installed. Clone the repo by running `git clone https://github.com/RouNNdeL/cesar-demo/` and then run `npm i` to install all the dependencies. Since the repo only contains source files, which are not enough to run the webpage you need to build it. Run `npm run build` in the project's root directory to build the vendor files and sources. All build files are put in to the `dist` directory.

# Test
The project includes tests for the cipher function. You can run them with `npm test`

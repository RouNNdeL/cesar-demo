# Introduction 
This is a demo for my IT class talk regarding the Cesar's Cipher. It can be previewed [here](https://demo.zdul.xyz/).

# Code samples
The project contains examples of implementing the alghoritm in diffrent programming or scripting languages (Batch, Bash, C, Java, Kotlin, PHP, Python and Javascript). The files are located in the `examples` directory except Javascript, since it is used by the site itself and is thus located in `src/js`.

# Clone and build
To mess with the page on your own you need to clone it by running `git clone https://github.com/RouNNdeL/cesar-demo/` and then run `npm i` to install all the dependencies. Since the repo only contains source files, which are not enough to run the webpage you need to build it. Run `grunt vendor` in the project's root directory to build the vendor bundles and then `grunt` to build the actual sources. All build files are put in to the `dist` directory.

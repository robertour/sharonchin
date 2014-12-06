If you want to modify the sources of the less code, 

(1) Download the Boostrap Less source files from http://getbootstrap.com/2.3.2/.
(2) Create a folder called bootstrap/, and add all the the less source files into this folder.
(3) Install less and yui-compressor sudo apt-get install node-less yui-compressor
(4) Run the following command in a terminal located in the current folder:
     lessc bootstrap.less --yui-compress > ../css/bootstrap.min.css 

Please be aware that this requires is Bootstrap v2 and not v3
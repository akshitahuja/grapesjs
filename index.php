<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <title>GrapesJS</title>
    <link rel="stylesheet" href="dist/css/grapes.min.css">
    <script src="dist/grapes.min.js"></script>
    <script
  src="https://code.jquery.com/jquery-3.4.1.js"
  integrity="sha256-WpOohJOqMqqyKL9FccASB9O0KwACQJpFTUBLTYOVvVU="
  crossorigin="anonymous"></script>
    <style>
      body,
      html {
        height: 100%;
        margin: 0;
      }
      .collapse-button, .expand-button {
        position: absolute;
        bottom: 15%;
        right: 15%;
        color: black;
        z-index: 999;
        background-image: url(http://www.helpdocsonline.com/resources/app/images/arrow-sprite.png?v=1449064983)!important;
        background-repeat: no-repeat;
        background-position: 0px -105px;
        width: 25px;
        height: 25px;
        cursor: pointer;
      }
      .expand-button {
        background-position: 0px -70px;
        right: 0%;
      }
    </style>
  </head>

  <body>
      <div class="collapse-button">&nbsp;</div>
      <div class="expand-button" style="display: none;">&nbsp;</div>
    <div id="gjs" style="height:0px; overflow:hidden;"></div>

    <script type="text/javascript">
      const htmlContent = `<div class="panel"><h1 class="welcome">Welcome to</h1><div class="big-title"><svg viewBox="0 0 100 100" class="logo"><path d="M40 5l-12.9 7.4 -12.9 7.4c-1.4 0.8-2.7 2.3-3.7 3.9 -0.9 1.6-1.5 3.5-1.5 5.1v14.9 14.9c0 1.7 0.6 3.5 1.5 5.1 0.9 1.6 2.2 3.1 3.7 3.9l12.9 7.4 12.9 7.4c1.4 0.8 3.3 1.2 5.2 1.2 1.9 0 3.8-0.4 5.2-1.2l12.9-7.4 12.9-7.4c1.4-0.8 2.7-2.2 3.7-3.9 0.9-1.6 1.5-3.5 1.5-5.1v-14.9 -12.7c0-4.6-3.8-6-6.8-4.2l-28 16.2"></path></svg><span>GrapesJS</span></div><div class="description">This is a demo content from index.html. For the development, you shouldn't edit this file, instead you can copy and rename it to _index.html, on next server start the new file will be served, and it will be ignored by git.</div></div>`;
      const cssContent = `* {
  box-sizing: border-box;
}
body {
  margin: 0;
}
.panel{
  width:90%;
  max-width:700px;
  border-top-left-radius:3px;
  border-top-right-radius:3px;
  border-bottom-right-radius:3px;
  border-bottom-left-radius:3px;
  padding-top:30px;
  padding-right:20px;
  padding-bottom:30px;
  padding-left:20px;
  margin-top:150px;
  margin-right:auto;
  margin-bottom:0px;
  margin-left:auto;
  background-color:rgb(217, 131, 166);
  box-shadow:rgba(0, 0, 0, 0.25) 0px 3px 10px 0px;
  color:rgba(255, 255, 255, 0.75);
  font-style:normal;
  font-size:16px;
  font-family:Arial;
  font-stretch:normal;
  font-variant-caps:normal;
  font-variant-ligatures:normal;
  font-variant-numeric:normal;
  font-variant-east-asian:normal;
  line-height:normal;
  font-weight:100;
}
.welcome{
  text-align:center;
  font-weight:100;
  margin-top:0px;
  margin-right:0px;
  margin-bottom:0px;
  margin-left:0px;
}
.logo{
  width:70px;
  height:70px;
  vertical-align:middle;
}
.logo path{
  pointer-events:none;
  fill:none;
  stroke-linecap:round;
  stroke-width:7;
  stroke:rgb(255, 255, 255);
}
.big-title{
  text-align:center;
  font-size:3.5rem;
  margin-top:15px;
  margin-right:0px;
  margin-bottom:15px;
  margin-left:0px;
}
.description{
  text-align:justify;
  font-size:1rem;
  line-height:1.5rem;
}`;
      const LandingPage = {
        html: htmlContent,
        css: cssContent,
        components: null,
        style: null,
      };
      var editor = grapesjs.init({
        showOffsets: 1,
        noticeOnUnload: 0,
        container: '#gjs',
        height: '100%',
        components: LandingPage.components || LandingPage.html,
        style: LandingPage.style || LandingPage.css,
        fromElement: false,
        commands: {
    defaults: [
      {
        // id and run are mandatory in this case
        id: 'alert-now',
        run() {
          alert('This is my command');
        },
      }
    ],
  },
        /* Local Storage */
        storageManager: {
          id: 'gjs-',             // Prefix identifier that will be used inside storing and loading
          type: 'local',          // Type of the storage
          autosave: false,         // Store data automatically
          autoload: true,         // Autoload stored data on init
          stepsBeforeSave: 1,     // If autosave enabled, indicates how many changes are necessary before store method is triggered
          storeComponents: true,  // Enable/Disable storing of components in JSON format
          storeStyles: true,      // Enable/Disable storing of rules in JSON format
          storeHtml: true,        // Enable/Disable storing of components as HTML string
          storeCss: true,         // Enable/Disable storing of rules as CSS string
        },

        /* Remote Storage */
        // storageManager: {
        //   id: 'gjs-',
        //   type: 'remote',
        //   autosave: false,
        //   autoload: false, 
        //   stepsBeforeSave: 3,
        //   urlStore: '/grapesjs/dbOperations.php/?fn=store',
        //   urlLoad: '/grapesjs/dbOperations.php/?fn=load',
        //   // For custom parameters/headers on requests
        //   params: {},
        //   headers: {},      // Enable/Disable storing of rules as CSS string
        // },
        styleManager : {
          sectors: [{
              name: 'General',
              open: false,
              buildProps: ['float', 'display', 'position', 'top', 'right', 'left', 'bottom']
            },{
              name: 'Flex',
              open: false,
              buildProps: ['flex-direction', 'flex-wrap', 'justify-content', 'align-items', 'align-content', 'order', 'flex-basis', 'flex-grow', 'flex-shrink', 'align-self']
            },{
              name: 'Dimension',
              open: false,
              buildProps: ['width', 'height', 'max-width', 'min-height', 'margin', 'padding'],
            },{
              name: 'Typography',
              open: false,
              buildProps: ['font-family', 'font-size', 'font-weight', 'letter-spacing', 'color', 'line-height', 'text-shadow'],
            },{
              name: 'Decorations',
              open: false,
              buildProps: ['border-radius-c', 'background-color', 'border-radius', 'border', 'box-shadow', 'background'],
            },{
              name: 'Extra',
              open: false,
              buildProps: ['transition', 'perspective', 'transform'],
            }
          ],
        },
      });

      function clearCanvas() {
        editor.DomComponents.clear();
            editor.CssComposer.clear();
            editor.getComponents().add('<link rel="stylesheet" type="text/css" href="./template-style.css" />');
            editor.getComponents().add('<link href="https://fonts.googleapis.com/css?family=Roboto&display=swap" rel="stylesheet">');
      }
      
      editor.Panels.addButton('options', 
        [{
          id: 'save', 
          className: 'fa fa-floppy-o icon-blank', 
          label: '&nbsp; Save', 
          command: function(editor1, sender) { 
            editor1.store();
          }, 
          attributes: { title: 'Save Template' } 
        }]);

      editor.Panels.addButton('options', 
        [{
          id: 'clear', 
          className: 'fa fa-floppy-o icon-blank', 
          label: '&nbsp; Clear', 
          command: function(editor1, sender) { 
            // editor1.setComponents('');
            // editor1.setStyle('');
            editor1.DomComponents.clear();
            editor1.CssComposer.clear();
            editor.getComponents().add('<link rel="stylesheet" type="text/css" href="./template-style.css" />');
            editor.getComponents().add('<link href="https://fonts.googleapis.com/css?family=Roboto&display=swap" rel="stylesheet">');
          }, 
          attributes: { title: 'Clear Canvas' } 
        }]);

      editor.Panels.addPanel({ id: "devices-c" }).get("buttons").add([
    { id: "set-device-desktop", command: function(e) { return e.setDevice("Desktop") }, className: "fa fa-desktop", active: 1 },
    { id: "set-device-tablet", command: function(e) { return e.setDevice("Tablet") }, className: "fa fa-tablet" },
    { id: "set-device-mobile", command: function(e) { return e.setDevice("Mobile portrait") }, className: "fa fa-mobile" },
    { id: "block-editor", command: function(e) { alert("hello world ") }, className: "fa fa-book" }
]);

      editor.BlockManager.add('kbsearch', {
        label: 'KB Search',
        attributes: { class:'gjs-fonts gjs-f-b1' },
        content: `<div class="search-kb">
          <div class="input-field">
            <input type="search" id="search-header" class="search-field searchbox" placeholder="Search for a query" />
            <span class="search-icon">&nbsp;</span>
          </div>
        </div>`,
        category: 'Knowledge Base Elements'
      });

      editor.BlockManager.add('categories', {
        label: 'Categories',
        attributes: { class:'gjs-fonts gjs-f-b1' },
        content: `<div class="categories">
      <div class="category-inner">
        <a href=""><img src="https://dzf8vqv24eqhg.cloudfront.net/userfiles/14125/18876/ckfinder/images/10372652090.png" class="category-icon" /></a>
        <h1><a href="" class="category-heading">Getting Started</a></h1>
        <p class="category-text">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Suspendisse consequat auctor maximus.</p>
      </div>
      <div class="category-inner">
        <a href=""><img src="https://dzf8vqv24eqhg.cloudfront.net/userfiles/14125/18876/ckfinder/images/2459782203.png" class="category-icon" /></a>
        <h1><a href="" class="category-heading">Key Concepts</a></h1>
        <p class="category-text">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Suspendisse consequat auctor maximus.</p>
      </div>
      <div class="category-inner">
        <a href=""><img src="https://dzf8vqv24eqhg.cloudfront.net/userfiles/14125/18876/ckfinder/images/10888184630.png" class="category-icon" /></a>
        <h1><a href="" class="category-heading">Release Notes</a></h1>
        <p class="category-text">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Suspendisse consequat auctor maximus.</p>
      </div>
      <div class="category-inner">
        <a href=""><img src="https://dzf8vqv24eqhg.cloudfront.net/userfiles/14125/18876/ckfinder/images/8725058726.png" class="category-icon" /></a>
        <h1><a href="" class="category-heading">Resources</a></h1>
        <p class="category-text">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Suspendisse consequat auctor maximus.</p>
      </div>
    </div>`,
        category: 'Knowledge Base Elements'
      });

      editor.BlockManager.add('single-category-box', {
        label: 'Category Box (Single)',
        attributes: { class:'gjs-fonts gjs-f-b1' },
        content: `<div class="category-inner">
        <a href=""><img src="https://dzf8vqv24eqhg.cloudfront.net/userfiles/14125/18876/ckfinder/images/10372652090.png" class="category-icon" /></a>
        <h1><a href="" class="category-heading">Getting Started</a></h1>
        <p class="category-text">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Suspendisse consequat auctor maximus.</p>
      </div>`,
        category: 'Knowledge Base Elements'
      });

      editor.BlockManager.add('popular-articles', {
        label: 'Popular Articles',
        attributes: { class:'gjs-fonts gjs-f-b1' },
        content: `<div class="popular">
      <div class="popular-heading-container">
        <h1 class="popular-heading">Popular Articles</h1>
      </div>  
      <div class="popular-articles">  
        <ul>
          <li class="popular-article-item"><a href="">Lorem Ipsum is simply dummy text</a></li>
          <li class="popular-article-item"><a href="">Lorem Ipsum has been the industry's standard dummy text</a></li>
          <li class="popular-article-item"><a href="">Lorem Ipsum is not simply random text</a></li>
        </ul>
      </div>
    </div>`,
        category: 'Knowledge Base Elements'
      });


const domComponents = editor.DomComponents;
var contentIsThis = `<div class="container">
    <div class="banner">
      <div class="banner-inner">
        <h1 class="heading1">Business Documentation</h1>
        <h3 class="heading2">Here is the Business Documentation Template</h3>
        <div class="search-kb">
          <div class="input-field">
            <input type="search" id="search-header" class="search-field searchbox" placeholder="Search for a query" />
            <span class="search-icon">&nbsp;</span>
          </div>
        </div>
      </div>
    </div>
    <div class="categories">
      <div class="category-inner">
        <a href=""><img src="https://dzf8vqv24eqhg.cloudfront.net/userfiles/14125/18876/ckfinder/images/10372652090.png" class="category-icon" /></a>
        <h1><a href="" class="category-heading">Getting Started</a></h1>
        <p class="category-text">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Suspendisse consequat auctor maximus.</p>
      </div>
      <div class="category-inner">
        <a href=""><img src="https://dzf8vqv24eqhg.cloudfront.net/userfiles/14125/18876/ckfinder/images/2459782203.png" class="category-icon" /></a>
        <h1><a href="" class="category-heading">Key Concepts</a></h1>
        <p class="category-text">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Suspendisse consequat auctor maximus.</p>
      </div>
      <div class="category-inner">
        <a href=""><img src="https://dzf8vqv24eqhg.cloudfront.net/userfiles/14125/18876/ckfinder/images/10888184630.png" class="category-icon" /></a>
        <h1><a href="" class="category-heading">Release Notes</a></h1>
        <p class="category-text">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Suspendisse consequat auctor maximus.</p>
      </div>
      <div class="category-inner">
        <a href=""><img src="https://dzf8vqv24eqhg.cloudfront.net/userfiles/14125/18876/ckfinder/images/8725058726.png" class="category-icon" /></a>
        <h1><a href="" class="category-heading">Resources</a></h1>
        <p class="category-text">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Suspendisse consequat auctor maximus.</p>
      </div>
    </div>
    <div class="popular">
      <div class="popular-heading-container">
        <h1 class="popular-heading">Popular Articles</h1>
      </div>  
      <div class="popular-articles">  
        <ul>
          <li class="popular-article-item"><a href="">Lorem Ipsum is simply dummy text</a></li>
          <li class="popular-article-item"><a href="">Lorem Ipsum has been the industry's standard dummy text</a></li>
          <li class="popular-article-item"><a href="">Lorem Ipsum is not simply random text</a></li>
        </ul>
      </div>
    </div>
  </div>`;

editor.on('block:drag:start', function(model) {
  //clearCanvas();
});



      editor.BlockManager.add('business-documentation', {
        label: 'Business Documentation',
        attributes: { class:'gjs-fonts gjs-f-b1' },
        content: contentIsThis,
        category: 'Ready to use Templates',
      });


// editor.on('run:addComponent:before', opts => {
//   console.log(opts);
// });

//const domComponents = editor.DomComponents;
//       var comp1 = domComponents.addComponent({
//   tagName: 'div',
//   removable: true, // Can't remove it
//   draggable: true, // Can't move it
//   copyable: true, // Disable copy/past
//   content: 'Content text', // Text inside component
//   style: { color: 'red'},
//   attributes: { title: 'here' }
// });

//       editor.on('sorter:drag:start', (targetCollection, modelToDrop, errors) => {
//   // if (component.is('my-cmp')) {
//   //   editor.BlockManager.get('my-cmp-block') // eg. hide the block
//   //   // ...
//   // }
//   console.log(targetCollection);
//   console.log(modelToDrop);
//   console.log(errors);
//   console.log(editor);
//   editor.setComponents('');
// });

editor.getComponents().add('<link rel="stylesheet" type="text/css" href="./template-style.css" />');
editor.getComponents().add('<link href="https://fonts.googleapis.com/css?family=Roboto&display=swap" rel="stylesheet">');
editor.on('component:selected', () => {
  openStyleManager();
  expandSidebar();
});
removeLayersManager();
function removeLayersManager() {
  const openLmBtn = editor.Panels.getButton('views', 'open-layers');
  openLmBtn.collection.remove(openLmBtn);
}
var openSmBtn = editor.Panels.getButton('views', 'open-sm');
openSmBtn.set('label', ' Properties');

var openSmBtn = editor.Panels.getButton('views', 'open-sm');
openSmBtn.set('label', ' Properties');
openSmBtn.set('className', '');

var openBlBtn = editor.Panels.getButton('views', 'open-blocks');
openBlBtn.set('label', ' Content');
openBlBtn.set('className', '');

function openStyleManager() {
  const openSmBtn = editor.Panels.getButton('views', 'open-sm');
  openSmBtn.set('active', 1);
}
        $('.collapse-button').on('click', function() {
          collapseSidebar();
        });
        $('.expand-button').on('click', function() {
          expandSidebar();
        });
        $('body').on('click', 'span[title="Preview"]', function() {
          collapseSidebar();
          $('.expand-button').hide();
        });
        $('body').on('click', '.gjs-off-prv', function() {
          expandSidebar();
        });
        function collapseSidebar() {
          $('.gjs-pn-views-container').css('display', 'none');
          $('.gjs-pn-views').css('display', 'none');
          $('.gjs-cv-canvas').css('width', '100%');
          $('.gjs-pn-commands').css('width', '100%');
          $('.gjs-pn-options').css('right', '0');
          $('.collapse-button').hide();
          $('.expand-button').show();
        }
        function expandSidebar() {
          $('.gjs-pn-views-container').css('display', 'inline-block');
          $('.gjs-pn-views').css('display', 'inline-block');
          $('.gjs-cv-canvas').css('width', '85%');
          $('.gjs-pn-commands').css('width', '85%');
          $('.gjs-pn-options').css('right', '15%');
          $('.expand-button').hide();
          $('.collapse-button').show();
        }
    </script>
  </body>
</html>

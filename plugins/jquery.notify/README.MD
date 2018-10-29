Fork me on GitHub
Notify.js
 
Summary
Notify.js is a jQuery plugin to provide simple yet fully customisable notifications. The javascript code snippets in this documentation with the green edge are runnable by clicking them.

$.notify("Hello World");

Download
Download Notify.js including the pre-made bootstrap notification style:
 Download notify.js  Download notify.min.js

Basic Usage
Element Notifications
You can place notifications on any element:

$(".elem-demo").notify("Hello Box");
Like this box

Global Notifications
If you don't specify an element, notification will appear in the top left (unless you specify a different position - See Positioning)

$.notify("I'm over here !");
Notification Styles
Each style may define a set of classes to use to substyle the notification. The pre-packaged version includes a bootstrap notification style (see more below in Styling). These classes include:

Success
$.notify("Access granted", "success");Info
$.notify("Do not press this button", "info");Warning
$.notify("Warning: Self-destruct in 3.. 2..", "warn");Error
$.notify("BOOM!", "error");
Note: This page has set the default class to"success" with$.notify.defaults({ className: "success" });.

Positioning
The position string option is used to describe both vertical and horizontal alignment. Element notifications and Global notifications can be vertically repositioned to: "top", "middle" or "bottom" and horozontally repositioned to: "left", "center" or "right". If we don't provide a position option the default alignments are defined in the default settings: globalPosition and elementPosition. When only one alignment is provided, the vertical alignment is middle and horizontal alignment is centre.

$(".pos-demo").notify(
  "I'm to the right of this box", 
  { position:"right" }
);
We can position the notification around this box

Use this positioning tool to see all possible position combinations.

Element   Global  
An awesome cool larrrggggeeee box

API
$.notify( string|object, [ options ])
string|object - global notification data
options - an options object or class name string

$.notify( element, string|object, [ options ])
element - a jquery element
string|object - element notification data
options - an options object or class name string

$( selector ).notify( string|object, [ options ])
selector - jquery selector
string|object - element notification data
options - an options object or class name string

$.notify.addStyle( styleName, styleDefinition )
styleName - string (the style option references this name)
styleDefinition - style definition object (see Styling below)

$.notify.defaults( options )
options - an options object (updates the defaults listed below)

Options
The options object listed above are in the form below. This object below is the actual used to check option validity and set defaults.

{
  // whether to hide the notification on click
  clickToHide: true,
  // whether to auto-hide the notification
  autoHide: true,
  // if autoHide, hide after milliseconds
  autoHideDelay: 5000,
  // show the arrow pointing at the element
  arrowShow: true,
  // arrow size in pixels
  arrowSize: 5,
  // position defines the notification position though uses the defaults below
  position: '...',
  // default positions
  elementPosition: 'bottom left',
  globalPosition: 'top right',
  // default style
  style: 'bootstrap',
  // default class (string or [string])
  className: 'error',
  // show animation
  showAnimation: 'slideDown',
  // show animation duration
  showDuration: 400,
  // hide animation
  hideAnimation: 'slideUp',
  // hide animation duration
  hideDuration: 200,
  // padding between element and notification
  gap: 2
}
Custom Styling Guide
You can add your own styles to Notify.js with the$.notify.addStyle method. See API.

Style definition objects are in the form:

{
  //required html representing each notification 
  html: "",
  //optional object to be converted to css
  classes: {
    <className>: {
      <propertyName>: <value> 
    },
    <className>: {
      ...
    },
    ...
  },
  //optional css to be inserted onto the page
  css: ""
}
html - If you only have HTML element that you need to modify per notification then you should give this element an attribute of data-notify-text or data-notify-html. Use data-notify-html if you wish to display arbitrary HTML inside the notification, otherwise, use data-notify-text as it is more secure.
Otherwise, if you wish to modify multiple HTML elements per notification then you'll need to give each element one of the two attributes above as well as a value. For an example of this see the Advanced Example below.
classes - This object will be used to construct css. It must be in the form described above and there is an example below.
css - This string is simply raw css. Use this property if you want to keep your style definition inside your js files.
Class naming convention
When each notification is constructed, it's container (outer most element defined in your style html) will automatically apply the class:

notifyjs-<style name>-base

When you use the class name option (className) the class:

notifyjs-<style name>-<class name>

will be applied. So if you define your styles in an external CSS file or in the style's css property, you must define your CSS rules using this naming convention.

Simple Example
If you were to define the style:

$.notify.addStyle('happyblue', {
  html: "<div>☺<span data-notify-text/>☺</div>",
  classes: {
    base: {
      "white-space": "nowrap",
      "background-color": "lightblue",
      "padding": "5px"
    },
    superblue: {
      "color": "white",
      "background-color": "blue"
    }
  }
});
Upon running this code, the classes object in this example will be converted the following css:

.notifyjs-happyblue-base {
  white-space: nowrap;
  background-color: lightblue;
  padding: 5px;
}
.notifyjs-happyblue-superblue {
  color: white;
  background-color: blue;
}You can confirm this now by inspecting the DOM (look for the tagged style element in the head)
You can now use your new style with:

$.notify('hello !!', {
  style: 'happyblue'
});
and you can use the superblue class with:

$.notify('HELLO !!!!', {
  style: 'happyblue',
  className: 'superblue'
});
Advanced Example
Say you wanted to use buttons in your notifications then you could do something like:

//add a new style 'foo'
$.notify.addStyle('foo', {
  html: 
    "<div>" +
      "<div class='clearfix'>" +
        "<div class='title' data-notify-html='title'/>" +
        "<div class='buttons'>" +
          "<button class='no'>Cancel</button>" +
          "<button class='yes' data-notify-text='button'></button>" +
        "</div>" +
      "</div>" +
    "</div>"
});

//listen for click events from this style
$(document).on('click', '.notifyjs-foo-base .no', function() {
  //programmatically trigger propogating hide event
  $(this).trigger('notify-hide');
});
$(document).on('click', '.notifyjs-foo-base .yes', function() {
  //show button text
  alert($(this).text() + " clicked!");
  //hide notification
  $(this).trigger('notify-hide');
});
Notice there is no classes property defined above. Since the CSS in this example is non-trivial, we'll use an exteral CSS file instead:

Note: you could also convert this CSS code to a JavaScript string and use it with the css property. It's not very readable though it's better for distribution.

.notifyjs-foo-base {
  opacity: 0.85;
  width: 200px;
  background: #F5F5F5;
  padding: 5px;
  border-radius: 10px;
}

.notifyjs-foo-base .title {
  width: 100px;
  float: left;
  margin: 10px 0 0 10px;
  text-align: right;
}

.notifyjs-foo-base .buttons {
  width: 70px;
  float: right;
  font-size: 9px;
  padding: 5px;
  margin: 2px;
}

.notifyjs-foo-base button {
  font-size: 9px;
  padding: 5px;
  margin: 2px;
  width: 60px;
}
You can now use this style with:

$.notify({
  title: 'Would you like some Foo ?',
  button: 'Confirm'
}, { 
  style: 'foo',
  autoHide: false,
  clickToHide: false
});
Extra Example
If using the above methods still don't provide you with what you need then you can, pass jQuery objects straight into the notification (provided that the element has the data-notify-html attribute):

var h5 = $("<h5/>").append("You MUST have some Foo !")

$.notify({
  title: h5,
  button: 'YES !'
}, { 
  style: 'foo',
  autoHide: false,
  clickToHide: false
});
Style List
bootstrap
metro
Contributing More Styles
Contributing more styles is easy!

Click this link
Sign into GitHub (if you're not already)
Click 'Fork'
Enter your new style
Click 'Commit New File'
Click 'Send Pull Request'!
To get people started with some styles ideas, checkout this post on various Growl styles.

Note: If you wish to contribute to the library by fixing bugs or adding features, see the src folder. Also, the source is in CoffeeScript, however, new styles can be either JavaScript or CoffeeScript. I'm using Grunt to compile, minify and concat the builds, you can do so with:

Fork https://github.com/notifyjs/notifyjs
cd notifyjs
npm install -g grunt-cli
npm install
grunt
Pull-request !
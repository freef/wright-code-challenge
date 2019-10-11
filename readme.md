# Matt Freeland Code Challenge for Wright
## Scenario
  On our website, we have a "Back to Top" button that appears in the lower right hand corner of most pages (with some exceptions, e.g. homepage) Implement this component as a vue component from scratch.

## Requirements

- [x] Setup a fresh Laravel 5.5 project for this task using composer (https://laravel.com/docs/5.5/ - note that you will need to do this via the composer create-project method as we are on the previous LTS version)
- [x] Make sure you're using laravel-mix for compiling the JS assets (this is included by default in the laravel install process). See https://laravel.com/docs/5.5/mix on general setup and usage for mix. Note that Vue is already included in the default package.json file.
- [x] The button should be implemented as a Single-File-Vue-Component, which can be referenced in the blade template as <to-top :props></to-top> (component name for example). Reference resources/assets/js/app.js on how to bootstrap the Vue components
- [x] Implement a test page with block sections and lorem ipsum text, large enough to warrant a scroll to top button. Don’t need to worry about the page styling or structure, just enough content so that the page is tall enough.
- [x] Clicking the fixed-position/floating button should smoothly animate to the top of the page (default easing, configurable duration, ~800ms default)
- [x] The button should automatically hide by default, and show once the user is scrolled 500px down the page (hiding again if user scrolls back above the threshold)
- [x] Should be a configuration-based threshold on when it shows (default otherwise)
- [x] Bonus points for being able to set a px value OR an element selector
- [x] On our modular content pages, the button also switches color dynamically between a light and dark version, depending on the content block underneath it
- [x] Default to .dark, switch to .light when button intersects with an element with .dark class or an element with a .global-footer class


## Usage
The TopButton.vue component is a single file component. It does not require any props or any other components to function. The component renders a button that will return the user to the top of the page. If the fixed position button is above an elmenent with the class .dark or .global-footer it will reverse its colors.

### Props
- **px**: this prop takes a number. It defines how many pixels a user must scroll before the button becomes visible. The default is 500
- **elselect**: this props takes an element ID. When the button reaches the same height as the specified element it will become visible. Default is false.
- **scrolltime**: this prop takes a number. It defines the duration of the scroll to top animation in miliseconds. Default value is -1, which uses the default smooth scrolling attribute.

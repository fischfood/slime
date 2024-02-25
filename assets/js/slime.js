import jQuery from 'jquery';
import site from './site'
import header from './header'
// If you want to pick and choose which modules to include, comment out the above and uncomment
// the line below
//import './lib/foundation-explicit-pieces';

jQuery( function() {
    site();
    header();
});

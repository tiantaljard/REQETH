// Code below adapted from online course:
// site:            https://www.udemy.com
// Course title:    PHP: Complete Login and Registration System with PHP & MYSQL
// Instructor:      Osayawe Terry Ogbemudia
var url = window.location;
$('ul.nav a').filter(function(){
    return this.href == url;
}).parent().addClass('active').parent().parent().addClass('active');

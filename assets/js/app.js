import $ from 'jquery';
import bootstrap from 'bootstrap';
import select2 from 'select2/dist/js/select2.min';
import '../css/app.scss';

/*
 * Welcome to your app's main JavaScript file!
 *
 * We recommend including the built version of this JavaScript file
 * (and its CSS file) in your base layout (base.html.twig).
 */

// any CSS you require will output into a single css file (app.scss in this case)

// Need jQuery? Install it with "yarn add jquery", then uncomment to require it.
// const $ = require('jquery');

console.log('Hello Webpack Encore! Edit me in assets/js/app.js');


require('bootstrap');
$(document).ready(function() {
    $('[data-toggle="popover"]').popover();
});

//=============================================Ajout d'images===========================================//

//Ajout d'input pour les images
var $collectionHolder;
//setup an "add a picture" link
var $addPictureButton = $('<button type="button" class="add_picture_link btn btn-success">Ajouter une photo</button>');
var $newLinkLi = $('<li></li>').append($addPictureButton);

$(document).ready(function () {
    //Get the ul that holds the collection of tags
    $collectionHolder = $('ul.pictures');

    //Add the "add a picture" anchor and li to the tags ul
    $collectionHolder.append($newLinkLi);

    // count the current form inputs we have (e.g. 2), use that as the new
    // index when inserting a new item (e.g. 2)
    $collectionHolder.data('index', $collectionHolder.find(':input').length);

    $addPictureButton.on('click', function (e) {
        e.preventDefault();
        // add a new tag form (see next code block)
        addPicturesForm($collectionHolder, $newLinkLi);

    });
});

function addPicturesForm($collectionHolder, $newLinkLi) {
    // Get the data-prototype explained earlier
    let prototype = $collectionHolder.data('prototype');
    // get the new index
    let index = $collectionHolder.data('index');
    let newForm = prototype;
    newForm = newForm.replace(/__name__/g, index);
    // increase the index with one for the next item
    $collectionHolder.data('index', index + 1);
    // Display the form in the page in an li, before the "Add a tag" link li
    let $newFormLi = $('<li></li>').append(newForm);
    $newLinkLi.before($newFormLi);
}

//=============================================Ajout de steps===========================================//

//Ajout d'input pour les images
var $collectionStepHolder;
//setup an "add a picture" link
var $addStepButton = $('<button type="button" class="add_step_link btn btn-success">Ajouter une étape</button>');
var $newStepLinkLi = $('<li></li>').append($addStepButton);

$(document).ready(function () {
    //Get the ul that holds the collection of tags
    $collectionStepHolder = $('ul.steps');

    //Add the "add a step" anchor and li to the tags ul
    $collectionStepHolder.append($newStepLinkLi);

    // count the current form inputs we have (e.g. 2), use that as the new
    // index when inserting a new item (e.g. 2)
    $collectionStepHolder.data('index', $collectionStepHolder.find(':input').length);

    $addStepButton.on('click', function (e) {
        e.preventDefault();
        // add a new tag form (see next code block)
        addStepsForm($collectionStepHolder, $newStepLinkLi);

    });
});

function addStepsForm($collectionStepHolder, $newStepLinkLi) {
    // Get the data-prototype explained earlier
    let prototype = $collectionStepHolder.data('prototype');
    // get the new index
    let index = $collectionHolder.data('index');
    let newForm = prototype;
    newForm = newForm.replace(/__name__/g, index);
    // increase the index with one for the next item
    $collectionStepHolder.data('index', index + 1);
    // Display the form in the page in an li, before the "Add a tag" link li
    let $newFormLi = $('<li></li>').append(newForm);
    $newStepLinkLi.before($newFormLi);
}



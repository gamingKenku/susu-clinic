/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

// require('jquery');
// require('@popperjs/core');
import './bootstrap';
import $ from 'jquery';

import select2 from 'select2';
select2();

import "/node_modules/select2/dist/css/select2.css";

import Quill from 'quill';
import "/node_modules/quill/dist/quill.core.css";
import "/node_modules/quill/dist/quill.snow.css";


// import 'bootstrap-select';
import { createApp } from 'vue';

/**
 * Next, we will create a fresh Vue application instance. You may then begin
 * registering components with the application instance so they are ready
 * to use in your application's views. An example is included for you.
 */

const app = createApp({

});

import ExampleComponent from './components/ExampleComponent.vue';
app.component('example-component', ExampleComponent);

/**
 * The following block of code may be used to automatically register your
 * Vue components. It will recursively scan this directory for the Vue
 * components and automatically register them with their "basename".
 *
 * Eg. ./components/ExampleComponent.vue -> <example-component></example-component>
 */

Object.entries(import.meta.glob('./**/*.vue', { eager: true })).forEach(([path, definition]) => {
    app.component(path.split('/').pop().replace(/\.\w+$/, ''), definition.default);
});

/**
 * Finally, we will attach the application instance to a HTML element with
 * an "id" attribute of "app". This element is included with the "auth"
 * scaffolding. Otherwise, you will need to add an element yourself.
 */

app.mount('#app');


$(document).ready(function () {
    
    $(".refresh-button").on("click", function(event) {
        let unchecked_flag = $(event.target).data('unchecked-flag');
        
        let url = window.location.href;
        url = url.split('?')[0];
        
        if (url.indexOf('?') > -1){
            url += '&unchecked=' + unchecked_flag;
        } else {
            url += '?unchecked=' + unchecked_flag;
        }
        window.location.href = url;
    });
    
    $(".selectpicker").select2({
        theme: "bootstrap-5",
    });
    
    // const create_event_quill = new Quill('#event_content_editor', {
    //     modules: {
    //         toolbar: [
    //             [{ header: [1, 2, false] }],    
    //             ['bold', 'italic'],
    //             ['link', 'blockquote'],
    //             [{ list: 'ordered' }, { list: 'bullet' }],
    //         ],
    //       },
    //     placeholder: 'Введите содержание...',
    //     theme: 'snow',
    // });

    // $("#create_event_form").on('submit', function() {
    //     $("#content").val($("#event_content_editor .ql-editor").html()) 
    // })

    $('.quill-editor').each(function() {
        new Quill(this, {
            modules: {
                toolbar: [
                    [{ header: [1, 2, false] }],    
                    ['bold', 'italic'],
                    ['link', 'blockquote'],
                    [{ list: 'ordered' }, { list: 'bullet' }],
                ],
            },
            placeholder: 'Введите содержание...',
            theme: 'snow',
        });
    });
    
    // $(".quill-form").on('submit', function() {
    //     var editor = $(this).find('.ql-editor');
    //     $(this).find('.quill-content').val(editor.html());
    // });

    // $(".quill-form").on('submit', function() {
    //     var editor = $(this).find('.ql-editor');
    //     $(this).find('.quill-content').val(editor.html());
    // });

    $(".quill-form").on('submit', function() {
        $(this).find('.editor-container').each(function() {
            var editor = $(this).find('.ql-editor');
            $(this).siblings('.quill-content').val(editor.html());
        });
    });    
});

/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require('./bootstrap');

import { createApp } from 'vue';


let app=createApp({})

app.component('todo-list', require('./components/TodoList.vue').default);

app.mount("#app");
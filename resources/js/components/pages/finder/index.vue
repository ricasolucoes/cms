 import Vue from 'vue';
    import vuefinder from 'vuefinder/src/Finder.vue';

    Vue.component('vuefinder', vuefinder);

    var app = new Vue({
        el: '#app'
    });
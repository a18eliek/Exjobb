import Vue from 'vue'

require('./bootstrap');

require('alpinejs');
require('./hello.tsx');

import Hello from './hello.vue'

const hello = new Vue({
    el: '#vuejs-test',
    components: { Hello }
});
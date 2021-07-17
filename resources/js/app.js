require('./bootstrap');

// Import modules...
import { createApp, h } from 'vue';
import { App as InertiaApp, plugin as InertiaPlugin } from '@inertiajs/inertia-vue3';
import { InertiaProgress } from '@inertiajs/progress';
// import 'vue-select/dist/vue-select.css';
// import moment from 'moment'

const el = document.getElementById('app');
var moment = require('moment'); // 追記
// var vueGC = require('vue-google-charts') // 追記
// var chartjs = require('chart.js'); // 追記
// var vuechartjs = require('vue-chartjs'); //追記
// console.log(moment(new Date).format('YYYY/MM/DD')); //追記

createApp({
    render: () =>
        h(InertiaApp, {
            initialPage: JSON.parse(el.dataset.page),
            resolveComponent: (name) => require(`./Pages/${name}`).default,
        }),
})
    .mixin({ methods: { route } })
    .use(InertiaPlugin)
    .mount(el);

InertiaProgress.init({ color: '#4B5563' });

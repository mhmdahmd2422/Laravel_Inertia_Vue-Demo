import { createApp, h } from 'vue'
import {createInertiaApp, Head, Link} from '@inertiajs/vue3'
import Layout from "./Pages/Shared/Layout.vue";
import {resolvePageComponent} from "laravel-vite-plugin/inertia-helpers";

createInertiaApp({
    resolve: async (name) => {
        const { default: page } = await resolvePageComponent( `./Pages/${name}.vue`, import.meta.glob("./Pages/**/*.vue"));

        if (page.layout === undefined) {
            page.layout = Layout;
        }

        if (page.props?.layout === null) {
            page.layout = undefined;
        }

        return page;
    },
    setup({ el, App, props, plugin }) {
        createApp({render:()=> h(App, props) })
            .use(plugin)
            .component('Link', Link)
            .component('Head', Head)
            .mount(el)
    },
    title: title => `My App - ${title}`,
    progress: {
        color: 'red',
        showSpinner: true,
    }
});


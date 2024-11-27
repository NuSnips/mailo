import "../css/app.css";
import "./bootstrap";

import { createInertiaApp, Head } from "@inertiajs/vue3";
import { resolvePageComponent } from "laravel-vite-plugin/inertia-helpers";
import { createApp, h } from "vue";
import { ZiggyVue } from "../../vendor/tightenco/ziggy";
import Vueform from "@vueform/vueform";
import vueformConfig from "./../../vueform.config";

import GuestLayout from "@/Layouts/GuestLayout.vue";
import MainAppLayout from "./Layouts/MainAppLayout.vue";

const appName = import.meta.env.VITE_APP_NAME || "Mailo";

createInertiaApp({
    title: (title) => `${title} - ${appName}`,
    resolve: async (name) => {
        let page = (
            await resolvePageComponent(
                `./Pages/${name}.vue`,
                import.meta.glob("./Pages/**/*.vue")
            )
        ).default;
        if (page.layout == undefined) {
            page.layout = MainAppLayout;
        }
        return page;
    },
    setup({ el, App, props, plugin }) {
        return createApp({ render: () => h(App, props) })
            .use(plugin)
            .use(ZiggyVue)
            .use(Vueform, vueformConfig)
            .component("Head", Head)
            .mount(el);
    },
    progress: {
        color: "#4B5563",
    },
});

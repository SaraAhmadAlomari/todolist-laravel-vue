import "./bootstrap";

import { createApp } from "vue";
import App from "./vue/app.vue";

const app = createApp(App); // Create Vue app instance with App component

app.mount("#app"); // Mount Vue app to the DOM element with id "app"

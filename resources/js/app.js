require("./bootstrap");

window.Vue = require("vue");

 import vmodal from 'vue-js-modal'
    Vue.use(vmodal, { dialog: true });

// Register our components
Vue.component("kanban-board", require("./components/KanbanBoard.vue").default);

const app = new Vue({
  el: "#app"
});

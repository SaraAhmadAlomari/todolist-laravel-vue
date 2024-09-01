<template>
    <div class="todoListContainer">
        <div class="heading">
            <h2 id="title">To Do List</h2>
            <FormView v-on:reloadlist="getItem()"/>
            <ListView :items="items" v-on:reloadlist="getItem()"/>
        </div>
    </div>
</template>
<script>
import ListView from "./listView.vue";
import FormView from "./formView.vue";

export default {
    components: {
        ListView,
        FormView,
    },
    data() {
        return {
            items: [],
        };
    },
    methods: {
        getItem() {
            axios
                .get("api/items")
                .then((response) => {
                    if (response.status == 200) {
                        this.items = response.data;
                        console.log(response.data.message);
                    }
                })
                .catch((error) => {
                    console.log(error);
                });
        },
    },
    created() {
    this.getItem();
    },
};
</script>

<style lang="css" scoped>
.todoListContainer {
    width: 60%;
    margin: auto;
}
.heading {
    background-color: #ffe6e6;
    color: #ff0066;
    padding: 3px 0;
}
#title {
    text-align: center;
    font-size: 36px;
    font-weight: bold;
    font-family: 'Courier New', Courier, monospace;
}
</style>

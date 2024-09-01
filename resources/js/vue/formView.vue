<template>
    <div class="container">
        <input
            type="text"
            v-model="item.name"
            class="add-task"
            placeholder="Task..."
        />
        <span
            @click="newElement()"
            :class="[item.name ? 'active' : 'inactive', 'btn-success']"
            >  <i class="fas fa-plus"/></span
        >

    </div>
</template>
<script>
import axios from "axios";

export default {
    data: function () {
        return {
            item: {
                name: "",
            },
        };
    },
    methods: {
        newElement() {
            if (this.item.name == "") {
                return;
            }
            axios
                .post('api/item/store', { item: this.item })
                .then(response => {
                    if (response.status == 201) {
                        this.item.name = "";
                         this.$emit('reloadlist');
                        console.log(response.data);
                    }
                })
                .catch(error => {
                    console.log(error.response.data);
                });
        },
    },
};
</script>

<style scoped>
.add-task {
    width: 90%;
    padding: 10px 4px;
    margin-left: 5px;
    margin-bottom: 10px;
    border: 0;
    border-radius: 3px;
}
.btn-success {
    border-radius: 5px;
    padding: 9px 15px;
    color: white;
    border: none;
    cursor: pointer;
    margin-left: 5px;
    margin-top: 20px;
}
.active {
    background-color: #28a745;
}
.active:hover {
    background-color: #0dca39;
}
.inactive {
    background-color: gray;
}
</style>

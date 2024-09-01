<template>
    <ul class="items"  v-if="items.length > 0">
        <li v-for="item in items" :key="item.id">
            <div>
                <input type="checkbox" v-model="item.completed" @change="updateItem(item)" />
                <span :style="{ textDecoration: item.completed ? 'line-through' : 'none' }">
                {{ item.name  }}
                </span>
            </div>
            <i class="fas fa-trash" @click="deleteItem(item.id)" ></i>
        </li>
    </ul>
    <p class="empty-message" v-else>There is no tasks to do</p>



</template>

<script>
import axios from "axios";

export default {
    props: ["items"],
    methods: {
        deleteItem(id) {
            axios
                .delete("api/item/" + id)
                .then((response) => {
                    if (response.status == 201) {
                        this.$emit("reloadlist");
                        console.log(response.data);
                    }
                })
                .catch((error) => {
                    console.log(error);
                });
        },
        updateItem(item) {
              axios
                .put(`/api/item/${item.id}`,{completed:item.completed})
                .then((response) => {
                    if (response.status == 201) {
                        // this.$emit("reloadlist");
                        console.log(response.data);
                    }
                })
                .catch((error) => {
                    console.log(error);
                });
        }
    },
};
</script>

<style scoped>
ul {
    width: 100%;
    margin-top: 30px;
    padding: 0;

}

/* Style the list items */
ul li {

    cursor: pointer;
    position: relative;
    padding: 12px 8px 12px 40px;
    background: #eee;
    font-size: 18px;
    transition: 0.2s;
    list-style: none;
         display: flex;
  justify-content: space-between;
}
ul li:nth-child(odd) {
    background: #f9f9f9;
}

/* Darker background-color on hover */
ul li:hover {
    background: #ddd;
}

ul li.checked {
    background: #888;
    color: #fff;
    text-decoration: line-through;
}
/* Add a "checked" mark when clicked on */
ul li.checked::before {
    content: "";
    position: absolute;
    border-color: #fff;
    border-style: solid;
    border-width: 0 2px 2px 0;
    top: 10px;
    left: 16px;
    transform: rotate(45deg);
    height: 15px;
    width: 7px;
}
.btn-delete {
    border-radius: 5px;
    padding: 10px 30px;
    background-color: rgb(241, 43, 82);
    color: white;
    border: none;
    cursor: pointer;
    margin-left: 5px;
}
i{
    padding: 5px;
    transition: transform 0.3s ease; /* Smooth transition */
}
 i:hover{
     transform: scale(1.2); /* Scale up by 20% */
}
.empty-message{
  text-align: center;
  font-size: 1.2em;
  color: #888;
  padding: 20px;
  border: 2px dashed #ccc;
  border-radius: 10px;
  background-color: #f9f9f9;
  margin-top: 20px;
  max-width: 300px;
  margin-left: auto;
  margin-right: auto;
}

</style>

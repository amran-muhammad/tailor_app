<template>
    <div class="row">
        <Modal v-model="deleteModal" title="Are you sure delete the notification?" @on-ok="deleteCloth"
            @on-cancel="deleteModal = false" ok-text="Confirm" draggable sticky loading>

        </Modal>
    

        <div class="col-md-12">
            <h1>Notifications</h1>
            <br>
            Total Notifications: {{ notifications.length }}
            <br>
          
        </div>
       
       

        <div>

        </div>
        <table class="table">
            <thead>
                <tr>
                    <th scope="col">Tailor Name </th>
                    <th scope="col">Customer Name </th>
                    <th scope="col">Title </th>
                    <th scope="col">Message </th>
                    <th scope="col">Status </th>
                    <th scope="col">Is Seen?</th>
                   
                    <th scope="col">Action</th>
                </tr>
            </thead>
            <tbody v-if="loader">
                <div class="spinner-grow text-primary" role="status">
                    <span class="sr-only"></span>
                </div>
                <div class="spinner-grow text-secondary" role="status">
                    <span class="sr-only"></span>
                </div>
                <div class="spinner-grow text-success" role="status">
                    <span class="sr-only"></span>
                </div>
                <div class="spinner-grow text-danger" role="status">
                    <span class="sr-only"></span>
                </div>
                <div class="spinner-grow text-warning" role="status">
                    <span class="sr-only"></span>
                </div>
                <div class="spinner-grow text-info" role="status">
                    <span class="sr-only"></span>
                </div>
                <div class="spinner-grow text-light" role="status">
                    <span class="sr-only"></span>
                </div>
                <div class="spinner-grow text-dark" role="status">
                    <span class="sr-only">Loading...</span>
                </div>

            </tbody>
            <tbody v-else>
                <tr v-for="(item, index) in notifications" :key="index">
                    <td>{{ item.tailor.fname}} {{ item.tailor.lname}}</td>
                    <td>{{ item.customer.fname}} {{ item.customer.lname}}</td>
                    <td>{{item.title}}</td>
                    <td>{{item.message}}</td>
                    <td>{{item.status}}</td>
                    <td>{{ item.is_seen}}</td>
                    <td>
                        
                        <button style="margin-left:5px" class="btn btn-sm btn-danger"
                            @click="deleteClothOn(item, index)">Delete</button>
                    </td>
                </tr>

            </tbody>
        </table>
    </div>
</template>

<script>
import { ref } from 'vue'
export default {
    name: "Cloths",
    data() {
        return {
            error: ref(''),
            notifications: [],
            loader: true,
            deleteModal: ref(false),
            editIndex: -1,
          
        }
    },
    created() {
        this.get_all_notifications()
    },

    beforeRouteEnter(to, from, next) {
        if (window.Laravel.user.type != 'Admin') {
            window.location.href = "/";
        }
        next();
    },
    methods: {
        get_all_notifications() {
            this.$axios.get('/api/notifications/all?type=Admin')
                .then(response => {
                    if (response.data.data) {
                        this.loader = false
                        this.notifications = response.data.data
                    } else {
                        console.log(response);
                    }
                })
                .catch(function (error) {
                    console.error(error);
                });
        },
        
        deleteClothOn(item, index) {
            this.deleteModal = true
            this.editIndex = index
            this.edit_data.id = item.id
        },
        deleteCloth() {
            this.$axios.get('/sanctum/csrf-cookie').then(response => {
                this.$axios.post('/api/notifications/delete', {
                    id: this.edit_data.id
                })
                    .then(response => {
                        if (response.data.data) {
                            this.deleteModal = false
                            this.notifications.splice(this.editIndex, 1)
                            this.editIndex = -1
                        } else {
                            console.log(response);
                        }
                    })
                    .catch(function (error) {
                        console.error(error);
                    });
            })
        },

    },
}
</script>
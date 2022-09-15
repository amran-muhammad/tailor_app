<template>
    <div class="row">
        <Modal v-model="deleteModal" title="Are you sure delete the order?" @on-ok="deleteCloth"
            @on-cancel="deleteModal = false" ok-text="Confirm" draggable sticky loading>

        </Modal>
    
      
        <Modal v-model="editModal" title="Edit A order" @on-ok="updateCloth" @on-cancel="editModal = false"
            ok-text="Confirm" draggable sticky loading>
            <div class="col-md-12">
                <div class="card card-default">
                    <div class="card-body">
                        <div>
                            <div class="form-group row">
                                <label for="search" class="col-sm-4 col-form-label text-md-right">Order Status</label>
                                <select class="form-control" v-model="edit_data.order_status">
                                    <option value="">Choose...</option>
                                    <option value="Pending">Pending</option>
                                    <option value="Received">Received</option>
                                    <option value="Delivered">Delivered</option>
                                    <option value="Canceled">Canceled</option>
                                    <option value="Extended">Extended</option>
                                    <option value="On Delivery">On Delivery</option>
                                    <option value="Completed">Completed</option>
                                </select>
                            </div>
                            <div class="form-group row">
                                <label for="ffname" class="col-sm-4 col-form-label text-md-right">Notification Title</label>
                                <div class="col-md-12">
                                    <input id="ffname" type="text" class="form-control" v-model="edit_data.title" required
                                        autofocus autocomplete="off" placeholder="Enter Cloth Name">
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="ffname" class="col-sm-4 col-form-label text-md-right">Notification Message</label>
                                <div class="col-md-12">
                                    <textarea id="ffname" type="textarea" class="form-control" v-model="edit_data.message" required
                                        autofocus autocomplete="off" placeholder="Enter Cloth Name"></textarea>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </Modal>

        <div class="col-md-12">
            <h1>Orders</h1>
            <br>
            Total Orders: {{ orders.length }}
            <br>
            
        </div>
        <div class="col-md-6">
            <div class="form-group row">
                <div class="col-md-8">
                    
                    
                    <label for="search" class="col-sm-4 col-form-label text-md-right">Sort By</label>
                    <select class="form-control" v-model="sort">
                        <option value="">Choose...</option>
                        <option value="order_date">Order Date</option>
                        <option value="order_status">Order Status</option>
                    </select>
                    
                </div>
            </div>
        </div>
        <div class="col-md-6">
            <div class="form-group row">
                <div class="col-md-8">
                    
                    <label for="search" class="col-sm-4 col-form-label text-md-right">Sort Type</label>
                    <select class="form-control" v-model="sort_type">
                        <option value="">Choose...</option>
                        <option value="DESC">High to Low</option>
                        <option value="ASC">Low to High</option>
                    </select>
                    <label for="search" class="col-sm-4 col-form-label text-md-right">Order Status</label>
                    <select class="form-control" v-model="order_status">
                        <option value="">Choose...</option>
                        <option value="Pending">Pending</option>
                        <option value="Received">Received</option>
                        <option value="Delivered">Delivered</option>
                        <option value="Canceled">Canceled</option>
                        <option value="Extended">Extended</option>
                        <option value="On Delivery">On Delivery</option>
                        <option value="Completed">Completed</option>
                    </select>
                    <button style="margin-top:10px" class="btn btn-success" @click="sortOrder()">
                        Search
                    </button>
                </div>
            </div>
        </div>

        <div>

        </div>
        <table class="table">
            <thead>
                <tr>
                    <th scope="col">Order ID</th>
                    <th scope="col">Cloth Name</th>
                    <th scope="col">Delivery To</th>
                    <th scope="col">Order Status</th>
                    <th scope="col">Order Date</th>
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
                <tr v-for="(item, index) in orders" :key="index">
                    <td>{{ item.id}}</td>
                    <td>{{ item.cloth_name}}</td>
                    <td>{{ item.delivered_to_name}}</td>
                    <td>{{ item.order_status}}</td>
                    <td>{{ item.order_date}}</td>
                    
                    <td>
                        <button style="margin-left:5px" class="btn btn-sm btn-secondary"
                            @click="editCloth(item, index)">Edit</button>
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
    name: "Orders",
    data() {
        return {
            error: ref(''),
            orders: [],
            loader: true,
            deleteModal: ref(false),
            editModal: ref(false),
            
            edit_data: {
                id: 0,
                order_status: '',
                title:'',
                message:'',
                tailor_id: 0,
                customer_id:0,
            },
            editIndex: -1,
            sort: '',
            order_status: '',
            category_name: '',
            sort_type: 'ASC'
        }
    },
    created() {
        this.get_all_order()
    },

    beforeRouteEnter(to, from, next) {
        if (window.Laravel.user.type != 'Admin') {
            window.location.href = "/";
        }
        next();
    },
    methods: {
        get_all_order() {
            this.$axios.get('/api/orders/all?type=Admin')
                .then(response => {
                    if (response.data.data) {
                        this.loader = false
                        this.orders = response.data.data
                    } else {
                        console.log(response);
                    }
                })
                .catch(function (error) {
                    console.error(error);
                });
        },
       
        editCloth(item, index) {
            this.editModal = true
            this.editIndex = index
            this.edit_data.id = item.id
            this.edit_data.order_status = item.order_status
            this.edit_data.customer_id = item.customer_id
            this.edit_data.tailor_id = item.tailor_id
        },
       
        updateCloth() {
            this.$axios.get('/sanctum/csrf-cookie').then(response => {
                this.$axios.post('/api/orders/update/data', this.edit_data)
                    .then(response => {
                        if (response.data.data) {
                            this.editModal = false
                            this.orders[this.editIndex] = response.data.data
                        } else {
                            console.log(response);
                        }
                    })
                    .catch(function (error) {
                        console.error(error);
                    });
            })
        },
       
        sortOrder() {
            this.loader = true
            this.$axios.get('/sanctum/csrf-cookie').then(response => {
                this.$axios.get('/api/orders/sort' + '?order_status=' + this.order_status + '&sort='+ this.sort + '&sort_type='+ this.sort_type+'&user_type=Admin')
                    .then(response => {
                        if (response.data.data) {
                            this.loader = false
                            this.orders = response.data.data
                        } else {
                            console.log(response);
                        }
                    })
                    .catch(function (error) {
                        console.error(error);
                    });
            })
        },
        deleteClothOn(item, index) {
            this.deleteModal = true
            this.editIndex = index
            this.edit_data.id = item.id
        },
        deleteCloth() {
            this.$axios.get('/sanctum/csrf-cookie').then(response => {
                this.$axios.post('/api/orders/delete', {
                    id: this.edit_data.id
                })
                    .then(response => {
                        if (response.data.data) {
                            this.deleteModal = false
                            this.orders.splice(this.editIndex, 1)
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
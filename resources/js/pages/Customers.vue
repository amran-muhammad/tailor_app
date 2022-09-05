<template>
    <div class="row">
        <Modal v-model="deleteModal" title="Are you sure delete the customer?" @on-ok="deleteCustomer"
            @on-cancel="deleteModal = false" ok-text="Confirm" draggable sticky loading>

        </Modal>
        <Modal v-model="editStatusModal" title="Are you sure update the status?" @on-ok="updateCustomerStatus"
            @on-cancel="editStatusModal = false" ok-text="Confirm" draggable sticky loading>
        </Modal>
        <Modal v-model="addModal" title="Add new customer" @on-ok="addCustomer" @on-cancel="addModal = false"
            ok-text="Save" draggable sticky loading>
            <div class="col-md-12">
                <div v-if="error != ''" class="alert alert-danger alert-dismissible fade show" role="alert">
                    <button @click="error=''" type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>

                    <strong>{{ error }}</strong>
                </div>
                <div class="card card-default">
                    <div class="card-body">
                        <div>
                            <div class="form-group row">
                                <label for="ffname" class="col-sm-4 col-form-label text-md-right">First Name</label>
                                <div class="col-md-8">
                                    <input id="ffname" type="text" class="form-control" v-model="form_data.fname" required
                                        autofocus autocomplete="off" placeholder="Enter First Name">
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="llname" class="col-sm-4 col-form-label text-md-right">Last Name</label>
                                <div class="col-md-8">
                                    <input id="llname" type="text" class="form-control" v-model="form_data.lname" required
                                        autofocus autocomplete="off" placeholder="Enter Last Name">
                                </div>
                            </div>

                            <div class="form-group row mt-1">
                                <label for="email" class="col-sm-4 col-form-label text-md-right">E-Mail Address</label>
                                <div class="col-md-8">
                                    <input id="email" type="email" class="form-control" v-model="form_data.email"
                                        required autofocus autocomplete="off" placeholder="Enter Email">
                                </div>
                            </div>


                            <div class="form-group row mt-1">
                                <label for="password" class="col-md-4 col-form-label text-md-right">Password</label>
                                <div class="col-md-8">
                                    <input id="password" type="password" class="form-control"
                                        v-model="form_data.password" required autocomplete="off"
                                        placeholder="Enter password">
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="mobile" class="col-sm-4 col-form-label text-md-right">Mobile</label>
                                <div class="col-md-8">
                                    <input id="mobile" type="text" class="form-control" v-model="form_data.mobile" required
                                        autofocus autocomplete="off" placeholder="Enter Mobile Number">
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="address" class="col-sm-4 col-form-label text-md-right">Address</label>
                                <div class="col-md-8">
                                    <textarea id="address" type="text" class="form-control" v-model="form_data.address"
                                        autofocus autocomplete="off" placeholder="Enter Address"></textarea>
                                </div>
                            </div>

                            <div class="form-group row mt-1">
                                <label for="status" class="col-sm-4 col-form-label text-md-right">Status</label>
                                <div class="col-md-8">
                                    <select class="form-control" v-model="form_data.status">
                                        <option value="">Choose...</option>
                                        <option value="Pending">Pending</option>
                                        <option value="Approved">Approved</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </Modal>
        <Modal v-model="editModal" title="Edit A Customer" @on-ok="updateCustomer" @on-cancel="editModal = false"
            ok-text="Confirm" draggable sticky loading>
            <div class="col-md-12">
                <div class="card card-default">
                    <div class="card-body">
                        <div>
                            <div class="form-group row">
                                <label for="fname" class="col-sm-4 col-form-label text-md-right">First Name</label>
                                <div class="col-md-8">
                                    <input id="fname" type="text" class="form-control" v-model="edit_data.fname" required
                                        autofocus autocomplete="off" placeholder="Enter First Name">
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="lname" class="col-sm-4 col-form-label text-md-right">Last Name</label>
                                <div class="col-md-8">
                                    <input id="lname" type="text" class="form-control" v-model="edit_data.lname" required
                                        autofocus autocomplete="off" placeholder="Enter Last Name">
                                </div>
                            </div>

                            <div class="form-group row mt-1">
                                <label for="email" class="col-sm-4 col-form-label text-md-right">E-Mail Address</label>
                                <div class="col-md-8">
                                    <input id="email" type="email" class="form-control" v-model="edit_data.email"
                                        required autofocus autocomplete="off" placeholder="Enter Email">
                                </div>
                            </div>


                            <div class="form-group row">
                                <label for="mmobile" class="col-sm-4 col-form-label text-md-right">Mobile</label>
                                <div class="col-md-8">
                                    <input id="mmobile" type="text" class="form-control" v-model="edit_data.mobile" required
                                        autofocus autocomplete="off" placeholder="Enter Mobile Number">
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="address" class="col-sm-4 col-form-label text-md-right">Address</label>
                                <div class="col-md-8">
                                    <textarea id="address" type="text" class="form-control" v-model="edit_data.address"
                                        autofocus autocomplete="off" placeholder="Enter Address"></textarea>
                                </div>
                            </div>

                        </div>
                    </div>
                </div>
            </div>

        </Modal>

        <div class="col-md-6">
            <h1>Customers</h1>
            <br>
            Total Customers: {{ customers.length }}
            <br>
            <div>
                <button @click="addModal = true" class="btn btn-sm btn-secondary">Add New Customer</button>
            </div>
        </div>
        <div class="col-md-6">
            <div class="form-group row">
                <div class="col-md-8">
                    <label for="search" class="col-sm-4 col-form-label text-md-right">Find A Customer</label>
                    <input id="search" type="text" class="form-control" v-model="search" autofocus autocomplete="off"
                        placeholder="Enter Email/Mobile/First Name/Last Name">

                    <button style="margin-top:10px" class="btn btn-success" @click="searchUser()">
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
                    <th scope="col">Customer Name</th>
                    <th scope="col">Email</th>
                    <th scope="col">Mobile</th>
                    <th scope="col">Address</th>
                    <th scope="col">Status</th>
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
                <tr v-for="(item, index) in customers" :key="index">
                    <td>{{ item.fname }} {{ item.lname }}</td>
                    <td>{{ item.email }}</td>
                    <td>{{ item.mobile }}</td>
                    <td>{{ item.address }}</td>
                    <td>{{ item.status }}</td>
                    <td>
                        <button v-if="item.status == 'Pending'" class="btn btn-sm btn-success"
                            @click="editStatusModalOn(item, index)">Activate</button>
                        <button v-else class="btn btn-sm btn-info"
                            @click="editStatusModalOn(item, index)">Deactivate</button>
                        <button style="margin-left:5px" class="btn btn-sm btn-secondary"
                            @click="editCustomer(item, index)">Edit</button>
                        <button style="margin-left:5px" class="btn btn-sm btn-danger"
                            @click="deleteCustomerOn(item, index)">Delete</button>
                    </td>
                </tr>

            </tbody>
        </table>
    </div>
</template>

<script>
import { ref } from 'vue'
export default {
    name: "Customers",
    data() {
        return {
            error: ref(''),
            customers: [],
            loader: true,
            addModal: ref(false),
            deleteModal: ref(false),
            editModal: ref(false),
            editStatusModal: ref(false),
            form_data: {
                fname: '',
                lname: '',
                email: '',
                password: '',
                mobile: '',
                address: '',
                status: '',
                type: 'Customer'
            },
            edit_data: {
                id: 0,
                fname: '',
                lname: '',
                email: '',
                password: '',
                mobile: '',
                address: '',
                status: '',
                type: 'Customer'
            },
            editIndex: -1,
            search: ''
        }
    },
    created() {
        this.get_all_customer()
    },

    beforeRouteEnter(to, from, next) {
        if (window.Laravel.user.type != 'Admin') {
            window.location.href = "/";
        }
        next();
    },
    methods: {
        get_all_customer() {
            this.$axios.get('/sanctum/csrf-cookie').then(response => {
                this.$axios.get('/api/customers/all')
                    .then(response => {
                        if (response.data.data) {
                            this.loader = false
                            this.customers = response.data.data
                        } else {
                            console.log(response);
                        }
                    })
                    .catch(function (error) {
                        console.error(error);
                    });
            })
        },
        addCustomer() {
            if (this.form_data.fname == "") {
                this.error = "First Name is required!"
                return
            }
            else if (this.form_data.lname == "") {
                this.error = "Last Name is required!"
                return
            }
            else if (this.form_data.email == "") {
                this.error = "Email is required!"
                return
            }
            else if (this.form_data.password == "") {
                this.error = "Password is required!"
                return
            }
            
            else if (this.form_data.mobile == "") {
                this.error = "Mobile Number is required!"
                return
            }
            
        
            this.$axios.get('/sanctum/csrf-cookie').then(response => {
                this.$axios.post('/api/user/create/new/customer', this.form_data)
                    .then(response => {
                        if (response.data.data) {
                            this.addModal = false
                            this.customers.unshift(response.data.data)
                        } else {
                            console.log(response);
                        }
                    })
                    .catch(function (error) {
                        console.error(error);
                    });
            })
        },
        editCustomer(item, index) {
            this.editModal = true
            this.editIndex = index
            this.edit_data.id = item.id
            this.edit_data.fname = item.fname
            this.edit_data.lname = item.lname
            this.edit_data.mobile = item.mobile
            this.edit_data.address = item.address
            this.edit_data.email = item.email
        },
        editStatusModalOn(item, index) {
            this.editStatusModal = true
            this.editIndex = index
            this.edit_data.id = item.id
            this.edit_data.status = item.status == 'Pending' ? 'Approved' : 'Pending'
        },

        updateCustomer() {
            this.$axios.get('/sanctum/csrf-cookie').then(response => {
                this.$axios.post('/api/user/update/data', this.edit_data)
                    .then(response => {
                        if (response.data.data) {
                            this.editModal = false
                            this.customers[this.editIndex] = response.data.data
                        } else {
                            console.log(response);
                        }
                    })
                    .catch(function (error) {
                        console.error(error);
                    });
            })
        },
        updateCustomerStatus() {
            this.$axios.get('/sanctum/csrf-cookie').then(response => {
                this.$axios.post('/api/user/update/data', { id: this.edit_data.id, status: this.edit_data.status })
                    .then(response => {
                        if (response.data.data) {
                            this.editStatusModal = false
                            this.customers[this.editIndex].id = response.data.data.id
                            this.customers[this.editIndex].status = response.data.data.status
                        } else {
                            console.log(response);
                        }
                    })
                    .catch(function (error) {
                        console.error(error);
                    });
            })
        },
        searchUser() {
            this.loader = true
            this.$axios.get('/sanctum/csrf-cookie').then(response => {
                this.$axios.get('/api/user/search' + '?search=' + search.value + '&type=Customer')
                    .then(response => {
                        if (response.data.data) {
                            this.loader = false
                            this.customers = response.data.data
                        } else {
                            console.log(response);
                        }
                    })
                    .catch(function (error) {
                        console.error(error);
                    });
            })
        },
        deleteCustomerOn(item, index) {
            this.deleteModal = true
            this.editIndex = index
            this.edit_data.id = item.id
        },
        deleteCustomer() {
            this.$axios.get('/sanctum/csrf-cookie').then(response => {
                this.$axios.post('/api/user/delete', {
                    id: this.edit_data.id
                })
                    .then(response => {
                        if (response.data.data) {
                            this.deleteModal = false
                            this.customers.splice(this.editIndex, 1)
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
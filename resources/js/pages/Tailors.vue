<template>
    <div class="row">
        <Modal v-model="deleteModal" title="Are you sure delete the tailor?" @on-ok="deleteTailor"
            @on-cancel="deleteModal = false" ok-text="Confirm" draggable sticky loading>

        </Modal>
       
        <Modal v-model="addModal" title="Add New Tailor" @on-ok="addTailor" @on-cancel="addModal = false"
            ok-text="Confirm" draggable sticky loading>
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

                            
                        </div>
                    </div>
                </div>
            </div>

        </Modal>

        <Modal v-model="editModal" title="Edit New Tailor" @on-ok="updateTailor" @on-cancel="editModal = false"
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
            <h1>Tailors</h1>
            <br>
            Total tailors: {{ tailors.length }}
            <br>
            <div>
                <button @click="addModal = true" class="btn btn-sm btn-secondary">Add New Tailor</button>
            </div>
        </div>
        <div class="col-md-6">
            <div class="form-group row">
                <div class="col-md-8">
                    <label for="search" class="col-sm-4 col-form-label text-md-right">Find A Tailor</label>
                    <input id="search" type="text" class="form-control" v-model="search" autofocus autocomplete="off"
                        placeholder="Enter tailor Email/Mobile/First Name/Last Name">

                    <button style="margin-top:10px" class="btn btn-success" @click="searchUser()">
                        Search
                    </button>
                </div>
            </div>
        </div>
        <br>
        <table class="table">
            <thead>
                <tr>
                    <th scope="col">Tailor Name</th>
                    <th scope="col">Email</th>
                    <th scope="col">Mobile</th>
                    <th scope="col">Address</th>
                    <th scope="col">Joined</th>
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
                <tr v-for="(item, index) in tailors" :key="index">
                    <td>{{ item.fname }} {{ item.lname }}</td>
                    <td>{{ item.email }}</td>
                    <td>{{ item.mobile }}</td>
                    <td>{{ item.address }}</td>
                    <td>{{item.created_at.substring(0,10)}}
                     </td>
                    <td>
                        <button style="margin-left:5px" class="btn btn-sm btn-secondary"
                            @click="editTailor(item, index)">Edit</button>
                        <button style="margin-left:5px" class="btn btn-sm btn-danger"
                            @click="deleteTailorOn(item, index)">Delete</button>
                    </td>
                </tr>

            </tbody>
        </table>
    </div>
</template>

<script>
import { ref } from 'vue';

export default {
    name: "Tailors",
    data() {
        return {
            error: ref(''),
            deleteModal: ref(false),
            addModal: ref(false),
            editModal: ref(false),
            search: ref(''),
            tailors: [],
            editIndex: -1,
            loader: true,
            form_data: {
                fname: '',
                lname: '',
                email: '',
                password: '',
                mobile: '',
                type: 'Tailor'
            },
            edit_data: {
                id: '',
                fname: '',
                lname: '',
                email: '',
                password: '',
                mobile: '',
                type: 'Tailor'
            },
        }
    },
    created() {
        this.get_all_tailor()
    },
    beforeRouteEnter(to, from, next) {
        if (window.Laravel.user.type != 'Admin') {
            window.location.href = "/";
        }
        next();
    },
    methods: {
        get_all_tailor() {
            this.$axios.get('/api/tailors/all')
                .then(response => {
                    if (response.data.data) {
                        this.loader = false
                        this.tailors = response.data.data
                    } else {
                        console.log(response);
                    }
                })
                .catch(function (error) {
                    console.error(error);
                });
        },
        addTailor() {
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
                this.$axios.post('/api/user/create/new/tailor', this.form_data)
                    .then(response => {
                        if (response.data.data) {
                            this.addModal = false
                            this.tailors.unshift(response.data.data)
                        } else {
                            console.log(response);
                        }
                    })
                    .catch(function (error) {
                        console.error(error);
                    });
            })
        },
        editTailor(item, index) {
            this.editModal = true
            this.editIndex = index
            this.edit_data.id = item.id
            this.edit_data.fname = item.fname
            this.edit_data.lname = item.lname
            this.edit_data.mobile = item.mobile
            this.edit_data.address = item.address
            this.edit_data.email = item.email
        },

        updateTailor() {
            this.$axios.get('/sanctum/csrf-cookie').then(response => {
                this.$axios.post('/api/user/update/data', this.edit_data)
                    .then(response => {
                        if (response.data.data) {
                            this.editModal = false
                            this.tailors[this.editIndex] = response.data.data
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
                this.$axios.get('/api/user/search' + '?search=' + search.value + '&type=Tailor')
                    .then(response => {
                        if (response.data.data) {
                            this.loader = false
                            this.tailors = response.data.data
                        } else {
                            console.log(response);
                        }
                    })
                    .catch(function (error) {
                        console.error(error);
                    });
        },
        deleteTailorOn(item, index) {
            this.deleteModal = true
            this.editIndex = index
            this.edit_data.id = item.id
        },
        deleteTailor() {
            this.$axios.get('/sanctum/csrf-cookie').then(response => {
                this.$axios.post('/api/user/delete', {
                    id: this.edit_data.id
                })
                    .then(response => {
                        if (response.data.data) {
                            this.deleteModal = false
                            this.tailors.splice(this.editIndex, 1)
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
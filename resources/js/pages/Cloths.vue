<template>
    <div class="row">
        <Modal v-model="deleteModal" title="Are you sure delete the cloth?" @on-ok="deleteCloth"
            @on-cancel="deleteModal = false" ok-text="Confirm" draggable sticky loading>

        </Modal>
        <Modal v-model="editStatusModal" title="Are you sure update the status?" @on-ok="updateClothStatus"
            @on-cancel="editStatusModal = false" ok-text="Confirm" draggable sticky loading>
        </Modal>
        <Modal v-model="addModal" title="Add new cloth" @on-ok="addCloth" @on-cancel="addModal = false"
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
                                <label for="ffname" class="col-sm-4 col-form-label text-md-right">Cloth Name</label>
                                <div class="col-md-8">
                                    <input id="ffname" type="text" class="form-control" v-model="form_data.cloth_name" required
                                        autofocus autocomplete="off" placeholder="Enter Cloth Name">
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="llname" class="col-sm-4 col-form-label text-md-right">Image Link</label>
                                <div class="col-md-8">
                                    <input id="llname" type="text" class="form-control" v-model="form_data.image" required
                                        autofocus autocomplete="off" placeholder="Paste Image Link">
                                </div>
                            </div>

                            <div class="form-group row mt-1">
                                <label for="password" class="col-md-4 col-form-label text-md-right">Price</label>
                                <div class="col-md-8">
                                    <input id="password" min="0" type="number" class="form-control"
                                        v-model="form_data.price" required autocomplete="off"
                                        placeholder="Enter Price">
                                </div>
                            </div>

                            
                            <div class="form-group row">
                                <label for="address" class="col-sm-4 col-form-label text-md-right">Description</label>
                                <div class="col-md-8">
                                    <textarea id="address" type="text" class="form-control" v-model="form_data.description"
                                        autofocus autocomplete="off" placeholder="Enter Description"></textarea>
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
                            <div class="form-group row mt-1">
                                <label for="status" class="col-sm-4 col-form-label text-md-right">Category Name</label>
                                <div class="col-md-8">
                                    <select class="form-control" v-model="form_data.category_name">
                                        <option value="">Choose...</option>
                                        <option value="Male">Male</option>
                                        <option value="Female">Female</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </Modal>
        <Modal v-model="editModal" title="Edit A Cloth" @on-ok="updateCloth" @on-cancel="editModal = false"
            ok-text="Confirm" draggable sticky loading>
            <div class="col-md-12">
                <div class="card card-default">
                    <div class="card-body">
                        <div>
                            <div class="form-group row">
                                <label for="ffname" class="col-sm-4 col-form-label text-md-right">Cloth Name</label>
                                <div class="col-md-8">
                                    <input id="ffname" type="text" class="form-control" v-model="edit_data.cloth_name" required
                                        autofocus autocomplete="off" placeholder="Enter Cloth Name">
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="llname" class="col-sm-4 col-form-label text-md-right">Image Link</label>
                                <div class="col-md-8">
                                    <input id="llname" type="text" class="form-control" v-model="edit_data.image" required
                                        autofocus autocomplete="off" placeholder="Paste Image Link">
                                </div>
                            </div>

                            <div class="form-group row mt-1">
                                <label for="password" class="col-md-4 col-form-label text-md-right">Price</label>
                                <div class="col-md-8">
                                    <input id="password" min="0" type="number" class="form-control"
                                        v-model="edit_data.price" required autocomplete="off"
                                        placeholder="Enter Price">
                                </div>
                            </div>

                            
                            <div class="form-group row">
                                <label for="address" class="col-sm-4 col-form-label text-md-right">Description</label>
                                <div class="col-md-8">
                                    <textarea id="address" type="text" class="form-control" v-model="edit_data.description"
                                        autofocus autocomplete="off" placeholder="Enter Description"></textarea>
                                </div>
                            </div>

                            <div class="form-group row mt-1">
                                <label for="status" class="col-sm-4 col-form-label text-md-right">Status</label>
                                <div class="col-md-8">
                                    <select class="form-control" v-model="edit_data.status">
                                        <option value="">Choose...</option>
                                        <option value="Pending">Pending</option>
                                        <option value="Approved">Approved</option>
                                    </select>
                                </div>
                            </div>
                            <div class="form-group row mt-1">
                                <label for="status" class="col-sm-4 col-form-label text-md-right">Category Name</label>
                                <div class="col-md-8">
                                    <select class="form-control" v-model="edit_data.category_name">
                                        <option value="">Choose...</option>
                                        <option value="Male">Male</option>
                                        <option value="Female">Female</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </Modal>

        <div class="col-md-6">
            <h1>Cloths</h1>
            <br>
            Total Cloths: {{ cloths.length }}
            <br>
            <div>
                <button @click="addModal = true" class="btn btn-sm btn-secondary">Add New Cloth</button>
            </div>
        </div>
        <div class="col-md-6">
            <div class="form-group row">
                <div class="col-md-8">
                    <label for="search" class="col-sm-4 col-form-label text-md-right">Find A Cloth</label>
                    <input id="search" type="text" class="form-control" v-model="search" autofocus autocomplete="off"
                        placeholder="Enter Email/Mobile/First Name/Last Name">

                    <button style="margin-top:10px" class="btn btn-success" @click="searchCloth()">
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
                    <th scope="col">Cloth Name</th>
                    <th scope="col">Category</th>
                    <th scope="col">Price</th>
                    <th scope="col">Image</th>
                    <th scope="col">Description</th>
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
                <tr v-for="(item, index) in cloths" :key="index">
                    <td>{{ item.cloth_name}}</td>
                    <td>{{ item.category_name }}</td>
                    <td>{{ item.price }}</td>
                    <td> <img height="100" width="100" :src="item.image"></td>
                    <td>{{ item.description }}</td>
                    <td>{{ item.status }}</td>
                    <td>
                        <button v-if="item.status == 'Pending'" class="btn btn-sm btn-success"
                            @click="editStatusModalOn(item, index)">Activate</button>
                        <button v-else class="btn btn-sm btn-info"
                            @click="editStatusModalOn(item, index)">Deactivate</button>
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
    name: "Cloths",
    data() {
        return {
            error: ref(''),
            cloths: [],
            loader: true,
            addModal: ref(false),
            deleteModal: ref(false),
            editModal: ref(false),
            editStatusModal: ref(false),
            form_data: {
                cloth_name: '',
                price: 0,
                category_name: '',
                image: '',
                description: '',
                status: '',
            },
            edit_data: {
                id: 0,
                cloth_name: '',
                price: 0,
                category_name: '',
                image: '',
                description: '',
                status: '',
            },
            editIndex: -1,
            search: ''
        }
    },
    created() {
        this.get_all_cloth()
    },

    beforeRouteEnter(to, from, next) {
        if (window.Laravel.user.type != 'Admin') {
            window.location.href = "/";
        }
        next();
    },
    methods: {
        get_all_cloth() {
            this.$axios.get('/api/cloths/all')
                .then(response => {
                    if (response.data.data) {
                        this.loader = false
                        this.cloths = response.data.data
                    } else {
                        console.log(response);
                    }
                })
                .catch(function (error) {
                    console.error(error);
                });
        },
        addCloth() {
            if (this.form_data.cloth_name == "") {
                this.error = "CLoth Name is required!"
                return
            }
            else if (this.form_data.image == "") {
                this.error = "Image link is required!"
                return
            }
            else if (this.form_data.price == 0) {
                this.error = "Price is required!"
                return
            }
            else if (this.form_data.description == "") {
                this.error = "Description is required!"
                return
            }
            
            this.$axios.get('/sanctum/csrf-cookie').then(response => {
                this.$axios.post('/api/user/create/new/cloth', this.form_data)
                    .then(response => {
                        if (response.data.data) {
                            this.addModal = false
                            this.cloths.unshift(response.data.data)
                        } else {
                            console.log(response);
                        }
                    })
                    .catch(function (error) {
                        console.error(error);
                    });
            })
        },
        editCloth(item, index) {
            this.editModal = true
            this.editIndex = index
            this.edit_data.id = item.id
            this.edit_data.cloth_name = item.cloth_name
            this.edit_data.price = item.price
            this.edit_data.category_name = item.category_name
            this.edit_data.image = item.image
            this.edit_data.description = item.description
            this.edit_data.status = item.status
        },
        editStatusModalOn(item, index) {
            this.editStatusModal = true
            this.editIndex = index
            this.edit_data.id = item.id
            this.edit_data.status = item.status == 'Pending' ? 'Approved' : 'Pending'
        },

        updateCloth() {
            this.$axios.get('/sanctum/csrf-cookie').then(response => {
                this.$axios.post('/api/user/update/data', this.edit_data)
                    .then(response => {
                        if (response.data.data) {
                            this.editModal = false
                            this.cloths[this.editIndex] = response.data.data
                        } else {
                            console.log(response);
                        }
                    })
                    .catch(function (error) {
                        console.error(error);
                    });
            })
        },
        updateClothStatus() {
            this.$axios.get('/sanctum/csrf-cookie').then(response => {
                this.$axios.post('/api/user/update/data', { id: this.edit_data.id, status: this.edit_data.status })
                    .then(response => {
                        if (response.data.data) {
                            this.editStatusModal = false
                            this.cloths[this.editIndex].id = response.data.data.id
                            this.cloths[this.editIndex].status = response.data.data.status
                        } else {
                            console.log(response);
                        }
                    })
                    .catch(function (error) {
                        console.error(error);
                    });
            })
        },
        searchCloth() {
            this.loader = true
            this.$axios.get('/sanctum/csrf-cookie').then(response => {
                this.$axios.get('/api/cloth/search' + '?search=' + search.value + '&type=Cloth')
                    .then(response => {
                        if (response.data.data) {
                            this.loader = false
                            this.cloths = response.data.data
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
                this.$axios.post('/api/cloth/delete', {
                    id: this.edit_data.id
                })
                    .then(response => {
                        if (response.data.data) {
                            this.deleteModal = false
                            this.cloths.splice(this.editIndex, 1)
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
<template>
    <div class="container">
        <nav class="navbar navbar-expand-sm navbar-light bg-light mb-4">
            <a class="navbar-brand" href="#">Tailor App</a>
            <button class="navbar-toggler d-lg-none" type="button" data-bs-toggle="collapse" data-bs-target="#collapsibleNavId" aria-controls="collapsibleNavId"
                aria-expanded="false" aria-label="Toggle navigation"></button>
            <div class="navbar-nav" v-if="isLoggedIn">
                <router-link to="/dashboard" class="nav-item nav-link">Dashboard</router-link>
            </div>
            <div class="navbar-nav" v-if="isLoggedIn && type=='Admin'">
                <router-link to="/tailors" class="nav-item nav-link">Tailors</router-link>
                <router-link to="/customers" class="nav-item nav-link">Customers</router-link>
                <router-link to="/cloths" class="nav-item nav-link">Cloths</router-link>
                <router-link to="/orders" class="nav-item nav-link">Orders</router-link>
                <router-link to="/notifications" class="nav-item nav-link">Notifications</router-link>
            </div>
        
            
            
            <div class="navbar-nav" v-if="isLoggedIn">
                <a class="nav-item nav-link" style="cursor: pointer;" @click="logout">Logout</a>
            </div>
            <div class="navbar-nav" v-else>
                <router-link to="/" class="nav-item nav-link">Home</router-link>
                <router-link to="/login" class="nav-item nav-link">Login</router-link>
            </div>
        </nav>


        <router-view></router-view>
    </div>
</template>
<script>
    export default {
        name: "App",
        data() {
            return {
                isLoggedIn: false,
                type:'',
                name:''
            }
        },
        created() {
            if (window.Laravel.isLoggedin) {
                this.isLoggedIn = true
                this.type = window.Laravel.user.type
                this.name = window.Laravel.user.name
            }
        },
        methods: {
            logout(e) {
                e.preventDefault()
                this.$axios.get('/sanctum/csrf-cookie').then(response => {
                    this.$axios.post('/api/logout')
                    .then(response => {
                        if(response.data.success) {
                            window.location.href = "/"
                        } else {
                            console.log(response);
                        }
                    })
                    .catch(function (error) {
                        console.error(error);
                    });
                })
            }
        },
    }


</script>
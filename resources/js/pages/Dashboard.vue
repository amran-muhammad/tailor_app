<template>
    <div class="row">
        

        <h1>Dashboard ({{user.fname}} {{user.lname}})</h1>
        
       
        
    </div>
</template>

<script>
export default {
    name: "Dashboard",
    data() {
        return {
            user: {},
        }
    },
    created() {
        if (window.Laravel.user) {
            this.user = window.Laravel.user
        }
    },
    beforeRouteEnter(to, from, next) {
        if (!window.Laravel.user) {
            window.location.href = "/";
        }
        next();
    },
}
</script>
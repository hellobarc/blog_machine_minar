<template lang="">
    <div>
        <form @submit.prevent="login">
            <input type="email" v-model="credential.email" placeholder="Enter your email" id="email">
            <br>
            <input type="password" v-model="credential.password" placeholder="*******" id="password">
            <button type="submit">Sumbit</button>
        </form>
    </div>
</template>
<script>
export default {
    head(){
        return{
            title: 'login',
        };
    },
    data(){
        return{
            credential:{
                email:'',
                password:'',
            }
        };
    },
    methods:{
        login(){
            this.$auth.loginWith('laravelJWT', { data: this.credential })
        },
    }
}
</script>

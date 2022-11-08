<template lang="">
    <div>
        <Login/>
        <nuxt/>
    </div>
</template>
<script>
export default {
    created(){
        console.log(process.env.URL)
    }
}
</script>
<style lang="">
    
</style>
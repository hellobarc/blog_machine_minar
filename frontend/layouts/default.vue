<template lang="">
    <div>
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
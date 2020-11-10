<template>

    <option v-for="room in rooms"> {{ room.name }} </option>

</template>

<script>
    export default {
        data(){
            return {

            }

        },
        mounted() {
            console.log('Component mounted.')
        }
    }
</script>
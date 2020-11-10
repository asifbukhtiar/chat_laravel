<template>

    <div class="chatwindow">
        <ul class="list-group" v-if="users && users.length">
            <li class="list-group-item active">{{users[0].username}}</li>
            <li class="list-group-item" v-for="msg in messages">

                <p>{{ msg.sender.username }}</p>
                <p>{{ msg.message }}</p>


            </li>
            <li class="list-group-item">

                <input type="text" class="form-control" v-model="message" v-on:keyup.enter="sendMessage"/>
            </li>


        </ul>
    </div>


</template>
<style>
    .chatwindow{
        position: relative;
        width:594px;

        right: 479px;
        top: 180px;
    }

</style>

<script>
    export default {
        props: ['dta'],
        data() {
            return{
                messages: [],
                message: '',
                users: []
            }
        },
        sockets:{
            connect: function(){
                console.log('privatechat connected')
            },
            privatechat: function(val){
                this.getMessage();
            }
        },
        methods: {
            sendMessage(){
                axios.post('/chat/privateMessages', {id: this.$props.dta, body:this.message}).then(response => {
                    console.log(response);
                });
                this.message = '';
            },

            getMessage(){
                axios.get('/chat/privateMessages/'+this.$props.dta).then(response => {
                    this.messages = response.data;
                }).catch(function (error) {
                    console.log(error);
                });
            },
            getClickedUser(){
                axios.get('/chat/getUsername/' + this.$props.dta).then(response => {
                    this.users = response.data;
                }).catch(function (error) {
                    console.log(error);
                });
            }
        },
        mounted() {
            this.getMessage();
            this.getClickedUser();
        }
    }
</script>

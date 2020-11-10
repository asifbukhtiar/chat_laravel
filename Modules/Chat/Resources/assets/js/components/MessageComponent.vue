<template>
        <div>
        <div v-if="messages && messages.length">
            <div class="media" v-for="msg in messages">
                <div>
                        <img :src="msg.pic" class="img-circle" width="50" height="50"/>

                </div>
                <div style="text-align: left; margin-right: 8px;">
                     {{ msg.username }} :</div>
                <div class="media-body">
                     {{ msg.message }}
                </div>
            </div>
        </div>
            <div v-else>Not Found</div>
    <div class="form-group">
    <input type="text" class="form-control" v-model="message" v-on:keyup.enter="sendMessage"/>
        <select v-model="selected" v-on:change="getRoomMessages">
            <option disabled value="">Please select Chatroom</option>
            <option v-for="room in options" v-bind:value="room.id">
            {{ room.name }}
            </option>

        </select>

    </div>
        </div>
</template>

<script>
    export default {
        data() {
            return{
                messages: [],
                message: '',
                options: [],
                selected: ''
            }
        },
        sockets:{
            connect: function(){
                console.log('socket connected')
            },
            message: function(val){
                this.getMessage();

            }

        },
        methods: {
            sendMessage(){
                axios.post('/chat/messages', {name: '', body:this.message, chatroom: this.selected}).then(response => {
                    console.log(response);
                });
              this.message = '';
            },

            getMessage(){
                axios.get('/chat/messages').then(response => {
                    this.messages = response.data;
                }).catch(function (error) {
                   console.log(error);
                });
            },

            getChatrooms(){
                axios.get('/chat/rooms').then(response => {
                    this.options = response.data;
                }).catch(function (error) {
                    console.log(error);
                });
            },

            getRoomMessages(){
                axios.post('/chat/roomMessages', {id: this.selected}).then(response => {
                    this.messages = response.data;
                }).catch(function (error) {
                    console.log(error);
                });
            }
        },
        mounted() {
            this.getMessage();
            this.getChatrooms();
        }
    }
</script>

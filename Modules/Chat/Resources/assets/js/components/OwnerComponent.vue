<template>
    <div class="wrapper">

        <ul v-if="ownerUser && ownerUser.length" v-for="user in ownerUser" @contextmenu.prevent="$refs.menu.open($event, user.id)">
            <li>
                <p style="float: left;"><img :src="user.pic" width="50" height="50" class="img-circle"></p>
                <p style="float: left; padding: 7px;">{{ user.username }}</p>
                <ul class="inner-imgs">
                    <li>
                        <img src="assets/images/whisper.png">

                        <span style="color: rgb(244, 100, 95);
    font-size: 15px;
    position: absolute;
    top: 41px;
    left: 146px;"  v-for="notis in count">{{ notis.NotifyCounts }}</span>
                        <img src="assets/images/chat.png" v-popover:foo>
                        <img src="assets/images/friends.png">
                        <img src="assets/images/request.png">
                        <img src="assets/images/settings.png" v-popover:settings>
                    </li>

                </ul>
            </li>

        </ul>

        <popover name="settings">

            <ul>
                <li v-on:click="changeChatName">Change Chat Name</li>
                <li>Change Status</li>
                <li>No Private Chat</li>
                <li>No Invention</li>
            </ul>
        </popover>


        <popover name="foo" v-if="count.length > 0">

            <button class="btn btn-success" v-on:click="acceptChat(count[0].from)">Accept</button>
            <button class="btn btn-danger" v-on:click="rejectChat(count[0].from)">Reject</button>
        </popover>



    </div>



</template>


<script>
    import Popover  from 'vue-js-popover'
    Vue.use(Popover)
    export default {
        data(){
            return{
                ownerUser: '',
                count: '',
                clicked : false
            }
        },

        methods: {
            getOwnerUsers(){
                axios.get('/chat/owner').then(response => {
                    this.ownerUser = response.data

                    this.$nextTick(function() {
                        $('[data-toggle="popover"]').popover()
                    })

                }).catch(function(errors){
                    console.log(errors);
                });
            },

            getNotificationCount(){
                axios.get('/chat/counts').then(response => {
                    this.count.push(response.data)
                })
                    .catch(function(errors){
                    console.log(errors);
                });

            },
            changeChatName(){
                axios.get('/chat/change').then(response => {
                    this.count.push(response.data)
                })
                    .catch(function(errors){
                        console.log(errors);
                    });
            },

            acceptChat(id){
                axios.get('/chat/updateStatus/'+id).then(response => {
                    this.clicked = true
                }).catch(function(errors){
                    console.log(errors);
                });
            }

        },
        mounted(){
            this.getOwnerUsers();
            this.getNotificationCount();
        }
    }

</script>
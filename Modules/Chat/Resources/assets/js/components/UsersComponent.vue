<template>
  <div class="wrapper">
     <h4 style="margin-top: 45px;">Users</h4>

        <ul v-if="users && users.length" v-for="user in users" @contextmenu.prevent="$refs.menu.open($event, user.id)">
          <li v-if="user.userOnline === true ">
              <p style="float: left;"><img :src="user.pic" width="50" height="50" class="img-circle"></p>
              <p style="float: left; padding: 7px;">{{ user.username }}</p>
              <ul class="inner-imgs">
                  <li>
                      <img src="assets/images/whisper.png">
                      <img src="assets/images/chat.png" >
                      <img src="assets/images/friends.png">
                      <img src="assets/images/request.png">
                      <img src="assets/images/settings.png">
                  </li>

              </ul>
          </li>

        </ul>
      <vContext ref="menu">
          <template slot-scope="child">
          <ul>
              <li @click="onClick($event.target.innerText)">Profile</li>
              <li @click="addFriend(child.userData)">Add Friend</li>
              <li @click="onClick($event.target.innerText)">No More Friend</li>
              <li @click="onClick($event.target.innerText)">Talk To</li>
              <li @click="whisperTo(child.userData)">Whisper To</li>
              <li @click="privatechat(child.userData)">Private Chat</li>
              <li @click="onClick($event.target.innerText)">Ignore</li>
              <li @click="onClick($event.target.innerText)">Unignore</li>
              <li @click="onClick($event.target.innerText)">Block</li>
              <li @click="onClick($event.target.innerText)">Unblock</li>
              <li @click="onClick($event.target.innerText)">Bounce</li>
              <li @click="onClick($event.target.innerText)">Report</li>
          </ul>
          </template>
      </vContext>

      <private-chat :dta="id" v-if="clicked"></private-chat>
  </div>


</template>
<style>
    #menu {
        display: none;
    }


</style>
<script>

export default {
        data(){
          return{
              users: [],
              id: [],
              clicked : false
          }
        },
       methods:{
           getUsers(){
                axios.get('/chat/loadusers').then(response => {
                    this.users = response.data;
                }).catch(function(errors){
                    console.log(errors);
                });
            },
           notiFied(value, type){
               axios.get('/chat/notifications/'+value+'/'+type).then(response => {
                   //this.content = response.data;
                   console.log(response.data);

               }).catch(function(errors){
                   console.log(errors);
               });

             },

           privatechat(id)
           {
               axios.get('/chat/private/'+id).then(response => {
                   this.id = id;
                   this.clicked = true
               }).catch(function(errors){
                   console.log(errors);
               });
           },
           whisperTo(id) {
               axios.post('/chat/messages/', {id: id}).then(response => {
                   this.id = id;
                   this.clicked = true
               }).catch(function(errors){
                   console.log(errors);
               });
           },
           addFriend(id){
               alert(id);
           }
       },
        mounted() {
           this.getUsers();

        }
    }


</script>

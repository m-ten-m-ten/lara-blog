<template>
  <table class="m-admin-table">
    <tr>
      <th>名前</th>
      <th>メールアドレス</th>
      <th>メッセージ数</th>
      <th></th>
    </tr>
    <tbody>
        <tr v-for="user in users">
          <td>{{ user.name }}</td>
          <td>{{ user.email }}</td>
          <td>{{ user.messages_count }}</td>
          <td class="nowrap">
            <button class="text-link" @click="deleteUser(user.id)" value="削除">削除</button></td>
        </tr>
    </tbody>
  </table>
</template>

<script>
  export default {
    data(){
      return {
        users: []
      }
    },
    methods: {
      deleteUser(id){
        axios.delete('/admin/user/destroy/' + id).then(response => {
          this.users = response.data;
          });
      }
    },
    mounted() {
      axios.get('/admin/users').then(response => this.users = response.data);
    }
  }
</script>
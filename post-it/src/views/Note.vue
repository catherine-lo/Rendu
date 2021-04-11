<template>
  <div v-if="note" class="boxe">
    <h2>{{ note.text }}</h2>
    <p>{{ note.description }}</p>
  </div>
  <div v-else>
    <p>Loading note...</p>
  </div>
  <router-link to="/" class="btn">Go back</router-link>
</template>

<script>
export default {
  data() {
    return {
      note: Object
    }
  },
  mounted() {
    fetch('/api/notes/'+ this.$route.params.id)
      .then(res => res.json())
      .then(data => this.note = data)
      .catch(err => console.log(err.message))
  }
}
</script>

<style>
    *{
        margin:0;
        padding:0;
        align-items: center;
    }
    body{
        font-family:arial,sans-serif;
        font-size:100%;
        margin:3em;
        color:#fff;
    }
    h2,p{
        font-size:100%;
        font-weight:normal;
        color: black;
    }
    .boxe{
        list-style:none;
        overflow:hidden;
        padding:3em;
        text-decoration:none;
        color:#000;
        background:#f6ff7a;
        display:block;
        height:30em;
        width:50em;
        padding:1em;
        -moz-box-shadow:5px 5px 7px rgba(33,33,33,1);
        /* Safari+Chrome */
        -webkit-box-shadow: 5px 5px 7px rgba(33,33,33,.7);
        /* Opera */
        box-shadow: 5px 5px 7px rgba(33,33,33,.7);
        -moz-transition:-moz-transform .15s linear;
        -o-transition:-o-transform .15s linear;
        -webkit-transition:-webkit-transform .15s linear;
        margin:1em;
        float:left;
        font-size:100%;
        font-weight:bold;
        padding-bottom:10px;
        font-family:"Reenie Beanie",arial,sans-serif;
    }
    h2{
        font-size:140%;
        font-weight:bold;
        padding-bottom:10px;
    }
    p{
      padding: 10px;
      font-family:"Reenie Beanie",arial,sans-serif;
        font-size:180%;
        overflow-wrap: break-word;
    }

</style>

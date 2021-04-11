<template>

  <router-view></router-view>

</template>

<script>



export default {
  name: 'App',
  
}
</script>

<style>
 *{
        margin:0;
        padding:0;
    }
   
body{
        font-family:arial,sans-serif;
        font-size:100%;
        margin:3em;
        background: pink;
        color:#fff;
    }


.btn {
  display: inline-block;
  background: black;
  color: white;
  border: none;
  padding: 10px 20px;
  margin: 5px;
  border-radius: 5px;
  cursor: pointer;
  text-decoration: none;
  font-size: 15px;
  font-family: inherit;
}

.btn:focus{
  outline: none;
}
</style>

<template>
    <div class="note">
    <i @click="onDelete(note.id)" class= "fas fa-times"></i>
    <router-link :to="{ name: 'Note', params: { id: note.id }}" class="router">
        <li>
        <h3>{{note.text}} </h3>
        <p> {{ note.description.substring(0, 80) + "..."}} </p>
        </li>
    </router-link>
    </div>
</template>

<script>  
    export default {
        name: 'Note',
        props:{
            note: Object
        },
        methods:{
            onDelete(id){
                this.$emit('delete-note', id)
            },
        } 
    }
</script>

<style scoped>    
    .fas{
        color: red;
        transform: scale(2.2,2);
        margin-left: -15px;
    }

    h2,p{
        font-size:100%;
        font-weight:normal;
        color: black;
        
    }

    li{
         text-decoration:none;
        color:#000;
        background:#f6ff7a;
        display:block;
        height:15em;
        width:15em;
        padding:1em;
        -moz-box-shadow:5px 5px 7px rgba(33,33,33,1);
        /* Safari+Chrome */
        -webkit-box-shadow: 5px 5px 7px rgba(33,33,33,.7);
        /* Opera */
        box-shadow: 5px 5px 7px rgba(33,33,33,.7);
        -moz-transition:-moz-transform .15s linear;
        -o-transition:-o-transform .15s linear;
        -webkit-transition:-webkit-transform .15s linear;
    }
    
    .note{
        padding: 30px;
    }

    p{
        padding: 10px;
        overflow-wrap: break-word;
    }

    .router{
        text-decoration: none;
    }

</style>